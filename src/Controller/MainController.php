<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{

    /**
     * @Route ("/", name="main_home")
     */
    public function home() {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route ("/traducteur", name="test_home")
     */
    public function traducteur() {
        return $this->render("main/traducteur.html.twig");
    }

    /**
     * @Route ("/aboutus", name="about_home")
     */
    public function aboutUs() {
        return $this->render("main/aboutus.html.twig");
    }
}