<?php

namespace Zubietxe\PrincipalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zubietxe\PrincipalBundle\Entity\Desplegables;
use Zubietxe\PrincipalBundle\Entity\DesplegablesRepository;

use Doctrine\ORM\EntityRepository;

class PersonaType extends AbstractType
{
    protected $grupo;


    public function __construct (EntityRepository $grupo)
    {
        $this->grupo = $grupo;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $opcionesInd = $options['opciones'];
        $builder
            ->add('idUnico')
            ->add('historial')
            ->add('sexo')
            ->add('nombre', 'text', array(
                'label' => $opcionesInd['ind1x1'][1]
                ))
            ->add('apellido1')
            ->add('apellido2')
            ->add('fechanac')
            ->add('lugarnac')
            ->add('dni')
            ->add('pasaporte')
            ->add('nie')
            ->add('numsegsoc')
            ->add('numexpediente')
         /*   ->add('nacionalidad', 'choice', array(
                'label' => 'Nacionalidad',
                'choices' => $this->grupo->findDesplegable('paises_mundo')
                ))    */
            ->add('telefono')
            ->add('direccionactual')
            ->add('poblacion')
            ->add('nucleoconv')
            ->add('estadocivil')
            ->add('hijos')
            ->add('numhijos')
            ->add('observacioneshijos')
            ->add('telefonosinteres')
            ->add('fechaingreso')
            ->add('fechasalida')
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
                'label' => 'Indicador 1.1',
                'choices' => $opcionesInd['ind1x1']
                ))
            ->add('ind1x1xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x1xa')
                ))
            ->add('ind1x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x2')
                ))
            ->add('ind1x2xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x2xa')
                ))
            ->add('ind1x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x3')
                ))
            ->add('ind1x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x4')
                ))
            ->add('ind1x5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x5')
                ))
            ->add('ind1x5xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x5xa')
                ))
            ->add('ind1x6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x6')
                ))
            ->add('ind1x7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind1x7')
                ))
            ->add('ind2x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2x1')
                ))
            ->add('ind2xax1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2xax1')
                ))
            ->add('ind2xax2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2xax2')
                ))
            ->add('ind2xax3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2xax3')
                ))
            ->add('ind2xax4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2xax4')
                ))
            ->add('ind2xbx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2xbx1')
                ))
            ->add('ind2xbx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind2xbx2')
                ))
            ->add('ind3x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x1')
                ))
            ->add('ind3x1xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x1xa')
                ))
            ->add('ind3x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x2')
                ))
            ->add('ind3x2xe', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x2xe')
                ))
            ->add('ind3x2xd', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x2xd')
                ))
            ->add('ind3x2xr', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x2xr')
                ))
            ->add('ind3x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x3')
                ))
            ->add('ind3x3xt', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x3xt')
                ))
            ->add('ind3x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind3x4')
                ))
            ->add('indtx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx1')
                ))
            ->add('indtx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx2')
                ))
            ->add('indtx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx3')
                ))
            ->add('indtx4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx4')
                ))
            ->add('ind4x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x1')
                ))
            ->add('ind4x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x2')
                ))
            ->add('ind4x2xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x2xa')
                ))
            ->add('ind4x2xb', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x2xb')
                ))
            ->add('ind4x2xc', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x2xc')
                ))
            ->add('ind4x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x3')
                ))
            ->add('ind4x3x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x3x1')
                ))
            ->add('ind4x3x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x3x2')
                ))
            ->add('ind4x3x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4x3x3')
                ))
            ->add('ind4xax1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xax1')
                ))
            ->add('ind4xax2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xax2')
                ))
            ->add('ind4xax3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xax3')
                ))
            ->add('ind4xax4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xax4')
                ))
            ->add('ind4xax5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xax5')
                ))
            ->add('ind4xax6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xax6')
                ))
            ->add('ind4xbx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xbx1')
                ))
            ->add('ind4xbx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xbx2')
                ))
            ->add('ind4xcx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xcx1')
                ))
            ->add('ind4xcx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xcx2')
                ))
            ->add('ind4xcx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xcx3')
                ))
            ->add('ind4xcx4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind4xcx4')
                ))
            ->add('ind5x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind5x1')
                ))
            ->add('ind5x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind5x2')
                ))
            ->add('ind5x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind5x3')
                ))
            ->add('ind5x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind5x4')
                ))
            ->add('ind5x5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind5x5')
                ))
            ->add('ind6x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x1')
                ))
            ->add('ind6x1x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x1x1')
                ))
            ->add('ind6x1x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x1x2')
                ))
            ->add('ind6x1x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x1x3')
                ))
            ->add('ind6x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x2')
                ))
            ->add('ind6x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x3')
                ))
            ->add('ind6x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind6x4')
                ))
            ->add('ind7xax1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax1')
                ))
            ->add('ind7xax2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax2')
                ))
            ->add('ind7xax3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax3')
                ))
            ->add('ind7xax4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax4')
                ))
            ->add('ind7xax5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax5')
                ))
            ->add('ind7xax6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax6')
                ))
            ->add('ind7xax7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xax7')
                ))
            ->add('ind7xbx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xbx1')
                ))
            ->add('ind7xbx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xbx2')
                ))
            ->add('ind7xbx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xbx3')
                ))
            ->add('ind7xbx4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xbx4')
                ))
            ->add('ind7xbx5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind7xbx5')
                ))
            ->add('ind8x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind8x1')
                ))
            ->add('ind8x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind8x2')
                ))
            ->add('ind8x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind8x3')
                ))
            ->add('ind8x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind8x4')
                ))
            ->add('indtx5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx5')
                ))
            ->add('indtx6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx6')
                ))
            ->add('indtx7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx7')
                ))
            ->add('indtx8', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx8')
                ))
            ->add('indtx9', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx9')
                ))
            ->add('indtx10', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx10')
                ))
            ->add('indtx11', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx11')
                ))
            ->add('indtx12', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx12')
                ))
            ->add('indtx13', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx13')
                ))
            ->add('indtx14', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx14')
                ))
            ->add('indtx15', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx15')
                ))
            ->add('indtx16', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx16')
                ))
            ->add('ind9xax1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xax1')
                ))
            ->add('ind9xax2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xax2')
                ))
            ->add('ind9xax3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xax3')
                ))
            ->add('ind9xax4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xax4')
                ))
            ->add('ind9xax5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xax5')
                ))
            ->add('ind9xbx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xbx1')
                ))
            ->add('ind9xbx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xbx2')
                ))
            ->add('ind9xbx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xbx3')
                ))
            ->add('ind9xbx4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xbx4')
                ))
            ->add('ind9xbx5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xbx5')
                ))
            ->add('ind9xcx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xcx1')
                ))
            ->add('ind9xcx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xcx2')
                ))
            ->add('ind9xcx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xcx3')
                ))
            ->add('ind9xcx4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xcx4')
                ))
            ->add('ind9xcx5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xcx5')
                ))
            ->add('ind9xcx6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xcx6')
                ))
            ->add('ind9xdx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx1')
                ))
            ->add('ind9xdx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx2')
                ))
            ->add('ind9xdx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx3')
                ))
            ->add('ind9xdx4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx4')
                ))
            ->add('ind9xdx5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx5')
                ))
            ->add('ind9xdx6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx6')
                ))
            ->add('ind9xdx7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx7')
                ))
            ->add('ind9xdx8', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind9xdx8')
                ))
            ->add('ind10x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x1')
                ))
            ->add('ind10x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x2')
                ))
            ->add('ind10x2x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x2x1')
                ))
            ->add('ind10x2x1xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x2x1xa')
                ))
            ->add('ind10x2x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x2x2')
                ))
            ->add('ind10x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x3')
                ))
            ->add('ind10x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x4')
                ))
            ->add('ind10x5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x5')
                ))
            ->add('ind10x6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x6')
                ))
            ->add('ind10x7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x7')
                ))
            ->add('ind10x8', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10x8')
                ))
            ->add('ind10xax1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10xax1')
                ))
            ->add('ind10xax2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10xax2')
                ))
            ->add('ind10xax3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10xax3')
                ))
            ->add('ind10xax4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind10xax4')
                ))
            ->add('ind11x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x1')
                ))
            ->add('ind11x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x2')
                ))
            ->add('ind11x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x3')
                ))
            ->add('ind11x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x4')
                ))
            ->add('ind11x5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x5')
                ))
            ->add('ind11x6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x6')
                ))
            ->add('ind11x7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind11x7')
                ))
            ->add('ind12x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind12x1')
                ))
            ->add('ind12x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind12x2')
                ))
            ->add('ind12x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind12x3')
                ))
            ->add('indtx17', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx17')
                ))
            ->add('indtx17xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx17xa')
                ))
            ->add('indtx17xb', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx17xb')
                ))
            ->add('indtx18', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx18')
                ))
            ->add('indtx19', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx19')
                ))
            ->add('ind13x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13x1')
                ))
            ->add('ind13x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13x2')
                ))
            ->add('ind13x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13x3')
                ))
            ->add('ind13x3xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13x3xa')
                ))
            ->add('ind13xax1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xax1')
                ))
            ->add('ind13xax2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xax2')
                ))
            ->add('ind13xbx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xbx1')
                ))
            ->add('ind13xbx1xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xbx1xa')
                ))
            ->add('ind13xbx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xbx2')
                ))
            ->add('ind13xbx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xbx3')
                ))
            ->add('ind13xcx1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xcx1')
                ))
            ->add('ind13xcx2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xcx2')
                ))
            ->add('ind13xcx3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind13xcx3')
                ))
            ->add('ind14x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind14x1')
                ))
            ->add('ind14x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind14x2')
                ))
            ->add('ind14x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind14x3')
                ))
            ->add('ind14x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind14x4')
                ))
            ->add('indtx20', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx20')
                ))
            ->add('indtx21', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx21')
                ))
            ->add('indtx22', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'indtx22')
                ))
            ->add('ind15x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind15x1')
                ))
            ->add('ind15x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind15x2')
                ))
            ->add('ind16x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind16x1')
                ))
            ->add('ind16x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind16x2')
                ))
            ->add('ind17x1', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x1')
                ))
            ->add('ind17x1xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x1xa')
                ))
            ->add('ind17x2', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x2')
                ))
            ->add('ind17x2xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x2xa')
                ))
            ->add('ind17x3', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x3')
                ))
            ->add('ind17x3xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x3xa')
                ))
            ->add('ind17x4', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x4')
                ))
            ->add('ind17x5', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x5')
                ))
            ->add('ind17x5xa', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x5xa')
                ))
            ->add('ind17x6', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x6')
                ))
            ->add('ind17x7', 'choice', array(
                'label' => 'Indicador 1.1',
                'choices' => $this->grupo->findRespuestas( 'ind17x7')
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zubietxe\PrincipalBundle\Entity\Persona',
            'opciones' => array()
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
