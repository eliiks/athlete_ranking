<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $club = new Club();
        $club->setAdminCode(123);
        $club->setName("CJF");
        $manager->persist($club);

        $club2 = new Club();
        $club2->setAdminCode(456);
        $club2->setName("HBA");

        $manager->persist($club2);

        $club3 = new Club();
        $club3->setAdminCode(789);
        $club3->setName("Vannes");
        $manager->persist($club3);

        $manager->flush();
    }
}
