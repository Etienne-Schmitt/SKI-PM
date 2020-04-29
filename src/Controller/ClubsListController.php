<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClubsListController extends AbstractController
{
    /**
     * @Route("/clubs", name="clubs_list")
     */
    public function index(int $club_id)
    {
        return $this->render('clubs_list/clubs_list.html.twig', [
            'controller_name' => 'ClubsListController',
        ]);
    }
}
