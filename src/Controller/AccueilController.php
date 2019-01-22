<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use App\Entity\Visiteur;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
        public function indexAction(Request $request)
        {
                    // creates a task and gives it some dummy data for this example

            return $this->render('accueil/index.html.twig');
            
        }
    /**
     * @Route("/formI", name="ajouterTask")
     */
        public function insertTaskAction(Request $request)
        {


            $task = new Task();
            $task->setTask('Write a blog post');
            $task->setDueDate(new \DateTime('tomorrow'));
            
                $form = $this->createFormBuilder($task)
                    ->add('task', TextType::class)
                    ->add('dueDate', DateType::class)
                    ->add('save', SubmitType::class, array('label' => 'Create Task'))
                    ->getForm();
           
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $task = $form->getData();

               dump($task);
        
                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                // $entityManager = $this->getDoctrine()->getManager();
                // $entityManager->persist($task);
                // $entityManager->flush();
        
                return $this->redirectToRoute('accueil');
            }
        
            return $this->render('inscription/addTask.html.twig', array(
                'form' => $form->createView(),
            ));
        }

     /**
     * @Route("/formC", name="myformConnexion")
     */
        public function connectVisiteurAction()
        {
           // dump($id);
           return $this->render('connexion/formulaireConnexion.html.twig');
        }
    /**
     * @Route("/formCreate/visiteur", name="myformInscription")
     */
        public function createVisiteur()
        {
            return $this->render('inscription/formulaireInscription.html.twig');
        }
    }