<?php

namespace Amiga\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AmigaPrincipalBundle:Default:index.html.twig', array('name' => $name));
    }
}
