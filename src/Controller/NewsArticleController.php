<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsArticleController extends AbstractController
{
    /**
     * @Route("/news/{article_id}", name="news_article")
     */
    public function index(int $article_id)
    {
        return $this->render('news_article/news_article.html.twig', [
            'controller_name' => 'NewsArticleController',
        ]);
    }
}
