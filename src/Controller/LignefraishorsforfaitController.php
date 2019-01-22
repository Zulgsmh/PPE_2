<?php

namespace App\Controller;

use App\Entity\Lignefraishorsforfait;
use App\Form\LignefraishorsforfaitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lignefraishorsforfait")
 */
class LignefraishorsforfaitController extends AbstractController
{
    /**
     * @Route("/", name="lignefraishorsforfait_index", methods="GET")
     */
    public function index(): Response
    {
        $lignefraishorsforfaits = $this->getDoctrine()
            ->getRepository(Lignefraishorsforfait::class)
            ->findAll();

        return $this->render('lignefraishorsforfait/index.html.twig', ['lignefraishorsforfaits' => $lignefraishorsforfaits]);
    }

    /**
     * @Route("/new", name="lignefraishorsforfait_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $lignefraishorsforfait = new Lignefraishorsforfait();
        $form = $this->createForm(LignefraishorsforfaitType::class, $lignefraishorsforfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lignefraishorsforfait);
            $em->flush();

            return $this->redirectToRoute('lignefraishorsforfait_index');
        }

        return $this->render('lignefraishorsforfait/new.html.twig', [
            'lignefraishorsforfait' => $lignefraishorsforfait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lignefraishorsforfait_show", methods="GET")
     */
    public function show(Lignefraishorsforfait $lignefraishorsforfait): Response
    {
        return $this->render('lignefraishorsforfait/show.html.twig', ['lignefraishorsforfait' => $lignefraishorsforfait]);
    }

    /**
     * @Route("/{id}/edit", name="lignefraishorsforfait_edit", methods="GET|POST")
     */
    public function edit(Request $request, Lignefraishorsforfait $lignefraishorsforfait): Response
    {
        $form = $this->createForm(LignefraishorsforfaitType::class, $lignefraishorsforfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lignefraishorsforfait_index', ['id' => $lignefraishorsforfait->getId()]);
        }

        return $this->render('lignefraishorsforfait/edit.html.twig', [
            'lignefraishorsforfait' => $lignefraishorsforfait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lignefraishorsforfait_delete", methods="DELETE")
     */
    public function delete(Request $request, Lignefraishorsforfait $lignefraishorsforfait): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignefraishorsforfait->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lignefraishorsforfait);
            $em->flush();
        }

        return $this->redirectToRoute('lignefraishorsforfait_index');
    }
}