<?php

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;
use Authentication\Form\RegisterForm;
use Application\Entity\User;
use Authentication\Service\ValidationServiceInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Crypt\Password\Bcrypt;

class RegisterController extends AbstractActionController
{
    private $entityManager;
    private $registerForm;
    private $validationService;
    private $ormAuthService;

    public function __construct(
        EntityManagerInterface $entityManager,
        RegisterForm $registerForm,
        ValidationServiceInterface $validationService,
        $ormAuthService
    ) {
        $this->entityManager      = $entityManager;
        $this->registerForm       = $registerForm;
        $this->validationService  = $validationService;
        $this->ormAuthService     = $ormAuthService;
    }

    public function indexAction()
    {
        if ($this->identity()) {
            return $this->redirect()->toRoute('home');
            die;
        }

        $user = new User();
        $form = $this->registerForm;

        $form->setHydrator(new DoctrineObject($this->entityManager));
        $form->bind($user);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $repository = $this->entityManager->getRepository(User::class);

                if ($this->validationService->isObjectExists($repository, $user->getName(), ['name'])) {
                    $nameExists = 'User with name ' . $user->getName() . ' exists already';
                    $form->get('name')->setMessages(['nameExists' => $nameExists]);
                    return ['form' => $form];
                }

                $cloneUser = clone $user; // to have not hashed password

                $hash = (new Bcrypt())->create($user->getPassword());
                $user->setPassword($hash);

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $this->entityManager->getRepository(User::class)->login($cloneUser, $this->ormAuthService);

                return $this->redirect()->toRoute('home');
            }
        }

        return new ViewModel(['form' => $form]);
    }
}
