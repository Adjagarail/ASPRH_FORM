<?php

namespace App\Controller;

use App\Repository\BesoinRepository;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function index(StructureRepository $structureRepository, BesoinRepository $besoinRepository , EntityManagerInterface $entityManager): Response
    {
        // Faire un decompte des entregistement qui existe en base de données

            $machin = $entityManager ->createQuery('SELECT COUNT(s) FROM App\Entity\Structure s')->getSingleScalarResult();
            $machin1 = $entityManager->createQuery('SELECT COUNT(b) FROM App\Entity\Besoin b')->getSingleScalarResult();
            $machin2 = $entityManager->createQuery('SELECT COUNT(a) FROM App\Entity\Activite a')->getSingleScalarResult();
            $machin3 = $entityManager->createQuery('SELECT SUM(b.Employer) as Employer FROM App\Entity\Besoin b')->getSingleScalarResult();
            $machin4 = $entityManager->createQuery('SELECT SUM(b.Agent) as Agent FROM App\Entity\Besoin b')->getSingleScalarResult();
            $machin5 = $entityManager->createQuery('SELECT SUM(b.Cadre) as Cadre FROM App\Entity\Besoin b')->getSingleScalarResult();
            $machintotal = $machin3 + $machin4 + $machin5;
        return $this->render('dashboard/index.html.twig', [
            'structures' => $structureRepository->findAll(),
            'besoins'=> $besoinRepository->findAll(),
            'stats'=> [
                'structure'=> $machin,
                'besoin' => $machin1,
                'activite' => $machin2,
                'total' => $machintotal
            ],
            'controller_name' => 'DashboardController',
        ]);
    }
}
