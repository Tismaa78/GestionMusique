<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Labell;
use App\Repository\AlbumRepository;
use App\Repository\LabellRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LabellController extends AbstractController
{
    #[Route('/labell', name: 'labell', methods:["GET"])]
    public function listeLabel(LabellRepository $repo, AlbumRepository $repoA): Response
    {
        $labels = $repo->findAll();
        $albums = $repoA->findAll();
        return $this->render('labell/listeLabel.html.twig', [
            'lesLabels' => $labels,
            'lesAlbums' => $albums
        ]);
    }

    #[Route('/labell/{id}', name: 'ficheLabel', methods:["GET"])]
    public function ficheLabel(Labell $label, Album $album): Response
    {

        return $this->render('labell/ficheLabel.html.twig', [
            'leLabel' => $label,
            'leAlbum' => $album
        ]);
    }
}
