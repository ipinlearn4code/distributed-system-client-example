<?php
error_reporting(1); // error ditampilkan
class Client
{	private $host="localhost";	
	private $dbname="serviceclient";
	private $conn,$api;
	
	// koneksi ke database mysql di client
	private $driver="mysql";
	private $user="root";
	private $password="";
	private $port="3306";
	
	/*
	// koneksi ke database postgresql di client
	private $driver="pgsql";
	private $user="postgres";
	private $password="postgres";
	private $port="5432";
	*/

	// function yang pertama kali di-load saat class dipanggil
	public function __construct($api)
	{	// buat objek baru dari class SOAP Client
		$this->api = new SoapClient($api);
		// koneksi database lokal client
		try
		{	if ($this->driver == 'mysql')
			{	$this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8",$this->user,$this->password);	
			} elseif ($this->driver == 'pgsql')
			{	$this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->password");	
			}	
		} catch (PDOException $e)
		{	echo "Koneksi gagal";			
		}
		unset($api);
	}

	// function untuk menghapus selain huruf dan angka
	public function filter($data)
	{	$data = preg_replace('/[^a-zA-Z0-9]/','', $data);
		return $data;
		unset($data);
	}

	public function tampil_semua_data()
	{	$data = $this->api->tampil_semua_data();
		return $data;		
		unset($data);
	}
	
	public function tampil_data($nim)
	{	$nim = $this->filter($nim);
		$data = $this->api->tampil_data($nim);
		return $data;
		unset($nim,$data);			
	}	

	public function tambah_data($data)
	{	$this->api->tambah_data($data);
		unset($data);
	}

	public function ubah_data($data)
	{	$this->api->ubah_data($data);
		unset($data);	
	}
	
	public function hapus_data($nim)
	{	$this->api->hapus_data($nim);
		unset($nim);	
	}

	public function sinkronisasi()
    {
        // Clear local database
        $query = $this->conn->prepare("DELETE FROM mahasiswa");
        $query->execute();
        $query->closeCursor();

        // Fetch all data from the server
        $data = $this->api->tampil_semua_data();

        foreach ($data as $r) {
            // Insert data into local database
            $query = $this->conn->prepare("INSERT INTO mahasiswa (nim, nama, no_hp, alamat) VALUES (?, ?, ?, ?)");
            $query->execute(array($r->nim, $r->nama, $r->no_hp, $r->alamat));
            $query->closeCursor();
        }
        unset($data, $r);
    }

    // Retrieve all local data
    public function daftar_mhs_client()
    {
        $query = $this->conn->prepare("SELECT nim, nama, no_hp, alamat FROM mahasiswa ORDER BY nim");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

	// function yang terakhir kali di-load saat class dipanggil
	public function __destruct()
	{	unset($this->options,$this->api);	
	}
}

$api = 'http://192.168.41.3:8085/teori/wsdl/server.php?wsdl';
// buat objek baru dari class Client
$objek = new Client($api);
?>
