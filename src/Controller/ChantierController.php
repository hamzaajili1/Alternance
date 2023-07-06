<?php

namespace App\Controller;

use App\Entity\Chantier;
use App\Form\ChantierType;
use App\Repository\ChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;



/**
 * @Route("/chantier")
 */
class ChantierController extends AbstractController
{
    /**
     * @Route("/", name="chantier_index", methods={"GET"})
     * @param ChantierRepository $chantierRepository
     * @return Response
     */
    public function index(ChantierRepository $chantierRepository): Response
    {
        return $this->render('chantier/index.html.twig', [
            'chantiers' => $chantierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chantier_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $chantier = new Chantier();
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chantier);
            $entityManager->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chantier_show", methods={"GET"})
     * @param Chantier $chantier
     * @return Response
     */
    public function show(Chantier $chantier): Response
    {
        return $this->render('chantier/show.html.twig', [
            'chantier' => $chantier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chantier_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Chantier $chantier
     * @return Response
     */
    public function edit(Request $request, Chantier $chantier): Response
    {
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

/**
 * @Route("/{id}", name="chantier_delete", methods={"DELETE"})
 * @param Request $request
 * @param Chantier $chantier
 * @param EntityManagerInterface $entityManager
 * @return Response
 */
public function delete(Request $request, Chantier $chantier, EntityManagerInterface $entityManager): Response
{
    $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('chantier_delete', ['id' => $chantier->getId()]))
        ->setMethod('DELETE')
        ->getForm();
    
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->remove($chantier);
        $entityManager->flush();

        return $this->redirectToRoute('chantier_index');
    }

    return $this->render('chantier/delete.html.twig', [
        'chantier' => $chantier,
        'delete_form' => $form->createView(),
    ]);
}
}
