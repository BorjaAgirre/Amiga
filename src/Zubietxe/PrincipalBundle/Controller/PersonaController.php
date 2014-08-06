<?php
namespace Zubietxe\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zubietxe\PrincipalBundle\Entity\Persona;
use Zubietxe\PrincipalBundle\Form\PersonaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class personaController extends Controller
{
    public function activAction(Request $request, $id)
    {
    // create a activ and give it some dummy data for this example
    //     $activ = new Actividad();
        $em = $this->getDoctrine();
        $pers = $em->getRepository('ZubietxePrincipalBundle:Persona')->find('1024');
                if (!$pers) {
                    throw $this->createNotFoundException(
                        'No se ha encontrado una persona con identificador 1024'
                    );
                }

        $grupo = $em->getRepository('ZubietxePrincipalBundle:Desplegables'); 
        $grupo2 = $em->getRepository('ZubietxePrincipalBundle:Desplegables')->findDesplegable('anosconsumo'); 


    	$form = $this->createForm(new PersonaType($grupo), $pers);            

		$form->handleRequest($request);

	    if ($form->isValid()) {
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($pers);
		    $em->flush();
	     //return $this->redirect($this->generateUrl('guardado'));
            return new Response('Guardado persona!');
	       // return $this->render('ZubietxePrincipalBundle:Default:index.html.twig', array('name' => $pers->getIdUnico()));

	    } else {
	        return $this->render('ZubietxePrincipalBundle:Default:persona.html.twig', array(
	            'form' => $form->createView(),
	        ));
        }

    }
}


?>
