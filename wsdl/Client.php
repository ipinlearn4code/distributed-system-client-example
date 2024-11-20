<?php
error_reporting(1);
require_once("nusoap.php");

class Client{
    private $api;
    public function __construct($url){
        $this->api = new nusoap_client($url,true);
        unset($url);
    }

    public function tampil_semua_data(){
        $data = $this->api->call('tampil_semua_data');
        return $data;
        unset($data);
    }

    public function tampil_data($id_barang){
        $data = $this->api->call('tampil_data',array($id_barang));
        return $data;
        unset($id_barang,$data);
    }

    public function tambah_data($data){
        $this->api->call('tambah_data',array($data));
        unset($data);
    }
    public function ubah_data($data){
        $this->api->call('ubah_data',array($data));
        unset($data);
    }

    public function hapus_data($id_barang){
        $this->api->call('hapus_data',array($id_barang));
        unset($id_barang);
    }

    public function __destruct(){
        unset($this->api);
    }
}

$url = "http://192.168.41.3:8085/wsdl/server.php?wsdl";
$abc = new Client($url);