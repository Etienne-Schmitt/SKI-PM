<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;
use App\Entity\RaceResult;
use App\Repository\RaceResultRepository;

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

        /** @var RaceResultRepository $raceResultRepo */
        $raceResultRepo =  $this->getDoctrine()
            ->getRepository(RaceResult::class);
 
        $rapideResults = $raceResultRepo
            ->lastPodiumResults(2);

        $fondResults = $raceResultRepo
            ->lastPodiumResults(1);     



        // $rapideResults = $this
        //     ->getDoctrine()
        //     ->getRepository(RaceResult::class)
        //     ->lastPodiumResults(2);
            
            
            // var_dump($news);

            // var_dump(
            //     $this
            //     ->getDoctrine()
            //     ->getRepository(RaceResult::class)
            //     ->lastPodiumResults(1)
            // );


            // var_dump(
            //     count($this
            //     ->getDoctrine()
            //     ->getRepository(RaceResult::class)
            //     ->lastFondPodium())
            // );

        return $this->render('home/homepage.html.twig', [
            'controller_name' => 'HomeController',
            'news' => $news,
            'fondResults' => $fondResults,
            'rapideResults' => $rapideResults,

        ]);
    }
}
