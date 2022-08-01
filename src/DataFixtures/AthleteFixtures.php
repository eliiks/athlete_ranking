<?php

namespace App\DataFixtures;

use App\Entity\Athlete;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AthleteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $allClubs = $manager->getRepository('App\Entity\Club');
        $club = $allClubs->findAll();

        $allCategories = $manager->getRepository('App\Entity\Category');
        $cat = $allCategories->findAll();

        $athlete1 = new Athlete();
        $athlete1->setFirstName("Guillaume");
        $athlete1->setLastName("COBAT");
        $athlete1->setNbPoints(0);
        $athlete1->setClub($club[0]);
        $athlete1->setCategory($cat[0]);
        $manager->persist($athlete1);

        $athlete2 = new Athlete();
        $athlete2->setFirstName("Cedric");
        $athlete2->setLastName("BERTRONC");
        $athlete2->setNbPoints(0);
        $athlete2->setClub($club[0]);
        $athlete2->setCategory($cat[0]);
        $manager->persist($athlete2);

        $athlete3 = new Athlete();
        $athlete3->setFirstName("Kilian");
        $athlete3->setLastName("LE BOURHIS");
        $athlete3->setNbPoints(0);
        $athlete3->setClub($club[0]);
        $athlete3->setCategory($cat[0]);
        $manager->persist($athlete3);

        $athlete4 = new Athlete();
        $athlete4->setFirstName("Julien");
        $athlete4->setLastName("TERTRAIN");
        $athlete4->setNbPoints(0);
        $athlete4->setClub($club[0]);
        $athlete4->setCategory($cat[0]);
        $manager->persist($athlete4);

        $athlete5 = new Athlete();
        $athlete5->setFirstName("Arnaud");
        $athlete5->setLastName("EVEILLARD");
        $athlete5->setNbPoints(0);
        $athlete5->setClub($club[0]);
        $athlete5->setCategory($cat[0]);
        $manager->persist($athlete5);

        $athlete6 = new Athlete();
        $athlete6->setFirstName("Enzo");
        $athlete6->setLastName("OUISSE");
        $athlete6->setNbPoints(0);
        $athlete6->setClub($club[0]);
        $athlete6->setCategory($cat[0]);
        $manager->persist($athlete6);

        $manager->flush();
    }
}
