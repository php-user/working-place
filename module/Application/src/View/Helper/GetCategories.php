<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Doctrine\ORM\EntityManagerInterface;
use Application\Entity\Category;

class GetCategories extends AbstractHelper
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke()
    {
        $result = $this->entityManager->getRepository(Category::class)->findBy(['isVisible' => 1]);

        $categories = [];
        foreach ($result as $category) {
            $categories[$category->getParent()][] = $category;
        }

        return $this->buildTree($categories, null);
    }

    private function buildTree($cat, $catId)
    {
        $output = '';

        if (is_array($cat) && isset($cat[$catId])) {
            $output .= '<ul class="topnav list-group list-unstyled">';
            foreach ($cat[$catId] as $category) {
                $output .= '<li><a href="#" class="list-group-item">' . $category->getName() . '</a>';
                $output .= $this->buildTree($cat, $category->getId());
                $output .= '</li>';
            }
            $output .= '</ul>';
        }

        return $output;
    }
}
