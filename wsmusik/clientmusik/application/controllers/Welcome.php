<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('nusoap_library');
        $this->load->helper('url');
    }
    public function index()
    {
        $this->load->view('welcome_message');
    }
    //crud kategori musik
    public function kategori(){
        $wsdl = "http://127.0.0.1/wsmusik/wskategori.php?wsdl";
        $client = new nusoap_client($wsdl, 'wsdl');//link file wsdl

        $error = $client->getError();//respon web service error
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }


        if ($client->fault) {//web service client fault
            echo "error";
        }else {
            $error = $client->getError();//web service client error
            if ($error) {
                echo "<h2>Error</h2><pre>" . $error . "</pre>";
            }else {
                $result = $client->call("readall");//respon web service
                $data = array('itemkategori'=>$result);
                $this->load->view('kategoriform', $data, FALSE);
            }
        }
    }
    public function createkategori(){
        if (!$this->input->is_ajax_request()) {
            echo show_404();
        }else{
            $client = new nusoap_client("http://127.0.0.1/wsmusik/wskategori.php/");//alamat web service

            $error = $client->getError();//respon web service error
            if ($error) {
                $status = "error";
                $msg = "<h2>Constructor error</h2><pre>" . $error . "</pre>";
            }

            $result = $client->call("create", array("title" => $this->input->post('title'),"penyanyi" => $this->input->post('penyanyi'),"genre" => $this->input->post('genre')));//respon web service

            if ($client->fault) {//web service client fault
                $status = "error";
                $msg = $result;
            }else {
                $error = $client->getError();//web service client error
                if ($error) {
                    $status = "error";
                    $msg = "<h2>Error</h2><pre>" . $error . "</pre>";
                }else {
                    if ($result=="sukses") {
                        $status = "success";
                        $msg = "data berhasil disimpan";
                    }else{
                        $status = "error";
                        $msg = "terjadi kesalahan saat menyimpan data, atau data sudah ada";
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    public function editkategori(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            $client = new nusoap_client("http://127.0.0.1/wsmusik/wskategori.php");//alamat web service

            $error = $client->getError();//respon web service error
            if ($error) {
                $status = 'error';
                $msg = "<h2>Constructor error</h2><pre>" . $error . "</pre>";
                $kategori = null;
            }

            $result = $client->call("readbyid", array("id" => $this->input->post('id')));//respon web service

            if ($client->fault) {//web service client fault
                $status = 'error';
                $msg = "Error";
                $kategori = null;
            }else {
                $error = $client->getError();//web service client error
                if ($error) {
                    $status = 'error';
                    $msg = "<h2>Error</h2><pre>" . $error . "</pre>";
                    $kategori = null;
                }else {
                    $status = 'success';
                    $msg = 'data ditemukan';
                    $kategori = $result;
                }
            }

            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg,'kategori'=>$kategori)));
        }
    }
    public function updatekategori(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            $client = new nusoap_client("http://127.0.0.1/wsmusik/wskategori.php");//alamat web service

            $error = $client->getError();//respon web service error
            if ($error) {
                $status = "error";
                $msg = "<h2>Constructor error</h2><pre>" . $error . "</pre>";
            }

            $result = $client->call("updatebyid", array("id"=>$this->input->post('id'),"title" => $this->input->post('title'),"penyanyi" => $this->input->post('penyanyi'),"genre" => $this->input->post('genre')));//respon web service

            if ($client->fault) {//web service client fault
                $status = "error";
                $msg = $result;
            }else {
                $error = $client->getError();//web service client error
                if ($error) {
                    $status = "error";
                    $msg = "<h2>Error</h2><pre>" . $error . "</pre>";
                }else {
                    if ($result=="sukses") {
                        $status = "success";
                        $msg = "data berhasil diupdate";
                    }else{
                        $status = "error";
                        $msg = "terjadi kesalahan saat mengupdate data";
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    public function removekategori(){
        if (!$this->input->is_ajax_request()) {
            show_404();
        }else{
            $client = new nusoap_client("http://127.0.0.1/wsmusik/wskategori.php");//alamat web service
            $error = $client->getError();//respon web service error
            if ($error) {
                $status = "error";
                $msg = "<h2>Constructor error</h2><pre>" . $error . "</pre>";
            }

            $result = $client->call("deletebyid", array("id" => $this->input->post('id')));//respon web service

            if ($client->fault) {//web service client fault
                $status = "error";
                $msg = $result;
            }else {
                $error = $client->getError();//web service client error
                if ($error) {
                    $status = "error";
                    $msg = "<h2>Error</h2><pre>" . $error . "</pre>";
                }
                else {
                    if ($result=="sukses") {
                        $status = "success";
                        $msg = "data berhasil dihapus";
                    }else{
                        $status = "error";
                        $msg = "terjadi kesalahan saat menghapus data";
                    }
                }
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
        }
    }
    //end crud kategori musik
}