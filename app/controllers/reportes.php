<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller
{
    private $id_usuario;
    private $reporte=array();
    public function __construct()

    {
        parent::__construct();
        $this->id_usuario='2732e323-83a4-11e8-be07-bcee7be16e8e';
        $this->load->library('reporter');
        $this->load->library('reportes/reporter_graph');
        $this->load->library('reporter/reporte_selectores');
        $this->load->library('reporter/reporte_estructura_despacho');
        $this->load->library('reporter/reporte_prestaciones');
        $this->load->library('reporter/reporte_compensaciones_prestaciones');
        $this->load->library('reporter/reporte_bonos_incentivos');
        $this->load->library('reporter/reporte_tarifas_productividad');
        $this->load->library('reporter/reporte_mercadotecnia');
        $this->load->library('reporter/reporte_seguros_jubilacion');
        $this->load->library('reporter/reporte_ti');
        $this->load->library('reporter/reporte_ingresos_cobranza');
        $this->load->library('reporter/reporte_ed_especial');
    }


    public function reporte_ti()
    {
       $this->reporte_ti->getData();

    }


    public function getSubSecciones()
    {
        $indice =$this->input->post('indice');
        $data=$this->reporte_selectores->getSubSecciones($indice);
        echo $data;

    }

    public function getCategorias()
    {
        $subindice =$this->input->post('subindice');

        $data=$this->reporte_selectores->getCategorias($subindice);
        echo $data;

    }

    public function prestaciones()
    {
        $this->load->view('reportes/prestaciones');
    }

    public function seguros_jubilacion()
    {
        $this->load->view('reportes/seguros_jubilacion');
    }

    public function estructura_despacho()
    {
        $this->load->view('reportes/estructura_despacho');
    }

    public function compensaciones_prestaciones()
    {
        $this->load->view('reportes/compensaciones_prestaciones');
    }
    public function bonos_incentivos()
    {
        $this->load->view('reportes/bonos_incentivos');
    }

    public function tarifas_productividad()
    {
        $this->load->view('reportes/tarifas_productividad');
    }

    public function mercadotecnia()
    {
        $this->load->view('reportes/mercadotecnia');
    }

    public function ti()
    {
        $this->load->view('reportes/ti');
    }

    public function ingresos_cobranza()
    {
        $this->load->view('reportes/ingresos_cobranza');
    }

    public function comparativa_sueldos()
    {
        $this->load->view('reportes/comparativa_sueldos');
    }
    public function reportes_estructura_despacho()
    {
        $parametros =$this->input->post('parametros');
        @$categoria = $parametros['categoria'];
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        //$muestras   = $parametros['muestras'];
        //$muestras=(string) implode("', '",$parametros['muestras']);
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1'){
            $data=$this->reporte_estructura_despacho->reporte($subindice,$periodo,$anio,$muestras);
        }elseif ($tipo_rpte=='2'){
            $data=$this->reporte_ed_especial->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);
    }

    public function reportes_seguros_jubilacion()
    {
        $parametros =$this->input->post('parametros');
        @$categoria = $parametros['categoria'];
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {
            $data = $this->reporte_seguros_jubilacion->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }

    public function reportes_prestaciones()
    {
        $parametros =$this->input->post('parametros');
        @$categoria = $parametros['categoria'];
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {
            $data = $this->reporte_prestaciones->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }

    public function reportes_compensaciones_prestaciones()
    {
        $parametros =$this->input->post('parametros');
        @$categoria = $parametros['categoria'];
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);



        if($tipo_rpte=='1') {
            $data = $this->reporte_compensaciones_prestaciones->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }

    public function reportes_bonos_incentivos()
    {

        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        @$categoria = $parametros['categoria'];
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {
            $data = $this->reporte_bonos_incentivos->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }
    public function reportes_tarifas_productividad()
    {
        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        @$categoria = $parametros['categoria'];
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {
            $data = $this->reporte_tarifas_productividad->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }


    public function reportes_ti()
    {
        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {

            $data = $this->reporte_ti->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }

    public function reportes_mercadotecnia()
    {

        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {

            $data = $this->reporte_mercadotecnia->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }
    public function reportes_ingresos_cobranza()
    {

        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        $subindice  = $parametros['subindice'];
        $periodo    = $parametros['periodo'];
        $anio       = $parametros['anio'];
        $tipo_rpte  = $parametros['tipo'];
        $muestras=$this->addComillas($parametros['muestras']);


        if($tipo_rpte=='1') {

            $data = $this->reporte_ingresos_cobranza->reporte($subindice,$periodo,$anio,$muestras);
        }

        echo json_encode($data);


    }

    public function getPeriodos()
    {
        $data=$this->reporte_selectores->getPeriodos();
        echo $data;
    }
    public function getAnios()
    {
        $data=$this->reporte_selectores->getAnios();
        echo $data;
    }

    public function getMuestras()
    {
        $data=$this->reporte_selectores->getMuestras();
        echo $data;
    }

    public function addComillas($data)
    {
        $muestras="";
        foreach ($data as $item){
            $muestras.= '"' . $item .'"' .',';
        }
        return substr($muestras, 0, -1);
    }
    public function getSubcategorias()
    {
        $indice =$this->input->post('indice');
        $data=$this->reporte_selectores->getSubcategorias($indice);
        echo $data;

    }


}
