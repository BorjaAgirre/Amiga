<?php

namespace Zubietxe\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Zubietxe\PrincipalBundle\Entity\Desplegables;
use Zubietxe\PrincipalBundle\Entity\DesplegablesRepository;


class GuardadoController extends Controller
{
    public function indexAction()
    {


		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('ZubietxePrincipalBundle:Desplegables')->findByDespl('estudios');
	//	$product = 'superbien'; 


            //return new Response('Guardado ferpectamente!');
            return $this->render('ZubietxePrincipalBundle:Default:guardado.html.twig', 
            	array('product' => $product));
    }
}
