<?php

namespace App\DataFixtures;

use App\Entity\Administrator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdministratorFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher=$hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $allClubs = $manager->getRepository('App\Entity\Club');
        $club = $allClubs->findAll();

        $adminA = new Administrator();
        $adminA->setLogin('eliiks');
        $this->hasher->
        $adminA->setPassword($this->hasher->hashPassword($adminA, "dieu"));
        $adminA->setClub($club[1]);
        $adminA->setRoles(['ROLE_ADMIN']);

        $adminB = new Administrator();
        $adminB->setLogin('pulkio');
        $adminB->setPassword($this->hasher->hashPassword($adminB, "connard"));
        $adminB->setClub($club[0]);
        $adminB->setRoles(['ROLE_ADMIN']);

        $manager->persist($adminA);
        $manager->persist($adminB);

        $manager->flush();
    }
}
