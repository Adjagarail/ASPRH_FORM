<?php

namespace App\Controller;

use App\Entity\Besoin;
use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\ORM\EntityManager;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/structure")
 */
class StructureController extends AbstractController
{
    /**
     * @Route("/", name="structure_index", methods={"GET"})
     */
    public function index(StructureRepository $structureRepository): Response
    {
        return $this->render('structure/index.html.twig', [
            'structures' => $structureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="structure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $structure = new Structure();
        $besoin1 = new Besoin();
        $besoin1 ->setDescription('Description 1');
        $structure->addBesoin($besoin1);
        

        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($structure);
            $entityManager->flush();

            return $this->redirectToRoute('structure_index');
        }

        return $this->render('structure/new.html.twig', [
            'structure' => $structure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="structure_show", methods={"GET"})
     */
    public function show(Structure $structure): Response
    {
        return $this->render('structure/show.html.twig', [
            'structure' => $structure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="structure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Structure $structure, EntityManagerInterface $entityManager): Response
    {
        if (null === $structure = $entityManager->getRepository(Structure::class)->find($id)) {
            throw $this->createNotFoundException('No Structure found for id ' . $id);
        }
        
        $originalStructure = new ArrayCollection();

        // Create an ArrayCollection of the current besoin objects in the database
        foreach ($structure->getBesoin() as $besoin) {
            $originalStructure->add($besoin);
        }

        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($originalStructure as $besoin) {
                if (false === $structure->getbesoin()->contains($besoin)) {
                    // remove the Task from the besoin
                    $besoin->getStructure()->removeElement($structure);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $besoin->setTask(null);

                    $entityManager->persist($besoin);

                    // if you wanted to delete the besoin entirely, you can also do that
                    // $entityManager->remove($besoin);
                }
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('structure_index');
        }

        return $this->render('structure/edit.html.twig', [
            'structure' => $structure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="structure_delete", methods={"DELETE"}, requirements={"id":"\d+"})
     * @ParamConverter("id", class="Besoin", options={"id": "id"})
     */
    public function delete(Request $request, Structure $structure, Besoin $besoin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$structure->getId(), 'delete' . $besoin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($structure, $besoin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('structure_index');
    }
}
