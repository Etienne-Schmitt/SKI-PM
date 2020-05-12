<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home page")
     */
    public function index()
    {
        // $repoNews = $this->getDoctrine()->getRepository(News::class);
        // $news = $repo->find(1); // Récupère une cible
        // $news = $repo->findAll(); // Récupère tout
        // $manager = $this->getDoctrine()->getManager();
        // $manager->remove($new); // Pour supprimer
        // $manager->flush();

        $newsNumber = 5;

        // define("NEWS_NUMBER", 5);

        $news = $this
            ->getDoctrine()
            ->getRepository(News::class)
            ->findBy([], ['date' => 'DESC'], $newsNumber);
            
            // var_dump($news);
        
        return $this->render('home/homepage.html.twig', [
            'controller_name' => 'HomeController',
            'news' => $news,

        ]);
    }
}
