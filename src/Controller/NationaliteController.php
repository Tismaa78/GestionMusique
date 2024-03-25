<?php

namespace App\Controller;

use App\Repository\ArtisteRepository;
use App\Repository\NationaliteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nationalite; // Importez la classe Nationalite
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NationaliteController extends AbstractController
{
    #[Route('/nationalite', name: 'app_nationalite', methods:["GET"])]
    public function listeNationalite(NationaliteRepository $repo): Response
    {
        // Récupérer toutes les nationalités
        $nationalites = $repo->findAll();

        // Initialiser un tableau pour stocker le nombre d'artistes par nationalité
        $artistesParNationalite = [];

        // Pour chaque nationalité, compter le nombre d'artistes correspondant
        foreach ($nationalites as $nationalite) {
            $nombreArtistes = count($nationalite->getArtistes());
            $artistesParNationalite[$nationalite->getLibelle()] = $nombreArtistes;
        }

        return $this->render('nationalite/listeNationalite.html.twig', [
            'nationalites' => $nationalites,
            'artistesParNationalite' => $artistesParNationalite,
        ]);
    }
}




// class NationaliteController extends AbstractController
// {
//     #[Route('/nationalite', name: 'liste_nationalite')]
//     public function index(): Response
//     {
//         // Récupérer toutes les nationalités depuis la base de données
//         $nationalites = $this->getDoctrine()->getRepository(Nationalite::class)->findAll();

//         return $this->render('nationalite/index.html.twig', [
//             'nationalites' => $nationalites,
//         ]);
//     }
// }