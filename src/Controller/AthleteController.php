<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/athlete", name="athlete")
 */
class AthleteController extends AbstractController
{
    /**
     * @Route("/listeClub", name="_listeClub")
     */
    public function listeClubAction(): Response
    {
        return $this->render('athlete/index.html.twig', [
            'controller_name' => 'AthleteController',
        ]);
    }
}
