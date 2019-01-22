<?php

namespace App\Controller;

use App\Entity\Lignefraisforfait;
use App\Form\LignefraisforfaitType;
use App\Entity\Lignefraishorsforfait;
use App\Form\LignefraishorsforfaitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RenseignerficheController extends AbstractController
{
    /**
     * @Route("/Renseigner", name="Renseigner")
     */
    public function nouvelleFiche(Request $request ,  SessionInterface $session)
    {
        $lignefraishorsforfait = new Lignefraishorsforfait();
        $form1 = $this->createForm(LignefraishorsforfaitType::class, $lignefraishorsforfait);
        $form1->handleRequest($request);
        $lignefraisforfait = new Lignefraisforfait();
        $form2 = $this->createForm(LignefraisforfaitType::class, $lignefraisforfait);
        $form2->handleRequest($request);


        if ($request->getMethod() == 'POST') {


            if ($request->request->has('lignefraishorsforfait')) {
                dump("okkk");
                if($form1->isSubmitted() && $form1->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                   dump($lignefraishorsforfait);
                    $em->persist($lignefraishorsforfait);
                    $em->flush();
                    return $this->redirectToRoute('lignefraishorsforfait_index');
                }

 
            }

 
            if ($request->request->has('lignefraisforfait') ){
                if ($form2->isSubmitted() && $form2->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($lignefraisforfait);
                    $em->flush();
                    dump("ok1");
                   return $this->redirectToRoute('lignefraisforfait_index');
                }

            }

        }
 
        return $this->render('renseignerfiche/renseignerfiche.html.twig', array(
            'form1' => $form1->createView(),
            'form2' => $form2->createView()));
           }
        }
