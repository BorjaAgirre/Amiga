<?php

namespace Zubietxe\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Doctrine\ORM\EntityRepository;

class PersonaType extends AbstractType
{


        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $opcionesInd = $options['opciones'];
        $tituloInd = $options['titulos'];
        $despl = $options['despl'];
/*        foreach ($indicadores as $row)  {
 //           if (isset($opcionesInd[$row->getIndicador()])) {
            if ($row->getTitulo() == 't') {
                if (isset($opcionesInd[$row->getIndicador()])) {
                    $builder->add($row->getIndicador(), 'choice', array(
                    'label' => $row->getTexto(),
                    'choices' => $opcionesInd[$row->getIndicador()]
                    ));
                } else {
                    $builder->add($row->getIndicador(), 'text', array(
                    'label' => $row->getTexto()
                    ));
                }
            }
        }
*/
        $builder
            ->add('sexo', 'choice', array(
                'label' => 'Nacionalidad',
                'choices' => $despl->findDesplegable('sexo')
                ))    
            ->add('nombre')
            ->add('apellido1')
            ->add('apellido2')
            ->add('fechanac', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('lugarnac')
            ->add('dni')
            ->add('pasaporte')
            ->add('nie')
            ->add('numsegsoc')
            ->add('numexpediente')
            ->add('nacionalidad', 'choice', array(
                'label' => 'Nacionalidad',
                'choices' => $despl->findDesplegable('paises_mundo')
                ))    
            ->add('telefono')
            ->add('direccionactual')
            ->add('poblacion', 'choice', array(
                'choices' => $despl->findDesplegable('poblaciones')
                ))    
            ->add('nucleoconv', 'choice', array(
                'choices' => $despl->findDesplegable('nucleoconv')
                ))    
            ->add('estadocivil', 'choice', array(
                'choices' => $despl->findDesplegable('estado_civil')
                ))    
            ->add('hijos')
            ->add('numhijos')
            ->add('observacioneshijos')
            ->add('telefonosinteres')
            ->add('fechaingreso', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('fechasalida', 'date', array('widget' => 'single_text', 'format' => 'dd-M-yyyy'))
            ->add('procedenciademanda')
            ->add('responsable')
            ->add('comedorlun')
            ->add('comedormar')
            ->add('comedormie')
            ->add('comedorjue')
            ->add('comedorvie')
            ->add('transporte')
            ->add('listaespera')
            ->add('observacionesnivelformativo')
            ->add('nivelformativo')
            ->add('observacionesidioma')
            ->add('edadabandonoestudios')
            ->add('laboralorigen')
            ->add('laboralespana')
            ->add('tiempotrabajado')
            ->add('trabaja')
            ->add('autonomia')
            ->add('disminucionfisica')
            ->add('minusvaliaporcentaje')
            ->add('incapacitacion')
            ->add('toxicomania')
            ->add('antecconsumo')
            ->add('disminucionpsiquica')
            ->add('enfermedadmental')
            ->add('tuberculosis')
            ->add('hepatitis')
            ->add('vih')
            ->add('diabetes')
            ->add('otras')
            ->add('enfermedadescomentarios')
            ->add('medicacion')
            ->add('enfmentaldiagnostico')
            ->add('enfmentalfechadiagn')
            ->add('enfmentaltratamiento')
            ->add('enfmentalingresos')
            ->add('enfmentalpadres')
            ->add('enfmentalhermanos')
            ->add('enfmentalpareja')
            ->add('enfmentalhijos')
            ->add('drogaspadres')
            ->add('drogashermanos')
            ->add('drogaspareja')
            ->add('drogashijos')
            ->add('permisoresid')
            ->add('permisoresidtr')
            ->add('numpasap')
            ->add('fechapasap')
            ->add('numcedula')
            ->add('fechacaduccedula')
            ->add('fecharesidsolicit')
            ->add('numresidconced')
            ->add('fecharesidconced')
            ->add('fecharesidtrabsolicit')
            ->add('numresidtrabconc')
            ->add('fecharesidtrabconc')
            ->add('visado')
            ->add('asilo')
            ->add('otrosdoc')
            ->add('fechaentrada')
            ->add('fechaprueba')
            ->add('abogadootros')
            ->add('permisoresidrazonesno')
            ->add('permisosolicitudlugar')
            ->add('tiemporesidenciaespanya')
            ->add('tiemporesidenciabilbao')
            ->add('permisotrabajo')
            ->add('permisotrabajorazonesno')
            ->add('fechaempadronamiento')
            ->add('direccionpadronactual')
            ->add('tis')
            ->add('redapoyo')
            ->add('ingresospropios')
            ->add('ingresospnc')
            ->add('ingresosotros')
            ->add('ingresosnomina')
            ->add('ingresosrgi')
            ->add('ingresosprestcontrib')
            ->add('ingresossedesconoce')
            ->add('ingresosayudaindividual')
            ->add('ingresosno')
            ->add('penalantecedentesprision')
            ->add('penalordenalejamiento')
            ->add('penalprisionpreventiva')
            ->add('penalprisionotros')
            ->add('penallibcondicional')
            ->add('penalmedidaseguridad')
            ->add('penalcausaspendientes')
            ->add('penalpermisopenitenc')
            ->add('penaltercergrado')
            ->add('penaltbc')
            ->add('ducha')
            ->add('ropero')
            ->add('lavanderia')
            ->add('tlsabado')
            ->add('tldomingo')
            ->add('salidaverano')
            ->add('salidaotro')
            ->add('medicacioncentro')
            ->add('nivelcastellano')
            ->add('explaboral')
            ->add('lanbide')
            ->add('fechaaltalanbide')
            ->add('fecharenovlanbide')
            ->add('inem')
            ->add('fechaaltainem')
            ->add('fecharenovinem')
            ->add('cursos')
            ->add('poblacionpadron')
            ->add('consumoprinc')
            ->add('insertidusuario')
            ->add('fechainsert')
            ->add('anosconsumo')
            ->add('tratamiento')
            ->add('tratamientotipo')
            ->add('procedenciademandalista')
            ->add('situacionadministrativa')
            ->add('fechacaductis')
            ->add('ind1x1', 'choice', array(
                'label' => $tituloInd['ind1x1'],
                'choices' => $opcionesInd['ind1x1']
                ))
            ->add('ind1x1xA', 'choice', array(
                'label' => $tituloInd['ind1x1xA'],
                'choices' => $opcionesInd['ind1x1xA']
                ))
            ->add('ind1x2', 'choice', array(
                'label' => $tituloInd['ind1x2'],
                'choices' => $opcionesInd['ind1x2']
                ))
            ->add('ind1x2xA', 'choice', array(
                'label' => $tituloInd['ind1x2xA'],
                'choices' => $opcionesInd['ind1x2xA']
                ))
            ->add('ind1x3', 'choice', array(
                'label' => $tituloInd['ind1x3'],
                'choices' => $opcionesInd['ind1x3']
                ))
            ->add('ind1x4', 'choice', array(
                'label' => $tituloInd['ind1x4'],
                'choices' => $opcionesInd['ind1x4']
                ))
            ->add('ind1x5', 'choice', array(
                'label' => $tituloInd['ind1x5'],
                'choices' => $opcionesInd['ind1x5']
                ))
            ->add('ind1x5xA', 'choice', array(
                'label' => $tituloInd['ind1x5xA'],
                'choices' => $opcionesInd['ind1x5xA']
                ))
            ->add('ind1x6', 'choice', array(
                'label' => $tituloInd['ind1x6'],
                'choices' => $opcionesInd['ind1x6']
                ))
            ->add('ind1x7', 'choice', array(
                'label' => $tituloInd['ind1x7'],
                'choices' => $opcionesInd['ind1x7']
                ))
            ->add('ind2x1', 'choice', array(
                'label' => $tituloInd['ind2x1'],
                'choices' => $opcionesInd['ind2x1']
                ))
            ->add('ind2xAx1', 'choice', array(
                'label' => $tituloInd['ind2xAx1'],
                'choices' => $opcionesInd['ind2xAx1']
                ))
            ->add('ind2xAx2', 'choice', array(
                'label' => $tituloInd['ind2xAx2'],
                'choices' => $opcionesInd['ind2xAx2']
                ))
            ->add('ind2xAx3', 'choice', array(
                'label' => $tituloInd['ind2xAx3'],
                'choices' => $opcionesInd['ind2xAx3']
                ))
            ->add('ind2xAx4', 'choice', array(
                'label' => $tituloInd['ind2xAx4'],
                'choices' => $opcionesInd['ind2xAx4']
                ))
            ->add('ind2xBx1', 'choice', array(
                'label' => $tituloInd['ind2xBx1'],
                'choices' => $opcionesInd['ind2xBx1']
                ))
            ->add('ind2xBx2', 'choice', array(
                'label' => $tituloInd['ind2xBx2'],
                'choices' => $opcionesInd['ind2xBx2']
                ))
            ->add('ind3x1', 'choice', array(
                'label' => $tituloInd['ind3x1'],
                'choices' => $opcionesInd['ind3x1']
                ))
            ->add('ind3x1xA', 'choice', array(
                'label' => $tituloInd['ind3x1xA'],
                'choices' => $opcionesInd['ind3x1xA']
                ))
            ->add('ind3x2', 'choice', array(
                'label' => $tituloInd['ind3x2'],
                'choices' => $opcionesInd['ind3x2']
                ))
            ->add('ind3x2xE', 'choice', array(
                'label' => $tituloInd['ind3x2xE'],
                'choices' => $opcionesInd['ind3x2xE']
                ))
            ->add('ind3x2xD', 'choice', array(
                'label' => $tituloInd['ind3x2xD'],
                'choices' => $opcionesInd['ind3x2xD']
                ))
            ->add('ind3x2xR', 'choice', array(
                'label' => $tituloInd['ind3x2xR'],
                'choices' => $opcionesInd['ind3x2xR']
                ))
            ->add('ind3x3', 'choice', array(
                'label' => $tituloInd['ind3x3'],
                'choices' => $opcionesInd['ind3x3']
                ))
            ->add('ind3x3xT', 'choice', array(
                'label' => $tituloInd['ind3x3xT'],
                'choices' => $opcionesInd['ind3x3xT']
                ))
            ->add('ind3x4', 'choice', array(
                'label' => $tituloInd['ind3x4'],
                'choices' => $opcionesInd['ind3x4']
                ))
            ->add('indTx1', 'choice', array(
                'label' => $tituloInd['indTx1'],
                'choices' => $opcionesInd['indTx1']
                ))
            ->add('indTx2', 'choice', array(
                'label' => $tituloInd['indTx2'],
                'choices' => $opcionesInd['indTx2']
                ))
            ->add('indTx3', 'choice', array(
                'label' => $tituloInd['indTx3'],
                'choices' => $opcionesInd['indTx3']
                ))
            ->add('indTx4', 'choice', array(
                'label' => $tituloInd['indTx4'],
                'choices' => $opcionesInd['indTx4']
                ))
            ->add('ind4x1', 'choice', array(
                'label' => $tituloInd['ind4x1'],
                'choices' => $opcionesInd['ind4x1']
                ))
            ->add('ind4x2', 'text', array(
                'label' => $tituloInd['ind4x2'],
                'required'    => false,
                ))
            ->add('ind4x2xA', 'choice', array(
                'label' => $tituloInd['ind4x2xA'],
                'choices' => $opcionesInd['ind4x2xA']
                ))
            ->add('ind4x2xB', 'choice', array(
                'label' => $tituloInd['ind4x2xB'],
                'choices' => $opcionesInd['ind4x2xB']
                ))
            ->add('ind4x2xC', 'choice', array(
                'label' => $tituloInd['ind4x2xC'],
                'choices' => $opcionesInd['ind4x2xC']
                ))
            ->add('ind4x3', 'choice', array(
                'label' => $tituloInd['ind4x3'],
                'choices' => $opcionesInd['ind4x3']
                ))
            ->add('ind4x3x1', 'choice', array(
                'label' => $tituloInd['ind4x3x1'],
                'choices' => $opcionesInd['ind4x3x1']
                ))
            ->add('ind4x3x2', 'choice', array(
                'label' => $tituloInd['ind4x3x2'],
                'choices' => $opcionesInd['ind4x3x2']
                ))
            ->add('ind4x3x3', 'choice', array(
                'label' => $tituloInd['ind4x3x3'],
                'choices' => $opcionesInd['ind4x3x3']
                ))
            ->add('ind4xAx1', 'choice', array(
                'label' => $tituloInd['ind4xAx1'],
                'choices' => $opcionesInd['ind4xAx1']
                ))
            ->add('ind4xAx2', 'choice', array(
                'label' => $tituloInd['ind4xAx2'],
                'choices' => $opcionesInd['ind4xAx2']
                ))
            ->add('ind4xAx3', 'choice', array(
                'label' => $tituloInd['ind4xAx3'],
                'choices' => $opcionesInd['ind4xAx3']
                ))
            ->add('ind4xAx4', 'choice', array(
                'label' => $tituloInd['ind4xAx4'],
                'choices' => $opcionesInd['ind4xAx4']
                ))
            ->add('ind4xAx5', 'choice', array(
                'label' => $tituloInd['ind4xAx5'],
                'choices' => $opcionesInd['ind4xAx5']
                ))
            ->add('ind4xAx6', 'choice', array(
                'label' => $tituloInd['ind4xAx6'],
                'choices' => $opcionesInd['ind4xAx6']
                ))
            ->add('ind4xBx1', 'choice', array(
                'label' => $tituloInd['ind4xBx1'],
                'choices' => $opcionesInd['ind4xBx1']
                ))
            ->add('ind4xBx2', 'choice', array(
                'label' => $tituloInd['ind4xBx2'],
                'choices' => $opcionesInd['ind4xBx2']
                ))
            ->add('ind4xCx1', 'choice', array(
                'label' => $tituloInd['ind4xCx1'],
                'choices' => $opcionesInd['ind4xCx1']
                ))
            ->add('ind4xCx2', 'choice', array(
                'label' => $tituloInd['ind4xCx2'],
                'choices' => $opcionesInd['ind4xCx2']
                ))
            ->add('ind4xCx3', 'choice', array(
                'label' => $tituloInd['ind4xCx3'],
                'choices' => $opcionesInd['ind4xCx3']
                ))
            ->add('ind4xCx4', 'choice', array(
                'label' => $tituloInd['ind4xCx4'],
                'choices' => $opcionesInd['ind4xCx4']
                ))
            ->add('ind5x1', 'choice', array(
                'label' => $tituloInd['ind5x1'],
                'choices' => $opcionesInd['ind5x1']
                ))
            ->add('ind5x2', 'choice', array(
                'label' => $tituloInd['ind5x2'],
                'choices' => $opcionesInd['ind5x2']
                ))
            ->add('ind5x3', 'choice', array(
                'label' => $tituloInd['ind5x3'],
                'choices' => $opcionesInd['ind5x3']
                ))
            ->add('ind5x4', 'choice', array(
                'label' => $tituloInd['ind5x4'],
                'choices' => $opcionesInd['ind5x4']
                ))
            ->add('ind5x5', 'choice', array(
                'label' => $tituloInd['ind5x5'],
                'choices' => $opcionesInd['ind5x5']
                ))
            ->add('ind6x1', 'text', array(
                'label' => $tituloInd['ind6x1'],
                'required'    => false,
                ))
            ->add('ind6x1x1', 'choice', array(
                'label' => $tituloInd['ind6x1x1'],
                'choices' => $opcionesInd['ind6x1x1']
                ))
            ->add('ind6x1x2', 'choice', array(
                'label' => $tituloInd['ind6x1x2'],
                'choices' => $opcionesInd['ind6x1x2']
                ))
            ->add('ind6x1x3', 'choice', array(
                'label' => $tituloInd['ind6x1x3'],
                'choices' => $opcionesInd['ind6x1x3']
                ))
            ->add('ind6x2', 'choice', array(
                'label' => $tituloInd['ind6x2'],
                'choices' => $opcionesInd['ind6x2']
                ))
            ->add('ind6x3', 'choice', array(
                'label' => $tituloInd['ind6x3'],
                'choices' => $opcionesInd['ind6x3']
                ))
            ->add('ind6x4', 'choice', array(
                'label' => $tituloInd['ind6x4'],
                'choices' => $opcionesInd['ind6x4']
                ))
            ->add('ind7xAx1', 'choice', array(
                'label' => $tituloInd['ind7xAx1'],
                'choices' => $opcionesInd['ind7xAx1']
                ))
            ->add('ind7xAx2', 'choice', array(
                'label' => $tituloInd['ind7xAx2'],
                'choices' => $opcionesInd['ind7xAx2']
                ))
            ->add('ind7xAx3', 'choice', array(
                'label' => $tituloInd['ind7xAx3'],
                'choices' => $opcionesInd['ind7xAx3']
                ))
            ->add('ind7xAx4', 'choice', array(
                'label' => $tituloInd['ind7xAx4'],
                'choices' => $opcionesInd['ind7xAx4']
                ))
            ->add('ind7xAx5', 'choice', array(
                'label' => $tituloInd['ind7xAx5'],
                'choices' => $opcionesInd['ind7xAx5']
                ))
            ->add('ind7xAx6', 'choice', array(
                'label' => $tituloInd['ind7xAx6'],
                'choices' => $opcionesInd['ind7xAx6']
                ))
            ->add('ind7xAx7', 'choice', array(
                'label' => $tituloInd['ind7xAx7'],
                'choices' => $opcionesInd['ind7xAx7']
                ))
            ->add('ind7xBx1', 'choice', array(
                'label' => $tituloInd['ind7xBx1'],
                'choices' => $opcionesInd['ind7xBx1']
                ))
            ->add('ind7xBx2', 'choice', array(
                'label' => $tituloInd['ind7xBx2'],
                'choices' => $opcionesInd['ind7xBx2']
                ))
            ->add('ind7xBx3', 'choice', array(
                'label' => $tituloInd['ind7xBx3'],
                'choices' => $opcionesInd['ind7xBx3']
                ))
            ->add('ind7xBx4', 'choice', array(
                'label' => $tituloInd['ind7xBx4'],
                'choices' => $opcionesInd['ind7xBx4']
                ))
            ->add('ind7xBx5', 'choice', array(
                'label' => $tituloInd['ind7xBx5'],
                'choices' => $opcionesInd['ind7xBx5']
                ))
            ->add('ind8x1', 'choice', array(
                'label' => $tituloInd['ind8x1'],
                'choices' => $opcionesInd['ind8x1']
                ))
            ->add('ind8x2', 'choice', array(
                'label' => $tituloInd['ind8x2'],
                'choices' => $opcionesInd['ind8x2']
                ))
            ->add('ind8x3', 'choice', array(
                'label' => $tituloInd['ind8x3'],
                'choices' => $opcionesInd['ind8x3']
                ))
            ->add('ind8x4', 'choice', array(
                'label' => $tituloInd['ind8x4'],
                'choices' => $opcionesInd['ind8x4']
                ))
            ->add('indTx5', 'choice', array(
                'label' => $tituloInd['indTx5'],
                'choices' => $opcionesInd['indTx5']
                ))
            ->add('indTx6', 'choice', array(
                'label' => $tituloInd['indTx6'],
                'choices' => $opcionesInd['indTx6']
                ))
            ->add('indTx7', 'choice', array(
                'label' => $tituloInd['indTx7'],
                'choices' => $opcionesInd['indTx7']
                ))
            ->add('indTx8', 'choice', array(
                'label' => $tituloInd['indTx8'],
                'choices' => $opcionesInd['indTx8']
                ))
            ->add('indTx9', 'choice', array(
                'label' => $tituloInd['indTx9'],
                'choices' => $opcionesInd['indTx9']
                ))
            ->add('indTx10', 'choice', array(
                'label' => $tituloInd['indTx10'],
                'choices' => $opcionesInd['indTx10']
                ))
            ->add('indTx11', 'choice', array(
                'label' => $tituloInd['indTx11'],
                'choices' => $opcionesInd['indTx11']
                ))
            ->add('indTx12', 'choice', array(
                'label' => $tituloInd['indTx12'],
                'choices' => $opcionesInd['indTx12']
                ))
            ->add('indTx13', 'choice', array(
                'label' => $tituloInd['indTx13'],
                'choices' => $opcionesInd['indTx13']
                ))
            ->add('indTx14', 'choice', array(
                'label' => $tituloInd['indTx14'],
                'choices' => $opcionesInd['indTx14']
                ))
            ->add('indTx15', 'choice', array(
                'label' => $tituloInd['indTx15'],
                'choices' => $opcionesInd['indTx15']
                ))
            ->add('indTx16', 'choice', array(
                'label' => $tituloInd['indTx16'],
                'choices' => $opcionesInd['indTx16']
                ))
            ->add('ind9xAx1', 'choice', array(
                'label' => $tituloInd['ind9xAx1'],
                'choices' => $opcionesInd['ind9xAx1']
                ))
            ->add('ind9xAx2', 'choice', array(
                'label' => $tituloInd['ind9xAx2'],
                'choices' => $opcionesInd['ind9xAx2']
                ))
            ->add('ind9xAx3', 'choice', array(
                'label' => $tituloInd['ind9xAx3'],
                'choices' => $opcionesInd['ind9xAx3']
                ))
            ->add('ind9xAx4', 'choice', array(
                'label' => $tituloInd['ind9xAx4'],
                'choices' => $opcionesInd['ind9xAx4']
                ))
            ->add('ind9xAx5', 'choice', array(
                'label' => $tituloInd['ind9xAx5'],
                'choices' => $opcionesInd['ind9xAx5']
                ))
            ->add('ind9xBx1', 'choice', array(
                'label' => $tituloInd['ind9xBx1'],
                'choices' => $opcionesInd['ind9xBx1']
                ))
            ->add('ind9xBx2', 'choice', array(
                'label' => $tituloInd['ind9xBx2'],
                'choices' => $opcionesInd['ind9xBx2']
                ))
            ->add('ind9xBx3', 'choice', array(
                'label' => $tituloInd['ind9xBx3'],
                'choices' => $opcionesInd['ind9xBx3']
                ))
            ->add('ind9xBx4', 'choice', array(
                'label' => $tituloInd['ind9xBx4'],
                'choices' => $opcionesInd['ind9xBx4']
                ))
            ->add('ind9xBx5', 'choice', array(
                'label' => $tituloInd['ind9xBx5'],
                'choices' => $opcionesInd['ind9xBx5']
                ))
            ->add('ind9xCx1', 'choice', array(
                'label' => $tituloInd['ind9xCx1'],
                'choices' => $opcionesInd['ind9xCx1']
                ))
            ->add('ind9xCx2', 'choice', array(
                'label' => $tituloInd['ind9xCx2'],
                'choices' => $opcionesInd['ind9xCx2']
                ))
            ->add('ind9xCx3', 'choice', array(
                'label' => $tituloInd['ind9xCx3'],
                'choices' => $opcionesInd['ind9xCx3']
                ))
            ->add('ind9xCx4', 'choice', array(
                'label' => $tituloInd['ind9xCx4'],
                'choices' => $opcionesInd['ind9xCx4']
                ))
            ->add('ind9xCx5', 'choice', array(
                'label' => $tituloInd['ind9xCx5'],
                'choices' => $opcionesInd['ind9xCx5']
                ))
            ->add('ind9xCx6', 'choice', array(
                'label' => $tituloInd['ind9xCx6'],
                'choices' => $opcionesInd['ind9xCx6']
                ))
            ->add('ind9xDx1', 'choice', array(
                'label' => $tituloInd['ind9xDx1'],
                'choices' => $opcionesInd['ind9xDx1']
                ))
            ->add('ind9xDx2', 'choice', array(
                'label' => $tituloInd['ind9xDx2'],
                'choices' => $opcionesInd['ind9xDx2']
                ))
            ->add('ind9xDx3', 'choice', array(
                'label' => $tituloInd['ind9xDx3'],
                'choices' => $opcionesInd['ind9xDx3']
                ))
            ->add('ind9xDx4', 'choice', array(
                'label' => $tituloInd['ind9xDx4'],
                'choices' => $opcionesInd['ind9xDx4']
                ))
            ->add('ind9xDx5', 'choice', array(
                'label' => $tituloInd['ind9xDx5'],
                'choices' => $opcionesInd['ind9xDx5']
                ))
            ->add('ind9xDx6', 'choice', array(
                'label' => $tituloInd['ind9xDx6'],
                'choices' => $opcionesInd['ind9xDx6']
                ))
            ->add('ind9xDx7', 'choice', array(
                'label' => $tituloInd['ind9xDx7'],
                'choices' => $opcionesInd['ind9xDx7']
                ))
            ->add('ind9xDx8', 'choice', array(
                'label' => $tituloInd['ind9xDx8'],
                'choices' => $opcionesInd['ind9xDx8']
                ))
            ->add('ind10x1', 'choice', array(
                'label' => $tituloInd['ind10x1'],
                'choices' => $opcionesInd['ind10x1']
                ))
            ->add('ind10x2', 'text', array(
                'label' => $tituloInd['ind10x2'],
                'required'    => false,
                ))
            ->add('ind10x2x1', 'choice', array(
                'label' => $tituloInd['ind10x2x1'],
                'choices' => $opcionesInd['ind10x2x1']
                ))
            ->add('ind10x2x1xA', 'choice', array(
                'label' => $tituloInd['ind10x2x1xA'],
                'choices' => $opcionesInd['ind10x2x1xA']
                ))
            ->add('ind10x2x2', 'choice', array(
                'label' => $tituloInd['ind10x2x2'],
                'choices' => $opcionesInd['ind10x2x2']
                ))
            ->add('ind10x3', 'choice', array(
                'label' => $tituloInd['ind10x3'],
                'choices' => $opcionesInd['ind10x3']
                ))
            ->add('ind10x4', 'choice', array(
                'label' => $tituloInd['ind10x4'],
                'choices' => $opcionesInd['ind10x4']
                ))
            ->add('ind10x5', 'choice', array(
                'label' => $tituloInd['ind10x5'],
                'choices' => $opcionesInd['ind10x5']
                ))
            ->add('ind10x6', 'choice', array(
                'label' => $tituloInd['ind10x6'],
                'choices' => $opcionesInd['ind10x6']
                ))
            ->add('ind10x7', 'choice', array(
                'label' => $tituloInd['ind10x7'],
                'choices' => $opcionesInd['ind10x7']
                ))
            ->add('ind10x8', 'choice', array(
                'label' => $tituloInd['ind10x8'],
                'choices' => $opcionesInd['ind10x8']
                ))
            ->add('ind10xAx1', 'choice', array(
                'label' => $tituloInd['ind10xAx1'],
                'choices' => $opcionesInd['ind10xAx1']
                ))
            ->add('ind10xAx2', 'choice', array(
                'label' => $tituloInd['ind10xAx2'],
                'choices' => $opcionesInd['ind10xAx2']
                ))
            ->add('ind10xAx3', 'choice', array(
                'label' => $tituloInd['ind10xAx3'],
                'choices' => $opcionesInd['ind10xAx3']
                ))
            ->add('ind10xAx4', 'choice', array(
                'label' => $tituloInd['ind10xAx4'],
                'choices' => $opcionesInd['ind10xAx4']
                ))
            ->add('ind11x1', 'choice', array(
                'label' => $tituloInd['ind11x1'],
                'choices' => $opcionesInd['ind11x1']
                ))
            ->add('ind11x2', 'choice', array(
                'label' => $tituloInd['ind11x2'],
                'choices' => $opcionesInd['ind11x2']
                ))
            ->add('ind11x3', 'choice', array(
                'label' => $tituloInd['ind11x3'],
                'choices' => $opcionesInd['ind11x3']
                ))
            ->add('ind11x4', 'choice', array(
                'label' => $tituloInd['ind11x4'],
                'choices' => $opcionesInd['ind11x4']
                ))
            ->add('ind11x5', 'choice', array(
                'label' => $tituloInd['ind11x5'],
                'choices' => $opcionesInd['ind11x5']
                ))
            ->add('ind11x6', 'choice', array(
                'label' => $tituloInd['ind11x6'],
                'choices' => $opcionesInd['ind11x6']
                ))
            ->add('ind11x7', 'choice', array(
                'label' => $tituloInd['ind11x7'],
                'choices' => $opcionesInd['ind11x7']
                ))
            ->add('ind12x1', 'choice', array(
                'label' => $tituloInd['ind12x1'],
                'choices' => $opcionesInd['ind12x1']
                ))
            ->add('ind12x2', 'choice', array(
                'label' => $tituloInd['ind12x2'],
                'choices' => $opcionesInd['ind12x2']
                ))
            ->add('ind12x3', 'choice', array(
                'label' => $tituloInd['ind12x3'],
                'choices' => $opcionesInd['ind12x3']
                ))
            ->add('indTx17', 'text', array(
                'label' => $tituloInd['indTx17'],
                'required'    => false,
                ))
            ->add('indTx17xA', 'choice', array(
                'label' => $tituloInd['indTx17xA'],
                'choices' => $opcionesInd['indTx17xA']
                ))
            ->add('indTx17xB', 'choice', array(
                'label' => $tituloInd['indTx17xB'],
                'choices' => $opcionesInd['indTx17xB']
                ))
            ->add('indTx18', 'choice', array(
                'label' => $tituloInd['indTx18'],
                'choices' => $opcionesInd['indTx18']
                ))
            ->add('indTx19', 'choice', array(
                'label' => $tituloInd['indTx19'],
                'choices' => $opcionesInd['indTx19']
                ))
            ->add('ind13x1', 'choice', array(
                'label' => $tituloInd['ind13x1'],
                'choices' => $opcionesInd['ind13x1']
                ))
            ->add('ind13x2', 'choice', array(
                'label' => $tituloInd['ind13x2'],
                'choices' => $opcionesInd['ind13x2']
                ))
            ->add('ind13x3', 'choice', array(
                'label' => $tituloInd['ind13x3'],
                'choices' => $opcionesInd['ind13x3']
                ))
            ->add('ind13x3xA', 'choice', array(
                'label' => $tituloInd['ind13x3xA'],
                'choices' => $opcionesInd['ind13x3xA']
                ))
            ->add('ind13xAx1', 'choice', array(
                'label' => $tituloInd['ind13xAx1'],
                'choices' => $opcionesInd['ind13xAx1']
                ))
            ->add('ind13xAx2', 'choice', array(
                'label' => $tituloInd['ind13xAx2'],
                'choices' => $opcionesInd['ind13xAx2']
                ))
            ->add('ind13xBx1', 'choice', array(
                'label' => $tituloInd['ind13xBx1'],
                'choices' => $opcionesInd['ind13xBx1']
                ))
            ->add('ind13xBx1xA', 'choice', array(
                'label' => $tituloInd['ind13xBx1xA'],
                'choices' => $opcionesInd['ind13xBx1xA']
                ))
            ->add('ind13xBx2', 'choice', array(
                'label' => $tituloInd['ind13xBx2'],
                'choices' => $opcionesInd['ind13xBx2']
                ))
            ->add('ind13xBx3', 'choice', array(
                'label' => $tituloInd['ind13xBx3'],
                'choices' => $opcionesInd['ind13xBx3']
                ))
            ->add('ind13xCx1', 'choice', array(
                'label' => $tituloInd['ind13xCx1'],
                'choices' => $opcionesInd['ind13xCx1']
                ))
            ->add('ind13xCx2', 'choice', array(
                'label' => $tituloInd['ind13xCx2'],
                'choices' => $opcionesInd['ind13xCx2']
                ))
            ->add('ind13xCx3', 'choice', array(
                'label' => $tituloInd['ind13xCx3'],
                'choices' => $opcionesInd['ind13xCx3']
                ))
            ->add('ind14x1', 'choice', array(
                'label' => $tituloInd['ind14x1'],
                'choices' => $opcionesInd['ind14x1']
                ))
            ->add('ind14x2', 'choice', array(
                'label' => $tituloInd['ind14x2'],
                'choices' => $opcionesInd['ind14x2']
                ))
            ->add('ind14x3', 'choice', array(
                'label' => $tituloInd['ind14x3'],
                'choices' => $opcionesInd['ind14x3']
                ))
            ->add('ind14x4', 'choice', array(
                'label' => $tituloInd['ind14x4'],
                'choices' => $opcionesInd['ind14x4']
                ))
            ->add('indTx20', 'choice', array(
                'label' => $tituloInd['indTx20'],
                'choices' => $opcionesInd['indTx20']
                ))
            ->add('indTx21', 'choice', array(
                'label' => $tituloInd['indTx21'],
                'choices' => $opcionesInd['indTx21']
                ))
            ->add('indTx22', 'choice', array(
                'label' => $tituloInd['indTx22'],
                'choices' => $opcionesInd['indTx22']
                ))
            ->add('ind15x1', 'choice', array(
                'label' => $tituloInd['ind15x1'],
                'choices' => $opcionesInd['ind15x1']
                ))
            ->add('ind15x2', 'choice', array(
                'label' => $tituloInd['ind15x2'],
                'choices' => $opcionesInd['ind15x2']
                ))
            ->add('ind16x1', 'choice', array(
                'label' => $tituloInd['ind16x1'],
                'choices' => $opcionesInd['ind16x1']
                ))
            ->add('ind16x2', 'choice', array(
                'label' => $tituloInd['ind16x2'],
                'choices' => $opcionesInd['ind16x2']
                ))
            ->add('ind17x1', 'choice', array(
                'label' => $tituloInd['ind17x1'],
                'choices' => $opcionesInd['ind17x1']
                ))
            ->add('ind17x1xA', 'choice', array(
                'label' => $tituloInd['ind17x1xA'],
                'choices' => $opcionesInd['ind17x1xA']
                ))
            ->add('ind17x2', 'choice', array(
                'label' => $tituloInd['ind17x2'],
                'choices' => $opcionesInd['ind17x2']
                ))
            ->add('ind17x2xA', 'choice', array(
                'label' => $tituloInd['ind17x2xA'],
                'choices' => $opcionesInd['ind17x2xA']
                ))
            ->add('ind17x3', 'choice', array(
                'label' => $tituloInd['ind17x3'],
                'choices' => $opcionesInd['ind17x3']
                ))
            ->add('ind17x3xA', 'choice', array(
                'label' => $tituloInd['ind17x3xA'],
                'choices' => $opcionesInd['ind17x3xA']
                ))
            ->add('ind17x4', 'choice', array(
                'label' => $tituloInd['ind17x4'],
                'choices' => $opcionesInd['ind17x4']
                ))
            ->add('ind17x5', 'choice', array(
                'label' => $tituloInd['ind17x5'],
                'choices' => $opcionesInd['ind17x5']
                ))
            ->add('ind17x5xA', 'choice', array(
                'label' => $tituloInd['ind17x5xA'],
                'choices' => $opcionesInd['ind17x5xA']
                ))
            ->add('ind17x6', 'choice', array(
                'label' => $tituloInd['ind17x6'],
                'choices' => $opcionesInd['ind17x6']
                ))
            ->add('ind17x7', 'choice', array(
                'label' => $tituloInd['ind17x7'],
                'choices' => $opcionesInd['ind17x7']
                ))
//
//  botones
//
            ->add('guardar', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zubietxe\PrincipalBundle\Entity\Persona',
            'opciones' => array(),
            'titulos' => array(), 
            'despl' => array()
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zubietxe_principalbundle_persona';
    }
}
