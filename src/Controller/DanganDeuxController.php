<?php

namespace App\Controller;

use App\Entity\DanganDeux;
use App\Form\DanganDeuxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DanganDeuxController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    
    /**
     * @Route("/dangan/deux", name="app_dangan_deux")
     */
    public function index(Request $request): Response
    {
        $danganDeux = new DanganDeux();

        $add = $this->createForm(DanganDeuxType::class, $danganDeux);
        $add->handleRequest($request);

        if($add->isSubmitted() && $add->isValid()){
            $this->manager->persist($danganDeux);
            $this->manager->flush();

            return $this->redirectToRoute('app_all_dangan_deux');
        }

        return $this->render('dangan_deux/index.html.twig', [
            'addForm' => $add->createView(),
        ]);
    }

    /**
     * @Route("/all/dangan/deux", name="app_all_dangan_deux")
     */
    public function all(): Response
    {    
        // J'INSTANTIE DANGANDEUX
        $danganDeux = new DanganDeux;
        $danganDeux = $this->manager->getRepository(DanganDeux::class)->findAll();
    
        return $this->render('dangan_deux/77.html.twig', [
            'danganDeux' => $danganDeux,
        ]);
    }

    /**
     * @Route("/single2/danganDeux/{id}", name="app_single2_dangan")
     */
    public function single(DanganDeux $id): Response{
        $danganDeux = $this->manager->getRepository(DanganDeux::class)->find($id);

        return $this->render('dangan_deux/single2.html.twig', [
            'danganDeux' => $danganDeux,
        ]);
    }
}
