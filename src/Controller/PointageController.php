<?php

namespace App\Controller;

use App\Entity\Pointage;
use App\EventHandler\FormErrorHandler;
use App\Form\PointageType;
use App\Repository\PointageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/pointage")
 */
class PointageController extends AbstractController
{
    /**
     * @Route("/", name="pointage_index", methods={"GET"})
     * @param PointageRepository $pointageRepository
     * @return Response
     */
    public function index(PointageRepository $pointageRepository): Response
    {
        return $this->render('pointage/index.html.twig', [
            'pointages' => $pointageRepository->findAll(),
        ]);
    }

   /**
 * @Route("/new", name="pointage_new", methods={"GET","POST"})
 * @param Request $request
 * @param FormErrorHandler $handler
 * @return Response
 */
public function new(Request $request, FormErrorHandler $handler): Response
{
    $pointage = new Pointage();
    $form = $this->createForm(PointageType::class, $pointage);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pointage);
        $entityManager->flush();

        return $this->redirectToRoute('pointage_index');
    } elseif ($form->isSubmitted() && !$form->isValid()) {
        $errors = $handler->getErrors($form);
        return $this->json(['errors' => $errors]);
    }

    return $this->render('pointage/new.html.twig', [
        'pointage' => $pointage,
        'form' => $form->createView(),
    ]);
}




    /**
     * @Route("/{id}", name="pointage_delete", methods={"DELETE"})
     * @param Request $request
     * @param Pointage $pointage
     * @return Response
     */
    public function delete(Request $request, Pointage $pointage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pointage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pointage_index');
    }
}