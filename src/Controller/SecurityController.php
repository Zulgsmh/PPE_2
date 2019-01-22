<?php

namespace App\Controller;
use App\Entity\Visiteur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login1")
     */
    public function login(Request $request, SessionInterface $session)
    {
        $form = $this->createFormBuilder()
            ->add('login', TextType::class, array('label' => 'Login'))
            ->add('mdp', PasswordType::class, array('label' => 'Mot de passe'))
            ->add('Connexion', SubmitType::class, array('label' => 'Connexion'))
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $donnee = $form->getData();
                $repository = $this->getDoctrine()->getRepository(Visiteur::class);
                $visiteur= $repository->findOneBy([
                    'login' => $donnee ['login'],
                    'mdp' => $donnee ['mdp'],
                ]);
                if (!empty($visiteur)){
                   // $session = new Session();
                   // $session->start();
                    $session->set('visiteur', $visiteur);

                    // set flash messages
                    $session->getFlashBag()->add('information', 'Vous êtes bien connecté');
                    return $this->redirectToRoute('accueil');
                }

                var_dump($visiteur);

            }

        return $this->render('security/login.html.twig', array(
            'form' => $form->createView(),
        ));
    }
        /**
     * @Route("/deconnecter", name="deconnecter")
     */
    public function deconnecterVisiteur(Request $request, SessionInterface $session){

        $session->remove('visiteur');
        return $this->render('accueil/index.html.twig');
    
    }
}
?>