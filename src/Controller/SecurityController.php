<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class SecurityController extends AbstractController{

    /**
     * @Route("/register", name="security.register")
     */
    public function registration(ObjectManager $manager, Request $request){
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user)
                     ->add('fname')
                     ->add('lname')
                     ->add('email')
                     ->add('username')
                     ->add('password');

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $user->setIsActive(true);
            $user->setCreatedAt(new \DateTime());

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('main.home');
            $this->addFlash('success', "Inscription réussie !");
        }

        return $this->render('main/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
