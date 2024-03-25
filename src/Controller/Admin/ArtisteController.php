<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArtisteController extends AbstractController
{
    #[Route('/admin/artiste', name: 'admin_artistes', methods:["GET"])]
    public function listeArtiste(ArtisteRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $artistes = $paginator->paginate(
        $repo->listeArtisteCompletePaginee(),
        $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );
        return $this->render('admin/artiste/listeArtistes.html.twig', [
            'lesArtistes' => $artistes,
        ]);
    }

    #[Route('/admin/artiste/ajout', name: 'admin_artistes_ajout', methods:["GET", "POST"])]
    #[Route('/admin/artiste/modif/{id}', name: 'admin_artistes_modif', methods:["GET", "POST"])]
    public function ajoutModifArtiste(Artiste $artiste = null, Request $request, EntityManagerInterface $manager): Response
    {      

        // Créer un objet dansle cadre d'un ajout :
        if($artiste == null)
        {
            $artiste = new Artiste();
            $mode = "ajouté";
        }
        else 
        {
            $mode = "modifié";
        }

        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($artiste);
            $manager->flush();
            $this->addFlash("success","L'artiste à bien été $mode");
            return $this->redirectToRoute('admin_artistes');
        }
        return $this->render('admin/artiste/formAjoutModifArtiste.html.twig', [
            'formArtiste' => $form->createView(),
        ]);
    }

    #[Route('/admin/artiste/supp/{id}', name: 'admin_artistes_supp', methods:["GET"])]
    public function suppArtiste(Artiste $artiste, EntityManagerInterface $manager): Response
    {      
        $nbAlbums = $artiste->getAlbums()->count();
            if($nbAlbums > 0)
            {
                $this->addFlash("danger","Vous ne pouvez pas supprimer l'artiste car $nbAlbums album(s) y sont associés");
            }
            else
            {
                $manager->remove($artiste);
                $manager->flush();
                $this->addFlash("success","L'artiste à bien été supprimé");
            }
            
            return $this->redirectToRoute('admin_artistes');
    }

}
