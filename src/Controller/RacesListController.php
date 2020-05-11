<?php

namespace App\Controller;

use App\Entity\Race;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RacesListController extends AbstractController
{
    /**
     * @Route("/races", name="races_list")
     */
    public function index()
    {
        /** @var Race $test */
        $test = $this->getDoctrine()
            ->getRepository(Race::class)
            ->find(1);

        $truc =  $test->getRaceResults();

//        var_dump($truc->count());

        return $this->render('races_list/races_list.html.twig', [
            'controller_name' => 'RacesListController',
        ]);
    }
}
