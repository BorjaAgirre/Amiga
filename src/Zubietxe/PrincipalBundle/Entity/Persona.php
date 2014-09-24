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
     * @ORM\Column(name="lugar_nac", type="string", length=30, nullable=true)
     */
    private $lugarNac;

    /**
     * @var string
     *
     * @ORM\Column(name="dni_pas", type="string", length=15, nullable=true)
     */
    private $dniPas;

    /**
     * @var string
     *
     * @ORM\Column(name="num_ss", type="string", length=20, nullable=true)
     */
    private $numSs;

    /**
     * @var string
     *
     * @ORM\Column(name="num_expediente", type="string", length=10, nullable=true)
     */
    private $numExpediente;

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
     * @ORM\Column(name="direccion", type="string", length=40, nullable=true)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="poblacion", type="integer", nullable=true)
     */
    private $poblacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="nucleo_conv", type="integer", nullable=true)
     */
    private $nucleoConv;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_civil", type="integer", nullable=true)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="hijos", type="string", length=4, nullable=true)
     */
    private $hijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_hijos", type="integer", nullable=true)
     */
    private $nHijos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_hijos", type="string", length=255, nullable=true)
     */
    private $observacionesHijos;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonos_interes", type="string", length=512, nullable=true)
     */
    private $telefonosInteres;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="date", nullable=true)
     */
    private $fechaSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia_demanda", type="string", length=120, nullable=true)
     */
    private $procedenciaDemanda;

    /**
     * @var integer
     *
     * @ORM\Column(name="tutor", type="integer", nullable=true)
     */
    private $tutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_lu", type="integer", nullable=true)
     */
    private $comeLu;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_ma", type="integer", nullable=true)
     */
    private $comeMa;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_mi", type="integer", nullable=true)
     */
    private $comeMi;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_ju", type="integer", nullable=true)
     */
    private $comeJu;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_vi", type="integer", nullable=true)
     */
    private $comeVi;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_sa", type="integer", nullable=true)
     */
    private $comeSa;

    /**
     * @var integer
     *
     * @ORM\Column(name="come_do", type="integer", nullable=true)
     */
    private $comeDo;

    /**
     * @var string
     *
     * @ORM\Column(name="come_sa_notas", type="string", length=30, nullable=true)
     */
    private $comeSaNotas;

    /**
     * @var string
     *
     * @ORM\Column(name="come_do_notas", type="string", length=30, nullable=true)
     */
    private $comeDoNotas;

    /**
     * @var integer
     *
     * @ORM\Column(name="creditrans", type="integer", nullable=true)
     */
    private $creditrans;

    /**
     * @var string
     *
     * @ORM\Column(name="lista_espera_piso", type="string", length=20, nullable=true)
     */
    private $listaEsperaPiso;

    /**
     * @var string
     *
     * @ORM\Column(name="DatosFormativosObs", type="string", length=100, nullable=true)
     */
    private $datosformativosobs;

    /**
     * @var string
     *
     * @ORM\Column(name="DatosFormativosItem", type="string", length=30, nullable=true)
     */
    private $datosformativositem;

    /**
     * @var string
     *
     * @ORM\Column(name="Idioma", type="string", length=50, nullable=true)
     */
    private $idioma;

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
     * @ORM\Column(name="npasap", type="string", length=20, nullable=true)
     */
    private $npasap;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fpasap", type="date", nullable=true)
     */
    private $fpasap;

    /**
     * @var string
     *
     * @ORM\Column(name="ncedula", type="string", length=20, nullable=true)
     */
    private $ncedula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fcedula", type="date", nullable=true)
     */
    private $fcedula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fressol", type="date", nullable=true)
     */
    private $fressol;

    /**
     * @var string
     *
     * @ORM\Column(name="nresconc", type="string", length=20, nullable=true)
     */
    private $nresconc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fresconc", type="date", nullable=true)
     */
    private $fresconc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="frestrsol", type="date", nullable=true)
     */
    private $frestrsol;

    /**
     * @var string
     *
     * @ORM\Column(name="nrestrconc", type="string", length=20, nullable=true)
     */
    private $nrestrconc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="frestrconc", type="date", nullable=true)
     */
    private $frestrconc;

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
     * @ORM\Column(name="otrosdoc", type="string", length=40, nullable=true)
     */
    private $otrosdoc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fentrada", type="date", nullable=true)
     */
    private $fentrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fprueba", type="date", nullable=true)
     */
    private $fprueba;

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
     * @var \DateTime
     *
     * @ORM\Column(name="PermisoSolicitudFecha", type="date", nullable=true)
     */
    private $permisosolicitudfecha;

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
     * @ORM\Column(name="Empadronamiento", type="string", length=50, nullable=true)
     */
    private $empadronamiento;

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
     * @ORM\Column(name="IngresosRentaBas", type="integer", nullable=true)
     */
    private $ingresosrentabas;

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
     * @ORM\Column(name="tl_sabado", type="integer", nullable=true)
     */
    private $tlSabado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tl_domingo", type="integer", nullable=true)
     */
    private $tlDomingo;

    /**
     * @var integer
     *
     * @ORM\Column(name="salida_verano", type="integer", nullable=true)
     */
    private $salidaVerano;

    /**
     * @var integer
     *
     * @ORM\Column(name="salida_otro", type="integer", nullable=true)
     */
    private $salidaOtro;

    /**
     * @var integer
     *
     * @ORM\Column(name="medicacion_centro", type="integer", nullable=true)
     */
    private $medicacionCentro;

    /**
     * @var integer
     *
     * @ORM\Column(name="NivelCastellano", type="integer", nullable=true)
     */
    private $nivelcastellano;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp_laboral", type="integer", nullable=true)
     */
    private $expLaboral;

    /**
     * @var integer
     *
     * @ORM\Column(name="lanbide", type="integer", nullable=true)
     */
    private $lanbide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="F_alta_lanbide", type="date", nullable=true)
     */
    private $fAltaLanbide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="F_renov_lanbide", type="date", nullable=true)
     */
    private $fRenovLanbide;

    /**
     * @var integer
     *
     * @ORM\Column(name="inem", type="integer", nullable=true)
     */
    private $inem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="F_alta_inem", type="date", nullable=true)
     */
    private $fAltaInem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="F_renov_inem", type="date", nullable=true)
     */
    private $fRenovInem;

    /**
     * @var string
     *
     * @ORM\Column(name="cursos", type="string", length=100, nullable=true)
     */
    private $cursos;

    /**
     * @var integer
     *
     * @ORM\Column(name="poblacion_padron", type="integer", nullable=true)
     */
    private $poblacionPadron;

    /**
     * @var integer
     *
     * @ORM\Column(name="ConsumoPrinc", type="integer", nullable=true)
     */
    private $consumoprinc;

    /**
     * @var integer
     *
     * @ORM\Column(name="insert_id_usuario", type="integer", nullable=true)
     */
    private $insertIdUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_fecha", type="date", nullable=true)
     */
    private $insertFecha;

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
     * @ORM\Column(name="procedencia_demanda_lista", type="integer", nullable=true)
     */
    private $procedenciaDemandaLista;

    /**
     * @var integer
     *
     * @ORM\Column(name="DocumentoIdentif", type="integer", nullable=true)
     */
    private $documentoidentif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_caduc_tis", type="date", nullable=true)
     */
    private $fechaCaducTis;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_expulsion", type="integer", nullable=true)
     */
    private $ordenExpulsion;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresospropios", type="string", length=15, nullable=true)
     */
    private $cantidadIngresospropios;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresospnc", type="string", length=15, nullable=true)
     */
    private $cantidadIngresospnc;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresosotros", type="string", length=15, nullable=true)
     */
    private $cantidadIngresosotros;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresosnomina", type="string", length=15, nullable=true)
     */
    private $cantidadIngresosnomina;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresosrentabas", type="string", length=15, nullable=true)
     */
    private $cantidadIngresosrentabas;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresosprestcontrib", type="string", length=15, nullable=true)
     */
    private $cantidadIngresosprestcontrib;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingrsossedesconoce", type="string", length=15, nullable=true)
     */
    private $cantidadIngrsossedesconoce;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_ingresosayudaindividual", type="string", length=15, nullable=true)
     */
    private $cantidadIngresosayudaindividual;

    /**
     * @var integer
     *
     * @ORM\Column(name="autonomia_economia", type="integer", nullable=true)
     */
    private $autonomiaEconomia;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_economia", type="string", length=255, nullable=true)
     */
    private $observacionesEconomia;

    /**
     * @var string
     *
     * @ORM\Column(name="curso_actual", type="string", length=255, nullable=true)
     */
    private $cursoActual;

    /**
     * @var integer
     *
     * @ORM\Column(name="JusticiaGratuita", type="integer", nullable=true)
     */
    private $justiciagratuita;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_1", type="smallint", nullable=true)
     */
    private $indicador11;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_1_a", type="smallint", nullable=true)
     */
    private $indicador11A;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_2", type="smallint", nullable=true)
     */
    private $indicador12;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_2_a", type="smallint", nullable=true)
     */
    private $indicador12A;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_3", type="smallint", nullable=true)
     */
    private $indicador13;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_4", type="smallint", nullable=true)
     */
    private $indicador14;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_1_5", type="smallint", nullable=true)
     */
    private $indicador15;

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
     * Set lugarNac
     *
     * @param string $lugarNac
     * @return Persona
     */
    public function setLugarNac($lugarNac)
    {
        $this->lugarNac = $lugarNac;

        return $this;
    }

    /**
     * Get lugarNac
     *
     * @return string 
     */
    public function getLugarNac()
    {
        return $this->lugarNac;
    }

    /**
     * Set dniPas
     *
     * @param string $dniPas
     * @return Persona
     */
    public function setDniPas($dniPas)
    {
        $this->dniPas = $dniPas;

        return $this;
    }

    /**
     * Get dniPas
     *
     * @return string 
     */
    public function getDniPas()
    {
        return $this->dniPas;
    }

    /**
     * Set numSs
     *
     * @param string $numSs
     * @return Persona
     */
    public function setNumSs($numSs)
    {
        $this->numSs = $numSs;

        return $this;
    }

    /**
     * Get numSs
     *
     * @return string 
     */
    public function getNumSs()
    {
        return $this->numSs;
    }

    /**
     * Set numExpediente
     *
     * @param string $numExpediente
     * @return Persona
     */
    public function setNumExpediente($numExpediente)
    {
        $this->numExpediente = $numExpediente;

        return $this;
    }

    /**
     * Get numExpediente
     *
     * @return string 
     */
    public function getNumExpediente()
    {
        return $this->numExpediente;
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
     * Set direccion
     *
     * @param string $direccion
     * @return Persona
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
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
     * Set nucleoConv
     *
     * @param integer $nucleoConv
     * @return Persona
     */
    public function setNucleoConv($nucleoConv)
    {
        $this->nucleoConv = $nucleoConv;

        return $this;
    }

    /**
     * Get nucleoConv
     *
     * @return integer 
     */
    public function getNucleoConv()
    {
        return $this->nucleoConv;
    }

    /**
     * Set estadoCivil
     *
     * @param integer $estadoCivil
     * @return Persona
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return integer 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
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
     * Set nHijos
     *
     * @param integer $nHijos
     * @return Persona
     */
    public function setNHijos($nHijos)
    {
        $this->nHijos = $nHijos;

        return $this;
    }

    /**
     * Get nHijos
     *
     * @return integer 
     */
    public function getNHijos()
    {
        return $this->nHijos;
    }

    /**
     * Set observacionesHijos
     *
     * @param string $observacionesHijos
     * @return Persona
     */
    public function setObservacionesHijos($observacionesHijos)
    {
        $this->observacionesHijos = $observacionesHijos;

        return $this;
    }

    /**
     * Get observacionesHijos
     *
     * @return string 
     */
    public function getObservacionesHijos()
    {
        return $this->observacionesHijos;
    }

    /**
     * Set telefonosInteres
     *
     * @param string $telefonosInteres
     * @return Persona
     */
    public function setTelefonosInteres($telefonosInteres)
    {
        $this->telefonosInteres = $telefonosInteres;

        return $this;
    }

    /**
     * Get telefonosInteres
     *
     * @return string 
     */
    public function getTelefonosInteres()
    {
        return $this->telefonosInteres;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return Persona
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     * @return Persona
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime 
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set procedenciaDemanda
     *
     * @param string $procedenciaDemanda
     * @return Persona
     */
    public function setProcedenciaDemanda($procedenciaDemanda)
    {
        $this->procedenciaDemanda = $procedenciaDemanda;

        return $this;
    }

    /**
     * Get procedenciaDemanda
     *
     * @return string 
     */
    public function getProcedenciaDemanda()
    {
        return $this->procedenciaDemanda;
    }

    /**
     * Set tutor
     *
     * @param integer $tutor
     * @return Persona
     */
    public function setTutor($tutor)
    {
        $this->tutor = $tutor;

        return $this;
    }

    /**
     * Get tutor
     *
     * @return integer 
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * Set comeLu
     *
     * @param integer $comeLu
     * @return Persona
     */
    public function setComeLu($comeLu)
    {
        $this->comeLu = $comeLu;

        return $this;
    }

    /**
     * Get comeLu
     *
     * @return integer 
     */
    public function getComeLu()
    {
        return $this->comeLu;
    }

    /**
     * Set comeMa
     *
     * @param integer $comeMa
     * @return Persona
     */
    public function setComeMa($comeMa)
    {
        $this->comeMa = $comeMa;

        return $this;
    }

    /**
     * Get comeMa
     *
     * @return integer 
     */
    public function getComeMa()
    {
        return $this->comeMa;
    }

    /**
     * Set comeMi
     *
     * @param integer $comeMi
     * @return Persona
     */
    public function setComeMi($comeMi)
    {
        $this->comeMi = $comeMi;

        return $this;
    }

    /**
     * Get comeMi
     *
     * @return integer 
     */
    public function getComeMi()
    {
        return $this->comeMi;
    }

    /**
     * Set comeJu
     *
     * @param integer $comeJu
     * @return Persona
     */
    public function setComeJu($comeJu)
    {
        $this->comeJu = $comeJu;

        return $this;
    }

    /**
     * Get comeJu
     *
     * @return integer 
     */
    public function getComeJu()
    {
        return $this->comeJu;
    }

    /**
     * Set comeVi
     *
     * @param integer $comeVi
     * @return Persona
     */
    public function setComeVi($comeVi)
    {
        $this->comeVi = $comeVi;

        return $this;
    }

    /**
     * Get comeVi
     *
     * @return integer 
     */
    public function getComeVi()
    {
        return $this->comeVi;
    }

    /**
     * Set comeSa
     *
     * @param integer $comeSa
     * @return Persona
     */
    public function setComeSa($comeSa)
    {
        $this->comeSa = $comeSa;

        return $this;
    }

    /**
     * Get comeSa
     *
     * @return integer 
     */
    public function getComeSa()
    {
        return $this->comeSa;
    }

    /**
     * Set comeDo
     *
     * @param integer $comeDo
     * @return Persona
     */
    public function setComeDo($comeDo)
    {
        $this->comeDo = $comeDo;

        return $this;
    }

    /**
     * Get comeDo
     *
     * @return integer 
     */
    public function getComeDo()
    {
        return $this->comeDo;
    }

    /**
     * Set comeSaNotas
     *
     * @param string $comeSaNotas
     * @return Persona
     */
    public function setComeSaNotas($comeSaNotas)
    {
        $this->comeSaNotas = $comeSaNotas;

        return $this;
    }

    /**
     * Get comeSaNotas
     *
     * @return string 
     */
    public function getComeSaNotas()
    {
        return $this->comeSaNotas;
    }

    /**
     * Set comeDoNotas
     *
     * @param string $comeDoNotas
     * @return Persona
     */
    public function setComeDoNotas($comeDoNotas)
    {
        $this->comeDoNotas = $comeDoNotas;

        return $this;
    }

    /**
     * Get comeDoNotas
     *
     * @return string 
     */
    public function getComeDoNotas()
    {
        return $this->comeDoNotas;
    }

    /**
     * Set creditrans
     *
     * @param integer $creditrans
     * @return Persona
     */
    public function setCreditrans($creditrans)
    {
        $this->creditrans = $creditrans;

        return $this;
    }

    /**
     * Get creditrans
     *
     * @return integer 
     */
    public function getCreditrans()
    {
        return $this->creditrans;
    }

    /**
     * Set listaEsperaPiso
     *
     * @param string $listaEsperaPiso
     * @return Persona
     */
    public function setListaEsperaPiso($listaEsperaPiso)
    {
        $this->listaEsperaPiso = $listaEsperaPiso;

        return $this;
    }

    /**
     * Get listaEsperaPiso
     *
     * @return string 
     */
    public function getListaEsperaPiso()
    {
        return $this->listaEsperaPiso;
    }

    /**
     * Set datosformativosobs
     *
     * @param string $datosformativosobs
     * @return Persona
     */
    public function setDatosformativosobs($datosformativosobs)
    {
        $this->datosformativosobs = $datosformativosobs;

        return $this;
    }

    /**
     * Get datosformativosobs
     *
     * @return string 
     */
    public function getDatosformativosobs()
    {
        return $this->datosformativosobs;
    }

    /**
     * Set datosformativositem
     *
     * @param string $datosformativositem
     * @return Persona
     */
    public function setDatosformativositem($datosformativositem)
    {
        $this->datosformativositem = $datosformativositem;

        return $this;
    }

    /**
     * Get datosformativositem
     *
     * @return string 
     */
    public function getDatosformativositem()
    {
        return $this->datosformativositem;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     * @return Persona
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
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
     * Set npasap
     *
     * @param string $npasap
     * @return Persona
     */
    public function setNpasap($npasap)
    {
        $this->npasap = $npasap;

        return $this;
    }

    /**
     * Get npasap
     *
     * @return string 
     */
    public function getNpasap()
    {
        return $this->npasap;
    }

    /**
     * Set fpasap
     *
     * @param \DateTime $fpasap
     * @return Persona
     */
    public function setFpasap($fpasap)
    {
        $this->fpasap = $fpasap;

        return $this;
    }

    /**
     * Get fpasap
     *
     * @return \DateTime 
     */
    public function getFpasap()
    {
        return $this->fpasap;
    }

    /**
     * Set ncedula
     *
     * @param string $ncedula
     * @return Persona
     */
    public function setNcedula($ncedula)
    {
        $this->ncedula = $ncedula;

        return $this;
    }

    /**
     * Get ncedula
     *
     * @return string 
     */
    public function getNcedula()
    {
        return $this->ncedula;
    }

    /**
     * Set fcedula
     *
     * @param \DateTime $fcedula
     * @return Persona
     */
    public function setFcedula($fcedula)
    {
        $this->fcedula = $fcedula;

        return $this;
    }

    /**
     * Get fcedula
     *
     * @return \DateTime 
     */
    public function getFcedula()
    {
        return $this->fcedula;
    }

    /**
     * Set fressol
     *
     * @param \DateTime $fressol
     * @return Persona
     */
    public function setFressol($fressol)
    {
        $this->fressol = $fressol;

        return $this;
    }

    /**
     * Get fressol
     *
     * @return \DateTime 
     */
    public function getFressol()
    {
        return $this->fressol;
    }

    /**
     * Set nresconc
     *
     * @param string $nresconc
     * @return Persona
     */
    public function setNresconc($nresconc)
    {
        $this->nresconc = $nresconc;

        return $this;
    }

    /**
     * Get nresconc
     *
     * @return string 
     */
    public function getNresconc()
    {
        return $this->nresconc;
    }

    /**
     * Set fresconc
     *
     * @param \DateTime $fresconc
     * @return Persona
     */
    public function setFresconc($fresconc)
    {
        $this->fresconc = $fresconc;

        return $this;
    }

    /**
     * Get fresconc
     *
     * @return \DateTime 
     */
    public function getFresconc()
    {
        return $this->fresconc;
    }

    /**
     * Set frestrsol
     *
     * @param \DateTime $frestrsol
     * @return Persona
     */
    public function setFrestrsol($frestrsol)
    {
        $this->frestrsol = $frestrsol;

        return $this;
    }

    /**
     * Get frestrsol
     *
     * @return \DateTime 
     */
    public function getFrestrsol()
    {
        return $this->frestrsol;
    }

    /**
     * Set nrestrconc
     *
     * @param string $nrestrconc
     * @return Persona
     */
    public function setNrestrconc($nrestrconc)
    {
        $this->nrestrconc = $nrestrconc;

        return $this;
    }

    /**
     * Get nrestrconc
     *
     * @return string 
     */
    public function getNrestrconc()
    {
        return $this->nrestrconc;
    }

    /**
     * Set frestrconc
     *
     * @param \DateTime $frestrconc
     * @return Persona
     */
    public function setFrestrconc($frestrconc)
    {
        $this->frestrconc = $frestrconc;

        return $this;
    }

    /**
     * Get frestrconc
     *
     * @return \DateTime 
     */
    public function getFrestrconc()
    {
        return $this->frestrconc;
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
     * Set fentrada
     *
     * @param \DateTime $fentrada
     * @return Persona
     */
    public function setFentrada($fentrada)
    {
        $this->fentrada = $fentrada;

        return $this;
    }

    /**
     * Get fentrada
     *
     * @return \DateTime 
     */
    public function getFentrada()
    {
        return $this->fentrada;
    }

    /**
     * Set fprueba
     *
     * @param \DateTime $fprueba
     * @return Persona
     */
    public function setFprueba($fprueba)
    {
        $this->fprueba = $fprueba;

        return $this;
    }

    /**
     * Get fprueba
     *
     * @return \DateTime 
     */
    public function getFprueba()
    {
        return $this->fprueba;
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
     * Set permisosolicitudfecha
     *
     * @param \DateTime $permisosolicitudfecha
     * @return Persona
     */
    public function setPermisosolicitudfecha($permisosolicitudfecha)
    {
        $this->permisosolicitudfecha = $permisosolicitudfecha;

        return $this;
    }

    /**
     * Get permisosolicitudfecha
     *
     * @return \DateTime 
     */
    public function getPermisosolicitudfecha()
    {
        return $this->permisosolicitudfecha;
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
     * Set empadronamiento
     *
     * @param string $empadronamiento
     * @return Persona
     */
    public function setEmpadronamiento($empadronamiento)
    {
        $this->empadronamiento = $empadronamiento;

        return $this;
    }

    /**
     * Get empadronamiento
     *
     * @return string 
     */
    public function getEmpadronamiento()
    {
        return $this->empadronamiento;
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
     * Set ingresosrentabas
     *
     * @param integer $ingresosrentabas
     * @return Persona
     */
    public function setIngresosrentabas($ingresosrentabas)
    {
        $this->ingresosrentabas = $ingresosrentabas;

        return $this;
    }

    /**
     * Get ingresosrentabas
     *
     * @return integer 
     */
    public function getIngresosrentabas()
    {
        return $this->ingresosrentabas;
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
     * Set tlSabado
     *
     * @param integer $tlSabado
     * @return Persona
     */
    public function setTlSabado($tlSabado)
    {
        $this->tlSabado = $tlSabado;

        return $this;
    }

    /**
     * Get tlSabado
     *
     * @return integer 
     */
    public function getTlSabado()
    {
        return $this->tlSabado;
    }

    /**
     * Set tlDomingo
     *
     * @param integer $tlDomingo
     * @return Persona
     */
    public function setTlDomingo($tlDomingo)
    {
        $this->tlDomingo = $tlDomingo;

        return $this;
    }

    /**
     * Get tlDomingo
     *
     * @return integer 
     */
    public function getTlDomingo()
    {
        return $this->tlDomingo;
    }

    /**
     * Set salidaVerano
     *
     * @param integer $salidaVerano
     * @return Persona
     */
    public function setSalidaVerano($salidaVerano)
    {
        $this->salidaVerano = $salidaVerano;

        return $this;
    }

    /**
     * Get salidaVerano
     *
     * @return integer 
     */
    public function getSalidaVerano()
    {
        return $this->salidaVerano;
    }

    /**
     * Set salidaOtro
     *
     * @param integer $salidaOtro
     * @return Persona
     */
    public function setSalidaOtro($salidaOtro)
    {
        $this->salidaOtro = $salidaOtro;

        return $this;
    }

    /**
     * Get salidaOtro
     *
     * @return integer 
     */
    public function getSalidaOtro()
    {
        return $this->salidaOtro;
    }

    /**
     * Set medicacionCentro
     *
     * @param integer $medicacionCentro
     * @return Persona
     */
    public function setMedicacionCentro($medicacionCentro)
    {
        $this->medicacionCentro = $medicacionCentro;

        return $this;
    }

    /**
     * Get medicacionCentro
     *
     * @return integer 
     */
    public function getMedicacionCentro()
    {
        return $this->medicacionCentro;
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
     * Set expLaboral
     *
     * @param integer $expLaboral
     * @return Persona
     */
    public function setExpLaboral($expLaboral)
    {
        $this->expLaboral = $expLaboral;

        return $this;
    }

    /**
     * Get expLaboral
     *
     * @return integer 
     */
    public function getExpLaboral()
    {
        return $this->expLaboral;
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
     * Set fAltaLanbide
     *
     * @param \DateTime $fAltaLanbide
     * @return Persona
     */
    public function setFAltaLanbide($fAltaLanbide)
    {
        $this->fAltaLanbide = $fAltaLanbide;

        return $this;
    }

    /**
     * Get fAltaLanbide
     *
     * @return \DateTime 
     */
    public function getFAltaLanbide()
    {
        return $this->fAltaLanbide;
    }

    /**
     * Set fRenovLanbide
     *
     * @param \DateTime $fRenovLanbide
     * @return Persona
     */
    public function setFRenovLanbide($fRenovLanbide)
    {
        $this->fRenovLanbide = $fRenovLanbide;

        return $this;
    }

    /**
     * Get fRenovLanbide
     *
     * @return \DateTime 
     */
    public function getFRenovLanbide()
    {
        return $this->fRenovLanbide;
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
     * Set fAltaInem
     *
     * @param \DateTime $fAltaInem
     * @return Persona
     */
    public function setFAltaInem($fAltaInem)
    {
        $this->fAltaInem = $fAltaInem;

        return $this;
    }

    /**
     * Get fAltaInem
     *
     * @return \DateTime 
     */
    public function getFAltaInem()
    {
        return $this->fAltaInem;
    }

    /**
     * Set fRenovInem
     *
     * @param \DateTime $fRenovInem
     * @return Persona
     */
    public function setFRenovInem($fRenovInem)
    {
        $this->fRenovInem = $fRenovInem;

        return $this;
    }

    /**
     * Get fRenovInem
     *
     * @return \DateTime 
     */
    public function getFRenovInem()
    {
        return $this->fRenovInem;
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
     * Set poblacionPadron
     *
     * @param integer $poblacionPadron
     * @return Persona
     */
    public function setPoblacionPadron($poblacionPadron)
    {
        $this->poblacionPadron = $poblacionPadron;

        return $this;
    }

    /**
     * Get poblacionPadron
     *
     * @return integer 
     */
    public function getPoblacionPadron()
    {
        return $this->poblacionPadron;
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
     * Set insertIdUsuario
     *
     * @param integer $insertIdUsuario
     * @return Persona
     */
    public function setInsertIdUsuario($insertIdUsuario)
    {
        $this->insertIdUsuario = $insertIdUsuario;

        return $this;
    }

    /**
     * Get insertIdUsuario
     *
     * @return integer 
     */
    public function getInsertIdUsuario()
    {
        return $this->insertIdUsuario;
    }

    /**
     * Set insertFecha
     *
     * @param \DateTime $insertFecha
     * @return Persona
     */
    public function setInsertFecha($insertFecha)
    {
        $this->insertFecha = $insertFecha;

        return $this;
    }

    /**
     * Get insertFecha
     *
     * @return \DateTime 
     */
    public function getInsertFecha()
    {
        return $this->insertFecha;
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
     * Set procedenciaDemandaLista
     *
     * @param integer $procedenciaDemandaLista
     * @return Persona
     */
    public function setProcedenciaDemandaLista($procedenciaDemandaLista)
    {
        $this->procedenciaDemandaLista = $procedenciaDemandaLista;

        return $this;
    }

    /**
     * Get procedenciaDemandaLista
     *
     * @return integer 
     */
    public function getProcedenciaDemandaLista()
    {
        return $this->procedenciaDemandaLista;
    }

    /**
     * Set documentoidentif
     *
     * @param integer $documentoidentif
     * @return Persona
     */
    public function setDocumentoidentif($documentoidentif)
    {
        $this->documentoidentif = $documentoidentif;

        return $this;
    }

    /**
     * Get documentoidentif
     *
     * @return integer 
     */
    public function getDocumentoidentif()
    {
        return $this->documentoidentif;
    }

    /**
     * Set fechaCaducTis
     *
     * @param \DateTime $fechaCaducTis
     * @return Persona
     */
    public function setFechaCaducTis($fechaCaducTis)
    {
        $this->fechaCaducTis = $fechaCaducTis;

        return $this;
    }

    /**
     * Get fechaCaducTis
     *
     * @return \DateTime 
     */
    public function getFechaCaducTis()
    {
        return $this->fechaCaducTis;
    }

    /**
     * Set ordenExpulsion
     *
     * @param integer $ordenExpulsion
     * @return Persona
     */
    public function setOrdenExpulsion($ordenExpulsion)
    {
        $this->ordenExpulsion = $ordenExpulsion;

        return $this;
    }

    /**
     * Get ordenExpulsion
     *
     * @return integer 
     */
    public function getOrdenExpulsion()
    {
        return $this->ordenExpulsion;
    }

    /**
     * Set cantidadIngresospropios
     *
     * @param string $cantidadIngresospropios
     * @return Persona
     */
    public function setCantidadIngresospropios($cantidadIngresospropios)
    {
        $this->cantidadIngresospropios = $cantidadIngresospropios;

        return $this;
    }

    /**
     * Get cantidadIngresospropios
     *
     * @return string 
     */
    public function getCantidadIngresospropios()
    {
        return $this->cantidadIngresospropios;
    }

    /**
     * Set cantidadIngresospnc
     *
     * @param string $cantidadIngresospnc
     * @return Persona
     */
    public function setCantidadIngresospnc($cantidadIngresospnc)
    {
        $this->cantidadIngresospnc = $cantidadIngresospnc;

        return $this;
    }

    /**
     * Get cantidadIngresospnc
     *
     * @return string 
     */
    public function getCantidadIngresospnc()
    {
        return $this->cantidadIngresospnc;
    }

    /**
     * Set cantidadIngresosotros
     *
     * @param string $cantidadIngresosotros
     * @return Persona
     */
    public function setCantidadIngresosotros($cantidadIngresosotros)
    {
        $this->cantidadIngresosotros = $cantidadIngresosotros;

        return $this;
    }

    /**
     * Get cantidadIngresosotros
     *
     * @return string 
     */
    public function getCantidadIngresosotros()
    {
        return $this->cantidadIngresosotros;
    }

    /**
     * Set cantidadIngresosnomina
     *
     * @param string $cantidadIngresosnomina
     * @return Persona
     */
    public function setCantidadIngresosnomina($cantidadIngresosnomina)
    {
        $this->cantidadIngresosnomina = $cantidadIngresosnomina;

        return $this;
    }

    /**
     * Get cantidadIngresosnomina
     *
     * @return string 
     */
    public function getCantidadIngresosnomina()
    {
        return $this->cantidadIngresosnomina;
    }

    /**
     * Set cantidadIngresosrentabas
     *
     * @param string $cantidadIngresosrentabas
     * @return Persona
     */
    public function setCantidadIngresosrentabas($cantidadIngresosrentabas)
    {
        $this->cantidadIngresosrentabas = $cantidadIngresosrentabas;

        return $this;
    }

    /**
     * Get cantidadIngresosrentabas
     *
     * @return string 
     */
    public function getCantidadIngresosrentabas()
    {
        return $this->cantidadIngresosrentabas;
    }

    /**
     * Set cantidadIngresosprestcontrib
     *
     * @param string $cantidadIngresosprestcontrib
     * @return Persona
     */
    public function setCantidadIngresosprestcontrib($cantidadIngresosprestcontrib)
    {
        $this->cantidadIngresosprestcontrib = $cantidadIngresosprestcontrib;

        return $this;
    }

    /**
     * Get cantidadIngresosprestcontrib
     *
     * @return string 
     */
    public function getCantidadIngresosprestcontrib()
    {
        return $this->cantidadIngresosprestcontrib;
    }

    /**
     * Set cantidadIngrsossedesconoce
     *
     * @param string $cantidadIngrsossedesconoce
     * @return Persona
     */
    public function setCantidadIngrsossedesconoce($cantidadIngrsossedesconoce)
    {
        $this->cantidadIngrsossedesconoce = $cantidadIngrsossedesconoce;

        return $this;
    }

    /**
     * Get cantidadIngrsossedesconoce
     *
     * @return string 
     */
    public function getCantidadIngrsossedesconoce()
    {
        return $this->cantidadIngrsossedesconoce;
    }

    /**
     * Set cantidadIngresosayudaindividual
     *
     * @param string $cantidadIngresosayudaindividual
     * @return Persona
     */
    public function setCantidadIngresosayudaindividual($cantidadIngresosayudaindividual)
    {
        $this->cantidadIngresosayudaindividual = $cantidadIngresosayudaindividual;

        return $this;
    }

    /**
     * Get cantidadIngresosayudaindividual
     *
     * @return string 
     */
    public function getCantidadIngresosayudaindividual()
    {
        return $this->cantidadIngresosayudaindividual;
    }

    /**
     * Set autonomiaEconomia
     *
     * @param integer $autonomiaEconomia
     * @return Persona
     */
    public function setAutonomiaEconomia($autonomiaEconomia)
    {
        $this->autonomiaEconomia = $autonomiaEconomia;

        return $this;
    }

    /**
     * Get autonomiaEconomia
     *
     * @return integer 
     */
    public function getAutonomiaEconomia()
    {
        return $this->autonomiaEconomia;
    }

    /**
     * Set observacionesEconomia
     *
     * @param string $observacionesEconomia
     * @return Persona
     */
    public function setObservacionesEconomia($observacionesEconomia)
    {
        $this->observacionesEconomia = $observacionesEconomia;

        return $this;
    }

    /**
     * Get observacionesEconomia
     *
     * @return string 
     */
    public function getObservacionesEconomia()
    {
        return $this->observacionesEconomia;
    }

    /**
     * Set cursoActual
     *
     * @param string $cursoActual
     * @return Persona
     */
    public function setCursoActual($cursoActual)
    {
        $this->cursoActual = $cursoActual;

        return $this;
    }

    /**
     * Get cursoActual
     *
     * @return string 
     */
    public function getCursoActual()
    {
        return $this->cursoActual;
    }

    /**
     * Set justiciagratuita
     *
     * @param integer $justiciagratuita
     * @return Persona
     */
    public function setJusticiagratuita($justiciagratuita)
    {
        $this->justiciagratuita = $justiciagratuita;

        return $this;
    }

    /**
     * Get justiciagratuita
     *
     * @return integer 
     */
    public function getJusticiagratuita()
    {
        return $this->justiciagratuita;
    }

    /**
     * Set indicador11
     *
     * @param integer $indicador11
     * @return Persona
     */
    public function setIndicador11($indicador11)
    {
        $this->indicador11 = $indicador11;

        return $this;
    }

    /**
     * Get indicador11
     *
     * @return integer 
     */
    public function getIndicador11()
    {
        return $this->indicador11;
    }

    /**
     * Set indicador11A
     *
     * @param integer $indicador11A
     * @return Persona
     */
    public function setIndicador11A($indicador11A)
    {
        $this->indicador11A = $indicador11A;

        return $this;
    }

    /**
     * Get indicador11A
     *
     * @return integer 
     */
    public function getIndicador11A()
    {
        return $this->indicador11A;
    }

    /**
     * Set indicador12
     *
     * @param integer $indicador12
     * @return Persona
     */
    public function setIndicador12($indicador12)
    {
        $this->indicador12 = $indicador12;

        return $this;
    }

    /**
     * Get indicador12
     *
     * @return integer 
     */
    public function getIndicador12()
    {
        return $this->indicador12;
    }

    /**
     * Set indicador12A
     *
     * @param integer $indicador12A
     * @return Persona
     */
    public function setIndicador12A($indicador12A)
    {
        $this->indicador12A = $indicador12A;

        return $this;
    }

    /**
     * Get indicador12A
     *
     * @return integer 
     */
    public function getIndicador12A()
    {
        return $this->indicador12A;
    }

    /**
     * Set indicador13
     *
     * @param integer $indicador13
     * @return Persona
     */
    public function setIndicador13($indicador13)
    {
        $this->indicador13 = $indicador13;

        return $this;
    }

    /**
     * Get indicador13
     *
     * @return integer 
     */
    public function getIndicador13()
    {
        return $this->indicador13;
    }

    /**
     * Set indicador14
     *
     * @param integer $indicador14
     * @return Persona
     */
    public function setIndicador14($indicador14)
    {
        $this->indicador14 = $indicador14;

        return $this;
    }

    /**
     * Get indicador14
     *
     * @return integer 
     */
    public function getIndicador14()
    {
        return $this->indicador14;
    }

    /**
     * Set indicador15
     *
     * @param integer $indicador15
     * @return Persona
     */
    public function setIndicador15($indicador15)
    {
        $this->indicador15 = $indicador15;

        return $this;
    }

    /**
     * Get indicador15
     *
     * @return integer 
     */
    public function getIndicador15()
    {
        return $this->indicador15;
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
