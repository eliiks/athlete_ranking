<?php

namespace App\Controller;

use App\Entity\Administrator;
use App\Entity\Athlete;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function adminAjouterAthleteAction(ManagerRegistry $doctrine, ValidatorInterface $validator)
    {
        if($this->getUser()){
            $categories = $doctrine->getManager()->getRepository('App\Entity\Category')->findAll();

            if (isset($_POST['first_name'])) {
                //Category selected
                dump($categories);
                $categorySelected = $categories[$_POST['category']-$_POST['category']+1];



                $athlete = new Athlete();
                $athlete->setFirstName($_POST['first_name']);
                $athlete->setLastName($_POST['last_name']);
                $athlete->setClub($this->getUser()->getClub());
                $athlete->setCategory($categorySelected);

                dump(empty($validator->validate($athlete)[0]));
            }
            return $this->render("admin/ajouter_athlete.html.twig", ["categories" => $categories]);
        }else{
            return $this->redirectToRoute('accueil');
        }
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
