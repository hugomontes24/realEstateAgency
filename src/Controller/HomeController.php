<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    // /** 
    //  * @var Environment
    //  */
    // private $twig;// on le remplace par extends Abstract/Controller

    // public function __construct(Environment $twig)
    // {
    //     $this->twig = $twig;
    // }

    /**
     * @Route ("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        // return new Response(content:'HelloWorld');
        // return new Response($this->twig->render('pages/home.html.twig'));
        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig',['properties'=>$properties]);
    }



}