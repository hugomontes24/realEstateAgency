<?php

namespace App\Controller;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
  /**
   * Page de test
   * 
   * @Route('/', name = 'test')
   */
  public function hello()
  {
    var_dump( 'hello'); die();
    return new Response("accueil.");
  }

  /**
   * Page d'accueil
   * 
   * @Route('/home', name='accueil')
   */
  public function home()
  {
      return new Response("Bienvenue sur la page d'accueil.");
  }

  /**
   * Page d'accès à un article
   * 
   * @Route(
   *  "/article/{articleId<\d+}", 
   *  name="show-article",
   *  methods={"GET"})
   */
  public function show($articleId = 1)
  {
    return new Response("Voici le contenu de l'article avec l'id $articleId") ; 
  }


}
