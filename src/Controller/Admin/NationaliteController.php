<?php

namespace App\Controller\Admin;

use App\Entity\Nationalite;
use App\Form\NationaliteType;
use App\Repository\NationaliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NationaliteController extends AbstractController
{
    #[Route('/admin/nationalite', name: 'admin_nationalites', methods:["GET"])]
    public function listeNationalite(NationaliteRepository $repo): Response
    {
        $nationalites = $repo->findAll();

        return $this->render('admin/nationalite/listeNationalite.html.twig', [
            'lesNationalites' => $nationalites,
        ]);
    }

    #[Route('/admin/nationalite/ajout', name: 'admin_nationalites_ajout', methods:["GET", "POST"])]
    #[Route('/admin/nationalite/modif/{id}', name: 'admin_nationalites_modif', methods:["GET", "POST"])]
    public function ajoutModifNationalite(Nationalite $nationalite = null, Request $request, EntityManagerInterface $manager): Response
    {      
        if ($nationalite == null) {
            $nationalite = new Nationalite();
            $mode = "ajoutée";
        } else {
            $mode = "modifiée";
        }

        $form = $this->createForm(NationaliteType::class, $nationalite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($nationalite);
            $manager->flush();
            $this->addFlash("success", "La nationalité a bien été $mode");
            return $this->redirectToRoute('admin_nationalites');
        }

        return $this->render('admin/nationalite/formAjoutModifNationalite.html.twig', [
            'formNationalite' => $form->createView(),
        ]);
    }

    #[Route('/admin/nationalite/supp/{id}', name: 'admin_nationalites_supp', methods:["GET"])]
    public function suppNationalite(Nationalite $nationalite, EntityManagerInterface $manager): Response
    {      
        $manager->remove($nationalite);
        $manager->flush();
        $this->addFlash("success", "La nationalité a bien été supprimée");

        return $this->redirectToRoute('admin_nationalites');
    }
}
