<?php

namespace Zubietxe\PrincipalBundle\Controller;

use Zubietxe\PrincipalBundle\Entity\Actividad;
use Zubietxe\PrincipalBundle\Form\ActividadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;




class PrincipalController extends Controller
{
			public function newAction($id)
			{
			    $actividad = $this->getDoctrine()->getRepository('ZubietxePrincipalBundle:Actividad')->find($id);
			    if (!$activ) {
			        throw $this->createNotFoundException(
			            'No se ha encontrado una actividad con identificador 122 '
			        );
			    }


			    $form = $this->createForm(new ActividadType(), $actividad);

	        	return $this->render('ZubietxePrincipalBundle:Default:index.html.twig', array('name' => "Todo en orden"));

			}
}