<?php
error_reporting(1); // Display errors
class Client
{
    private $host = "localhost";
    private $dbname = "serviceclient";
    private $conn;
    private $url;

    // Database connection details
    private $driver = "mysql";
    private $user = "root";
    private $password = "";
    private $port = "3307";

    // Initialize the connection
    public function __construct($url)
    {
        $this->url = $url;
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Koneksi gagal";
        }
        unset($url);
    }

    // Remove special characters
    public function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    public function tampil_semua_data()
    {
        $client = curl_init($this->url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($data, $client, $response);
    }

    public function tampil_data($nim)
    {
        $nim = $this->filter($nim);
        $client = curl_init($this->url . "?aksi=tampil&nim=" . $nim);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nim, $client, $response, $data);
    }

    public function tambah_data($data)
    {
        $data = json_encode($data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_data($data)
    {
        $data = json_encode($data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function hapus_data($data)
    {
        $data = json_encode($data);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function sinkronisasi()
    {
        $query = $this->conn->prepare("DELETE FROM mahasiswa");
        $query->execute();
        $query->closeCursor();

        $client = curl_init($this->url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);

        foreach ($data as $r) {
            $query = $this->conn->prepare("INSERT INTO mahasiswa (nim, nama, no_hp, alamat) VALUES (?, ?, ?, ?)");
            $query->execute(array($r->nim, $r->nama, $r->no_hp, $r->alamat));
            $query->closeCursor();
        }
        unset($client, $response, $data, $r);
    }

    public function daftar_mhs_client()
    {
        $query = $this->conn->prepare("SELECT nim, nama, no_hp, alamat FROM mahasiswa ORDER BY nim");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function __destruct()
    {
        unset($this->url);
    }
}

$url = 'http://192.168.41.3:8085/teori/restfuljson/server.php';
$abc = new Client($url);
?>
