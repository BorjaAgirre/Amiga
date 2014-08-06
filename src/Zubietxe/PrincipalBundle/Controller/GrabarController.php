<?php

namespace Zubietxe\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zubietxe\PrincipalBundle\Controller\DatosTutor;

class GrabarController extends Controller
{
    public function indexAction($name)
    {
    	$datos = new DatosTutor();
    	$tutores = $datos->grabar(); 
    	$result = $tutores[$name]['nombre'];

	    $em = $this->getDoctrine()->getManager();

    	foreach ($tutores as $dato_tut) {
    		
			$em->persist($tutor);
		}

			    $em->flush();

        return $this->render('ZubietxePrincipalBundle:Default:index.html.twig', array('name' => $result));
    }
}
