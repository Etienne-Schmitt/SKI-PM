<?php

namespace App\Controller;

use App\Entity\Race;
use App\Repository\RaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RacesListController extends AbstractController
{
    /**
     * @Route("/races", name="races_list_page")
     */
    public function index()
    {
        /** @var RaceRepository $raceRepository */
        $raceRepository = $this->getDoctrine()
            ->getRepository(Race::class);

        $allCategories = $raceRepository->getAllCategories();

        return $this->render('races_list/races_list.html.twig', [
            'controller_name' => 'RacesListController',
            'categories' => $allCategories,
        ]);
    }

    /**
     * @Route("/api/races/list/{raceCategory}", name="races_list_api")
     * @param string $raceCategory
     * @return Response
     */
    public function api(string $raceCategory)
    {

        /** @var RaceRepository $raceRepo */
        $raceRepo = $this->getDoctrine()
            ->getRepository(Race::class);

        $raceList = $raceRepo->getAllRacesAs($raceCategory);

        $request = Request::createFromGlobals();
        if ($request->headers->contains('X-NoBrowser', 'true')) {
            return new Response(
                json_encode($raceList),
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );
        } else {
            return new Response(
                json_encode($raceList),
                Response::HTTP_OK,
                ['content-type' => 'application/json']
            );
        }
    }
}
