<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController{

    /**
     * @Route("/register", name="security.register")
     */
    public function registration(ObjectManager $manager, Request $request, UserPasswordEncoderInterface $encoder){
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

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

    /**
     * @Route("/login", name="security.login")
     */
    public function login(){
        return $this->render('security/login.html.twig');

    }

    /**
     * @Route("/logout", name="security.logout")
     */
    public function logout(){}
}
