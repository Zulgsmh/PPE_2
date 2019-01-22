<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Entity\Fichefrais;
use App\Entity\Lignefraisforfait;

use App\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/visiteur")
 */
class VisiteurController extends AbstractController
{
    /**
     * @Route("/", name="visiteur_index", methods="GET")
     */
    public function index(): Response
    {
        $visiteurs = $this->getDoctrine()
            ->getRepository(Visiteur::class)
            ->findAll();

        return $this->render('visiteur/index.html.twig', ['visiteurs' => $visiteurs]);
    }

    /**
     * @Route("/new", name="visiteur_new", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $visiteur = new Visiteur();
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //pour hasher le mdp
            $hash = $encoder->encodePassword($visiteur, $visiteur->getPassword());
            $visiteur->setPassword($hash);

            $em->persist($visiteur);
            $em->flush();

            return $this->redirectToRoute('visiteur_index');
        }

        return $this->render('visiteur/new.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visiteur_show", methods="GET")
     */
    public function show(Visiteur $visiteur): Response
    {
        return $this->render('visiteur/show.html.twig', ['visiteur' => $visiteur]);
    }

    /**
     * @Route("/{id}/edit", name="visiteur_edit", methods="GET|POST")
     */
    public function edit(Request $request, Visiteur $visiteur): Response
    {
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visiteur_index', ['id' => $visiteur->getId()]);
        }

        return $this->render('visiteur/edit.html.twig', [
            'visiteur' => $visiteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visiteur_delete", methods="DELETE")
     */
    public function delete(Request $request, Visiteur $visiteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visiteur->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($visiteur);
            $em->flush();
        }

        return $this->redirectToRoute('visiteur_index');
    }
    /**
     * @Route("/my_space/", name="visiteur_espace" ) 
     */
    public function showEspace(): Response
    {
        return $this->render('visiteur/PageChoixVisiteur.html.twig');
    }
    /**
     * @Route("/my_space/mes_fiches/", name="visiteur_listeFicheDeFrais")
     */
    public function showFicheDuClient(Visiteur $visiteur,Fichefrais $fichefrais,Lignefraisforfait $lignefraisforfait){

        $fichefrais = $this->getDoctrine()
            ->getRepository(Fichefrais::class)
            ->findAll();
        $lignefraisforfait = $this->getDoctrine()
            ->getRepository(Lignefraisforfait::class)
            ->findAll();        
        return $this->render('visiteur/listeFicheDeFrais.html.twig', ['visiteur' => $visiteur], ['fichefrais' => $fichefrais], ['lignefraisforfait' => $lignefraisforfait]);
    }

}
