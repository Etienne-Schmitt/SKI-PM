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
        $repo = $this->getDoctrine()->getRepository(News::class);
        // $news = $repo->find(1); // Récupère une cible
        $news = $repo->findAll(); // Récupère tout
        // $manager = $this->getDoctrine()->getManager();
        // $manager->remove($new); // Pour supprimer
        // $manager->flush();

        return $this->render('home/homepage.html.twig', [
            'controller_name' => 'HomeController',
            'news' => $news,
        ]);
    }
}
