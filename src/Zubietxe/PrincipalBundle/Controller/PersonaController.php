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
        $pers = $em->getRepository('ZubietxePrincipalBundle:Persona')->find($id);
                if (!$pers) {
                    throw $this->createNotFoundException(
                        'No se ha encontrado una persona con identificador '.$id
                    );
                }

        $grupo2 = $em->getRepository('ZubietxePrincipalBundle:Desplegables'); 
        $grupo = $em->getRepository('ZubietxePrincipalBundle:Indicadores'); 
        $opcionesInd = $em->getRepository('ZubietxePrincipalBundle:Indicadores')->opcionesIndicador();

        //$grupo2 = $em->getRepository('ZubietxePrincipalBundle:Desplegables')->findDesplegable('anosconsumo'); 


    	$form = $this->createForm(new PersonaType($grupo), $pers, array('opciones' => $opcionesInd));            

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
                'campos' => array(
                    array('var' => 'sexo', 'label' => 'Sexo', 'widget' => '2')
                ),
                'camp' => 'sexo'
	        ));
        }

    }
}


?>
