<?php

namespace App\Controller;

use App\Entity\Club;
use Doctrine\Persistence\ManagerRegistry;
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
    public function listeClubAction(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $clubRep = $em->getRepository('App\Entity\Club');
        $allClubs = $clubRep->findAll();
        return $this->render('athlete/index.html.twig', [
            'clubs' => $allClubs,
        ]);
    }

    /**
     * @Route("/recherche", name="_recherche")
     */
    public function rechercheAction(): Response
    {
        if(isset($_POST["leclub"])) {
            return $this->render('athlete/recherche.html.twig', [
                'clubId'=> $_POST["leclub"]
            ]);
        }
    }

    /**
     * @Route("/rechercheAthlete/{clubId}", name="_rechercheAthlete", requirements={"clubId":"[0-9]+"})
     */
    public function rechercheAthlete(int $clubId): Response
    {
        dump($clubId);
        return $this->render("athlete/rechercheParAthlete.html.twig");
    }

}
