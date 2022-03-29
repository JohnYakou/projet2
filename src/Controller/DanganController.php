<?php

namespace App\Controller;

use App\Entity\Dangan;
use App\Form\DanganType;
use App\Entity\DanganDeux;
use App\Form\DanganDeuxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DanganController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/dangan", name="app_dangan")
     */
    public function index(Request $request): Response
    {
        $dangan = new Dangan();

        $add = $this->createForm(DanganType::class, $dangan);
        $add->handleRequest($request);

        if($add->isSubmitted() && $add->isValid()){
            $this->manager->persist($dangan);
            $this->manager->flush();

            return $this->redirectToRoute('app_all_dangan');
        }

        return $this->render('dangan/index.html.twig', [
            'addForm' => $add->createView(),
        ]);
    }

    /**
     * @Route("all/dangan", name="app_all_dangan")
     */
    public function all(): Response{
        $eleves = $this->manager->getRepository(Dangan::class)->findAll();

        return $this->render('dangan/78.html.twig', [
            'eleves' => $eleves,
        ]);
    }

    /**
     * @Route("/single/dangan/{id}", name="app_single_dangan")
     */
    public function single(Dangan $id): Response{
        $eleves = $this->manager->getRepository(Dangan::class)->find($id);

        return $this->render('dangan/single.html.twig', [
            'eleves' => $eleves,
        ]);
    }

    /**
     * @Route("/admin/all/dangan", name="app_admin_all_dangan")
     */
    public function admin(): Response{
        $eleves = $this->manager->getRepository(Dangan::class)->findAll();

        // J'INSTANTIE DANGANDEUX
        $danganDeux = new DanganDeux;
        $danganDeux = $this->manager->getRepository(DanganDeux::class)->findAll();

        return $this->render('dangan/gestion.html.twig', [
            'eleves' => $eleves,
            'danganDeux' => $danganDeux,
        ]);
    }

    /**
     * @Route("/admin/dangan/delete/{id}", name="app_admin_delete_dangan")
     */
    public function delete(Dangan $dangan): Response{

        $this->manager->remove($dangan);
        $this->manager->flush();

        return $this->redirectToRoute('app_admin_all_dangan');
    }

    // ----- DELETE DE DANGANDEUX -----
    /**
     * @Route("/admin/danganDeux/delete/{id}", name="app_admin_delete_danganDeux")
     */
    public function deleteDeux(DanganDeux $danganDeux): Response{

        $this->manager->remove($danganDeux);
        $this->manager->flush();

        return $this->redirectToRoute('app_admin_all_dangan');
    }

    /**
     * @Route("/admin/dangan/edit/{id}", name="app_admin_edit_dangan")
     */
    public function edit(Dangan $dangan, Request $request): Response{

        $formEdit = $this->createForm(DanganType::class, $dangan);

        $formEdit->handleRequest($request);

        if($formEdit->isSubmitted() && $formEdit->isValid()){
            $this->manager->persist($dangan);
            $this->manager->flush();        
        
            return $this->redirectToRoute('app_admin_all_dangan');
        }
       

        return $this->render('dangan/edit.html.twig', [
            'modif' => $formEdit->createView(),
        ]);       
        

    }

    // EDIT DE DANGANDEUX
    /**
     * @Route("/admin/danganDeux/edit/{id}", name="app_admin_edit_danganDeux")
     */
    public function editDeux(DanganDeux $danganDeux, Request $request): Response{

        $formEdit = $this->createForm(DanganDeuxType::class, $danganDeux);

        $formEdit->handleRequest($request);

        if($formEdit->isSubmitted() && $formEdit->isValid()){
            $this->manager->persist($danganDeux);
            $this->manager->flush();        
        
            return $this->redirectToRoute('app_admin_all_dangan');
        }
       

        return $this->render('dangan_deux/editDeux.html.twig', [
            'modif' => $formEdit->createView(),
        ]);       
    }
}
