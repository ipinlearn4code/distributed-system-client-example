<?php
class Client
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function filter($data)
    {
        return preg_replace('/[^a-zA-Z0-9]/', "", $data);
    }

    public function login($data)
    {
        $data = json_encode($data);

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($c);
        curl_close($c);
        return json_decode($response);
    }

    public function tampil_semua_data($jwt)
    {
        $client = curl_init($this->url . '?jwt=' . urlencode($jwt));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        return json_decode($response);
    }

    public function tampil_data($data)
    {
        $id_barang = $this->filter($data['id_barang']);
        $client = curl_init($this->url . '?aksi=tampil&id_barang=' . urlencode($id_barang) . '&jwt=' . urlencode($data['jwt']));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        return json_decode($response);
    }

    public function tambah_data($data)
    {
        $data = json_encode($data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($c);
        curl_close($c);
    }

    public function ubah_data($data)
    {
        $data = json_encode($data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($c);
        curl_close($c);
    }

    public function hapus_data($data)
    {
        $data = json_encode($data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($c);
        curl_close($c);
    }
}

$url = 'http://192.168.41.3:8085/jwt/jwt2/server.php';
$abc = new Client($url);
