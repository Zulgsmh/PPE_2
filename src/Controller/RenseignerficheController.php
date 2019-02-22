<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Etat;
use App\Entity\Fichefrais;
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

    public function ajoutFicheFrais($mois,$visiteur,$Date,$Montant,$NbJustificatifs)
    {
        
        $em = $this->getDoctrine()->getManager();
        $repository= $this->getDoctrine()->getRepository(Fichefrais::class);
        $Fichefrais = $repository->findBy(['mois'=>$mois]);
           if (empty($Fichefrais))
           {
            $repository= $this->getDoctrine()->getRepository(Etat::class);
            $etat = $repository->findOneBy(['id'=>"CR"]);
               $Fichefrais = new Fichefrais();
               $Fichefrais->setMois($mois);
               $Fichefrais->setMontantvalide($Montant);
               $Fichefrais->setNbjustificatifs($NbJustificatifs);
               $Fichefrais->setDateModif($Date);
               $Fichefrais->setidvisiteur($visiteur);
                
               $Fichefrais->setIdEtat($etat);

               $em->persist($Fichefrais);
               $em->flush();

           }
           else
           {
               $MontantT=$Fichefrais[0]->getMontant()+$Montant;
               $Fichefrais[0]->setMontant($MontantT);

               $NbJustificatifsT=$Fichefrais[0]->getNbJustificatifs()+$NbJustificatifs;
               $Fichefrais[0]->setNbJustificatifs($NbJustificatifsT);

               $em->flush();

           }
        }

   



    /**
     * @Route("/Renseigner", name="Renseigner")
     */
    public function nouvelleFiche(Request $request ,  SessionInterface $session) //Permet de créer une ligne de frais (forfait ou hors forfait)
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

                    $uploadFile =  $lignefraishorsforfait -> getFichier();
                dump($uploadFile);

                    // $lignefraisho->getFichier() ;
                    // generateUniqueFileName() permet de generer une cle unique pour chaque fichier
                   $fileName =$uploadFile->getClientOriginalName();

                  // var_dump($uploadFile->guessExtension());
                    // Déplacez le fichier dans le répertoire où les brochures sont stockées dans le dossier web /uploads / documents
                   // $fileEx =  $uploadFile->getMimeType();
                   $document = new Document();
                    $uploadFile->move($this->getParameter('brochures_directory'),$fileName);
                   $document->setPath($fileName);
                   $document->setIdvisiteur($lignefraishorsforfait->getIdvisiteur());
                  

                   $em->persist($document);

                    $lignefraishorsforfaitCopie = new Lignefraishorsforfait();
                    $lignefraishorsforfaitCopie->setLibelle($lignefraishorsforfait->getLibelle());
                    $lignefraishorsforfaitCopie->setMois($lignefraishorsforfait->getMois());
                    $lignefraishorsforfaitCopie->setDate($lignefraishorsforfait->getDate());
                    $lignefraishorsforfaitCopie->setIdVisiteur($lignefraishorsforfait->getIdVisiteur());
                    $lignefraishorsforfaitCopie->setMontant($lignefraishorsforfait->getMontant());
                    $lignefraishorsforfaitCopie->setIddoc($document);
                    
                    
                    



                    $em->persist($lignefraishorsforfaitCopie);

                    

                   /* $fichefraisCopie = new fichefrais();
                    $fichefraisCopie->setIdvisiteur($lignefraishorsforfait->getIdvisiteur());
                    $fichefraisCopie->setMois($lignefraishorsforfait->getMois());
                    $fichefraisCopie->setNbjustificatifs(1);
                    $fichefraisCopie->setMontantvalide($lignefraishorsforfait->getMontant());
                    $fichefraisCopie->setDatemodif($lignefraishorsforfait->getDate());
                    $fichefraisCopie->setIdetat("CR"); */

                    //CreerFiche($lignefraishorsforfait);

                    //$em->persist($fichefraisCopie);
                    

                    $this->ajoutFicheFrais($lignefraishorsforfait->getMois(),
                    $lignefraishorsforfait->getIdvisiteur(),$lignefraishorsforfait->getDate(),
                    $lignefraishorsforfait->getMontant(),1);

                    $em->flush();
                    return $this->redirectToRoute('Renseigner');
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
