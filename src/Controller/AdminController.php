<?php

namespace App\Controller;

use App\Entity\Administrator;
use App\Entity\Athlete;
use App\Form\AddAthleteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/connexion",name="connexion")
     */
    public function connexionAction(AuthenticationUtils $authenticationUtils): Response
    {
        //Si déjà connecté, alors on redirige vers accueil admin
        if ($this->getUser()) {
             return $this->redirectToRoute('admin_accueil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion",name="deconnexion")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/admin/accueil", name="admin_accueil")
     */
    public function adminAccueilAction(ManagerRegistry $doctrine){
        if($this->getUser()) {
            $club = $doctrine->getManager()->getRepository('App\Entity\Club')->find($this->getUser()->getClub());

            if(isset($club)){
                //Admin connecté et lié à un club
                return $this->render("admin/accueil.html.twig", ["club" => $club]);
            }else{
                //Admin connecte mais aucun club lié
                return $this->redirectToRoute("admin_creer_club");
            }
        }else{
            //Retour vers connexion
            return $this->render("connexion");
        }
    }

    /**
     * @Route("/admin/creer_club", name="admin_creer_club")
     */
    public function adminCreerClubAction(ManagerRegistry $doctrine){
        //TODO : Se mettre d'accord sur la facon de creer un club
        return $this->redirectToRoute("accueil");
    }

    /**
     * @Route("/admin/ajouter_athlete", name="admin_ajouter_athlete")
     */
    public function adminAjouterAthleteAction(ManagerRegistry $doctrine, Request $request)
    {
        //Création du formulaire
        $formulaire = $this->createForm(AddAthleteType::class);
        $formulaire->add('ajouter_athlete', SubmitType::class, ['label' => 'Ajouter l\'athlète']);
        $formulaire->handleRequest($request); //permet de réafficher les données saisies dans le formulaire

        //Si le formulaire a été recu et est valide
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $em = $doctrine->getManager();

            $athlete = $formulaire->getData();
            $athlete->setClub($this->getUser()->getClub());

            $em->persist($athlete);
            $em->flush();

            return $this->redirectToRoute('admin_accueil');
        }

        //formulaire recu mais invalide
        if($formulaire->isSubmitted()){
            //message d'erreur
        }

        $args = array('ajouter_athlete_form' => $formulaire->createView());
        return $this->render('admin/ajouter_athlete.html.twig', $args);
    }

    /**
     * @Route("/admin/ajouter_evenement", name="admin_ajouter_evenement")
     */
    public function adminAjouterEvenementAction(ManagerRegistry $doctrine){
        return $this->redirectToRoute("accueil");
    }

    /**
     * @Route("/admin/liste_evenement", name="admin_liste_evenement")
     */
    public function adminListeEvenementAction(ManagerRegistry $doctrine){
        return $this->redirectToRoute("accueil");
    }
}
