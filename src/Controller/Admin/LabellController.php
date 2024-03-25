<?php

namespace App\Controller\Admin;

use App\Entity\Labell;
use App\Form\LabellType;
use App\Repository\AlbumRepository;
use App\Repository\LabellRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LabellController extends AbstractController
{
    #[Route('/admin/labell', name: 'admin_labell', methods:["GET"])]
    public function listeLabel(LabellRepository $repo, AlbumRepository $repoA, Request $request): Response
    {
        $labels = $repo->findAll();
        $albums = $repoA->findAll();
        return $this->render('admin/labell/listeLabel.html.twig', [
            'lesLabels' => $labels,
        ]);
    }

// MODIFIER & AJOUTER UN LABEL :

    #[Route('/admin/Labell/ajout', name: 'admin_labell_ajout', methods:["GET", "POST"])]
    #[Route('/admin/Labell/modif/{id}', name: 'admin_labell_modif', methods:["GET", "POST"])]
    public function ajoutModifLabell(Labell $Labell = null, Request $request, EntityManagerInterface $manager): Response
    {      
       // Créer un objet dans le cadre d'un ajout :
        if($Labell == null)
        {
            $Labell = new Labell();
            $mode = "ajouté";
        }
        else 
        {
            $mode = "modifié";
        }

        $form = $this->createForm(LabellType::class, $Labell);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($Labell);
            $manager->flush();
            $this->addFlash("success","le label à bien été $mode");
            return $this->redirectToRoute('admin_labell');
        }
        return $this->render('admin/Labell/formAjoutModifLabell.html.twig', [
            'formLabell' => $form->createView(),
        ]);
    }

    
    #[Route('/admin/labell/supp/{id}', name: 'admin_labell_supp', methods:["GET"])]
    public function suppArtiste(Labell $label, EntityManagerInterface $manager): Response
    {      
        $nbLabels = $label->getAlbums()->count();
            if($nbLabels > 0)
            {
                $this->addFlash("danger","Vous ne pouvez pas supprimer le label car $nbLabels album(s) y sont associés");
            }
            else
            {
                $manager->remove($label);
                $manager->flush();
                $this->addFlash("success","le label à bien été supprimé");
            }
            
            return $this->redirectToRoute('admin_labell');
    }
}
