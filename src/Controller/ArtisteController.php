<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController
{
    #[Route('/artiste', name: 'app_artiste', methods:["GET"])]
    public function listeArtiste(ArtisteRepository $repo): Response
    {
        $artistes = $repo->listeArtisteComplete();
        return $this->render('artiste/listeArtistes.html.twig', [
            'lesArtistes' => $artistes,
        ]);
    }

    #[Route('/artiste/{id}', name: 'ficheArtiste', methods:["GET"])]
    public function ficheArtiste(Artiste $artiste): Response
    {
             return $this->render('artiste/ficheArtiste.html.twig', [
            'leArtiste' => $artiste,
        ]);
    }
}
