<?php

namespace Zubietxe\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona", indexes={@ORM\Index(name="id_unico", columns={"id_unico"})})
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_unico", type="integer", nullable=true)
     */
    private $idUnico;

    /**
     * @var string
     *
     * @ORM\Column(name="historial", type="string", length=9, nullable=true)
     */
    private $historial;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=5, nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido1", type="string", length=30, nullable=true)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido2", type="string", length=30, nullable=true)
     */
    private $apellido2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechanac", type="date", nullable=true)
     */
    private $fechanac;

    /**
     * @var string
     *
     * @ORM\Column(name="lugarNac", type="string", length=30, nullable=true)
     */
    private $lugarnac;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=15, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="pasaporte", type="string", length=15, nullable=true)
     */
    private $pasaporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nie", type="string", length=15, nullable=true)
     */
    private $nie;

    /**
     * @var string
     *
     * @ORM\Column(name="numSegSoc", type="string", length=20, nullable=true)
     */
    private $numsegsoc;

    /**
     * @var string
     *
     * @ORM\Column(name="numExpediente", type="string", length=10, nullable=true)
     */
    private $numexpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="nacionalidad", type="integer", nullable=true)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=30, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionActual", type="string", length=40, nullable=true)
     */
    private $direccionactual;

    /**
     * @var integer
     *
     * @ORM\Column(name="poblacion", type="integer", nullable=true)
     */
    private $poblacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="nucleoConv", type="integer", nullable=true)
     */
    private $nucleoconv;

    /**
     * @var integer
     *
     * @ORM\Column(name="estadoCivil", type="integer", nullable=true)
     */
    private $estadocivil;

    /**
     * @var string
     *
     * @ORM\Column(name="hijos", type="string", length=4, nullable=true)
     */
    private $hijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="numHijos", type="integer", nullable=true)
     */
    private $numhijos;

    /**
     * @var string
     *
     * @ORM\Column(name="observacionesHijos", type="string", length=255, nullable=true)
     */
    private $observacioneshijos;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonosInteres", type="string", length=512, nullable=true)
     */
    private $telefonosinteres;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaIngreso", type="date", nullable=true)
     */
    private $fechaingreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaSalida", type="date", nullable=true)
     */
    private $fechasalida;

    /**
     * @var string
     *
     * @ORM\Column(name="procedenciaDemanda", type="string", length=120, nullable=true)
     */
    private $procedenciademanda;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=true)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="comedorLun", type="integer", nullable=true)
     */
    private $comedorlun;

    /**
     * @var integer
     *
     * @ORM\Column(name="comedorMar", type="integer", nullable=true)
     */
    private $comedormar;

    /**
     * @var integer
     *
     * @ORM\Column(name="comedorMie", type="integer", nullable=true)
     */
    private $comedormie;

    /**
     * @var integer
     *
     * @ORM\Column(name="comedorJue", type="integer", nullable=true)
     */
    private $comedorjue;

    /**
     * @var integer
     *
     * @ORM\Column(name="comedorVie", type="integer", nullable=true)
     */
    private $comedorvie;

    /**
     * @var integer
     *
     * @ORM\Column(name="transporte", type="integer", nullable=true)
     */
    private $transporte;

    /**
     * @var string
     *
     * @ORM\Column(name="listaEspera", type="string", length=20, nullable=true)
     */
    private $listaespera;

    /**
     * @var string
     *
     * @ORM\Column(name="observacionesNivelFormativo", type="string", length=100, nullable=true)
     */
    private $observacionesnivelformativo;

    /**
     * @var string
     *
     * @ORM\Column(name="nivelFormativo", type="string", length=30, nullable=true)
     */
    private $nivelformativo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacionesIdioma", type="string", length=50, nullable=true)
     */
    private $observacionesidioma;

    /**
     * @var string
     *
     * @ORM\Column(name="EdadAbandonoEstudios", type="string", length=5, nullable=true)
     */
    private $edadabandonoestudios;

    /**
     * @var string
     *
     * @ORM\Column(name="LaboralOrigen", type="string", length=20, nullable=true)
     */
    private $laboralorigen;

    /**
     * @var string
     *
     * @ORM\Column(name="LaboralEspana", type="string", length=20, nullable=true)
     */
    private $laboralespana;

    /**
     * @var string
     *
     * @ORM\Column(name="TiempoTrabajado", type="string", length=20, nullable=true)
     */
    private $tiempotrabajado;

    /**
     * @var integer
     *
     * @ORM\Column(name="Trabaja", type="integer", nullable=true)
     */
    private $trabaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="Autonomia", type="integer", nullable=true)
     */
    private $autonomia;

    /**
     * @var integer
     *
     * @ORM\Column(name="DisminucionFisica", type="integer", nullable=true)
     */
    private $disminucionfisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="MinusvaliaPorcentaje", type="integer", nullable=true)
     */
    private $minusvaliaporcentaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="Incapacitacion", type="integer", nullable=true)
     */
    private $incapacitacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="Toxicomania", type="integer", nullable=true)
     */
    private $toxicomania;

    /**
     * @var integer
     *
     * @ORM\Column(name="AntecConsumo", type="integer", nullable=true)
     */
    private $antecconsumo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DisminucionPsiquica", type="integer", nullable=true)
     */
    private $disminucionpsiquica;

    /**
     * @var integer
     *
     * @ORM\Column(name="EnfermedadMental", type="integer", nullable=true)
     */
    private $enfermedadmental;

    /**
     * @var integer
     *
     * @ORM\Column(name="Tuberculosis", type="integer", nullable=true)
     */
    private $tuberculosis;

    /**
     * @var integer
     *
     * @ORM\Column(name="Hepatitis", type="integer", nullable=true)
     */
    private $hepatitis;

    /**
     * @var integer
     *
     * @ORM\Column(name="VIH", type="integer", nullable=true)
     */
    private $vih;

    /**
     * @var string
     *
     * @ORM\Column(name="diabetes", type="string", length=2, nullable=true)
     */
    private $diabetes;

    /**
     * @var integer
     *
     * @ORM\Column(name="Otras", type="integer", nullable=true)
     */
    private $otras;

    /**
     * @var string
     *
     * @ORM\Column(name="EnfermedadesComentarios", type="string", length=200, nullable=true)
     */
    private $enfermedadescomentarios;

    /**
     * @var string
     *
     * @ORM\Column(name="Medicacion", type="string", length=200, nullable=true)
     */
    private $medicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="EnfMentalDiagnostico", type="string", length=120, nullable=true)
     */
    private $enfmentaldiagnostico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EnfMentalFechaDiagn", type="date", nullable=true)
     */
    private $enfmentalfechadiagn;

    /**
     * @var integer
     *
     * @ORM\Column(name="EnfMentalTratamiento", type="integer", nullable=true)
     */
    private $enfmentaltratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="EnfMentalIngresos", type="string", length=30, nullable=true)
     */
    private $enfmentalingresos;

    /**
     * @var integer
     *
     * @ORM\Column(name="EnfMentalPadres", type="integer", nullable=true)
     */
    private $enfmentalpadres;

    /**
     * @var integer
     *
     * @ORM\Column(name="EnfMentalHermanos", type="integer", nullable=true)
     */
    private $enfmentalhermanos;

    /**
     * @var integer
     *
     * @ORM\Column(name="EnfMentalPareja", type="integer", nullable=true)
     */
    private $enfmentalpareja;

    /**
     * @var integer
     *
     * @ORM\Column(name="EnfMentalHijos", type="integer", nullable=true)
     */
    private $enfmentalhijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DrogasPadres", type="integer", nullable=true)
     */
    private $drogaspadres;

    /**
     * @var integer
     *
     * @ORM\Column(name="DrogasHermanos", type="integer", nullable=true)
     */
    private $drogashermanos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DrogasPareja", type="integer", nullable=true)
     */
    private $drogaspareja;

    /**
     * @var integer
     *
     * @ORM\Column(name="DrogasHijos", type="integer", nullable=true)
     */
    private $drogashijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="PermisoResid", type="integer", nullable=true)
     */
    private $permisoresid;

    /**
     * @var integer
     *
     * @ORM\Column(name="PermisoResidTr", type="integer", nullable=true)
     */
    private $permisoresidtr;

    /**
     * @var string
     *
     * @ORM\Column(name="numPasap", type="string", length=20, nullable=true)
     */
    private $numpasap;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPasap", type="date", nullable=true)
     */
    private $fechapasap;

    /**
     * @var string
     *
     * @ORM\Column(name="numCedula", type="string", length=20, nullable=true)
     */
    private $numcedula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCaducCedula", type="date", nullable=true)
     */
    private $fechacaduccedula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaResidSolicit", type="date", nullable=true)
     */
    private $fecharesidsolicit;

    /**
     * @var string
     *
     * @ORM\Column(name="numResidConced", type="string", length=20, nullable=true)
     */
    private $numresidconced;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaResidConced", type="date", nullable=true)
     */
    private $fecharesidconced;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaResidTrabSolicit", type="date", nullable=true)
     */
    private $fecharesidtrabsolicit;

    /**
     * @var string
     *
     * @ORM\Column(name="numResidTrabConc", type="string", length=20, nullable=true)
     */
    private $numresidtrabconc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaResidTrabConc", type="date", nullable=true)
     */
    private $fecharesidtrabconc;

    /**
     * @var integer
     *
     * @ORM\Column(name="visado", type="integer", nullable=true)
     */
    private $visado;

    /**
     * @var integer
     *
     * @ORM\Column(name="asilo", type="integer", nullable=true)
     */
    private $asilo;

    /**
     * @var string
     *
     * @ORM\Column(name="otrosDoc", type="string", length=40, nullable=true)
     */
    private $otrosdoc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEntrada", type="date", nullable=true)
     */
    private $fechaentrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPrueba", type="date", nullable=true)
     */
    private $fechaprueba;

    /**
     * @var string
     *
     * @ORM\Column(name="abogadootros", type="string", length=40, nullable=true)
     */
    private $abogadootros;

    /**
     * @var string
     *
     * @ORM\Column(name="PermisoResidRazonesNo", type="string", length=20, nullable=true)
     */
    private $permisoresidrazonesno;

    /**
     * @var string
     *
     * @ORM\Column(name="PermisoSolicitudLugar", type="string", length=20, nullable=true)
     */
    private $permisosolicitudlugar;

    /**
     * @var string
     *
     * @ORM\Column(name="TiempoResidenciaEspanya", type="string", length=20, nullable=true)
     */
    private $tiemporesidenciaespanya;

    /**
     * @var string
     *
     * @ORM\Column(name="TiempoResidenciaBilbao", type="string", length=20, nullable=true)
     */
    private $tiemporesidenciabilbao;

    /**
     * @var string
     *
     * @ORM\Column(name="PermisoTrabajo", type="string", length=20, nullable=true)
     */
    private $permisotrabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="PermisoTrabajoRazonesNo", type="string", length=20, nullable=true)
     */
    private $permisotrabajorazonesno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaEmpadronamiento", type="date", nullable=true)
     */
    private $fechaempadronamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionPadronActual", type="string", length=50, nullable=true)
     */
    private $direccionpadronactual;

    /**
     * @var integer
     *
     * @ORM\Column(name="Tis", type="integer", nullable=true)
     */
    private $tis;

    /**
     * @var integer
     *
     * @ORM\Column(name="RedApoyo", type="integer", nullable=true)
     */
    private $redapoyo;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosPropios", type="integer", nullable=true)
     */
    private $ingresospropios;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosPnc", type="integer", nullable=true)
     */
    private $ingresospnc;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosOtros", type="integer", nullable=true)
     */
    private $ingresosotros;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosNomina", type="integer", nullable=true)
     */
    private $ingresosnomina;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosRGI", type="integer", nullable=true)
     */
    private $ingresosrgi;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosPrestContrib", type="integer", nullable=true)
     */
    private $ingresosprestcontrib;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosSeDesconoce", type="integer", nullable=true)
     */
    private $ingresossedesconoce;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosAyudaIndividual", type="integer", nullable=true)
     */
    private $ingresosayudaindividual;

    /**
     * @var integer
     *
     * @ORM\Column(name="IngresosNo", type="integer", nullable=true)
     */
    private $ingresosno;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalAntecedentesPrision", type="integer", nullable=true)
     */
    private $penalantecedentesprision;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalOrdenAlejamiento", type="integer", nullable=true)
     */
    private $penalordenalejamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalPrisionPreventiva", type="integer", nullable=true)
     */
    private $penalprisionpreventiva;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalPrisionOtros", type="integer", nullable=true)
     */
    private $penalprisionotros;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalLibCondicional", type="integer", nullable=true)
     */
    private $penallibcondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalMedidaSeguridad", type="integer", nullable=true)
     */
    private $penalmedidaseguridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalCausasPendientes", type="integer", nullable=true)
     */
    private $penalcausaspendientes;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalPermisoPenitenc", type="integer", nullable=true)
     */
    private $penalpermisopenitenc;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalTercerGrado", type="integer", nullable=true)
     */
    private $penaltercergrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="PenalTbc", type="integer", nullable=true)
     */
    private $penaltbc;

    /**
     * @var integer
     *
     * @ORM\Column(name="ducha", type="integer", nullable=true)
     */
    private $ducha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ropero", type="integer", nullable=true)
     */
    private $ropero;

    /**
     * @var integer
     *
     * @ORM\Column(name="lavanderia", type="integer", nullable=true)
     */
    private $lavanderia;

    /**
     * @var integer
     *
     * @ORM\Column(name="tlSabado", type="integer", nullable=true)
     */
    private $tlsabado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tlDomingo", type="integer", nullable=true)
     */
    private $tldomingo;

    /**
     * @var integer
     *
     * @ORM\Column(name="salidaVerano", type="integer", nullable=true)
     */
    private $salidaverano;

    /**
     * @var integer
     *
     * @ORM\Column(name="salidaOtro", type="integer", nullable=true)
     */
    private $salidaotro;

    /**
     * @var integer
     *
     * @ORM\Column(name="medicacionCentro", type="integer", nullable=true)
     */
    private $medicacioncentro;

    /**
     * @var integer
     *
     * @ORM\Column(name="NivelCastellano", type="integer", nullable=true)
     */
    private $nivelcastellano;

    /**
     * @var integer
     *
     * @ORM\Column(name="expLaboral", type="integer", nullable=true)
     */
    private $explaboral;

    /**
     * @var integer
     *
     * @ORM\Column(name="lanbide", type="integer", nullable=true)
     */
    private $lanbide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAltaLanbide", type="date", nullable=true)
     */
    private $fechaaltalanbide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRenovLanbide", type="date", nullable=true)
     */
    private $fecharenovlanbide;

    /**
     * @var integer
     *
     * @ORM\Column(name="inem", type="integer", nullable=true)
     */
    private $inem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAltaInem", type="date", nullable=true)
     */
    private $fechaaltainem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRenovInem", type="date", nullable=true)
     */
    private $fecharenovinem;

    /**
     * @var string
     *
     * @ORM\Column(name="cursos", type="string", length=100, nullable=true)
     */
    private $cursos;

    /**
     * @var integer
     *
     * @ORM\Column(name="poblacionPadron", type="integer", nullable=true)
     */
    private $poblacionpadron;

    /**
     * @var integer
     *
     * @ORM\Column(name="ConsumoPrinc", type="integer", nullable=true)
     */
    private $consumoprinc;

    /**
     * @var integer
     *
     * @ORM\Column(name="insertIdUsuario", type="integer", nullable=true)
     */
    private $insertidusuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInsert", type="date", nullable=true)
     */
    private $fechainsert;

    /**
     * @var integer
     *
     * @ORM\Column(name="AnosConsumo", type="integer", nullable=true)
     */
    private $anosconsumo;

    /**
     * @var integer
     *
     * @ORM\Column(name="Tratamiento", type="integer", nullable=true)
     */
    private $tratamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="TratamientoTipo", type="integer", nullable=true)
     */
    private $tratamientotipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="procedenciaDemandaLista", type="integer", nullable=true)
     */
    private $procedenciademandalista;

    /**
     * @var integer
     *
     * @ORM\Column(name="situacionAdministrativa", type="integer", nullable=true)
     */
    private $situacionadministrativa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCaducTis", type="date", nullable=true)
     */
    private $fechacaductis;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x1", type="boolean", nullable=true)
     */
    private $ind1x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x1xA", type="boolean", nullable=true)
     */
    private $ind1x1xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x2", type="boolean", nullable=true)
     */
    private $ind1x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x2xA", type="boolean", nullable=true)
     */
    private $ind1x2xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x3", type="boolean", nullable=true)
     */
    private $ind1x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x4", type="boolean", nullable=true)
     */
    private $ind1x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x5", type="boolean", nullable=true)
     */
    private $ind1x5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x5xA", type="boolean", nullable=true)
     */
    private $ind1x5xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x6", type="boolean", nullable=true)
     */
    private $ind1x6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind1x7", type="boolean", nullable=true)
     */
    private $ind1x7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2x1", type="boolean", nullable=true)
     */
    private $ind2x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2xAx1", type="boolean", nullable=true)
     */
    private $ind2xax1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2xAx2", type="boolean", nullable=true)
     */
    private $ind2xax2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2xAx3", type="boolean", nullable=true)
     */
    private $ind2xax3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2xAx4", type="boolean", nullable=true)
     */
    private $ind2xax4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2xBx1", type="boolean", nullable=true)
     */
    private $ind2xbx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind2xBx2", type="boolean", nullable=true)
     */
    private $ind2xbx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x1", type="boolean", nullable=true)
     */
    private $ind3x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x1xA", type="boolean", nullable=true)
     */
    private $ind3x1xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x2", type="boolean", nullable=true)
     */
    private $ind3x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x2xE", type="boolean", nullable=true)
     */
    private $ind3x2xe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x2xD", type="boolean", nullable=true)
     */
    private $ind3x2xd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x2xR", type="boolean", nullable=true)
     */
    private $ind3x2xr;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x3", type="boolean", nullable=true)
     */
    private $ind3x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x3xT", type="boolean", nullable=true)
     */
    private $ind3x3xt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind3x4", type="boolean", nullable=true)
     */
    private $ind3x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx1", type="boolean", nullable=true)
     */
    private $indtx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx2", type="boolean", nullable=true)
     */
    private $indtx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx3", type="boolean", nullable=true)
     */
    private $indtx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx4", type="boolean", nullable=true)
     */
    private $indtx4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x1", type="boolean", nullable=true)
     */
    private $ind4x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x2", type="boolean", nullable=true)
     */
    private $ind4x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x2xA", type="boolean", nullable=true)
     */
    private $ind4x2xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x2xB", type="boolean", nullable=true)
     */
    private $ind4x2xb;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x2xC", type="boolean", nullable=true)
     */
    private $ind4x2xc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x3", type="boolean", nullable=true)
     */
    private $ind4x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x3x1", type="boolean", nullable=true)
     */
    private $ind4x3x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x3x2", type="boolean", nullable=true)
     */
    private $ind4x3x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4x3x3", type="boolean", nullable=true)
     */
    private $ind4x3x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xAx1", type="boolean", nullable=true)
     */
    private $ind4xax1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xAx2", type="boolean", nullable=true)
     */
    private $ind4xax2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xAx3", type="boolean", nullable=true)
     */
    private $ind4xax3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xAx4", type="boolean", nullable=true)
     */
    private $ind4xax4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xAx5", type="boolean", nullable=true)
     */
    private $ind4xax5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xAx6", type="boolean", nullable=true)
     */
    private $ind4xax6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xBx1", type="boolean", nullable=true)
     */
    private $ind4xbx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xBx2", type="boolean", nullable=true)
     */
    private $ind4xbx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xCx1", type="boolean", nullable=true)
     */
    private $ind4xcx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xCx2", type="boolean", nullable=true)
     */
    private $ind4xcx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xCx3", type="boolean", nullable=true)
     */
    private $ind4xcx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind4xCx4", type="boolean", nullable=true)
     */
    private $ind4xcx4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind5x1", type="boolean", nullable=true)
     */
    private $ind5x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind5x2", type="boolean", nullable=true)
     */
    private $ind5x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind5x3", type="boolean", nullable=true)
     */
    private $ind5x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind5x4", type="boolean", nullable=true)
     */
    private $ind5x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind5x5", type="boolean", nullable=true)
     */
    private $ind5x5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x1", type="boolean", nullable=true)
     */
    private $ind6x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x1x1", type="boolean", nullable=true)
     */
    private $ind6x1x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x1x2", type="boolean", nullable=true)
     */
    private $ind6x1x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x1x3", type="boolean", nullable=true)
     */
    private $ind6x1x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x2", type="boolean", nullable=true)
     */
    private $ind6x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x3", type="boolean", nullable=true)
     */
    private $ind6x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind6x4", type="boolean", nullable=true)
     */
    private $ind6x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx1", type="boolean", nullable=true)
     */
    private $ind7xax1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx2", type="boolean", nullable=true)
     */
    private $ind7xax2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx3", type="boolean", nullable=true)
     */
    private $ind7xax3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx4", type="boolean", nullable=true)
     */
    private $ind7xax4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx5", type="boolean", nullable=true)
     */
    private $ind7xax5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx6", type="boolean", nullable=true)
     */
    private $ind7xax6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xAx7", type="boolean", nullable=true)
     */
    private $ind7xax7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xBx1", type="boolean", nullable=true)
     */
    private $ind7xbx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xBx2", type="boolean", nullable=true)
     */
    private $ind7xbx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xBx3", type="boolean", nullable=true)
     */
    private $ind7xbx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xBx4", type="boolean", nullable=true)
     */
    private $ind7xbx4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind7xBx5", type="boolean", nullable=true)
     */
    private $ind7xbx5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind8x1", type="boolean", nullable=true)
     */
    private $ind8x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind8x2", type="boolean", nullable=true)
     */
    private $ind8x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind8x3", type="boolean", nullable=true)
     */
    private $ind8x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind8x4", type="boolean", nullable=true)
     */
    private $ind8x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx5", type="boolean", nullable=true)
     */
    private $indtx5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx6", type="boolean", nullable=true)
     */
    private $indtx6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx7", type="boolean", nullable=true)
     */
    private $indtx7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx8", type="boolean", nullable=true)
     */
    private $indtx8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx9", type="boolean", nullable=true)
     */
    private $indtx9;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx10", type="boolean", nullable=true)
     */
    private $indtx10;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx11", type="boolean", nullable=true)
     */
    private $indtx11;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx12", type="boolean", nullable=true)
     */
    private $indtx12;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx13", type="boolean", nullable=true)
     */
    private $indtx13;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx14", type="boolean", nullable=true)
     */
    private $indtx14;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx15", type="boolean", nullable=true)
     */
    private $indtx15;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx16", type="boolean", nullable=true)
     */
    private $indtx16;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xAx1", type="boolean", nullable=true)
     */
    private $ind9xax1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xAx2", type="boolean", nullable=true)
     */
    private $ind9xax2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xAx3", type="boolean", nullable=true)
     */
    private $ind9xax3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xAx4", type="boolean", nullable=true)
     */
    private $ind9xax4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xAx5", type="boolean", nullable=true)
     */
    private $ind9xax5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xBx1", type="boolean", nullable=true)
     */
    private $ind9xbx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xBx2", type="boolean", nullable=true)
     */
    private $ind9xbx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xBx3", type="boolean", nullable=true)
     */
    private $ind9xbx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xBx4", type="boolean", nullable=true)
     */
    private $ind9xbx4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xBx5", type="boolean", nullable=true)
     */
    private $ind9xbx5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xCx1", type="boolean", nullable=true)
     */
    private $ind9xcx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xCx2", type="boolean", nullable=true)
     */
    private $ind9xcx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xCx3", type="boolean", nullable=true)
     */
    private $ind9xcx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xCx4", type="boolean", nullable=true)
     */
    private $ind9xcx4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xCx5", type="boolean", nullable=true)
     */
    private $ind9xcx5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xCx6", type="boolean", nullable=true)
     */
    private $ind9xcx6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx1", type="boolean", nullable=true)
     */
    private $ind9xdx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx2", type="boolean", nullable=true)
     */
    private $ind9xdx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx3", type="boolean", nullable=true)
     */
    private $ind9xdx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx4", type="boolean", nullable=true)
     */
    private $ind9xdx4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx5", type="boolean", nullable=true)
     */
    private $ind9xdx5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx6", type="boolean", nullable=true)
     */
    private $ind9xdx6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx7", type="boolean", nullable=true)
     */
    private $ind9xdx7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind9xDx8", type="boolean", nullable=true)
     */
    private $ind9xdx8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x1", type="boolean", nullable=true)
     */
    private $ind10x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x2", type="boolean", nullable=true)
     */
    private $ind10x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x2x1", type="boolean", nullable=true)
     */
    private $ind10x2x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x2x1xA", type="boolean", nullable=true)
     */
    private $ind10x2x1xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x2x2", type="boolean", nullable=true)
     */
    private $ind10x2x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x3", type="boolean", nullable=true)
     */
    private $ind10x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x4", type="boolean", nullable=true)
     */
    private $ind10x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x5", type="boolean", nullable=true)
     */
    private $ind10x5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x6", type="boolean", nullable=true)
     */
    private $ind10x6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x7", type="boolean", nullable=true)
     */
    private $ind10x7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10x8", type="boolean", nullable=true)
     */
    private $ind10x8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10xAx1", type="boolean", nullable=true)
     */
    private $ind10xax1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10xAx2", type="boolean", nullable=true)
     */
    private $ind10xax2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10xAx3", type="boolean", nullable=true)
     */
    private $ind10xax3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind10xAx4", type="boolean", nullable=true)
     */
    private $ind10xax4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x1", type="boolean", nullable=true)
     */
    private $ind11x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x2", type="boolean", nullable=true)
     */
    private $ind11x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x3", type="boolean", nullable=true)
     */
    private $ind11x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x4", type="boolean", nullable=true)
     */
    private $ind11x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x5", type="boolean", nullable=true)
     */
    private $ind11x5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x6", type="boolean", nullable=true)
     */
    private $ind11x6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind11x7", type="boolean", nullable=true)
     */
    private $ind11x7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind12x1", type="boolean", nullable=true)
     */
    private $ind12x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind12x2", type="boolean", nullable=true)
     */
    private $ind12x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind12x3", type="boolean", nullable=true)
     */
    private $ind12x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx17", type="boolean", nullable=true)
     */
    private $indtx17;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx17xA", type="boolean", nullable=true)
     */
    private $indtx17xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx17xB", type="boolean", nullable=true)
     */
    private $indtx17xb;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx18", type="boolean", nullable=true)
     */
    private $indtx18;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx19", type="boolean", nullable=true)
     */
    private $indtx19;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13x1", type="boolean", nullable=true)
     */
    private $ind13x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13x2", type="boolean", nullable=true)
     */
    private $ind13x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13x3", type="boolean", nullable=true)
     */
    private $ind13x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13x3xA", type="boolean", nullable=true)
     */
    private $ind13x3xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xAx1", type="boolean", nullable=true)
     */
    private $ind13xax1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xAx2", type="boolean", nullable=true)
     */
    private $ind13xax2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xBx1", type="boolean", nullable=true)
     */
    private $ind13xbx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xBx1xA", type="boolean", nullable=true)
     */
    private $ind13xbx1xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xBx2", type="boolean", nullable=true)
     */
    private $ind13xbx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xBx3", type="boolean", nullable=true)
     */
    private $ind13xbx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xCx1", type="boolean", nullable=true)
     */
    private $ind13xcx1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xCx2", type="boolean", nullable=true)
     */
    private $ind13xcx2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind13xCx3", type="boolean", nullable=true)
     */
    private $ind13xcx3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind14x1", type="boolean", nullable=true)
     */
    private $ind14x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind14x2", type="boolean", nullable=true)
     */
    private $ind14x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind14x3", type="boolean", nullable=true)
     */
    private $ind14x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind14x4", type="boolean", nullable=true)
     */
    private $ind14x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx20", type="boolean", nullable=true)
     */
    private $indtx20;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx21", type="boolean", nullable=true)
     */
    private $indtx21;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indTx22", type="boolean", nullable=true)
     */
    private $indtx22;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind15x1", type="boolean", nullable=true)
     */
    private $ind15x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind15x2", type="boolean", nullable=true)
     */
    private $ind15x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind16x1", type="boolean", nullable=true)
     */
    private $ind16x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind16x2", type="boolean", nullable=true)
     */
    private $ind16x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x1", type="boolean", nullable=true)
     */
    private $ind17x1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x1xA", type="boolean", nullable=true)
     */
    private $ind17x1xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x2", type="boolean", nullable=true)
     */
    private $ind17x2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x2xA", type="boolean", nullable=true)
     */
    private $ind17x2xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x3", type="boolean", nullable=true)
     */
    private $ind17x3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x3xA", type="boolean", nullable=true)
     */
    private $ind17x3xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x4", type="boolean", nullable=true)
     */
    private $ind17x4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x5", type="boolean", nullable=true)
     */
    private $ind17x5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x5xA", type="boolean", nullable=true)
     */
    private $ind17x5xa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x6", type="boolean", nullable=true)
     */
    private $ind17x6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ind17x7", type="boolean", nullable=true)
     */
    private $ind17x7;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pers", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPers;



    /**
     * Set idUnico
     *
     * @param integer $idUnico
     * @return Persona
     */
    public function setIdUnico($idUnico)
    {
        $this->idUnico = $idUnico;

        return $this;
    }

    /**
     * Get idUnico
     *
     * @return integer 
     */
    public function getIdUnico()
    {
        return $this->idUnico;
    }

    /**
     * Set historial
     *
     * @param string $historial
     * @return Persona
     */
    public function setHistorial($historial)
    {
        $this->historial = $historial;

        return $this;
    }

    /**
     * Get historial
     *
     * @return string 
     */
    public function getHistorial()
    {
        return $this->historial;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Persona
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido1
     *
     * @param string $apellido1
     * @return Persona
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string 
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     * @return Persona
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string 
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set fechanac
     *
     * @param \DateTime $fechanac
     * @return Persona
     */
    public function setFechanac($fechanac)
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    /**
     * Get fechanac
     *
     * @return \DateTime 
     */
    public function getFechanac()
    {
        return $this->fechanac;
    }

    /**
     * Set lugarnac
     *
     * @param string $lugarnac
     * @return Persona
     */
    public function setLugarnac($lugarnac)
    {
        $this->lugarnac = $lugarnac;

        return $this;
    }

    /**
     * Get lugarnac
     *
     * @return string 
     */
    public function getLugarnac()
    {
        return $this->lugarnac;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Persona
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set pasaporte
     *
     * @param string $pasaporte
     * @return Persona
     */
    public function setPasaporte($pasaporte)
    {
        $this->pasaporte = $pasaporte;

        return $this;
    }

    /**
     * Get pasaporte
     *
     * @return string 
     */
    public function getPasaporte()
    {
        return $this->pasaporte;
    }

    /**
     * Set nie
     *
     * @param string $nie
     * @return Persona
     */
    public function setNie($nie)
    {
        $this->nie = $nie;

        return $this;
    }

    /**
     * Get nie
     *
     * @return string 
     */
    public function getNie()
    {
        return $this->nie;
    }

    /**
     * Set numsegsoc
     *
     * @param string $numsegsoc
     * @return Persona
     */
    public function setNumsegsoc($numsegsoc)
    {
        $this->numsegsoc = $numsegsoc;

        return $this;
    }

    /**
     * Get numsegsoc
     *
     * @return string 
     */
    public function getNumsegsoc()
    {
        return $this->numsegsoc;
    }

    /**
     * Set numexpediente
     *
     * @param string $numexpediente
     * @return Persona
     */
    public function setNumexpediente($numexpediente)
    {
        $this->numexpediente = $numexpediente;

        return $this;
    }

    /**
     * Get numexpediente
     *
     * @return string 
     */
    public function getNumexpediente()
    {
        return $this->numexpediente;
    }

    /**
     * Set nacionalidad
     *
     * @param integer $nacionalidad
     * @return Persona
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return integer 
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Persona
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set direccionactual
     *
     * @param string $direccionactual
     * @return Persona
     */
    public function setDireccionactual($direccionactual)
    {
        $this->direccionactual = $direccionactual;

        return $this;
    }

    /**
     * Get direccionactual
     *
     * @return string 
     */
    public function getDireccionactual()
    {
        return $this->direccionactual;
    }

    /**
     * Set poblacion
     *
     * @param integer $poblacion
     * @return Persona
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return integer 
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set nucleoconv
     *
     * @param integer $nucleoconv
     * @return Persona
     */
    public function setNucleoconv($nucleoconv)
    {
        $this->nucleoconv = $nucleoconv;

        return $this;
    }

    /**
     * Get nucleoconv
     *
     * @return integer 
     */
    public function getNucleoconv()
    {
        return $this->nucleoconv;
    }

    /**
     * Set estadocivil
     *
     * @param integer $estadocivil
     * @return Persona
     */
    public function setEstadocivil($estadocivil)
    {
        $this->estadocivil = $estadocivil;

        return $this;
    }

    /**
     * Get estadocivil
     *
     * @return integer 
     */
    public function getEstadocivil()
    {
        return $this->estadocivil;
    }

    /**
     * Set hijos
     *
     * @param string $hijos
     * @return Persona
     */
    public function setHijos($hijos)
    {
        $this->hijos = $hijos;

        return $this;
    }

    /**
     * Get hijos
     *
     * @return string 
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * Set numhijos
     *
     * @param integer $numhijos
     * @return Persona
     */
    public function setNumhijos($numhijos)
    {
        $this->numhijos = $numhijos;

        return $this;
    }

    /**
     * Get numhijos
     *
     * @return integer 
     */
    public function getNumhijos()
    {
        return $this->numhijos;
    }

    /**
     * Set observacioneshijos
     *
     * @param string $observacioneshijos
     * @return Persona
     */
    public function setObservacioneshijos($observacioneshijos)
    {
        $this->observacioneshijos = $observacioneshijos;

        return $this;
    }

    /**
     * Get observacioneshijos
     *
     * @return string 
     */
    public function getObservacioneshijos()
    {
        return $this->observacioneshijos;
    }

    /**
     * Set telefonosinteres
     *
     * @param string $telefonosinteres
     * @return Persona
     */
    public function setTelefonosinteres($telefonosinteres)
    {
        $this->telefonosinteres = $telefonosinteres;

        return $this;
    }

    /**
     * Get telefonosinteres
     *
     * @return string 
     */
    public function getTelefonosinteres()
    {
        return $this->telefonosinteres;
    }

    /**
     * Set fechaingreso
     *
     * @param \DateTime $fechaingreso
     * @return Persona
     */
    public function setFechaingreso($fechaingreso)
    {
        $this->fechaingreso = $fechaingreso;

        return $this;
    }

    /**
     * Get fechaingreso
     *
     * @return \DateTime 
     */
    public function getFechaingreso()
    {
        return $this->fechaingreso;
    }

    /**
     * Set fechasalida
     *
     * @param \DateTime $fechasalida
     * @return Persona
     */
    public function setFechasalida($fechasalida)
    {
        $this->fechasalida = $fechasalida;

        return $this;
    }

    /**
     * Get fechasalida
     *
     * @return \DateTime 
     */
    public function getFechasalida()
    {
        return $this->fechasalida;
    }

    /**
     * Set procedenciademanda
     *
     * @param string $procedenciademanda
     * @return Persona
     */
    public function setProcedenciademanda($procedenciademanda)
    {
        $this->procedenciademanda = $procedenciademanda;

        return $this;
    }

    /**
     * Get procedenciademanda
     *
     * @return string 
     */
    public function getProcedenciademanda()
    {
        return $this->procedenciademanda;
    }

    /**
     * Set responsable
     *
     * @param integer $responsable
     * @return Persona
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return integer 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set comedorlun
     *
     * @param integer $comedorlun
     * @return Persona
     */
    public function setComedorlun($comedorlun)
    {
        $this->comedorlun = $comedorlun;

        return $this;
    }

    /**
     * Get comedorlun
     *
     * @return integer 
     */
    public function getComedorlun()
    {
        return $this->comedorlun;
    }

    /**
     * Set comedormar
     *
     * @param integer $comedormar
     * @return Persona
     */
    public function setComedormar($comedormar)
    {
        $this->comedormar = $comedormar;

        return $this;
    }

    /**
     * Get comedormar
     *
     * @return integer 
     */
    public function getComedormar()
    {
        return $this->comedormar;
    }

    /**
     * Set comedormie
     *
     * @param integer $comedormie
     * @return Persona
     */
    public function setComedormie($comedormie)
    {
        $this->comedormie = $comedormie;

        return $this;
    }

    /**
     * Get comedormie
     *
     * @return integer 
     */
    public function getComedormie()
    {
        return $this->comedormie;
    }

    /**
     * Set comedorjue
     *
     * @param integer $comedorjue
     * @return Persona
     */
    public function setComedorjue($comedorjue)
    {
        $this->comedorjue = $comedorjue;

        return $this;
    }

    /**
     * Get comedorjue
     *
     * @return integer 
     */
    public function getComedorjue()
    {
        return $this->comedorjue;
    }

    /**
     * Set comedorvie
     *
     * @param integer $comedorvie
     * @return Persona
     */
    public function setComedorvie($comedorvie)
    {
        $this->comedorvie = $comedorvie;

        return $this;
    }

    /**
     * Get comedorvie
     *
     * @return integer 
     */
    public function getComedorvie()
    {
        return $this->comedorvie;
    }

    /**
     * Set transporte
     *
     * @param integer $transporte
     * @return Persona
     */
    public function setTransporte($transporte)
    {
        $this->transporte = $transporte;

        return $this;
    }

    /**
     * Get transporte
     *
     * @return integer 
     */
    public function getTransporte()
    {
        return $this->transporte;
    }

    /**
     * Set listaespera
     *
     * @param string $listaespera
     * @return Persona
     */
    public function setListaespera($listaespera)
    {
        $this->listaespera = $listaespera;

        return $this;
    }

    /**
     * Get listaespera
     *
     * @return string 
     */
    public function getListaespera()
    {
        return $this->listaespera;
    }

    /**
     * Set observacionesnivelformativo
     *
     * @param string $observacionesnivelformativo
     * @return Persona
     */
    public function setObservacionesnivelformativo($observacionesnivelformativo)
    {
        $this->observacionesnivelformativo = $observacionesnivelformativo;

        return $this;
    }

    /**
     * Get observacionesnivelformativo
     *
     * @return string 
     */
    public function getObservacionesnivelformativo()
    {
        return $this->observacionesnivelformativo;
    }

    /**
     * Set nivelformativo
     *
     * @param string $nivelformativo
     * @return Persona
     */
    public function setNivelformativo($nivelformativo)
    {
        $this->nivelformativo = $nivelformativo;

        return $this;
    }

    /**
     * Get nivelformativo
     *
     * @return string 
     */
    public function getNivelformativo()
    {
        return $this->nivelformativo;
    }

    /**
     * Set observacionesidioma
     *
     * @param string $observacionesidioma
     * @return Persona
     */
    public function setObservacionesidioma($observacionesidioma)
    {
        $this->observacionesidioma = $observacionesidioma;

        return $this;
    }

    /**
     * Get observacionesidioma
     *
     * @return string 
     */
    public function getObservacionesidioma()
    {
        return $this->observacionesidioma;
    }

    /**
     * Set edadabandonoestudios
     *
     * @param string $edadabandonoestudios
     * @return Persona
     */
    public function setEdadabandonoestudios($edadabandonoestudios)
    {
        $this->edadabandonoestudios = $edadabandonoestudios;

        return $this;
    }

    /**
     * Get edadabandonoestudios
     *
     * @return string 
     */
    public function getEdadabandonoestudios()
    {
        return $this->edadabandonoestudios;
    }

    /**
     * Set laboralorigen
     *
     * @param string $laboralorigen
     * @return Persona
     */
    public function setLaboralorigen($laboralorigen)
    {
        $this->laboralorigen = $laboralorigen;

        return $this;
    }

    /**
     * Get laboralorigen
     *
     * @return string 
     */
    public function getLaboralorigen()
    {
        return $this->laboralorigen;
    }

    /**
     * Set laboralespana
     *
     * @param string $laboralespana
     * @return Persona
     */
    public function setLaboralespana($laboralespana)
    {
        $this->laboralespana = $laboralespana;

        return $this;
    }

    /**
     * Get laboralespana
     *
     * @return string 
     */
    public function getLaboralespana()
    {
        return $this->laboralespana;
    }

    /**
     * Set tiempotrabajado
     *
     * @param string $tiempotrabajado
     * @return Persona
     */
    public function setTiempotrabajado($tiempotrabajado)
    {
        $this->tiempotrabajado = $tiempotrabajado;

        return $this;
    }

    /**
     * Get tiempotrabajado
     *
     * @return string 
     */
    public function getTiempotrabajado()
    {
        return $this->tiempotrabajado;
    }

    /**
     * Set trabaja
     *
     * @param integer $trabaja
     * @return Persona
     */
    public function setTrabaja($trabaja)
    {
        $this->trabaja = $trabaja;

        return $this;
    }

    /**
     * Get trabaja
     *
     * @return integer 
     */
    public function getTrabaja()
    {
        return $this->trabaja;
    }

    /**
     * Set autonomia
     *
     * @param integer $autonomia
     * @return Persona
     */
    public function setAutonomia($autonomia)
    {
        $this->autonomia = $autonomia;

        return $this;
    }

    /**
     * Get autonomia
     *
     * @return integer 
     */
    public function getAutonomia()
    {
        return $this->autonomia;
    }

    /**
     * Set disminucionfisica
     *
     * @param integer $disminucionfisica
     * @return Persona
     */
    public function setDisminucionfisica($disminucionfisica)
    {
        $this->disminucionfisica = $disminucionfisica;

        return $this;
    }

    /**
     * Get disminucionfisica
     *
     * @return integer 
     */
    public function getDisminucionfisica()
    {
        return $this->disminucionfisica;
    }

    /**
     * Set minusvaliaporcentaje
     *
     * @param integer $minusvaliaporcentaje
     * @return Persona
     */
    public function setMinusvaliaporcentaje($minusvaliaporcentaje)
    {
        $this->minusvaliaporcentaje = $minusvaliaporcentaje;

        return $this;
    }

    /**
     * Get minusvaliaporcentaje
     *
     * @return integer 
     */
    public function getMinusvaliaporcentaje()
    {
        return $this->minusvaliaporcentaje;
    }

    /**
     * Set incapacitacion
     *
     * @param integer $incapacitacion
     * @return Persona
     */
    public function setIncapacitacion($incapacitacion)
    {
        $this->incapacitacion = $incapacitacion;

        return $this;
    }

    /**
     * Get incapacitacion
     *
     * @return integer 
     */
    public function getIncapacitacion()
    {
        return $this->incapacitacion;
    }

    /**
     * Set toxicomania
     *
     * @param integer $toxicomania
     * @return Persona
     */
    public function setToxicomania($toxicomania)
    {
        $this->toxicomania = $toxicomania;

        return $this;
    }

    /**
     * Get toxicomania
     *
     * @return integer 
     */
    public function getToxicomania()
    {
        return $this->toxicomania;
    }

    /**
     * Set antecconsumo
     *
     * @param integer $antecconsumo
     * @return Persona
     */
    public function setAntecconsumo($antecconsumo)
    {
        $this->antecconsumo = $antecconsumo;

        return $this;
    }

    /**
     * Get antecconsumo
     *
     * @return integer 
     */
    public function getAntecconsumo()
    {
        return $this->antecconsumo;
    }

    /**
     * Set disminucionpsiquica
     *
     * @param integer $disminucionpsiquica
     * @return Persona
     */
    public function setDisminucionpsiquica($disminucionpsiquica)
    {
        $this->disminucionpsiquica = $disminucionpsiquica;

        return $this;
    }

    /**
     * Get disminucionpsiquica
     *
     * @return integer 
     */
    public function getDisminucionpsiquica()
    {
        return $this->disminucionpsiquica;
    }

    /**
     * Set enfermedadmental
     *
     * @param integer $enfermedadmental
     * @return Persona
     */
    public function setEnfermedadmental($enfermedadmental)
    {
        $this->enfermedadmental = $enfermedadmental;

        return $this;
    }

    /**
     * Get enfermedadmental
     *
     * @return integer 
     */
    public function getEnfermedadmental()
    {
        return $this->enfermedadmental;
    }

    /**
     * Set tuberculosis
     *
     * @param integer $tuberculosis
     * @return Persona
     */
    public function setTuberculosis($tuberculosis)
    {
        $this->tuberculosis = $tuberculosis;

        return $this;
    }

    /**
     * Get tuberculosis
     *
     * @return integer 
     */
    public function getTuberculosis()
    {
        return $this->tuberculosis;
    }

    /**
     * Set hepatitis
     *
     * @param integer $hepatitis
     * @return Persona
     */
    public function setHepatitis($hepatitis)
    {
        $this->hepatitis = $hepatitis;

        return $this;
    }

    /**
     * Get hepatitis
     *
     * @return integer 
     */
    public function getHepatitis()
    {
        return $this->hepatitis;
    }

    /**
     * Set vih
     *
     * @param integer $vih
     * @return Persona
     */
    public function setVih($vih)
    {
        $this->vih = $vih;

        return $this;
    }

    /**
     * Get vih
     *
     * @return integer 
     */
    public function getVih()
    {
        return $this->vih;
    }

    /**
     * Set diabetes
     *
     * @param string $diabetes
     * @return Persona
     */
    public function setDiabetes($diabetes)
    {
        $this->diabetes = $diabetes;

        return $this;
    }

    /**
     * Get diabetes
     *
     * @return string 
     */
    public function getDiabetes()
    {
        return $this->diabetes;
    }

    /**
     * Set otras
     *
     * @param integer $otras
     * @return Persona
     */
    public function setOtras($otras)
    {
        $this->otras = $otras;

        return $this;
    }

    /**
     * Get otras
     *
     * @return integer 
     */
    public function getOtras()
    {
        return $this->otras;
    }

    /**
     * Set enfermedadescomentarios
     *
     * @param string $enfermedadescomentarios
     * @return Persona
     */
    public function setEnfermedadescomentarios($enfermedadescomentarios)
    {
        $this->enfermedadescomentarios = $enfermedadescomentarios;

        return $this;
    }

    /**
     * Get enfermedadescomentarios
     *
     * @return string 
     */
    public function getEnfermedadescomentarios()
    {
        return $this->enfermedadescomentarios;
    }

    /**
     * Set medicacion
     *
     * @param string $medicacion
     * @return Persona
     */
    public function setMedicacion($medicacion)
    {
        $this->medicacion = $medicacion;

        return $this;
    }

    /**
     * Get medicacion
     *
     * @return string 
     */
    public function getMedicacion()
    {
        return $this->medicacion;
    }

    /**
     * Set enfmentaldiagnostico
     *
     * @param string $enfmentaldiagnostico
     * @return Persona
     */
    public function setEnfmentaldiagnostico($enfmentaldiagnostico)
    {
        $this->enfmentaldiagnostico = $enfmentaldiagnostico;

        return $this;
    }

    /**
     * Get enfmentaldiagnostico
     *
     * @return string 
     */
    public function getEnfmentaldiagnostico()
    {
        return $this->enfmentaldiagnostico;
    }

    /**
     * Set enfmentalfechadiagn
     *
     * @param \DateTime $enfmentalfechadiagn
     * @return Persona
     */
    public function setEnfmentalfechadiagn($enfmentalfechadiagn)
    {
        $this->enfmentalfechadiagn = $enfmentalfechadiagn;

        return $this;
    }

    /**
     * Get enfmentalfechadiagn
     *
     * @return \DateTime 
     */
    public function getEnfmentalfechadiagn()
    {
        return $this->enfmentalfechadiagn;
    }

    /**
     * Set enfmentaltratamiento
     *
     * @param integer $enfmentaltratamiento
     * @return Persona
     */
    public function setEnfmentaltratamiento($enfmentaltratamiento)
    {
        $this->enfmentaltratamiento = $enfmentaltratamiento;

        return $this;
    }

    /**
     * Get enfmentaltratamiento
     *
     * @return integer 
     */
    public function getEnfmentaltratamiento()
    {
        return $this->enfmentaltratamiento;
    }

    /**
     * Set enfmentalingresos
     *
     * @param string $enfmentalingresos
     * @return Persona
     */
    public function setEnfmentalingresos($enfmentalingresos)
    {
        $this->enfmentalingresos = $enfmentalingresos;

        return $this;
    }

    /**
     * Get enfmentalingresos
     *
     * @return string 
     */
    public function getEnfmentalingresos()
    {
        return $this->enfmentalingresos;
    }

    /**
     * Set enfmentalpadres
     *
     * @param integer $enfmentalpadres
     * @return Persona
     */
    public function setEnfmentalpadres($enfmentalpadres)
    {
        $this->enfmentalpadres = $enfmentalpadres;

        return $this;
    }

    /**
     * Get enfmentalpadres
     *
     * @return integer 
     */
    public function getEnfmentalpadres()
    {
        return $this->enfmentalpadres;
    }

    /**
     * Set enfmentalhermanos
     *
     * @param integer $enfmentalhermanos
     * @return Persona
     */
    public function setEnfmentalhermanos($enfmentalhermanos)
    {
        $this->enfmentalhermanos = $enfmentalhermanos;

        return $this;
    }

    /**
     * Get enfmentalhermanos
     *
     * @return integer 
     */
    public function getEnfmentalhermanos()
    {
        return $this->enfmentalhermanos;
    }

    /**
     * Set enfmentalpareja
     *
     * @param integer $enfmentalpareja
     * @return Persona
     */
    public function setEnfmentalpareja($enfmentalpareja)
    {
        $this->enfmentalpareja = $enfmentalpareja;

        return $this;
    }

    /**
     * Get enfmentalpareja
     *
     * @return integer 
     */
    public function getEnfmentalpareja()
    {
        return $this->enfmentalpareja;
    }

    /**
     * Set enfmentalhijos
     *
     * @param integer $enfmentalhijos
     * @return Persona
     */
    public function setEnfmentalhijos($enfmentalhijos)
    {
        $this->enfmentalhijos = $enfmentalhijos;

        return $this;
    }

    /**
     * Get enfmentalhijos
     *
     * @return integer 
     */
    public function getEnfmentalhijos()
    {
        return $this->enfmentalhijos;
    }

    /**
     * Set drogaspadres
     *
     * @param integer $drogaspadres
     * @return Persona
     */
    public function setDrogaspadres($drogaspadres)
    {
        $this->drogaspadres = $drogaspadres;

        return $this;
    }

    /**
     * Get drogaspadres
     *
     * @return integer 
     */
    public function getDrogaspadres()
    {
        return $this->drogaspadres;
    }

    /**
     * Set drogashermanos
     *
     * @param integer $drogashermanos
     * @return Persona
     */
    public function setDrogashermanos($drogashermanos)
    {
        $this->drogashermanos = $drogashermanos;

        return $this;
    }

    /**
     * Get drogashermanos
     *
     * @return integer 
     */
    public function getDrogashermanos()
    {
        return $this->drogashermanos;
    }

    /**
     * Set drogaspareja
     *
     * @param integer $drogaspareja
     * @return Persona
     */
    public function setDrogaspareja($drogaspareja)
    {
        $this->drogaspareja = $drogaspareja;

        return $this;
    }

    /**
     * Get drogaspareja
     *
     * @return integer 
     */
    public function getDrogaspareja()
    {
        return $this->drogaspareja;
    }

    /**
     * Set drogashijos
     *
     * @param integer $drogashijos
     * @return Persona
     */
    public function setDrogashijos($drogashijos)
    {
        $this->drogashijos = $drogashijos;

        return $this;
    }

    /**
     * Get drogashijos
     *
     * @return integer 
     */
    public function getDrogashijos()
    {
        return $this->drogashijos;
    }

    /**
     * Set permisoresid
     *
     * @param integer $permisoresid
     * @return Persona
     */
    public function setPermisoresid($permisoresid)
    {
        $this->permisoresid = $permisoresid;

        return $this;
    }

    /**
     * Get permisoresid
     *
     * @return integer 
     */
    public function getPermisoresid()
    {
        return $this->permisoresid;
    }

    /**
     * Set permisoresidtr
     *
     * @param integer $permisoresidtr
     * @return Persona
     */
    public function setPermisoresidtr($permisoresidtr)
    {
        $this->permisoresidtr = $permisoresidtr;

        return $this;
    }

    /**
     * Get permisoresidtr
     *
     * @return integer 
     */
    public function getPermisoresidtr()
    {
        return $this->permisoresidtr;
    }

    /**
     * Set numpasap
     *
     * @param string $numpasap
     * @return Persona
     */
    public function setNumpasap($numpasap)
    {
        $this->numpasap = $numpasap;

        return $this;
    }

    /**
     * Get numpasap
     *
     * @return string 
     */
    public function getNumpasap()
    {
        return $this->numpasap;
    }

    /**
     * Set fechapasap
     *
     * @param \DateTime $fechapasap
     * @return Persona
     */
    public function setFechapasap($fechapasap)
    {
        $this->fechapasap = $fechapasap;

        return $this;
    }

    /**
     * Get fechapasap
     *
     * @return \DateTime 
     */
    public function getFechapasap()
    {
        return $this->fechapasap;
    }

    /**
     * Set numcedula
     *
     * @param string $numcedula
     * @return Persona
     */
    public function setNumcedula($numcedula)
    {
        $this->numcedula = $numcedula;

        return $this;
    }

    /**
     * Get numcedula
     *
     * @return string 
     */
    public function getNumcedula()
    {
        return $this->numcedula;
    }

    /**
     * Set fechacaduccedula
     *
     * @param \DateTime $fechacaduccedula
     * @return Persona
     */
    public function setFechacaduccedula($fechacaduccedula)
    {
        $this->fechacaduccedula = $fechacaduccedula;

        return $this;
    }

    /**
     * Get fechacaduccedula
     *
     * @return \DateTime 
     */
    public function getFechacaduccedula()
    {
        return $this->fechacaduccedula;
    }

    /**
     * Set fecharesidsolicit
     *
     * @param \DateTime $fecharesidsolicit
     * @return Persona
     */
    public function setFecharesidsolicit($fecharesidsolicit)
    {
        $this->fecharesidsolicit = $fecharesidsolicit;

        return $this;
    }

    /**
     * Get fecharesidsolicit
     *
     * @return \DateTime 
     */
    public function getFecharesidsolicit()
    {
        return $this->fecharesidsolicit;
    }

    /**
     * Set numresidconced
     *
     * @param string $numresidconced
     * @return Persona
     */
    public function setNumresidconced($numresidconced)
    {
        $this->numresidconced = $numresidconced;

        return $this;
    }

    /**
     * Get numresidconced
     *
     * @return string 
     */
    public function getNumresidconced()
    {
        return $this->numresidconced;
    }

    /**
     * Set fecharesidconced
     *
     * @param \DateTime $fecharesidconced
     * @return Persona
     */
    public function setFecharesidconced($fecharesidconced)
    {
        $this->fecharesidconced = $fecharesidconced;

        return $this;
    }

    /**
     * Get fecharesidconced
     *
     * @return \DateTime 
     */
    public function getFecharesidconced()
    {
        return $this->fecharesidconced;
    }

    /**
     * Set fecharesidtrabsolicit
     *
     * @param \DateTime $fecharesidtrabsolicit
     * @return Persona
     */
    public function setFecharesidtrabsolicit($fecharesidtrabsolicit)
    {
        $this->fecharesidtrabsolicit = $fecharesidtrabsolicit;

        return $this;
    }

    /**
     * Get fecharesidtrabsolicit
     *
     * @return \DateTime 
     */
    public function getFecharesidtrabsolicit()
    {
        return $this->fecharesidtrabsolicit;
    }

    /**
     * Set numresidtrabconc
     *
     * @param string $numresidtrabconc
     * @return Persona
     */
    public function setNumresidtrabconc($numresidtrabconc)
    {
        $this->numresidtrabconc = $numresidtrabconc;

        return $this;
    }

    /**
     * Get numresidtrabconc
     *
     * @return string 
     */
    public function getNumresidtrabconc()
    {
        return $this->numresidtrabconc;
    }

    /**
     * Set fecharesidtrabconc
     *
     * @param \DateTime $fecharesidtrabconc
     * @return Persona
     */
    public function setFecharesidtrabconc($fecharesidtrabconc)
    {
        $this->fecharesidtrabconc = $fecharesidtrabconc;

        return $this;
    }

    /**
     * Get fecharesidtrabconc
     *
     * @return \DateTime 
     */
    public function getFecharesidtrabconc()
    {
        return $this->fecharesidtrabconc;
    }

    /**
     * Set visado
     *
     * @param integer $visado
     * @return Persona
     */
    public function setVisado($visado)
    {
        $this->visado = $visado;

        return $this;
    }

    /**
     * Get visado
     *
     * @return integer 
     */
    public function getVisado()
    {
        return $this->visado;
    }

    /**
     * Set asilo
     *
     * @param integer $asilo
     * @return Persona
     */
    public function setAsilo($asilo)
    {
        $this->asilo = $asilo;

        return $this;
    }

    /**
     * Get asilo
     *
     * @return integer 
     */
    public function getAsilo()
    {
        return $this->asilo;
    }

    /**
     * Set otrosdoc
     *
     * @param string $otrosdoc
     * @return Persona
     */
    public function setOtrosdoc($otrosdoc)
    {
        $this->otrosdoc = $otrosdoc;

        return $this;
    }

    /**
     * Get otrosdoc
     *
     * @return string 
     */
    public function getOtrosdoc()
    {
        return $this->otrosdoc;
    }

    /**
     * Set fechaentrada
     *
     * @param \DateTime $fechaentrada
     * @return Persona
     */
    public function setFechaentrada($fechaentrada)
    {
        $this->fechaentrada = $fechaentrada;

        return $this;
    }

    /**
     * Get fechaentrada
     *
     * @return \DateTime 
     */
    public function getFechaentrada()
    {
        return $this->fechaentrada;
    }

    /**
     * Set fechaprueba
     *
     * @param \DateTime $fechaprueba
     * @return Persona
     */
    public function setFechaprueba($fechaprueba)
    {
        $this->fechaprueba = $fechaprueba;

        return $this;
    }

    /**
     * Get fechaprueba
     *
     * @return \DateTime 
     */
    public function getFechaprueba()
    {
        return $this->fechaprueba;
    }

    /**
     * Set abogadootros
     *
     * @param string $abogadootros
     * @return Persona
     */
    public function setAbogadootros($abogadootros)
    {
        $this->abogadootros = $abogadootros;

        return $this;
    }

    /**
     * Get abogadootros
     *
     * @return string 
     */
    public function getAbogadootros()
    {
        return $this->abogadootros;
    }

    /**
     * Set permisoresidrazonesno
     *
     * @param string $permisoresidrazonesno
     * @return Persona
     */
    public function setPermisoresidrazonesno($permisoresidrazonesno)
    {
        $this->permisoresidrazonesno = $permisoresidrazonesno;

        return $this;
    }

    /**
     * Get permisoresidrazonesno
     *
     * @return string 
     */
    public function getPermisoresidrazonesno()
    {
        return $this->permisoresidrazonesno;
    }

    /**
     * Set permisosolicitudlugar
     *
     * @param string $permisosolicitudlugar
     * @return Persona
     */
    public function setPermisosolicitudlugar($permisosolicitudlugar)
    {
        $this->permisosolicitudlugar = $permisosolicitudlugar;

        return $this;
    }

    /**
     * Get permisosolicitudlugar
     *
     * @return string 
     */
    public function getPermisosolicitudlugar()
    {
        return $this->permisosolicitudlugar;
    }

    /**
     * Set tiemporesidenciaespanya
     *
     * @param string $tiemporesidenciaespanya
     * @return Persona
     */
    public function setTiemporesidenciaespanya($tiemporesidenciaespanya)
    {
        $this->tiemporesidenciaespanya = $tiemporesidenciaespanya;

        return $this;
    }

    /**
     * Get tiemporesidenciaespanya
     *
     * @return string 
     */
    public function getTiemporesidenciaespanya()
    {
        return $this->tiemporesidenciaespanya;
    }

    /**
     * Set tiemporesidenciabilbao
     *
     * @param string $tiemporesidenciabilbao
     * @return Persona
     */
    public function setTiemporesidenciabilbao($tiemporesidenciabilbao)
    {
        $this->tiemporesidenciabilbao = $tiemporesidenciabilbao;

        return $this;
    }

    /**
     * Get tiemporesidenciabilbao
     *
     * @return string 
     */
    public function getTiemporesidenciabilbao()
    {
        return $this->tiemporesidenciabilbao;
    }

    /**
     * Set permisotrabajo
     *
     * @param string $permisotrabajo
     * @return Persona
     */
    public function setPermisotrabajo($permisotrabajo)
    {
        $this->permisotrabajo = $permisotrabajo;

        return $this;
    }

    /**
     * Get permisotrabajo
     *
     * @return string 
     */
    public function getPermisotrabajo()
    {
        return $this->permisotrabajo;
    }

    /**
     * Set permisotrabajorazonesno
     *
     * @param string $permisotrabajorazonesno
     * @return Persona
     */
    public function setPermisotrabajorazonesno($permisotrabajorazonesno)
    {
        $this->permisotrabajorazonesno = $permisotrabajorazonesno;

        return $this;
    }

    /**
     * Get permisotrabajorazonesno
     *
     * @return string 
     */
    public function getPermisotrabajorazonesno()
    {
        return $this->permisotrabajorazonesno;
    }

    /**
     * Set fechaempadronamiento
     *
     * @param \DateTime $fechaempadronamiento
     * @return Persona
     */
    public function setFechaempadronamiento($fechaempadronamiento)
    {
        $this->fechaempadronamiento = $fechaempadronamiento;

        return $this;
    }

    /**
     * Get fechaempadronamiento
     *
     * @return \DateTime 
     */
    public function getFechaempadronamiento()
    {
        return $this->fechaempadronamiento;
    }

    /**
     * Set direccionpadronactual
     *
     * @param string $direccionpadronactual
     * @return Persona
     */
    public function setDireccionpadronactual($direccionpadronactual)
    {
        $this->direccionpadronactual = $direccionpadronactual;

        return $this;
    }

    /**
     * Get direccionpadronactual
     *
     * @return string 
     */
    public function getDireccionpadronactual()
    {
        return $this->direccionpadronactual;
    }

    /**
     * Set tis
     *
     * @param integer $tis
     * @return Persona
     */
    public function setTis($tis)
    {
        $this->tis = $tis;

        return $this;
    }

    /**
     * Get tis
     *
     * @return integer 
     */
    public function getTis()
    {
        return $this->tis;
    }

    /**
     * Set redapoyo
     *
     * @param integer $redapoyo
     * @return Persona
     */
    public function setRedapoyo($redapoyo)
    {
        $this->redapoyo = $redapoyo;

        return $this;
    }

    /**
     * Get redapoyo
     *
     * @return integer 
     */
    public function getRedapoyo()
    {
        return $this->redapoyo;
    }

    /**
     * Set ingresospropios
     *
     * @param integer $ingresospropios
     * @return Persona
     */
    public function setIngresospropios($ingresospropios)
    {
        $this->ingresospropios = $ingresospropios;

        return $this;
    }

    /**
     * Get ingresospropios
     *
     * @return integer 
     */
    public function getIngresospropios()
    {
        return $this->ingresospropios;
    }

    /**
     * Set ingresospnc
     *
     * @param integer $ingresospnc
     * @return Persona
     */
    public function setIngresospnc($ingresospnc)
    {
        $this->ingresospnc = $ingresospnc;

        return $this;
    }

    /**
     * Get ingresospnc
     *
     * @return integer 
     */
    public function getIngresospnc()
    {
        return $this->ingresospnc;
    }

    /**
     * Set ingresosotros
     *
     * @param integer $ingresosotros
     * @return Persona
     */
    public function setIngresosotros($ingresosotros)
    {
        $this->ingresosotros = $ingresosotros;

        return $this;
    }

    /**
     * Get ingresosotros
     *
     * @return integer 
     */
    public function getIngresosotros()
    {
        return $this->ingresosotros;
    }

    /**
     * Set ingresosnomina
     *
     * @param integer $ingresosnomina
     * @return Persona
     */
    public function setIngresosnomina($ingresosnomina)
    {
        $this->ingresosnomina = $ingresosnomina;

        return $this;
    }

    /**
     * Get ingresosnomina
     *
     * @return integer 
     */
    public function getIngresosnomina()
    {
        return $this->ingresosnomina;
    }

    /**
     * Set ingresosrgi
     *
     * @param integer $ingresosrgi
     * @return Persona
     */
    public function setIngresosrgi($ingresosrgi)
    {
        $this->ingresosrgi = $ingresosrgi;

        return $this;
    }

    /**
     * Get ingresosrgi
     *
     * @return integer 
     */
    public function getIngresosrgi()
    {
        return $this->ingresosrgi;
    }

    /**
     * Set ingresosprestcontrib
     *
     * @param integer $ingresosprestcontrib
     * @return Persona
     */
    public function setIngresosprestcontrib($ingresosprestcontrib)
    {
        $this->ingresosprestcontrib = $ingresosprestcontrib;

        return $this;
    }

    /**
     * Get ingresosprestcontrib
     *
     * @return integer 
     */
    public function getIngresosprestcontrib()
    {
        return $this->ingresosprestcontrib;
    }

    /**
     * Set ingresossedesconoce
     *
     * @param integer $ingresossedesconoce
     * @return Persona
     */
    public function setIngresossedesconoce($ingresossedesconoce)
    {
        $this->ingresossedesconoce = $ingresossedesconoce;

        return $this;
    }

    /**
     * Get ingresossedesconoce
     *
     * @return integer 
     */
    public function getIngresossedesconoce()
    {
        return $this->ingresossedesconoce;
    }

    /**
     * Set ingresosayudaindividual
     *
     * @param integer $ingresosayudaindividual
     * @return Persona
     */
    public function setIngresosayudaindividual($ingresosayudaindividual)
    {
        $this->ingresosayudaindividual = $ingresosayudaindividual;

        return $this;
    }

    /**
     * Get ingresosayudaindividual
     *
     * @return integer 
     */
    public function getIngresosayudaindividual()
    {
        return $this->ingresosayudaindividual;
    }

    /**
     * Set ingresosno
     *
     * @param integer $ingresosno
     * @return Persona
     */
    public function setIngresosno($ingresosno)
    {
        $this->ingresosno = $ingresosno;

        return $this;
    }

    /**
     * Get ingresosno
     *
     * @return integer 
     */
    public function getIngresosno()
    {
        return $this->ingresosno;
    }

    /**
     * Set penalantecedentesprision
     *
     * @param integer $penalantecedentesprision
     * @return Persona
     */
    public function setPenalantecedentesprision($penalantecedentesprision)
    {
        $this->penalantecedentesprision = $penalantecedentesprision;

        return $this;
    }

    /**
     * Get penalantecedentesprision
     *
     * @return integer 
     */
    public function getPenalantecedentesprision()
    {
        return $this->penalantecedentesprision;
    }

    /**
     * Set penalordenalejamiento
     *
     * @param integer $penalordenalejamiento
     * @return Persona
     */
    public function setPenalordenalejamiento($penalordenalejamiento)
    {
        $this->penalordenalejamiento = $penalordenalejamiento;

        return $this;
    }

    /**
     * Get penalordenalejamiento
     *
     * @return integer 
     */
    public function getPenalordenalejamiento()
    {
        return $this->penalordenalejamiento;
    }

    /**
     * Set penalprisionpreventiva
     *
     * @param integer $penalprisionpreventiva
     * @return Persona
     */
    public function setPenalprisionpreventiva($penalprisionpreventiva)
    {
        $this->penalprisionpreventiva = $penalprisionpreventiva;

        return $this;
    }

    /**
     * Get penalprisionpreventiva
     *
     * @return integer 
     */
    public function getPenalprisionpreventiva()
    {
        return $this->penalprisionpreventiva;
    }

    /**
     * Set penalprisionotros
     *
     * @param integer $penalprisionotros
     * @return Persona
     */
    public function setPenalprisionotros($penalprisionotros)
    {
        $this->penalprisionotros = $penalprisionotros;

        return $this;
    }

    /**
     * Get penalprisionotros
     *
     * @return integer 
     */
    public function getPenalprisionotros()
    {
        return $this->penalprisionotros;
    }

    /**
     * Set penallibcondicional
     *
     * @param integer $penallibcondicional
     * @return Persona
     */
    public function setPenallibcondicional($penallibcondicional)
    {
        $this->penallibcondicional = $penallibcondicional;

        return $this;
    }

    /**
     * Get penallibcondicional
     *
     * @return integer 
     */
    public function getPenallibcondicional()
    {
        return $this->penallibcondicional;
    }

    /**
     * Set penalmedidaseguridad
     *
     * @param integer $penalmedidaseguridad
     * @return Persona
     */
    public function setPenalmedidaseguridad($penalmedidaseguridad)
    {
        $this->penalmedidaseguridad = $penalmedidaseguridad;

        return $this;
    }

    /**
     * Get penalmedidaseguridad
     *
     * @return integer 
     */
    public function getPenalmedidaseguridad()
    {
        return $this->penalmedidaseguridad;
    }

    /**
     * Set penalcausaspendientes
     *
     * @param integer $penalcausaspendientes
     * @return Persona
     */
    public function setPenalcausaspendientes($penalcausaspendientes)
    {
        $this->penalcausaspendientes = $penalcausaspendientes;

        return $this;
    }

    /**
     * Get penalcausaspendientes
     *
     * @return integer 
     */
    public function getPenalcausaspendientes()
    {
        return $this->penalcausaspendientes;
    }

    /**
     * Set penalpermisopenitenc
     *
     * @param integer $penalpermisopenitenc
     * @return Persona
     */
    public function setPenalpermisopenitenc($penalpermisopenitenc)
    {
        $this->penalpermisopenitenc = $penalpermisopenitenc;

        return $this;
    }

    /**
     * Get penalpermisopenitenc
     *
     * @return integer 
     */
    public function getPenalpermisopenitenc()
    {
        return $this->penalpermisopenitenc;
    }

    /**
     * Set penaltercergrado
     *
     * @param integer $penaltercergrado
     * @return Persona
     */
    public function setPenaltercergrado($penaltercergrado)
    {
        $this->penaltercergrado = $penaltercergrado;

        return $this;
    }

    /**
     * Get penaltercergrado
     *
     * @return integer 
     */
    public function getPenaltercergrado()
    {
        return $this->penaltercergrado;
    }

    /**
     * Set penaltbc
     *
     * @param integer $penaltbc
     * @return Persona
     */
    public function setPenaltbc($penaltbc)
    {
        $this->penaltbc = $penaltbc;

        return $this;
    }

    /**
     * Get penaltbc
     *
     * @return integer 
     */
    public function getPenaltbc()
    {
        return $this->penaltbc;
    }

    /**
     * Set ducha
     *
     * @param integer $ducha
     * @return Persona
     */
    public function setDucha($ducha)
    {
        $this->ducha = $ducha;

        return $this;
    }

    /**
     * Get ducha
     *
     * @return integer 
     */
    public function getDucha()
    {
        return $this->ducha;
    }

    /**
     * Set ropero
     *
     * @param integer $ropero
     * @return Persona
     */
    public function setRopero($ropero)
    {
        $this->ropero = $ropero;

        return $this;
    }

    /**
     * Get ropero
     *
     * @return integer 
     */
    public function getRopero()
    {
        return $this->ropero;
    }

    /**
     * Set lavanderia
     *
     * @param integer $lavanderia
     * @return Persona
     */
    public function setLavanderia($lavanderia)
    {
        $this->lavanderia = $lavanderia;

        return $this;
    }

    /**
     * Get lavanderia
     *
     * @return integer 
     */
    public function getLavanderia()
    {
        return $this->lavanderia;
    }

    /**
     * Set tlsabado
     *
     * @param integer $tlsabado
     * @return Persona
     */
    public function setTlsabado($tlsabado)
    {
        $this->tlsabado = $tlsabado;

        return $this;
    }

    /**
     * Get tlsabado
     *
     * @return integer 
     */
    public function getTlsabado()
    {
        return $this->tlsabado;
    }

    /**
     * Set tldomingo
     *
     * @param integer $tldomingo
     * @return Persona
     */
    public function setTldomingo($tldomingo)
    {
        $this->tldomingo = $tldomingo;

        return $this;
    }

    /**
     * Get tldomingo
     *
     * @return integer 
     */
    public function getTldomingo()
    {
        return $this->tldomingo;
    }

    /**
     * Set salidaverano
     *
     * @param integer $salidaverano
     * @return Persona
     */
    public function setSalidaverano($salidaverano)
    {
        $this->salidaverano = $salidaverano;

        return $this;
    }

    /**
     * Get salidaverano
     *
     * @return integer 
     */
    public function getSalidaverano()
    {
        return $this->salidaverano;
    }

    /**
     * Set salidaotro
     *
     * @param integer $salidaotro
     * @return Persona
     */
    public function setSalidaotro($salidaotro)
    {
        $this->salidaotro = $salidaotro;

        return $this;
    }

    /**
     * Get salidaotro
     *
     * @return integer 
     */
    public function getSalidaotro()
    {
        return $this->salidaotro;
    }

    /**
     * Set medicacioncentro
     *
     * @param integer $medicacioncentro
     * @return Persona
     */
    public function setMedicacioncentro($medicacioncentro)
    {
        $this->medicacioncentro = $medicacioncentro;

        return $this;
    }

    /**
     * Get medicacioncentro
     *
     * @return integer 
     */
    public function getMedicacioncentro()
    {
        return $this->medicacioncentro;
    }

    /**
     * Set nivelcastellano
     *
     * @param integer $nivelcastellano
     * @return Persona
     */
    public function setNivelcastellano($nivelcastellano)
    {
        $this->nivelcastellano = $nivelcastellano;

        return $this;
    }

    /**
     * Get nivelcastellano
     *
     * @return integer 
     */
    public function getNivelcastellano()
    {
        return $this->nivelcastellano;
    }

    /**
     * Set explaboral
     *
     * @param integer $explaboral
     * @return Persona
     */
    public function setExplaboral($explaboral)
    {
        $this->explaboral = $explaboral;

        return $this;
    }

    /**
     * Get explaboral
     *
     * @return integer 
     */
    public function getExplaboral()
    {
        return $this->explaboral;
    }

    /**
     * Set lanbide
     *
     * @param integer $lanbide
     * @return Persona
     */
    public function setLanbide($lanbide)
    {
        $this->lanbide = $lanbide;

        return $this;
    }

    /**
     * Get lanbide
     *
     * @return integer 
     */
    public function getLanbide()
    {
        return $this->lanbide;
    }

    /**
     * Set fechaaltalanbide
     *
     * @param \DateTime $fechaaltalanbide
     * @return Persona
     */
    public function setFechaaltalanbide($fechaaltalanbide)
    {
        $this->fechaaltalanbide = $fechaaltalanbide;

        return $this;
    }

    /**
     * Get fechaaltalanbide
     *
     * @return \DateTime 
     */
    public function getFechaaltalanbide()
    {
        return $this->fechaaltalanbide;
    }

    /**
     * Set fecharenovlanbide
     *
     * @param \DateTime $fecharenovlanbide
     * @return Persona
     */
    public function setFecharenovlanbide($fecharenovlanbide)
    {
        $this->fecharenovlanbide = $fecharenovlanbide;

        return $this;
    }

    /**
     * Get fecharenovlanbide
     *
     * @return \DateTime 
     */
    public function getFecharenovlanbide()
    {
        return $this->fecharenovlanbide;
    }

    /**
     * Set inem
     *
     * @param integer $inem
     * @return Persona
     */
    public function setInem($inem)
    {
        $this->inem = $inem;

        return $this;
    }

    /**
     * Get inem
     *
     * @return integer 
     */
    public function getInem()
    {
        return $this->inem;
    }

    /**
     * Set fechaaltainem
     *
     * @param \DateTime $fechaaltainem
     * @return Persona
     */
    public function setFechaaltainem($fechaaltainem)
    {
        $this->fechaaltainem = $fechaaltainem;

        return $this;
    }

    /**
     * Get fechaaltainem
     *
     * @return \DateTime 
     */
    public function getFechaaltainem()
    {
        return $this->fechaaltainem;
    }

    /**
     * Set fecharenovinem
     *
     * @param \DateTime $fecharenovinem
     * @return Persona
     */
    public function setFecharenovinem($fecharenovinem)
    {
        $this->fecharenovinem = $fecharenovinem;

        return $this;
    }

    /**
     * Get fecharenovinem
     *
     * @return \DateTime 
     */
    public function getFecharenovinem()
    {
        return $this->fecharenovinem;
    }

    /**
     * Set cursos
     *
     * @param string $cursos
     * @return Persona
     */
    public function setCursos($cursos)
    {
        $this->cursos = $cursos;

        return $this;
    }

    /**
     * Get cursos
     *
     * @return string 
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set poblacionpadron
     *
     * @param integer $poblacionpadron
     * @return Persona
     */
    public function setPoblacionpadron($poblacionpadron)
    {
        $this->poblacionpadron = $poblacionpadron;

        return $this;
    }

    /**
     * Get poblacionpadron
     *
     * @return integer 
     */
    public function getPoblacionpadron()
    {
        return $this->poblacionpadron;
    }

    /**
     * Set consumoprinc
     *
     * @param integer $consumoprinc
     * @return Persona
     */
    public function setConsumoprinc($consumoprinc)
    {
        $this->consumoprinc = $consumoprinc;

        return $this;
    }

    /**
     * Get consumoprinc
     *
     * @return integer 
     */
    public function getConsumoprinc()
    {
        return $this->consumoprinc;
    }

    /**
     * Set insertidusuario
     *
     * @param integer $insertidusuario
     * @return Persona
     */
    public function setInsertidusuario($insertidusuario)
    {
        $this->insertidusuario = $insertidusuario;

        return $this;
    }

    /**
     * Get insertidusuario
     *
     * @return integer 
     */
    public function getInsertidusuario()
    {
        return $this->insertidusuario;
    }

    /**
     * Set fechainsert
     *
     * @param \DateTime $fechainsert
     * @return Persona
     */
    public function setFechainsert($fechainsert)
    {
        $this->fechainsert = $fechainsert;

        return $this;
    }

    /**
     * Get fechainsert
     *
     * @return \DateTime 
     */
    public function getFechainsert()
    {
        return $this->fechainsert;
    }

    /**
     * Set anosconsumo
     *
     * @param integer $anosconsumo
     * @return Persona
     */
    public function setAnosconsumo($anosconsumo)
    {
        $this->anosconsumo = $anosconsumo;

        return $this;
    }

    /**
     * Get anosconsumo
     *
     * @return integer 
     */
    public function getAnosconsumo()
    {
        return $this->anosconsumo;
    }

    /**
     * Set tratamiento
     *
     * @param integer $tratamiento
     * @return Persona
     */
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return integer 
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set tratamientotipo
     *
     * @param integer $tratamientotipo
     * @return Persona
     */
    public function setTratamientotipo($tratamientotipo)
    {
        $this->tratamientotipo = $tratamientotipo;

        return $this;
    }

    /**
     * Get tratamientotipo
     *
     * @return integer 
     */
    public function getTratamientotipo()
    {
        return $this->tratamientotipo;
    }

    /**
     * Set procedenciademandalista
     *
     * @param integer $procedenciademandalista
     * @return Persona
     */
    public function setProcedenciademandalista($procedenciademandalista)
    {
        $this->procedenciademandalista = $procedenciademandalista;

        return $this;
    }

    /**
     * Get procedenciademandalista
     *
     * @return integer 
     */
    public function getProcedenciademandalista()
    {
        return $this->procedenciademandalista;
    }

    /**
     * Set situacionadministrativa
     *
     * @param integer $situacionadministrativa
     * @return Persona
     */
    public function setSituacionadministrativa($situacionadministrativa)
    {
        $this->situacionadministrativa = $situacionadministrativa;

        return $this;
    }

    /**
     * Get situacionadministrativa
     *
     * @return integer 
     */
    public function getSituacionadministrativa()
    {
        return $this->situacionadministrativa;
    }

    /**
     * Set fechacaductis
     *
     * @param \DateTime $fechacaductis
     * @return Persona
     */
    public function setFechacaductis($fechacaductis)
    {
        $this->fechacaductis = $fechacaductis;

        return $this;
    }

    /**
     * Get fechacaductis
     *
     * @return \DateTime 
     */
    public function getFechacaductis()
    {
        return $this->fechacaductis;
    }

    /**
     * Set ind1x1
     *
     * @param boolean $ind1x1
     * @return Persona
     */
    public function setInd1x1($ind1x1)
    {
        $this->ind1x1 = $ind1x1;

        return $this;
    }

    /**
     * Get ind1x1
     *
     * @return boolean 
     */
    public function getInd1x1()
    {
        return $this->ind1x1;
    }

    /**
     * Set ind1x1xa
     *
     * @param boolean $ind1x1xa
     * @return Persona
     */
    public function setInd1x1xa($ind1x1xa)
    {
        $this->ind1x1xa = $ind1x1xa;

        return $this;
    }

    /**
     * Get ind1x1xa
     *
     * @return boolean 
     */
    public function getInd1x1xa()
    {
        return $this->ind1x1xa;
    }

    /**
     * Set ind1x2
     *
     * @param boolean $ind1x2
     * @return Persona
     */
    public function setInd1x2($ind1x2)
    {
        $this->ind1x2 = $ind1x2;

        return $this;
    }

    /**
     * Get ind1x2
     *
     * @return boolean 
     */
    public function getInd1x2()
    {
        return $this->ind1x2;
    }

    /**
     * Set ind1x2xa
     *
     * @param boolean $ind1x2xa
     * @return Persona
     */
    public function setInd1x2xa($ind1x2xa)
    {
        $this->ind1x2xa = $ind1x2xa;

        return $this;
    }

    /**
     * Get ind1x2xa
     *
     * @return boolean 
     */
    public function getInd1x2xa()
    {
        return $this->ind1x2xa;
    }

    /**
     * Set ind1x3
     *
     * @param boolean $ind1x3
     * @return Persona
     */
    public function setInd1x3($ind1x3)
    {
        $this->ind1x3 = $ind1x3;

        return $this;
    }

    /**
     * Get ind1x3
     *
     * @return boolean 
     */
    public function getInd1x3()
    {
        return $this->ind1x3;
    }

    /**
     * Set ind1x4
     *
     * @param boolean $ind1x4
     * @return Persona
     */
    public function setInd1x4($ind1x4)
    {
        $this->ind1x4 = $ind1x4;

        return $this;
    }

    /**
     * Get ind1x4
     *
     * @return boolean 
     */
    public function getInd1x4()
    {
        return $this->ind1x4;
    }

    /**
     * Set ind1x5
     *
     * @param boolean $ind1x5
     * @return Persona
     */
    public function setInd1x5($ind1x5)
    {
        $this->ind1x5 = $ind1x5;

        return $this;
    }

    /**
     * Get ind1x5
     *
     * @return boolean 
     */
    public function getInd1x5()
    {
        return $this->ind1x5;
    }

    /**
     * Set ind1x5xa
     *
     * @param boolean $ind1x5xa
     * @return Persona
     */
    public function setInd1x5xa($ind1x5xa)
    {
        $this->ind1x5xa = $ind1x5xa;

        return $this;
    }

    /**
     * Get ind1x5xa
     *
     * @return boolean 
     */
    public function getInd1x5xa()
    {
        return $this->ind1x5xa;
    }

    /**
     * Set ind1x6
     *
     * @param boolean $ind1x6
     * @return Persona
     */
    public function setInd1x6($ind1x6)
    {
        $this->ind1x6 = $ind1x6;

        return $this;
    }

    /**
     * Get ind1x6
     *
     * @return boolean 
     */
    public function getInd1x6()
    {
        return $this->ind1x6;
    }

    /**
     * Set ind1x7
     *
     * @param boolean $ind1x7
     * @return Persona
     */
    public function setInd1x7($ind1x7)
    {
        $this->ind1x7 = $ind1x7;

        return $this;
    }

    /**
     * Get ind1x7
     *
     * @return boolean 
     */
    public function getInd1x7()
    {
        return $this->ind1x7;
    }

    /**
     * Set ind2x1
     *
     * @param boolean $ind2x1
     * @return Persona
     */
    public function setInd2x1($ind2x1)
    {
        $this->ind2x1 = $ind2x1;

        return $this;
    }

    /**
     * Get ind2x1
     *
     * @return boolean 
     */
    public function getInd2x1()
    {
        return $this->ind2x1;
    }

    /**
     * Set ind2xax1
     *
     * @param boolean $ind2xax1
     * @return Persona
     */
    public function setInd2xax1($ind2xax1)
    {
        $this->ind2xax1 = $ind2xax1;

        return $this;
    }

    /**
     * Get ind2xax1
     *
     * @return boolean 
     */
    public function getInd2xax1()
    {
        return $this->ind2xax1;
    }

    /**
     * Set ind2xax2
     *
     * @param boolean $ind2xax2
     * @return Persona
     */
    public function setInd2xax2($ind2xax2)
    {
        $this->ind2xax2 = $ind2xax2;

        return $this;
    }

    /**
     * Get ind2xax2
     *
     * @return boolean 
     */
    public function getInd2xax2()
    {
        return $this->ind2xax2;
    }

    /**
     * Set ind2xax3
     *
     * @param boolean $ind2xax3
     * @return Persona
     */
    public function setInd2xax3($ind2xax3)
    {
        $this->ind2xax3 = $ind2xax3;

        return $this;
    }

    /**
     * Get ind2xax3
     *
     * @return boolean 
     */
    public function getInd2xax3()
    {
        return $this->ind2xax3;
    }

    /**
     * Set ind2xax4
     *
     * @param boolean $ind2xax4
     * @return Persona
     */
    public function setInd2xax4($ind2xax4)
    {
        $this->ind2xax4 = $ind2xax4;

        return $this;
    }

    /**
     * Get ind2xax4
     *
     * @return boolean 
     */
    public function getInd2xax4()
    {
        return $this->ind2xax4;
    }

    /**
     * Set ind2xbx1
     *
     * @param boolean $ind2xbx1
     * @return Persona
     */
    public function setInd2xbx1($ind2xbx1)
    {
        $this->ind2xbx1 = $ind2xbx1;

        return $this;
    }

    /**
     * Get ind2xbx1
     *
     * @return boolean 
     */
    public function getInd2xbx1()
    {
        return $this->ind2xbx1;
    }

    /**
     * Set ind2xbx2
     *
     * @param boolean $ind2xbx2
     * @return Persona
     */
    public function setInd2xbx2($ind2xbx2)
    {
        $this->ind2xbx2 = $ind2xbx2;

        return $this;
    }

    /**
     * Get ind2xbx2
     *
     * @return boolean 
     */
    public function getInd2xbx2()
    {
        return $this->ind2xbx2;
    }

    /**
     * Set ind3x1
     *
     * @param boolean $ind3x1
     * @return Persona
     */
    public function setInd3x1($ind3x1)
    {
        $this->ind3x1 = $ind3x1;

        return $this;
    }

    /**
     * Get ind3x1
     *
     * @return boolean 
     */
    public function getInd3x1()
    {
        return $this->ind3x1;
    }

    /**
     * Set ind3x1xa
     *
     * @param boolean $ind3x1xa
     * @return Persona
     */
    public function setInd3x1xa($ind3x1xa)
    {
        $this->ind3x1xa = $ind3x1xa;

        return $this;
    }

    /**
     * Get ind3x1xa
     *
     * @return boolean 
     */
    public function getInd3x1xa()
    {
        return $this->ind3x1xa;
    }

    /**
     * Set ind3x2
     *
     * @param boolean $ind3x2
     * @return Persona
     */
    public function setInd3x2($ind3x2)
    {
        $this->ind3x2 = $ind3x2;

        return $this;
    }

    /**
     * Get ind3x2
     *
     * @return boolean 
     */
    public function getInd3x2()
    {
        return $this->ind3x2;
    }

    /**
     * Set ind3x2xe
     *
     * @param boolean $ind3x2xe
     * @return Persona
     */
    public function setInd3x2xe($ind3x2xe)
    {
        $this->ind3x2xe = $ind3x2xe;

        return $this;
    }

    /**
     * Get ind3x2xe
     *
     * @return boolean 
     */
    public function getInd3x2xe()
    {
        return $this->ind3x2xe;
    }

    /**
     * Set ind3x2xd
     *
     * @param boolean $ind3x2xd
     * @return Persona
     */
    public function setInd3x2xd($ind3x2xd)
    {
        $this->ind3x2xd = $ind3x2xd;

        return $this;
    }

    /**
     * Get ind3x2xd
     *
     * @return boolean 
     */
    public function getInd3x2xd()
    {
        return $this->ind3x2xd;
    }

    /**
     * Set ind3x2xr
     *
     * @param boolean $ind3x2xr
     * @return Persona
     */
    public function setInd3x2xr($ind3x2xr)
    {
        $this->ind3x2xr = $ind3x2xr;

        return $this;
    }

    /**
     * Get ind3x2xr
     *
     * @return boolean 
     */
    public function getInd3x2xr()
    {
        return $this->ind3x2xr;
    }

    /**
     * Set ind3x3
     *
     * @param boolean $ind3x3
     * @return Persona
     */
    public function setInd3x3($ind3x3)
    {
        $this->ind3x3 = $ind3x3;

        return $this;
    }

    /**
     * Get ind3x3
     *
     * @return boolean 
     */
    public function getInd3x3()
    {
        return $this->ind3x3;
    }

    /**
     * Set ind3x3xt
     *
     * @param boolean $ind3x3xt
     * @return Persona
     */
    public function setInd3x3xt($ind3x3xt)
    {
        $this->ind3x3xt = $ind3x3xt;

        return $this;
    }

    /**
     * Get ind3x3xt
     *
     * @return boolean 
     */
    public function getInd3x3xt()
    {
        return $this->ind3x3xt;
    }

    /**
     * Set ind3x4
     *
     * @param boolean $ind3x4
     * @return Persona
     */
    public function setInd3x4($ind3x4)
    {
        $this->ind3x4 = $ind3x4;

        return $this;
    }

    /**
     * Get ind3x4
     *
     * @return boolean 
     */
    public function getInd3x4()
    {
        return $this->ind3x4;
    }

    /**
     * Set indtx1
     *
     * @param boolean $indtx1
     * @return Persona
     */
    public function setIndtx1($indtx1)
    {
        $this->indtx1 = $indtx1;

        return $this;
    }

    /**
     * Get indtx1
     *
     * @return boolean 
     */
    public function getIndtx1()
    {
        return $this->indtx1;
    }

    /**
     * Set indtx2
     *
     * @param boolean $indtx2
     * @return Persona
     */
    public function setIndtx2($indtx2)
    {
        $this->indtx2 = $indtx2;

        return $this;
    }

    /**
     * Get indtx2
     *
     * @return boolean 
     */
    public function getIndtx2()
    {
        return $this->indtx2;
    }

    /**
     * Set indtx3
     *
     * @param boolean $indtx3
     * @return Persona
     */
    public function setIndtx3($indtx3)
    {
        $this->indtx3 = $indtx3;

        return $this;
    }

    /**
     * Get indtx3
     *
     * @return boolean 
     */
    public function getIndtx3()
    {
        return $this->indtx3;
    }

    /**
     * Set indtx4
     *
     * @param boolean $indtx4
     * @return Persona
     */
    public function setIndtx4($indtx4)
    {
        $this->indtx4 = $indtx4;

        return $this;
    }

    /**
     * Get indtx4
     *
     * @return boolean 
     */
    public function getIndtx4()
    {
        return $this->indtx4;
    }

    /**
     * Set ind4x1
     *
     * @param boolean $ind4x1
     * @return Persona
     */
    public function setInd4x1($ind4x1)
    {
        $this->ind4x1 = $ind4x1;

        return $this;
    }

    /**
     * Get ind4x1
     *
     * @return boolean 
     */
    public function getInd4x1()
    {
        return $this->ind4x1;
    }

    /**
     * Set ind4x2
     *
     * @param boolean $ind4x2
     * @return Persona
     */
    public function setInd4x2($ind4x2)
    {
        $this->ind4x2 = $ind4x2;

        return $this;
    }

    /**
     * Get ind4x2
     *
     * @return boolean 
     */
    public function getInd4x2()
    {
        return $this->ind4x2;
    }

    /**
     * Set ind4x2xa
     *
     * @param boolean $ind4x2xa
     * @return Persona
     */
    public function setInd4x2xa($ind4x2xa)
    {
        $this->ind4x2xa = $ind4x2xa;

        return $this;
    }

    /**
     * Get ind4x2xa
     *
     * @return boolean 
     */
    public function getInd4x2xa()
    {
        return $this->ind4x2xa;
    }

    /**
     * Set ind4x2xb
     *
     * @param boolean $ind4x2xb
     * @return Persona
     */
    public function setInd4x2xb($ind4x2xb)
    {
        $this->ind4x2xb = $ind4x2xb;

        return $this;
    }

    /**
     * Get ind4x2xb
     *
     * @return boolean 
     */
    public function getInd4x2xb()
    {
        return $this->ind4x2xb;
    }

    /**
     * Set ind4x2xc
     *
     * @param boolean $ind4x2xc
     * @return Persona
     */
    public function setInd4x2xc($ind4x2xc)
    {
        $this->ind4x2xc = $ind4x2xc;

        return $this;
    }

    /**
     * Get ind4x2xc
     *
     * @return boolean 
     */
    public function getInd4x2xc()
    {
        return $this->ind4x2xc;
    }

    /**
     * Set ind4x3
     *
     * @param boolean $ind4x3
     * @return Persona
     */
    public function setInd4x3($ind4x3)
    {
        $this->ind4x3 = $ind4x3;

        return $this;
    }

    /**
     * Get ind4x3
     *
     * @return boolean 
     */
    public function getInd4x3()
    {
        return $this->ind4x3;
    }

    /**
     * Set ind4x3x1
     *
     * @param boolean $ind4x3x1
     * @return Persona
     */
    public function setInd4x3x1($ind4x3x1)
    {
        $this->ind4x3x1 = $ind4x3x1;

        return $this;
    }

    /**
     * Get ind4x3x1
     *
     * @return boolean 
     */
    public function getInd4x3x1()
    {
        return $this->ind4x3x1;
    }

    /**
     * Set ind4x3x2
     *
     * @param boolean $ind4x3x2
     * @return Persona
     */
    public function setInd4x3x2($ind4x3x2)
    {
        $this->ind4x3x2 = $ind4x3x2;

        return $this;
    }

    /**
     * Get ind4x3x2
     *
     * @return boolean 
     */
    public function getInd4x3x2()
    {
        return $this->ind4x3x2;
    }

    /**
     * Set ind4x3x3
     *
     * @param boolean $ind4x3x3
     * @return Persona
     */
    public function setInd4x3x3($ind4x3x3)
    {
        $this->ind4x3x3 = $ind4x3x3;

        return $this;
    }

    /**
     * Get ind4x3x3
     *
     * @return boolean 
     */
    public function getInd4x3x3()
    {
        return $this->ind4x3x3;
    }

    /**
     * Set ind4xax1
     *
     * @param boolean $ind4xax1
     * @return Persona
     */
    public function setInd4xax1($ind4xax1)
    {
        $this->ind4xax1 = $ind4xax1;

        return $this;
    }

    /**
     * Get ind4xax1
     *
     * @return boolean 
     */
    public function getInd4xax1()
    {
        return $this->ind4xax1;
    }

    /**
     * Set ind4xax2
     *
     * @param boolean $ind4xax2
     * @return Persona
     */
    public function setInd4xax2($ind4xax2)
    {
        $this->ind4xax2 = $ind4xax2;

        return $this;
    }

    /**
     * Get ind4xax2
     *
     * @return boolean 
     */
    public function getInd4xax2()
    {
        return $this->ind4xax2;
    }

    /**
     * Set ind4xax3
     *
     * @param boolean $ind4xax3
     * @return Persona
     */
    public function setInd4xax3($ind4xax3)
    {
        $this->ind4xax3 = $ind4xax3;

        return $this;
    }

    /**
     * Get ind4xax3
     *
     * @return boolean 
     */
    public function getInd4xax3()
    {
        return $this->ind4xax3;
    }

    /**
     * Set ind4xax4
     *
     * @param boolean $ind4xax4
     * @return Persona
     */
    public function setInd4xax4($ind4xax4)
    {
        $this->ind4xax4 = $ind4xax4;

        return $this;
    }

    /**
     * Get ind4xax4
     *
     * @return boolean 
     */
    public function getInd4xax4()
    {
        return $this->ind4xax4;
    }

    /**
     * Set ind4xax5
     *
     * @param boolean $ind4xax5
     * @return Persona
     */
    public function setInd4xax5($ind4xax5)
    {
        $this->ind4xax5 = $ind4xax5;

        return $this;
    }

    /**
     * Get ind4xax5
     *
     * @return boolean 
     */
    public function getInd4xax5()
    {
        return $this->ind4xax5;
    }

    /**
     * Set ind4xax6
     *
     * @param boolean $ind4xax6
     * @return Persona
     */
    public function setInd4xax6($ind4xax6)
    {
        $this->ind4xax6 = $ind4xax6;

        return $this;
    }

    /**
     * Get ind4xax6
     *
     * @return boolean 
     */
    public function getInd4xax6()
    {
        return $this->ind4xax6;
    }

    /**
     * Set ind4xbx1
     *
     * @param boolean $ind4xbx1
     * @return Persona
     */
    public function setInd4xbx1($ind4xbx1)
    {
        $this->ind4xbx1 = $ind4xbx1;

        return $this;
    }

    /**
     * Get ind4xbx1
     *
     * @return boolean 
     */
    public function getInd4xbx1()
    {
        return $this->ind4xbx1;
    }

    /**
     * Set ind4xbx2
     *
     * @param boolean $ind4xbx2
     * @return Persona
     */
    public function setInd4xbx2($ind4xbx2)
    {
        $this->ind4xbx2 = $ind4xbx2;

        return $this;
    }

    /**
     * Get ind4xbx2
     *
     * @return boolean 
     */
    public function getInd4xbx2()
    {
        return $this->ind4xbx2;
    }

    /**
     * Set ind4xcx1
     *
     * @param boolean $ind4xcx1
     * @return Persona
     */
    public function setInd4xcx1($ind4xcx1)
    {
        $this->ind4xcx1 = $ind4xcx1;

        return $this;
    }

    /**
     * Get ind4xcx1
     *
     * @return boolean 
     */
    public function getInd4xcx1()
    {
        return $this->ind4xcx1;
    }

    /**
     * Set ind4xcx2
     *
     * @param boolean $ind4xcx2
     * @return Persona
     */
    public function setInd4xcx2($ind4xcx2)
    {
        $this->ind4xcx2 = $ind4xcx2;

        return $this;
    }

    /**
     * Get ind4xcx2
     *
     * @return boolean 
     */
    public function getInd4xcx2()
    {
        return $this->ind4xcx2;
    }

    /**
     * Set ind4xcx3
     *
     * @param boolean $ind4xcx3
     * @return Persona
     */
    public function setInd4xcx3($ind4xcx3)
    {
        $this->ind4xcx3 = $ind4xcx3;

        return $this;
    }

    /**
     * Get ind4xcx3
     *
     * @return boolean 
     */
    public function getInd4xcx3()
    {
        return $this->ind4xcx3;
    }

    /**
     * Set ind4xcx4
     *
     * @param boolean $ind4xcx4
     * @return Persona
     */
    public function setInd4xcx4($ind4xcx4)
    {
        $this->ind4xcx4 = $ind4xcx4;

        return $this;
    }

    /**
     * Get ind4xcx4
     *
     * @return boolean 
     */
    public function getInd4xcx4()
    {
        return $this->ind4xcx4;
    }

    /**
     * Set ind5x1
     *
     * @param boolean $ind5x1
     * @return Persona
     */
    public function setInd5x1($ind5x1)
    {
        $this->ind5x1 = $ind5x1;

        return $this;
    }

    /**
     * Get ind5x1
     *
     * @return boolean 
     */
    public function getInd5x1()
    {
        return $this->ind5x1;
    }

    /**
     * Set ind5x2
     *
     * @param boolean $ind5x2
     * @return Persona
     */
    public function setInd5x2($ind5x2)
    {
        $this->ind5x2 = $ind5x2;

        return $this;
    }

    /**
     * Get ind5x2
     *
     * @return boolean 
     */
    public function getInd5x2()
    {
        return $this->ind5x2;
    }

    /**
     * Set ind5x3
     *
     * @param boolean $ind5x3
     * @return Persona
     */
    public function setInd5x3($ind5x3)
    {
        $this->ind5x3 = $ind5x3;

        return $this;
    }

    /**
     * Get ind5x3
     *
     * @return boolean 
     */
    public function getInd5x3()
    {
        return $this->ind5x3;
    }

    /**
     * Set ind5x4
     *
     * @param boolean $ind5x4
     * @return Persona
     */
    public function setInd5x4($ind5x4)
    {
        $this->ind5x4 = $ind5x4;

        return $this;
    }

    /**
     * Get ind5x4
     *
     * @return boolean 
     */
    public function getInd5x4()
    {
        return $this->ind5x4;
    }

    /**
     * Set ind5x5
     *
     * @param boolean $ind5x5
     * @return Persona
     */
    public function setInd5x5($ind5x5)
    {
        $this->ind5x5 = $ind5x5;

        return $this;
    }

    /**
     * Get ind5x5
     *
     * @return boolean 
     */
    public function getInd5x5()
    {
        return $this->ind5x5;
    }

    /**
     * Set ind6x1
     *
     * @param boolean $ind6x1
     * @return Persona
     */
    public function setInd6x1($ind6x1)
    {
        $this->ind6x1 = $ind6x1;

        return $this;
    }

    /**
     * Get ind6x1
     *
     * @return boolean 
     */
    public function getInd6x1()
    {
        return $this->ind6x1;
    }

    /**
     * Set ind6x1x1
     *
     * @param boolean $ind6x1x1
     * @return Persona
     */
    public function setInd6x1x1($ind6x1x1)
    {
        $this->ind6x1x1 = $ind6x1x1;

        return $this;
    }

    /**
     * Get ind6x1x1
     *
     * @return boolean 
     */
    public function getInd6x1x1()
    {
        return $this->ind6x1x1;
    }

    /**
     * Set ind6x1x2
     *
     * @param boolean $ind6x1x2
     * @return Persona
     */
    public function setInd6x1x2($ind6x1x2)
    {
        $this->ind6x1x2 = $ind6x1x2;

        return $this;
    }

    /**
     * Get ind6x1x2
     *
     * @return boolean 
     */
    public function getInd6x1x2()
    {
        return $this->ind6x1x2;
    }

    /**
     * Set ind6x1x3
     *
     * @param boolean $ind6x1x3
     * @return Persona
     */
    public function setInd6x1x3($ind6x1x3)
    {
        $this->ind6x1x3 = $ind6x1x3;

        return $this;
    }

    /**
     * Get ind6x1x3
     *
     * @return boolean 
     */
    public function getInd6x1x3()
    {
        return $this->ind6x1x3;
    }

    /**
     * Set ind6x2
     *
     * @param boolean $ind6x2
     * @return Persona
     */
    public function setInd6x2($ind6x2)
    {
        $this->ind6x2 = $ind6x2;

        return $this;
    }

    /**
     * Get ind6x2
     *
     * @return boolean 
     */
    public function getInd6x2()
    {
        return $this->ind6x2;
    }

    /**
     * Set ind6x3
     *
     * @param boolean $ind6x3
     * @return Persona
     */
    public function setInd6x3($ind6x3)
    {
        $this->ind6x3 = $ind6x3;

        return $this;
    }

    /**
     * Get ind6x3
     *
     * @return boolean 
     */
    public function getInd6x3()
    {
        return $this->ind6x3;
    }

    /**
     * Set ind6x4
     *
     * @param boolean $ind6x4
     * @return Persona
     */
    public function setInd6x4($ind6x4)
    {
        $this->ind6x4 = $ind6x4;

        return $this;
    }

    /**
     * Get ind6x4
     *
     * @return boolean 
     */
    public function getInd6x4()
    {
        return $this->ind6x4;
    }

    /**
     * Set ind7xax1
     *
     * @param boolean $ind7xax1
     * @return Persona
     */
    public function setInd7xax1($ind7xax1)
    {
        $this->ind7xax1 = $ind7xax1;

        return $this;
    }

    /**
     * Get ind7xax1
     *
     * @return boolean 
     */
    public function getInd7xax1()
    {
        return $this->ind7xax1;
    }

    /**
     * Set ind7xax2
     *
     * @param boolean $ind7xax2
     * @return Persona
     */
    public function setInd7xax2($ind7xax2)
    {
        $this->ind7xax2 = $ind7xax2;

        return $this;
    }

    /**
     * Get ind7xax2
     *
     * @return boolean 
     */
    public function getInd7xax2()
    {
        return $this->ind7xax2;
    }

    /**
     * Set ind7xax3
     *
     * @param boolean $ind7xax3
     * @return Persona
     */
    public function setInd7xax3($ind7xax3)
    {
        $this->ind7xax3 = $ind7xax3;

        return $this;
    }

    /**
     * Get ind7xax3
     *
     * @return boolean 
     */
    public function getInd7xax3()
    {
        return $this->ind7xax3;
    }

    /**
     * Set ind7xax4
     *
     * @param boolean $ind7xax4
     * @return Persona
     */
    public function setInd7xax4($ind7xax4)
    {
        $this->ind7xax4 = $ind7xax4;

        return $this;
    }

    /**
     * Get ind7xax4
     *
     * @return boolean 
     */
    public function getInd7xax4()
    {
        return $this->ind7xax4;
    }

    /**
     * Set ind7xax5
     *
     * @param boolean $ind7xax5
     * @return Persona
     */
    public function setInd7xax5($ind7xax5)
    {
        $this->ind7xax5 = $ind7xax5;

        return $this;
    }

    /**
     * Get ind7xax5
     *
     * @return boolean 
     */
    public function getInd7xax5()
    {
        return $this->ind7xax5;
    }

    /**
     * Set ind7xax6
     *
     * @param boolean $ind7xax6
     * @return Persona
     */
    public function setInd7xax6($ind7xax6)
    {
        $this->ind7xax6 = $ind7xax6;

        return $this;
    }

    /**
     * Get ind7xax6
     *
     * @return boolean 
     */
    public function getInd7xax6()
    {
        return $this->ind7xax6;
    }

    /**
     * Set ind7xax7
     *
     * @param boolean $ind7xax7
     * @return Persona
     */
    public function setInd7xax7($ind7xax7)
    {
        $this->ind7xax7 = $ind7xax7;

        return $this;
    }

    /**
     * Get ind7xax7
     *
     * @return boolean 
     */
    public function getInd7xax7()
    {
        return $this->ind7xax7;
    }

    /**
     * Set ind7xbx1
     *
     * @param boolean $ind7xbx1
     * @return Persona
     */
    public function setInd7xbx1($ind7xbx1)
    {
        $this->ind7xbx1 = $ind7xbx1;

        return $this;
    }

    /**
     * Get ind7xbx1
     *
     * @return boolean 
     */
    public function getInd7xbx1()
    {
        return $this->ind7xbx1;
    }

    /**
     * Set ind7xbx2
     *
     * @param boolean $ind7xbx2
     * @return Persona
     */
    public function setInd7xbx2($ind7xbx2)
    {
        $this->ind7xbx2 = $ind7xbx2;

        return $this;
    }

    /**
     * Get ind7xbx2
     *
     * @return boolean 
     */
    public function getInd7xbx2()
    {
        return $this->ind7xbx2;
    }

    /**
     * Set ind7xbx3
     *
     * @param boolean $ind7xbx3
     * @return Persona
     */
    public function setInd7xbx3($ind7xbx3)
    {
        $this->ind7xbx3 = $ind7xbx3;

        return $this;
    }

    /**
     * Get ind7xbx3
     *
     * @return boolean 
     */
    public function getInd7xbx3()
    {
        return $this->ind7xbx3;
    }

    /**
     * Set ind7xbx4
     *
     * @param boolean $ind7xbx4
     * @return Persona
     */
    public function setInd7xbx4($ind7xbx4)
    {
        $this->ind7xbx4 = $ind7xbx4;

        return $this;
    }

    /**
     * Get ind7xbx4
     *
     * @return boolean 
     */
    public function getInd7xbx4()
    {
        return $this->ind7xbx4;
    }

    /**
     * Set ind7xbx5
     *
     * @param boolean $ind7xbx5
     * @return Persona
     */
    public function setInd7xbx5($ind7xbx5)
    {
        $this->ind7xbx5 = $ind7xbx5;

        return $this;
    }

    /**
     * Get ind7xbx5
     *
     * @return boolean 
     */
    public function getInd7xbx5()
    {
        return $this->ind7xbx5;
    }

    /**
     * Set ind8x1
     *
     * @param boolean $ind8x1
     * @return Persona
     */
    public function setInd8x1($ind8x1)
    {
        $this->ind8x1 = $ind8x1;

        return $this;
    }

    /**
     * Get ind8x1
     *
     * @return boolean 
     */
    public function getInd8x1()
    {
        return $this->ind8x1;
    }

    /**
     * Set ind8x2
     *
     * @param boolean $ind8x2
     * @return Persona
     */
    public function setInd8x2($ind8x2)
    {
        $this->ind8x2 = $ind8x2;

        return $this;
    }

    /**
     * Get ind8x2
     *
     * @return boolean 
     */
    public function getInd8x2()
    {
        return $this->ind8x2;
    }

    /**
     * Set ind8x3
     *
     * @param boolean $ind8x3
     * @return Persona
     */
    public function setInd8x3($ind8x3)
    {
        $this->ind8x3 = $ind8x3;

        return $this;
    }

    /**
     * Get ind8x3
     *
     * @return boolean 
     */
    public function getInd8x3()
    {
        return $this->ind8x3;
    }

    /**
     * Set ind8x4
     *
     * @param boolean $ind8x4
     * @return Persona
     */
    public function setInd8x4($ind8x4)
    {
        $this->ind8x4 = $ind8x4;

        return $this;
    }

    /**
     * Get ind8x4
     *
     * @return boolean 
     */
    public function getInd8x4()
    {
        return $this->ind8x4;
    }

    /**
     * Set indtx5
     *
     * @param boolean $indtx5
     * @return Persona
     */
    public function setIndtx5($indtx5)
    {
        $this->indtx5 = $indtx5;

        return $this;
    }

    /**
     * Get indtx5
     *
     * @return boolean 
     */
    public function getIndtx5()
    {
        return $this->indtx5;
    }

    /**
     * Set indtx6
     *
     * @param boolean $indtx6
     * @return Persona
     */
    public function setIndtx6($indtx6)
    {
        $this->indtx6 = $indtx6;

        return $this;
    }

    /**
     * Get indtx6
     *
     * @return boolean 
     */
    public function getIndtx6()
    {
        return $this->indtx6;
    }

    /**
     * Set indtx7
     *
     * @param boolean $indtx7
     * @return Persona
     */
    public function setIndtx7($indtx7)
    {
        $this->indtx7 = $indtx7;

        return $this;
    }

    /**
     * Get indtx7
     *
     * @return boolean 
     */
    public function getIndtx7()
    {
        return $this->indtx7;
    }

    /**
     * Set indtx8
     *
     * @param boolean $indtx8
     * @return Persona
     */
    public function setIndtx8($indtx8)
    {
        $this->indtx8 = $indtx8;

        return $this;
    }

    /**
     * Get indtx8
     *
     * @return boolean 
     */
    public function getIndtx8()
    {
        return $this->indtx8;
    }

    /**
     * Set indtx9
     *
     * @param boolean $indtx9
     * @return Persona
     */
    public function setIndtx9($indtx9)
    {
        $this->indtx9 = $indtx9;

        return $this;
    }

    /**
     * Get indtx9
     *
     * @return boolean 
     */
    public function getIndtx9()
    {
        return $this->indtx9;
    }

    /**
     * Set indtx10
     *
     * @param boolean $indtx10
     * @return Persona
     */
    public function setIndtx10($indtx10)
    {
        $this->indtx10 = $indtx10;

        return $this;
    }

    /**
     * Get indtx10
     *
     * @return boolean 
     */
    public function getIndtx10()
    {
        return $this->indtx10;
    }

    /**
     * Set indtx11
     *
     * @param boolean $indtx11
     * @return Persona
     */
    public function setIndtx11($indtx11)
    {
        $this->indtx11 = $indtx11;

        return $this;
    }

    /**
     * Get indtx11
     *
     * @return boolean 
     */
    public function getIndtx11()
    {
        return $this->indtx11;
    }

    /**
     * Set indtx12
     *
     * @param boolean $indtx12
     * @return Persona
     */
    public function setIndtx12($indtx12)
    {
        $this->indtx12 = $indtx12;

        return $this;
    }

    /**
     * Get indtx12
     *
     * @return boolean 
     */
    public function getIndtx12()
    {
        return $this->indtx12;
    }

    /**
     * Set indtx13
     *
     * @param boolean $indtx13
     * @return Persona
     */
    public function setIndtx13($indtx13)
    {
        $this->indtx13 = $indtx13;

        return $this;
    }

    /**
     * Get indtx13
     *
     * @return boolean 
     */
    public function getIndtx13()
    {
        return $this->indtx13;
    }

    /**
     * Set indtx14
     *
     * @param boolean $indtx14
     * @return Persona
     */
    public function setIndtx14($indtx14)
    {
        $this->indtx14 = $indtx14;

        return $this;
    }

    /**
     * Get indtx14
     *
     * @return boolean 
     */
    public function getIndtx14()
    {
        return $this->indtx14;
    }

    /**
     * Set indtx15
     *
     * @param boolean $indtx15
     * @return Persona
     */
    public function setIndtx15($indtx15)
    {
        $this->indtx15 = $indtx15;

        return $this;
    }

    /**
     * Get indtx15
     *
     * @return boolean 
     */
    public function getIndtx15()
    {
        return $this->indtx15;
    }

    /**
     * Set indtx16
     *
     * @param boolean $indtx16
     * @return Persona
     */
    public function setIndtx16($indtx16)
    {
        $this->indtx16 = $indtx16;

        return $this;
    }

    /**
     * Get indtx16
     *
     * @return boolean 
     */
    public function getIndtx16()
    {
        return $this->indtx16;
    }

    /**
     * Set ind9xax1
     *
     * @param boolean $ind9xax1
     * @return Persona
     */
    public function setInd9xax1($ind9xax1)
    {
        $this->ind9xax1 = $ind9xax1;

        return $this;
    }

    /**
     * Get ind9xax1
     *
     * @return boolean 
     */
    public function getInd9xax1()
    {
        return $this->ind9xax1;
    }

    /**
     * Set ind9xax2
     *
     * @param boolean $ind9xax2
     * @return Persona
     */
    public function setInd9xax2($ind9xax2)
    {
        $this->ind9xax2 = $ind9xax2;

        return $this;
    }

    /**
     * Get ind9xax2
     *
     * @return boolean 
     */
    public function getInd9xax2()
    {
        return $this->ind9xax2;
    }

    /**
     * Set ind9xax3
     *
     * @param boolean $ind9xax3
     * @return Persona
     */
    public function setInd9xax3($ind9xax3)
    {
        $this->ind9xax3 = $ind9xax3;

        return $this;
    }

    /**
     * Get ind9xax3
     *
     * @return boolean 
     */
    public function getInd9xax3()
    {
        return $this->ind9xax3;
    }

    /**
     * Set ind9xax4
     *
     * @param boolean $ind9xax4
     * @return Persona
     */
    public function setInd9xax4($ind9xax4)
    {
        $this->ind9xax4 = $ind9xax4;

        return $this;
    }

    /**
     * Get ind9xax4
     *
     * @return boolean 
     */
    public function getInd9xax4()
    {
        return $this->ind9xax4;
    }

    /**
     * Set ind9xax5
     *
     * @param boolean $ind9xax5
     * @return Persona
     */
    public function setInd9xax5($ind9xax5)
    {
        $this->ind9xax5 = $ind9xax5;

        return $this;
    }

    /**
     * Get ind9xax5
     *
     * @return boolean 
     */
    public function getInd9xax5()
    {
        return $this->ind9xax5;
    }

    /**
     * Set ind9xbx1
     *
     * @param boolean $ind9xbx1
     * @return Persona
     */
    public function setInd9xbx1($ind9xbx1)
    {
        $this->ind9xbx1 = $ind9xbx1;

        return $this;
    }

    /**
     * Get ind9xbx1
     *
     * @return boolean 
     */
    public function getInd9xbx1()
    {
        return $this->ind9xbx1;
    }

    /**
     * Set ind9xbx2
     *
     * @param boolean $ind9xbx2
     * @return Persona
     */
    public function setInd9xbx2($ind9xbx2)
    {
        $this->ind9xbx2 = $ind9xbx2;

        return $this;
    }

    /**
     * Get ind9xbx2
     *
     * @return boolean 
     */
    public function getInd9xbx2()
    {
        return $this->ind9xbx2;
    }

    /**
     * Set ind9xbx3
     *
     * @param boolean $ind9xbx3
     * @return Persona
     */
    public function setInd9xbx3($ind9xbx3)
    {
        $this->ind9xbx3 = $ind9xbx3;

        return $this;
    }

    /**
     * Get ind9xbx3
     *
     * @return boolean 
     */
    public function getInd9xbx3()
    {
        return $this->ind9xbx3;
    }

    /**
     * Set ind9xbx4
     *
     * @param boolean $ind9xbx4
     * @return Persona
     */
    public function setInd9xbx4($ind9xbx4)
    {
        $this->ind9xbx4 = $ind9xbx4;

        return $this;
    }

    /**
     * Get ind9xbx4
     *
     * @return boolean 
     */
    public function getInd9xbx4()
    {
        return $this->ind9xbx4;
    }

    /**
     * Set ind9xbx5
     *
     * @param boolean $ind9xbx5
     * @return Persona
     */
    public function setInd9xbx5($ind9xbx5)
    {
        $this->ind9xbx5 = $ind9xbx5;

        return $this;
    }

    /**
     * Get ind9xbx5
     *
     * @return boolean 
     */
    public function getInd9xbx5()
    {
        return $this->ind9xbx5;
    }

    /**
     * Set ind9xcx1
     *
     * @param boolean $ind9xcx1
     * @return Persona
     */
    public function setInd9xcx1($ind9xcx1)
    {
        $this->ind9xcx1 = $ind9xcx1;

        return $this;
    }

    /**
     * Get ind9xcx1
     *
     * @return boolean 
     */
    public function getInd9xcx1()
    {
        return $this->ind9xcx1;
    }

    /**
     * Set ind9xcx2
     *
     * @param boolean $ind9xcx2
     * @return Persona
     */
    public function setInd9xcx2($ind9xcx2)
    {
        $this->ind9xcx2 = $ind9xcx2;

        return $this;
    }

    /**
     * Get ind9xcx2
     *
     * @return boolean 
     */
    public function getInd9xcx2()
    {
        return $this->ind9xcx2;
    }

    /**
     * Set ind9xcx3
     *
     * @param boolean $ind9xcx3
     * @return Persona
     */
    public function setInd9xcx3($ind9xcx3)
    {
        $this->ind9xcx3 = $ind9xcx3;

        return $this;
    }

    /**
     * Get ind9xcx3
     *
     * @return boolean 
     */
    public function getInd9xcx3()
    {
        return $this->ind9xcx3;
    }

    /**
     * Set ind9xcx4
     *
     * @param boolean $ind9xcx4
     * @return Persona
     */
    public function setInd9xcx4($ind9xcx4)
    {
        $this->ind9xcx4 = $ind9xcx4;

        return $this;
    }

    /**
     * Get ind9xcx4
     *
     * @return boolean 
     */
    public function getInd9xcx4()
    {
        return $this->ind9xcx4;
    }

    /**
     * Set ind9xcx5
     *
     * @param boolean $ind9xcx5
     * @return Persona
     */
    public function setInd9xcx5($ind9xcx5)
    {
        $this->ind9xcx5 = $ind9xcx5;

        return $this;
    }

    /**
     * Get ind9xcx5
     *
     * @return boolean 
     */
    public function getInd9xcx5()
    {
        return $this->ind9xcx5;
    }

    /**
     * Set ind9xcx6
     *
     * @param boolean $ind9xcx6
     * @return Persona
     */
    public function setInd9xcx6($ind9xcx6)
    {
        $this->ind9xcx6 = $ind9xcx6;

        return $this;
    }

    /**
     * Get ind9xcx6
     *
     * @return boolean 
     */
    public function getInd9xcx6()
    {
        return $this->ind9xcx6;
    }

    /**
     * Set ind9xdx1
     *
     * @param boolean $ind9xdx1
     * @return Persona
     */
    public function setInd9xdx1($ind9xdx1)
    {
        $this->ind9xdx1 = $ind9xdx1;

        return $this;
    }

    /**
     * Get ind9xdx1
     *
     * @return boolean 
     */
    public function getInd9xdx1()
    {
        return $this->ind9xdx1;
    }

    /**
     * Set ind9xdx2
     *
     * @param boolean $ind9xdx2
     * @return Persona
     */
    public function setInd9xdx2($ind9xdx2)
    {
        $this->ind9xdx2 = $ind9xdx2;

        return $this;
    }

    /**
     * Get ind9xdx2
     *
     * @return boolean 
     */
    public function getInd9xdx2()
    {
        return $this->ind9xdx2;
    }

    /**
     * Set ind9xdx3
     *
     * @param boolean $ind9xdx3
     * @return Persona
     */
    public function setInd9xdx3($ind9xdx3)
    {
        $this->ind9xdx3 = $ind9xdx3;

        return $this;
    }

    /**
     * Get ind9xdx3
     *
     * @return boolean 
     */
    public function getInd9xdx3()
    {
        return $this->ind9xdx3;
    }

    /**
     * Set ind9xdx4
     *
     * @param boolean $ind9xdx4
     * @return Persona
     */
    public function setInd9xdx4($ind9xdx4)
    {
        $this->ind9xdx4 = $ind9xdx4;

        return $this;
    }

    /**
     * Get ind9xdx4
     *
     * @return boolean 
     */
    public function getInd9xdx4()
    {
        return $this->ind9xdx4;
    }

    /**
     * Set ind9xdx5
     *
     * @param boolean $ind9xdx5
     * @return Persona
     */
    public function setInd9xdx5($ind9xdx5)
    {
        $this->ind9xdx5 = $ind9xdx5;

        return $this;
    }

    /**
     * Get ind9xdx5
     *
     * @return boolean 
     */
    public function getInd9xdx5()
    {
        return $this->ind9xdx5;
    }

    /**
     * Set ind9xdx6
     *
     * @param boolean $ind9xdx6
     * @return Persona
     */
    public function setInd9xdx6($ind9xdx6)
    {
        $this->ind9xdx6 = $ind9xdx6;

        return $this;
    }

    /**
     * Get ind9xdx6
     *
     * @return boolean 
     */
    public function getInd9xdx6()
    {
        return $this->ind9xdx6;
    }

    /**
     * Set ind9xdx7
     *
     * @param boolean $ind9xdx7
     * @return Persona
     */
    public function setInd9xdx7($ind9xdx7)
    {
        $this->ind9xdx7 = $ind9xdx7;

        return $this;
    }

    /**
     * Get ind9xdx7
     *
     * @return boolean 
     */
    public function getInd9xdx7()
    {
        return $this->ind9xdx7;
    }

    /**
     * Set ind9xdx8
     *
     * @param boolean $ind9xdx8
     * @return Persona
     */
    public function setInd9xdx8($ind9xdx8)
    {
        $this->ind9xdx8 = $ind9xdx8;

        return $this;
    }

    /**
     * Get ind9xdx8
     *
     * @return boolean 
     */
    public function getInd9xdx8()
    {
        return $this->ind9xdx8;
    }

    /**
     * Set ind10x1
     *
     * @param boolean $ind10x1
     * @return Persona
     */
    public function setInd10x1($ind10x1)
    {
        $this->ind10x1 = $ind10x1;

        return $this;
    }

    /**
     * Get ind10x1
     *
     * @return boolean 
     */
    public function getInd10x1()
    {
        return $this->ind10x1;
    }

    /**
     * Set ind10x2
     *
     * @param boolean $ind10x2
     * @return Persona
     */
    public function setInd10x2($ind10x2)
    {
        $this->ind10x2 = $ind10x2;

        return $this;
    }

    /**
     * Get ind10x2
     *
     * @return boolean 
     */
    public function getInd10x2()
    {
        return $this->ind10x2;
    }

    /**
     * Set ind10x2x1
     *
     * @param boolean $ind10x2x1
     * @return Persona
     */
    public function setInd10x2x1($ind10x2x1)
    {
        $this->ind10x2x1 = $ind10x2x1;

        return $this;
    }

    /**
     * Get ind10x2x1
     *
     * @return boolean 
     */
    public function getInd10x2x1()
    {
        return $this->ind10x2x1;
    }

    /**
     * Set ind10x2x1xa
     *
     * @param boolean $ind10x2x1xa
     * @return Persona
     */
    public function setInd10x2x1xa($ind10x2x1xa)
    {
        $this->ind10x2x1xa = $ind10x2x1xa;

        return $this;
    }

    /**
     * Get ind10x2x1xa
     *
     * @return boolean 
     */
    public function getInd10x2x1xa()
    {
        return $this->ind10x2x1xa;
    }

    /**
     * Set ind10x2x2
     *
     * @param boolean $ind10x2x2
     * @return Persona
     */
    public function setInd10x2x2($ind10x2x2)
    {
        $this->ind10x2x2 = $ind10x2x2;

        return $this;
    }

    /**
     * Get ind10x2x2
     *
     * @return boolean 
     */
    public function getInd10x2x2()
    {
        return $this->ind10x2x2;
    }

    /**
     * Set ind10x3
     *
     * @param boolean $ind10x3
     * @return Persona
     */
    public function setInd10x3($ind10x3)
    {
        $this->ind10x3 = $ind10x3;

        return $this;
    }

    /**
     * Get ind10x3
     *
     * @return boolean 
     */
    public function getInd10x3()
    {
        return $this->ind10x3;
    }

    /**
     * Set ind10x4
     *
     * @param boolean $ind10x4
     * @return Persona
     */
    public function setInd10x4($ind10x4)
    {
        $this->ind10x4 = $ind10x4;

        return $this;
    }

    /**
     * Get ind10x4
     *
     * @return boolean 
     */
    public function getInd10x4()
    {
        return $this->ind10x4;
    }

    /**
     * Set ind10x5
     *
     * @param boolean $ind10x5
     * @return Persona
     */
    public function setInd10x5($ind10x5)
    {
        $this->ind10x5 = $ind10x5;

        return $this;
    }

    /**
     * Get ind10x5
     *
     * @return boolean 
     */
    public function getInd10x5()
    {
        return $this->ind10x5;
    }

    /**
     * Set ind10x6
     *
     * @param boolean $ind10x6
     * @return Persona
     */
    public function setInd10x6($ind10x6)
    {
        $this->ind10x6 = $ind10x6;

        return $this;
    }

    /**
     * Get ind10x6
     *
     * @return boolean 
     */
    public function getInd10x6()
    {
        return $this->ind10x6;
    }

    /**
     * Set ind10x7
     *
     * @param boolean $ind10x7
     * @return Persona
     */
    public function setInd10x7($ind10x7)
    {
        $this->ind10x7 = $ind10x7;

        return $this;
    }

    /**
     * Get ind10x7
     *
     * @return boolean 
     */
    public function getInd10x7()
    {
        return $this->ind10x7;
    }

    /**
     * Set ind10x8
     *
     * @param boolean $ind10x8
     * @return Persona
     */
    public function setInd10x8($ind10x8)
    {
        $this->ind10x8 = $ind10x8;

        return $this;
    }

    /**
     * Get ind10x8
     *
     * @return boolean 
     */
    public function getInd10x8()
    {
        return $this->ind10x8;
    }

    /**
     * Set ind10xax1
     *
     * @param boolean $ind10xax1
     * @return Persona
     */
    public function setInd10xax1($ind10xax1)
    {
        $this->ind10xax1 = $ind10xax1;

        return $this;
    }

    /**
     * Get ind10xax1
     *
     * @return boolean 
     */
    public function getInd10xax1()
    {
        return $this->ind10xax1;
    }

    /**
     * Set ind10xax2
     *
     * @param boolean $ind10xax2
     * @return Persona
     */
    public function setInd10xax2($ind10xax2)
    {
        $this->ind10xax2 = $ind10xax2;

        return $this;
    }

    /**
     * Get ind10xax2
     *
     * @return boolean 
     */
    public function getInd10xax2()
    {
        return $this->ind10xax2;
    }

    /**
     * Set ind10xax3
     *
     * @param boolean $ind10xax3
     * @return Persona
     */
    public function setInd10xax3($ind10xax3)
    {
        $this->ind10xax3 = $ind10xax3;

        return $this;
    }

    /**
     * Get ind10xax3
     *
     * @return boolean 
     */
    public function getInd10xax3()
    {
        return $this->ind10xax3;
    }

    /**
     * Set ind10xax4
     *
     * @param boolean $ind10xax4
     * @return Persona
     */
    public function setInd10xax4($ind10xax4)
    {
        $this->ind10xax4 = $ind10xax4;

        return $this;
    }

    /**
     * Get ind10xax4
     *
     * @return boolean 
     */
    public function getInd10xax4()
    {
        return $this->ind10xax4;
    }

    /**
     * Set ind11x1
     *
     * @param boolean $ind11x1
     * @return Persona
     */
    public function setInd11x1($ind11x1)
    {
        $this->ind11x1 = $ind11x1;

        return $this;
    }

    /**
     * Get ind11x1
     *
     * @return boolean 
     */
    public function getInd11x1()
    {
        return $this->ind11x1;
    }

    /**
     * Set ind11x2
     *
     * @param boolean $ind11x2
     * @return Persona
     */
    public function setInd11x2($ind11x2)
    {
        $this->ind11x2 = $ind11x2;

        return $this;
    }

    /**
     * Get ind11x2
     *
     * @return boolean 
     */
    public function getInd11x2()
    {
        return $this->ind11x2;
    }

    /**
     * Set ind11x3
     *
     * @param boolean $ind11x3
     * @return Persona
     */
    public function setInd11x3($ind11x3)
    {
        $this->ind11x3 = $ind11x3;

        return $this;
    }

    /**
     * Get ind11x3
     *
     * @return boolean 
     */
    public function getInd11x3()
    {
        return $this->ind11x3;
    }

    /**
     * Set ind11x4
     *
     * @param boolean $ind11x4
     * @return Persona
     */
    public function setInd11x4($ind11x4)
    {
        $this->ind11x4 = $ind11x4;

        return $this;
    }

    /**
     * Get ind11x4
     *
     * @return boolean 
     */
    public function getInd11x4()
    {
        return $this->ind11x4;
    }

    /**
     * Set ind11x5
     *
     * @param boolean $ind11x5
     * @return Persona
     */
    public function setInd11x5($ind11x5)
    {
        $this->ind11x5 = $ind11x5;

        return $this;
    }

    /**
     * Get ind11x5
     *
     * @return boolean 
     */
    public function getInd11x5()
    {
        return $this->ind11x5;
    }

    /**
     * Set ind11x6
     *
     * @param boolean $ind11x6
     * @return Persona
     */
    public function setInd11x6($ind11x6)
    {
        $this->ind11x6 = $ind11x6;

        return $this;
    }

    /**
     * Get ind11x6
     *
     * @return boolean 
     */
    public function getInd11x6()
    {
        return $this->ind11x6;
    }

    /**
     * Set ind11x7
     *
     * @param boolean $ind11x7
     * @return Persona
     */
    public function setInd11x7($ind11x7)
    {
        $this->ind11x7 = $ind11x7;

        return $this;
    }

    /**
     * Get ind11x7
     *
     * @return boolean 
     */
    public function getInd11x7()
    {
        return $this->ind11x7;
    }

    /**
     * Set ind12x1
     *
     * @param boolean $ind12x1
     * @return Persona
     */
    public function setInd12x1($ind12x1)
    {
        $this->ind12x1 = $ind12x1;

        return $this;
    }

    /**
     * Get ind12x1
     *
     * @return boolean 
     */
    public function getInd12x1()
    {
        return $this->ind12x1;
    }

    /**
     * Set ind12x2
     *
     * @param boolean $ind12x2
     * @return Persona
     */
    public function setInd12x2($ind12x2)
    {
        $this->ind12x2 = $ind12x2;

        return $this;
    }

    /**
     * Get ind12x2
     *
     * @return boolean 
     */
    public function getInd12x2()
    {
        return $this->ind12x2;
    }

    /**
     * Set ind12x3
     *
     * @param boolean $ind12x3
     * @return Persona
     */
    public function setInd12x3($ind12x3)
    {
        $this->ind12x3 = $ind12x3;

        return $this;
    }

    /**
     * Get ind12x3
     *
     * @return boolean 
     */
    public function getInd12x3()
    {
        return $this->ind12x3;
    }

    /**
     * Set indtx17
     *
     * @param boolean $indtx17
     * @return Persona
     */
    public function setIndtx17($indtx17)
    {
        $this->indtx17 = $indtx17;

        return $this;
    }

    /**
     * Get indtx17
     *
     * @return boolean 
     */
    public function getIndtx17()
    {
        return $this->indtx17;
    }

    /**
     * Set indtx17xa
     *
     * @param boolean $indtx17xa
     * @return Persona
     */
    public function setIndtx17xa($indtx17xa)
    {
        $this->indtx17xa = $indtx17xa;

        return $this;
    }

    /**
     * Get indtx17xa
     *
     * @return boolean 
     */
    public function getIndtx17xa()
    {
        return $this->indtx17xa;
    }

    /**
     * Set indtx17xb
     *
     * @param boolean $indtx17xb
     * @return Persona
     */
    public function setIndtx17xb($indtx17xb)
    {
        $this->indtx17xb = $indtx17xb;

        return $this;
    }

    /**
     * Get indtx17xb
     *
     * @return boolean 
     */
    public function getIndtx17xb()
    {
        return $this->indtx17xb;
    }

    /**
     * Set indtx18
     *
     * @param boolean $indtx18
     * @return Persona
     */
    public function setIndtx18($indtx18)
    {
        $this->indtx18 = $indtx18;

        return $this;
    }

    /**
     * Get indtx18
     *
     * @return boolean 
     */
    public function getIndtx18()
    {
        return $this->indtx18;
    }

    /**
     * Set indtx19
     *
     * @param boolean $indtx19
     * @return Persona
     */
    public function setIndtx19($indtx19)
    {
        $this->indtx19 = $indtx19;

        return $this;
    }

    /**
     * Get indtx19
     *
     * @return boolean 
     */
    public function getIndtx19()
    {
        return $this->indtx19;
    }

    /**
     * Set ind13x1
     *
     * @param boolean $ind13x1
     * @return Persona
     */
    public function setInd13x1($ind13x1)
    {
        $this->ind13x1 = $ind13x1;

        return $this;
    }

    /**
     * Get ind13x1
     *
     * @return boolean 
     */
    public function getInd13x1()
    {
        return $this->ind13x1;
    }

    /**
     * Set ind13x2
     *
     * @param boolean $ind13x2
     * @return Persona
     */
    public function setInd13x2($ind13x2)
    {
        $this->ind13x2 = $ind13x2;

        return $this;
    }

    /**
     * Get ind13x2
     *
     * @return boolean 
     */
    public function getInd13x2()
    {
        return $this->ind13x2;
    }

    /**
     * Set ind13x3
     *
     * @param boolean $ind13x3
     * @return Persona
     */
    public function setInd13x3($ind13x3)
    {
        $this->ind13x3 = $ind13x3;

        return $this;
    }

    /**
     * Get ind13x3
     *
     * @return boolean 
     */
    public function getInd13x3()
    {
        return $this->ind13x3;
    }

    /**
     * Set ind13x3xa
     *
     * @param boolean $ind13x3xa
     * @return Persona
     */
    public function setInd13x3xa($ind13x3xa)
    {
        $this->ind13x3xa = $ind13x3xa;

        return $this;
    }

    /**
     * Get ind13x3xa
     *
     * @return boolean 
     */
    public function getInd13x3xa()
    {
        return $this->ind13x3xa;
    }

    /**
     * Set ind13xax1
     *
     * @param boolean $ind13xax1
     * @return Persona
     */
    public function setInd13xax1($ind13xax1)
    {
        $this->ind13xax1 = $ind13xax1;

        return $this;
    }

    /**
     * Get ind13xax1
     *
     * @return boolean 
     */
    public function getInd13xax1()
    {
        return $this->ind13xax1;
    }

    /**
     * Set ind13xax2
     *
     * @param boolean $ind13xax2
     * @return Persona
     */
    public function setInd13xax2($ind13xax2)
    {
        $this->ind13xax2 = $ind13xax2;

        return $this;
    }

    /**
     * Get ind13xax2
     *
     * @return boolean 
     */
    public function getInd13xax2()
    {
        return $this->ind13xax2;
    }

    /**
     * Set ind13xbx1
     *
     * @param boolean $ind13xbx1
     * @return Persona
     */
    public function setInd13xbx1($ind13xbx1)
    {
        $this->ind13xbx1 = $ind13xbx1;

        return $this;
    }

    /**
     * Get ind13xbx1
     *
     * @return boolean 
     */
    public function getInd13xbx1()
    {
        return $this->ind13xbx1;
    }

    /**
     * Set ind13xbx1xa
     *
     * @param boolean $ind13xbx1xa
     * @return Persona
     */
    public function setInd13xbx1xa($ind13xbx1xa)
    {
        $this->ind13xbx1xa = $ind13xbx1xa;

        return $this;
    }

    /**
     * Get ind13xbx1xa
     *
     * @return boolean 
     */
    public function getInd13xbx1xa()
    {
        return $this->ind13xbx1xa;
    }

    /**
     * Set ind13xbx2
     *
     * @param boolean $ind13xbx2
     * @return Persona
     */
    public function setInd13xbx2($ind13xbx2)
    {
        $this->ind13xbx2 = $ind13xbx2;

        return $this;
    }

    /**
     * Get ind13xbx2
     *
     * @return boolean 
     */
    public function getInd13xbx2()
    {
        return $this->ind13xbx2;
    }

    /**
     * Set ind13xbx3
     *
     * @param boolean $ind13xbx3
     * @return Persona
     */
    public function setInd13xbx3($ind13xbx3)
    {
        $this->ind13xbx3 = $ind13xbx3;

        return $this;
    }

    /**
     * Get ind13xbx3
     *
     * @return boolean 
     */
    public function getInd13xbx3()
    {
        return $this->ind13xbx3;
    }

    /**
     * Set ind13xcx1
     *
     * @param boolean $ind13xcx1
     * @return Persona
     */
    public function setInd13xcx1($ind13xcx1)
    {
        $this->ind13xcx1 = $ind13xcx1;

        return $this;
    }

    /**
     * Get ind13xcx1
     *
     * @return boolean 
     */
    public function getInd13xcx1()
    {
        return $this->ind13xcx1;
    }

    /**
     * Set ind13xcx2
     *
     * @param boolean $ind13xcx2
     * @return Persona
     */
    public function setInd13xcx2($ind13xcx2)
    {
        $this->ind13xcx2 = $ind13xcx2;

        return $this;
    }

    /**
     * Get ind13xcx2
     *
     * @return boolean 
     */
    public function getInd13xcx2()
    {
        return $this->ind13xcx2;
    }

    /**
     * Set ind13xcx3
     *
     * @param boolean $ind13xcx3
     * @return Persona
     */
    public function setInd13xcx3($ind13xcx3)
    {
        $this->ind13xcx3 = $ind13xcx3;

        return $this;
    }

    /**
     * Get ind13xcx3
     *
     * @return boolean 
     */
    public function getInd13xcx3()
    {
        return $this->ind13xcx3;
    }

    /**
     * Set ind14x1
     *
     * @param boolean $ind14x1
     * @return Persona
     */
    public function setInd14x1($ind14x1)
    {
        $this->ind14x1 = $ind14x1;

        return $this;
    }

    /**
     * Get ind14x1
     *
     * @return boolean 
     */
    public function getInd14x1()
    {
        return $this->ind14x1;
    }

    /**
     * Set ind14x2
     *
     * @param boolean $ind14x2
     * @return Persona
     */
    public function setInd14x2($ind14x2)
    {
        $this->ind14x2 = $ind14x2;

        return $this;
    }

    /**
     * Get ind14x2
     *
     * @return boolean 
     */
    public function getInd14x2()
    {
        return $this->ind14x2;
    }

    /**
     * Set ind14x3
     *
     * @param boolean $ind14x3
     * @return Persona
     */
    public function setInd14x3($ind14x3)
    {
        $this->ind14x3 = $ind14x3;

        return $this;
    }

    /**
     * Get ind14x3
     *
     * @return boolean 
     */
    public function getInd14x3()
    {
        return $this->ind14x3;
    }

    /**
     * Set ind14x4
     *
     * @param boolean $ind14x4
     * @return Persona
     */
    public function setInd14x4($ind14x4)
    {
        $this->ind14x4 = $ind14x4;

        return $this;
    }

    /**
     * Get ind14x4
     *
     * @return boolean 
     */
    public function getInd14x4()
    {
        return $this->ind14x4;
    }

    /**
     * Set indtx20
     *
     * @param boolean $indtx20
     * @return Persona
     */
    public function setIndtx20($indtx20)
    {
        $this->indtx20 = $indtx20;

        return $this;
    }

    /**
     * Get indtx20
     *
     * @return boolean 
     */
    public function getIndtx20()
    {
        return $this->indtx20;
    }

    /**
     * Set indtx21
     *
     * @param boolean $indtx21
     * @return Persona
     */
    public function setIndtx21($indtx21)
    {
        $this->indtx21 = $indtx21;

        return $this;
    }

    /**
     * Get indtx21
     *
     * @return boolean 
     */
    public function getIndtx21()
    {
        return $this->indtx21;
    }

    /**
     * Set indtx22
     *
     * @param boolean $indtx22
     * @return Persona
     */
    public function setIndtx22($indtx22)
    {
        $this->indtx22 = $indtx22;

        return $this;
    }

    /**
     * Get indtx22
     *
     * @return boolean 
     */
    public function getIndtx22()
    {
        return $this->indtx22;
    }

    /**
     * Set ind15x1
     *
     * @param boolean $ind15x1
     * @return Persona
     */
    public function setInd15x1($ind15x1)
    {
        $this->ind15x1 = $ind15x1;

        return $this;
    }

    /**
     * Get ind15x1
     *
     * @return boolean 
     */
    public function getInd15x1()
    {
        return $this->ind15x1;
    }

    /**
     * Set ind15x2
     *
     * @param boolean $ind15x2
     * @return Persona
     */
    public function setInd15x2($ind15x2)
    {
        $this->ind15x2 = $ind15x2;

        return $this;
    }

    /**
     * Get ind15x2
     *
     * @return boolean 
     */
    public function getInd15x2()
    {
        return $this->ind15x2;
    }

    /**
     * Set ind16x1
     *
     * @param boolean $ind16x1
     * @return Persona
     */
    public function setInd16x1($ind16x1)
    {
        $this->ind16x1 = $ind16x1;

        return $this;
    }

    /**
     * Get ind16x1
     *
     * @return boolean 
     */
    public function getInd16x1()
    {
        return $this->ind16x1;
    }

    /**
     * Set ind16x2
     *
     * @param boolean $ind16x2
     * @return Persona
     */
    public function setInd16x2($ind16x2)
    {
        $this->ind16x2 = $ind16x2;

        return $this;
    }

    /**
     * Get ind16x2
     *
     * @return boolean 
     */
    public function getInd16x2()
    {
        return $this->ind16x2;
    }

    /**
     * Set ind17x1
     *
     * @param boolean $ind17x1
     * @return Persona
     */
    public function setInd17x1($ind17x1)
    {
        $this->ind17x1 = $ind17x1;

        return $this;
    }

    /**
     * Get ind17x1
     *
     * @return boolean 
     */
    public function getInd17x1()
    {
        return $this->ind17x1;
    }

    /**
     * Set ind17x1xa
     *
     * @param boolean $ind17x1xa
     * @return Persona
     */
    public function setInd17x1xa($ind17x1xa)
    {
        $this->ind17x1xa = $ind17x1xa;

        return $this;
    }

    /**
     * Get ind17x1xa
     *
     * @return boolean 
     */
    public function getInd17x1xa()
    {
        return $this->ind17x1xa;
    }

    /**
     * Set ind17x2
     *
     * @param boolean $ind17x2
     * @return Persona
     */
    public function setInd17x2($ind17x2)
    {
        $this->ind17x2 = $ind17x2;

        return $this;
    }

    /**
     * Get ind17x2
     *
     * @return boolean 
     */
    public function getInd17x2()
    {
        return $this->ind17x2;
    }

    /**
     * Set ind17x2xa
     *
     * @param boolean $ind17x2xa
     * @return Persona
     */
    public function setInd17x2xa($ind17x2xa)
    {
        $this->ind17x2xa = $ind17x2xa;

        return $this;
    }

    /**
     * Get ind17x2xa
     *
     * @return boolean 
     */
    public function getInd17x2xa()
    {
        return $this->ind17x2xa;
    }

    /**
     * Set ind17x3
     *
     * @param boolean $ind17x3
     * @return Persona
     */
    public function setInd17x3($ind17x3)
    {
        $this->ind17x3 = $ind17x3;

        return $this;
    }

    /**
     * Get ind17x3
     *
     * @return boolean 
     */
    public function getInd17x3()
    {
        return $this->ind17x3;
    }

    /**
     * Set ind17x3xa
     *
     * @param boolean $ind17x3xa
     * @return Persona
     */
    public function setInd17x3xa($ind17x3xa)
    {
        $this->ind17x3xa = $ind17x3xa;

        return $this;
    }

    /**
     * Get ind17x3xa
     *
     * @return boolean 
     */
    public function getInd17x3xa()
    {
        return $this->ind17x3xa;
    }

    /**
     * Set ind17x4
     *
     * @param boolean $ind17x4
     * @return Persona
     */
    public function setInd17x4($ind17x4)
    {
        $this->ind17x4 = $ind17x4;

        return $this;
    }

    /**
     * Get ind17x4
     *
     * @return boolean 
     */
    public function getInd17x4()
    {
        return $this->ind17x4;
    }

    /**
     * Set ind17x5
     *
     * @param boolean $ind17x5
     * @return Persona
     */
    public function setInd17x5($ind17x5)
    {
        $this->ind17x5 = $ind17x5;

        return $this;
    }

    /**
     * Get ind17x5
     *
     * @return boolean 
     */
    public function getInd17x5()
    {
        return $this->ind17x5;
    }

    /**
     * Set ind17x5xa
     *
     * @param boolean $ind17x5xa
     * @return Persona
     */
    public function setInd17x5xa($ind17x5xa)
    {
        $this->ind17x5xa = $ind17x5xa;

        return $this;
    }

    /**
     * Get ind17x5xa
     *
     * @return boolean 
     */
    public function getInd17x5xa()
    {
        return $this->ind17x5xa;
    }

    /**
     * Set ind17x6
     *
     * @param boolean $ind17x6
     * @return Persona
     */
    public function setInd17x6($ind17x6)
    {
        $this->ind17x6 = $ind17x6;

        return $this;
    }

    /**
     * Get ind17x6
     *
     * @return boolean 
     */
    public function getInd17x6()
    {
        return $this->ind17x6;
    }

    /**
     * Set ind17x7
     *
     * @param boolean $ind17x7
     * @return Persona
     */
    public function setInd17x7($ind17x7)
    {
        $this->ind17x7 = $ind17x7;

        return $this;
    }

    /**
     * Get ind17x7
     *
     * @return boolean 
     */
    public function getInd17x7()
    {
        return $this->ind17x7;
    }

    /**
     * Get idPers
     *
     * @return integer 
     */
    public function getIdPers()
    {
        return $this->idPers;
    }
}
