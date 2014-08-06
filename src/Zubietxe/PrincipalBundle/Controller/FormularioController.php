<?php
namespace Zubietxe\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zubietxe\PrincipalBundle\Entity\Actividad;
use Zubietxe\PrincipalBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FormularioController extends Controller
{
    public function activAction(Request $request)
    {
    // create a activ and give it some dummy data for this example
    //     $activ = new Actividad();
        $activ = $this->getDoctrine()->getRepository('ZubietxePrincipalBundle:Actividad')->find('122');
                if (!$activ) {
                    throw $this->createNotFoundException(
                        'No se ha encontrado una actividad con identificador 122'
                    );
                }

    	$form = $this->createForm(new ActividadType(), $activ);            

		$form->handleRequest($request);

	    if ($form->isValid()) {
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($activ);
		    $em->flush();
	     //return $this->redirect($this->generateUrl('guardado'));
            return new Response('Guardado!');
	       // return $this->render('ZubietxePrincipalBundle:Default:index.html.twig', array('name' => $pers->getIdUnico()));

	    } else {
	        return $this->render('ZubietxePrincipalBundle:Default:index.html.twig', array(
	            'form' => $form->createView(),
	        ));
        }

    }
}


?>
