<?php

namespace App\Controller;

use App\Entity\Administrator;
use App\Entity\Athlete;
use App\Form\AddAthleteType;
use App\Form\AddEventType;
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
     * @Route("/admin/liste_athlete", name="admin_liste_athlete")
     */
    public function adminListeAthleteAction(ManagerRegistry $doctrine)
    {
        $athletes = $doctrine->getManager()->getRepository('App\Entity\Athlete')->findBy(array('club'=>$this->getUser()->getClub()));
        $args = array('athletes' => $athletes);
        return $this->render('admin/liste_athlete.html.twig', $args);
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

            return $this->redirectToRoute('admin_liste_athlete');
        }

        //formulaire recu mais invalide
        if($formulaire->isSubmitted()){
            //message d'erreur
        }

        $args = array('ajouter_athlete_form' => $formulaire->createView());
        return $this->render('admin/ajouter_athlete.html.twig', $args);
    }

    /**
     * @Route("/admin/editer_athlete/{id}", name="admin_editer_athlete", requirements={"id" : "[0-9]+"})
     */
    public function adminEditerAthleteAction(int $id, ManagerRegistry $doctrine, Request $request)
    {
        $em = $doctrine->getManager();

        $athlete = $em->getRepository('App\Entity\Athlete')->find($id);
        if(isset($athlete)){
            //Création du formulaire
            $formulaire = $this->createForm(AddAthleteType::class, $athlete);
            $formulaire->add('modifier_athlete', SubmitType::class, ['label' => 'Modifier l\'athlète']);
            $formulaire->handleRequest($request); //permet de réafficher les données saisies dans le formulaire

            //Si le formulaire a été recu et est valide
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em->flush();

                return $this->redirectToRoute('admin_liste_athlete');
            }

            //formulaire recu mais invalide
            if($formulaire->isSubmitted()){
                //message d'erreur
            }

            $args = array('modifier_athlete_form' => $formulaire->createView(), 'athlete' => $athlete);
            return $this->render('admin/editer_athlete.html.twig', $args);
        }else{
            return $this->redirectToRoute('admin_liste_athlete');
        }
    }

    /**
     * @Route("/admin/supprimer_athlete/{id}", name="admin_supprimer_athlete", requirements={"id" : "[0-9]+"})
     */
    public function adminSupprimerAthleteAction(int $id, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();

        $athlete = $em->getRepository('App\Entity\Athlete')->find($id);
        if(isset($athlete)){

            $em->remove($athlete);
            $em->flush();
        }

        return $this->redirectToRoute('admin_liste_athlete');
    }

    /**
     * @Route("/admin/liste_evenement", name="admin_liste_evenement")
     */
    public function adminListeEvenementAction(ManagerRegistry $doctrine)
    {
        $events = $doctrine->getManager()->getRepository('App\Entity\Event')->findBy(array('club'=>$this->getUser()->getClub()));
        $args = array('events' => $events);
        return $this->render('admin/liste_evenement.html.twig', $args);
    }

    /**
     * @Route("/admin/ajouter_evenement", name="admin_ajouter_evenement")
     */
    public function adminAjouterEvenementAction(ManagerRegistry $doctrine, Request $request){
        //Création du formulaire
        $formulaire = $this->createForm(AddEventType::class);
        $formulaire->add('ajouter_evenement', SubmitType::class, ['label' => 'Ajouter l\'événement']);
        $formulaire->handleRequest($request); //permet de réafficher les données saisies dans le formulaire

        //Si le formulaire a été recu et est valide
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $em = $doctrine->getManager();

            $event = $formulaire->getData();
            $event->setClub($this->getUser()->getClub());

            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('admin_liste_evenement');
        }

        //formulaire recu mais invalide
        if($formulaire->isSubmitted()){
            //message d'erreur
        }

        $args = array('ajouter_evenement_form' => $formulaire->createView());
        return $this->render('admin/ajouter_evenement.html.twig', $args);
    }

    /**
     * @Route("/admin/editer_evenement/{id}", name="admin_editer_evenement", requirements={"id" : "[0-9]+"})
     */
    public function adminEditerEvenementAction(int $id, ManagerRegistry $doctrine, Request $request)
    {
        $em = $doctrine->getManager();

        $event = $em->getRepository('App\Entity\Event')->find($id);
        if(isset($event)){
            //Création du formulaire
            $formulaire = $this->createForm(AddEventType::class, $event);
            $formulaire->add('modifier_evenement', SubmitType::class, ['label' => 'Modifier l\'evenement']);
            $formulaire->handleRequest($request); //permet de réafficher les données saisies dans le formulaire

            //Si le formulaire a été recu et est valide
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em->flush();

                return $this->redirectToRoute('admin_liste_evenement');
            }

            //formulaire recu mais invalide
            if($formulaire->isSubmitted()){
                //message d'erreur
            }

            $args = array('modifier_evenement_form' => $formulaire->createView(), 'event' => $event);
            return $this->render('admin/editer_evenement.html.twig', $args);
        }else{
            return $this->redirectToRoute('admin_liste_evenement');
        }
    }

    /**
     * @Route("/admin/supprimer_evenement/{id}", name="admin_supprimer_evenement", requirements={"id" : "[0-9]+"})
     */
    public function adminSupprimerEventAction(int $id, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();

        $event = $em->getRepository('App\Entity\Event')->find($id);
        if(isset($event)){

            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('admin_liste_evenement');
    }
}
