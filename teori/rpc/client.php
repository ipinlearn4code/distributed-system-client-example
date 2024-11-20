<?php
error_reporting(1); // value 1 error ditampilkan, value 0 error tidak ditampilkan

class client
{
	private $host = "localhost";
	private $dbname = "serviceclient";
	private $conn, $url;

	// koneksi ke database mysql di client
	private $driver = "mysql";
	private $user = "root";
	private $password = "";
	private $port = "3307";



	// function yang pertama kali di-load saat class dipanggil
	public function __construct($url)
	{
		$this->url = $url;
		// koneksi database lokal client
		try {
			if ($this->driver == 'mysql') {
				$this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
			} elseif ($this->driver == 'pgsql') {
				$this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->password");
			}
		} catch (PDOException $e) {
			echo "Koneksi gagal";
		}
		// menghapus variabel dari memory
		unset($url);
	}

	// fungsi menghapus selain huruf dan angka
	public function filter($data)
	{
		$data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
		return $data;
		unset($data);
	}

	public function daftar_mhs_server()
	{
		$context = stream_context_create(array('http' => array(
			'method' => "GET",
			'header' => "Content-Type:text/xml;charset=UTF-8"
		)));
		$response = file_get_contents($this->url, false, $context);
		$data = xmlrpc_decode($response);
		// mengembalikan data
		return $data;
		// menghapus variabel dari memory
		unset($context, $response, $data);
	}

	public function tampil_mhs($nim)
	{
		$nim = $this->filter($nim);
		$context = stream_context_create(array('http' => array(
			'method' => "GET",
			'header' => "Content-Type:text/xml;charset=UTF-8"
		)));
		$response = file_get_contents($this->url . "?nim=" . $nim . "&aksi=tampil", false, $context);
		$data = xmlrpc_decode($response);
		return $data;
		unset($nim, $context, $response, $data);
	}

	public function tambah_mhs($data)
	{
		$data = xmlrpc_encode_request("method", array("nim" => $data['nim'], "nama" => $data['nama'], "no_hp" => $data['no_hp'], "alamat" => $data['alamat'], "aksi" => $data['aksi']));
		$context = stream_context_create(array('http' => array(
			'method' => "POST",
			'header' => "Content-Type:text/xml;charset=UTF-8",
			'content' => $data
		)));
		$file = file_get_contents($this->url, false, $context);
		xmlrpc_decode($file);
		unset($data, $context, $file);
	}

	public function ubah_mhs($data)
	{
		$data = xmlrpc_encode_request("method", array("nim" => $data['nim'], "nama" => $data['nama'], "no_hp" => $data['no_hp'], "alamat" => $data['alamat'], "aksi" => $data['aksi']));
		$context = stream_context_create(array('http' => array(
			'method' => "POST",
			'header' => "Content-Type:text/xml;charset=UTF-8",
			'content' => $data
		)));
		$file = file_get_contents($this->url, false, $context);
		xmlrpc_decode($file);
		unset($data, $context, $file);
	}

	public function hapus_mhs($data)
	{
		$data = xmlrpc_encode_request("method", array("nim" => $data['nim'], "aksi" => $data['aksi']));
		$context = stream_context_create(array('http' => array(
			'method' => "POST",
			'header' => "Content-Type:text/xml;charset=UTF-8",
			'content' => $data
		)));
		$file = file_get_contents($this->url, false, $context);
		xmlrpc_decode($file);
		unset($data, $context, $file);
	}

	public function sinkronisasi()
	{	// query ke lokal database client
		$query = $this->conn->prepare("delete from mahasiswa");
		$query->execute();
		$query->closeCursor();

		// mengambil data semua mahasiswa di server dan disimpan di $data
		$context = stream_context_create(array('http' => array(
			'method' => "GET",
			'header' => "Content-Type:text/xml;charset=UTF-8"
		)));
		$response = file_get_contents($this->url, false, $context);
		$data = xmlrpc_decode($response);
		// looping $data dan masukkan ke dalam database client 
		foreach ($data as $r) {	// query insert data ke lokal database client
			$query = $this->conn->prepare("insert into mahasiswa (nim,nama,no_hp,alamat) values (?,?,?,?)");
			$query->execute(array($r['nim'], $r['nama'],$r['no_hp'], $r['alamat']));
			$query->closeCursor();
		}
		unset($context, $response, $data, $r);
	}

	public function daftar_mhs_client()
	{
		$query = $this->conn->prepare("select nim, nama, no_hp, alamat from mahasiswa order by nim");
		$query->execute();
		// mengambil banyak record data dengan fetchAll()
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

$url = 'http://192.168.41.3:8085/teori/rpc/server.php';
// buat objek baru dari class Client
$bb = new client($url);
