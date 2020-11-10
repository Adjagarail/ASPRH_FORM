<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Repository\StructureRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function index(StructureRepository $structureRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'structures' => $structureRepository->findAll(),
            'controller_name' => 'DashboardController',
        ]);
    }
}
