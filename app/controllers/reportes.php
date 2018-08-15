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
        $this->load->library('reporter/reporte_ti');
        $this->load->library('reporter/reporte_mercadotecnia');

        $this->load->library('reporter/reporte_seguros_jubilacion');
        $this->load->library('reporter/reporte_ti');
        $this->load->library('reporter/reporte_ed_especial');




    }

    public function ajax()
    {
        $indice = $this->input->post('indice');

        $data=$this->reporter->reporte($indice);
        echo json_encode($data);
    }



    public function dashboard()
    {
            $this->load->view('reportes/reporte');
    }


    public function selectores()
    {

        $selector = $this->input->post('selector');
        $valor = $this->input->post('valor');

        switch ($selector){
            case 1:
                $data=$this->reporte_selectores->getModulos();
                echo $data;
                break;
            case 2:
                $data=$this->reporte_selectores->getReportesIndice($valor);
                echo $data;
            break;
            case 3:
                $data=$this->reporte_selectores->getReportesSubIndice($valor);
                echo $data;
                break;
            case 4:
                $data=$this->reporte_selectores->getCategorias($valor);
                echo $data;
                break;
            case 5:
                $data=$this->reporte_selectores->getGrupos($valor);
                echo $data;
                break;





        }

    }


    public function reporte()
    {

        $parametros =$this->input->post('parametros');
        $categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $data=$this->reporte_simple->reporte($subindice);


        echo json_encode($data);

    }

    public function reporte_ti()
    {
       $this->reporte_ti->getData();

    }


    public function getSubcategorias()
    {
     $indice =$this->input->post('indice');
     $data=$this->reporte_selectores->getSubcategorias($indice);
     echo $data;

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

    public function reportes_estructura_despacho()
    {
        $parametros =$this->input->post('parametros');
        @$categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1'){
            $data=$this->reporte_estructura_despacho->reporte($subindice);
        }elseif ($tipo_rpte=='2'){
            $data=$this->reporte_ed_especial->reporte($subindice);
        }

        echo json_encode($data);


    }


    public function reportes_seguros_jubilacion()
    {
        $parametros =$this->input->post('parametros');
        @$categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {
            $data = $this->reporte_seguros_jubilacion->reporte($subindice);
        }

        echo json_encode($data);


    }

    public function reportes_prestaciones()
    {
        $parametros =$this->input->post('parametros');
        $categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {
            $data = $this->reporte_prestaciones->reporte($subindice);
        }

        echo json_encode($data);


    }

    public function reportes_compensaciones_prestaciones()
    {
        $parametros =$this->input->post('parametros');
        $categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {
            $data = $this->reporte_compensaciones_prestaciones->reporte($subindice);
        }

        echo json_encode($data);


    }

    public function reportes_bonos_incentivos()
    {

        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        @$categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {
            $data = $this->reporte_bonos_incentivos->reporte($subindice);
        }

        echo json_encode($data);


    }
    public function reportes_tarifas_productividad()
    {

        $parametros =$this->input->post('parametros');
        // TODO Corregir este error no llegan categorias desde la vista categorias
        @$categoria = $parametros['categoria'];
        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {
            $data = $this->reporte_bonos_incentivos->reporte($subindice);
        }

        echo json_encode($data);


    }


    public function reportes_ti()
    {

        $parametros =$this->input->post('parametros');

        // TODO Corregir este error no llegan categorias desde la vista categorias

        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {

            $data = $this->reporte_ti->reporte($subindice);
        }

        echo json_encode($data);


    }

    public function reportes_mercadotecnia()
    {

        $parametros =$this->input->post('parametros');

        // TODO Corregir este error no llegan categorias desde la vista categorias

        $subindice = $parametros['subindice'];
        $tipo_rpte = $parametros['tipo'];



        if($tipo_rpte=='1') {

            $data = $this->reporte_mercadotecnia->reporte($subindice);
        }

        echo json_encode($data);


    }













}
