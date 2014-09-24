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
     * @ORM\Column(name="id_pers", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPers;

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
     * Get idPers
     *
     * @return integer 
     */
    public function getIdPers()
    {
        return $this->idPers;
    }

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
}
