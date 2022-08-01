<?php

namespace App\Controller;

use App\Entity\Category;
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

    // DONNE LA LISTE DES CLUBS : 1
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



    // RESULTAT SELECTION DU CLUB : 2

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

    // RECHERCHE PAR ATHLETE : 3 si clique sur Rechercher une personne

    /**
     * @Route("/rechercheAthlete/{clubId}", name="_rechercheAthleteAction", requirements={"clubId":"[0-9]+"})
     */
    public function rechercheAthleteAction(int $clubId): Response
    {
        dump($clubId);
        return $this->render("athlete/rechercheParAthlete.html.twig", [
            'clubId' => $clubId
        ]);
    }


    // RECHERCHE PAR CATEGORIE : 3 si clique sur Classement par catégorie
    /**
     * @Route("/selectCategorie/{clubId}", name="_selectCategorieAction", requirements={"clubId":"[0-9]+"})
     */
    public function selectCategorieAction(ManagerRegistry $doctrine, int $clubId): Response
    {

        $em = $doctrine->getManager();
//        $athleteRep = $em->getRepository('App\Entity\Athlete');
//
//        $athleteFromClub = $athleteRep->findBy(array('club' => $clubId));
//        dump($athleteFromClub);

        $catRep = $em->getRepository('App\Entity\Category');
        $allCats = $catRep->findAll();
        return $this->render("athlete/selectCategorie.html.twig", [
            'clubId' => $clubId,
            'allCats' => $allCats,
        ]);


    }



//    /**
//     * @Route("/choixCategorie", name="_choixCategorie")
//     */
//    public function choixCategorieAction(): Response
//    {
//        if(isset($_POST["leclub"])) {
//            return $this->render('athlete/recherche.html.twig', [
//                'clubId'=> $_POST["leclub"]
//            ]);
//        }
//    }



    // RESULTAT DE SELECT PAR CATEGORIE : 4
    /**
     * @Route("/athleteCategorie/{clubId}", name="_athletesCategorieAction", requirements={"clubId":"[0-9]+"})
     */
    public function athletesCategorieAction(ManagerRegistry $doctrine, int $clubId): Response
    {
        if(isset($_POST["laCat"])) {
            $em = $doctrine->getManager();
            $athleteRep = $em->getRepository('App\Entity\Athlete');
            $athletesCat = $athleteRep->findBy(array('club' => $clubId, 'category' => $_POST["laCat"]));


            return $this->render('athlete/afficheCategorieAthlete.html.twig', [
                'laCat'=> $_POST["laCat"],
                'athletesCat' => $athletesCat
            ]);
        }

    }







}
