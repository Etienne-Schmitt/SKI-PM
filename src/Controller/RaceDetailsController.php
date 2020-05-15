<?php

namespace App\Controller;

use App\Entity\RaceResult;
use App\Repository\RaceResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaceDetailsController extends AbstractController
{
    /**
     * @Route("/races/{raceName}", name="race_details")
     * @param string $raceName
     * @return Response
     */
    public function page(string $raceName)
    {
        /** @var RaceResultRepository $raceResultRepo */
        $raceResultRepo =  $this->getDoctrine()
            ->getRepository(RaceResult::class);

        $raceData = $raceResultRepo->getAllResultForRace($raceName);

        $raceAthlete = [];
        $raceResult = [];
        $i = 0;
        foreach ($raceData as $race) {
            $raceAthlete[$i] = $raceData[$i]['athlete'];
            $raceResult[$i]['run_1'] = $raceData[$i]['run_1'];
            $raceResult[$i]['run_2'] = $raceData[$i]['run_2'];
            $raceResult[$i]['run_average'] = $raceData[$i]['run_average'];
            $i++;
        }

        return $this->render('race_details/race_details.html.twig', [
            'raceName' => $raceName,
            'raceData' => $raceData,
        ]);
    }
}
