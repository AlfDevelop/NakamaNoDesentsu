<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{
    /**
     * @Route("/", name="main.home")
     */
    public function index(){
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/contacts", name="main.contacts")
     */
    public function goToContacts(){
        return $this->render('main/contacts.html.twig');
    }

    /**
     * @Route("/forum", name="main.forum")
     */
    public function goToForum(){
        return $this->render('main/forum.html.twig');
    }

    /**
     * @Route("/download", name="main.download")
     */
    public function goToDownload(){
        return $this->render('main/download.html.twig');
    }



}
