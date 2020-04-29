<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RaceDetailsController extends AbstractController
{
    /**
     * @Route("/races/{races_id}", name="race_details")
     */
    public function index(int $races_id)
    {
        return $this->render('race_details/race_details.html.twig', [
            'controller_name' => 'RaceDetailsController',
        ]);
    }
}
