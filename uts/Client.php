<?php
error_reporting(1);
class Client{
    private $option,$api;

    public function __construct($uri,$location){
        $this->option = array('location'=>$location,'uri'=>$uri);

        $this->api = new SoapClient(NULL,$this->option);

        unset($uri, $location);
    }

    public function filter($data){
        $data = preg_replace('/[^a-zA-Z0-9]/','',$data);
        return $data;
        unset($data);
    }

    public function tampil_semua_data(){
        $data = $this->api->tampil_semua_data();
        return $data;
        unsert($data);
    }

    public function tampil_data($no_buku){
        $no_buku = $this->filter($no_buku);
        $data = $this->api->tampil_data($no_buku);
        return $data;
        unset( $no_buku, $data);
    }

    public function tambah_data($data){
        $this->api->tambah_data($data);
        unset( $data);
    }

    public function ubah_data($data){
        $this->api->ubah_data($data);
        unset( $data);
    }

    public function hapus_data($no_buku){
        $this->api->hapus_data($no_buku);
        unset( $no_buku);
    }

    public function __destruct(){
        unset($this->option,$this->api);
    }    
}

$uri = 'http://192.168.41.3:8085';
$location = $uri.'/uts/server.php';
$abc = new Client($uri,$location);
// var_dump($abc->tampil_semua_data());
?>