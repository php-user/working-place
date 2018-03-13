<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;
use Application\Entity\Article;
use Application\Entity\Category;

class ArticleController extends AbstractActionController
{
    private $entityManager;
    private $articleRepository;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->articleRepository = $this->entityManager->getRepository(Article::class);
        $this->categoryRepository = $this->entityManager->getRepository(Category::class);
    }

    public function indexAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $articles = $this->articleRepository->findBy(['category' => $id]);
        $category = $this->categoryRepository->find($id);

        return new ViewModel([
            'articles' => $articles,
            'category' => $category,
        ]);
    }

    public function pageAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $article = $this->articleRepository->find($id);

        return new ViewModel([
            'article' => $article,
        ]);
    }
}
