<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Album;
use App\Entity\Labell;
use App\Repository\AlbumRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LabellFixtures extends Fixture
{
    private $albumRepo;
    public function __construct(AlbumRepository $albumRepo){
        $this->albumRepo=$albumRepo;
    }
    
    public function load(ObjectManager $manager): void{
    $faker=Factory::create("fr_FR");

        $Labell=new Labell();
        $Labell  ->setNom("Warner Music Group")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(2004)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell1", $Labell);

        $Labell=new Labell();
        $Labell  ->setNom("Universal Music Group")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(1996)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell2", $Labell);

        $Labell=new Labell();
        $Labell  ->setNom("Polygram Music")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(1972)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell3", $Labell);

        $Labell=new Labell();
        $Labell  ->setNom("EMI Group")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(1931)
                ->setType("Majeur")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell4", $Labell);

        $Labell=new Labell();
        $Labell  ->setNom("Alligator")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(2020)
                ->setType("Indépendant")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell5", $Labell);

        $Labell=new Labell();
        $Labell  ->setNom("Alive Records")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(2015)
                ->setType("Indépendant")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell6", $Labell);

        $Labell=new Labell();
        $Labell  ->setNom("Alchemy Records")
                ->setDescription("<p>". join("</p><p>",$faker->paragraphs(1)) . "</p>")
                ->setAnneeCreation(2018)
                ->setType("Indépendant")
                ->setLogo("https://picsum.photos/100/100");
                $manager->persist($Labell);
                // $manager->flush();
                $this->addReference("Labell7", $Labell);

    $lesAlbums=$this->albumRepo->findAll();
    foreach ($lesAlbums as $album) {
        $album->setLabell($this->getReference("Labell".mt_rand(1,7)));
    }
    $manager->flush();
    }

}
