<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClubDetailsController extends AbstractController
{
    /**
     * @Route("/clubs/{club_id}", name="club_details")
     */
    public function index(int $club_id)
    {
        return $this->render('club_details/club_details.html.twig', [
            'controller_name' => 'ClubDetailsController',
        ]);
    }
}
