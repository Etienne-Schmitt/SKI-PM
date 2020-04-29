<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RacesListController extends AbstractController
{
    /**
     * @Route("/races", name="races_list")
     */
    public function index()
    {
        return $this->render('races_list/races_list.html.twig', [
            'controller_name' => 'RacesListController',
        ]);
    }
}
