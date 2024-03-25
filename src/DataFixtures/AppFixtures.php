<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Album;
use App\Entity\Artiste;
use App\Entity\Contact;
use App\Entity\Morceau;
use App\Entity\Categorie;
use App\Entity\Style;
use App\Repository\MorceauRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Tests\Models\Enums\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create("fr_FR");
        $lesArtistes = $this->chargeFichiers("artiste.csv");
        $lesStyles = $this->chargeFichiers("style.csv");
        foreach ($lesStyles as $value)
        {
            $style = new Style();
            $style->setId(intval($value[0]))
                     ->setNom($value[1])
                     //->setDescription("<p>". join("</p><p>".$faker->paragraph(5)) . "</p>")
                     ->setCouleur($faker->safeColorName());
                     $manager->persist($style);
                     $this->addReference("style".$style->getID(), $style);
        }

        $genres = ["men", "women"];
        foreach ($lesArtistes as $value)
        {
            $artiste = new Artiste();
            $artiste->setId(intval($value[0]))
                     ->setNom($value[1])
                     //->setDescription("<p>". join("</p><p>".$faker->paragraph(5)) . "</p>")
                     ->setDescription($faker->text(10))
                     ->setSite($faker->url())
                     ->setImage("https://picsum.photos/100/100")
                     ->setType($value[2]);
                     $manager->persist($artiste);
                     $this->addReference("artiste".$artiste->getID(), $artiste);
        }
        
        $lesAlbums = $this->chargeFichiers("album.csv");
        foreach ($lesAlbums as $value)
        {
            $album = new Album();
            $album->setID(intval($value[0]))
            ->setNom($value[1])
            ->setDate(intval($value[2]))
            // ->setImage("$faker->imageUrl(640,480)")
            ->setImage("https://picsum.photos/100/100")
            ->addStyle($this->getReference("style".$value[3]))
            ->setArtiste($this->getReference("artiste".$value[4]));
            $manager->persist($album);
            $this->addReference("album".$album->getId(), $album);
            
        }
        
        $lesMorceaux = $this->chargeFichiers("morceau.csv");
        foreach ($lesMorceaux as $value)
        {
                $morceau = new Morceau();
                $morceau->setID(intval($value[0]))
                        ->setTitre($value[2])
                        ->setAlbum($this->getReference("album".$value[1])) 
                        ->setDuree(date("i:s",$value[3]));
                        $manager->persist($morceau);
                        
        }
        $manager->flush();
    }
        
        public function chargeFichiers($fichier)
        {
            $faker = Factory::create(("fr_FR"));
        $fichierCsv = fopen(__DIR__."/".$fichier, "r");
        while (!feof($fichierCsv))
        {
            $data[] = fgetcsv($fichierCsv);
        }
        fclose($fichierCsv);
        return $data;
    }
}
