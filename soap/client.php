<?php
// error_reporting(1); // Enable error reporting

class Client {
    private $options, $api;

    // Constructor: Initializes SOAP client with given location and URI
    public function __construct($uri, $location) {
        $this->options = [
            'location' => $location,
            'uri' => $uri
        ];
        try {
            // Initialize the SOAP client
            $this->api = new SoapClient(NULL, $this->options);
            echo "Grant connection";
        } catch (SoapFault $fault) {
            // Handle initialization error
            echo "Error initializing SOAP client: " . $fault->getMessage();
        }
    }

    // Filter input to remove anything other than letters and numbers
    private function filter($data) {
        return preg_replace('/[^a-zA-Z0-9]/', '', $data);
    }

    // Fetch all data
    public function tampil_semua_data() {
        try {
            $data = $this->api->tampil_semua_data();
            if (!$data) {
                throw new Exception("No data returned.");
                echo "method dipanggil";
            }
            return $data;
        } catch (Exception $e) {
            echo "Error fetching all data: " . $e->getMessage();
        }
    }

    // Fetch a specific record by ID
    public function tampil_data($id_barang) {
        $id_barang = $this->filter($id_barang); // Sanitize input
        try {
            $data = $this->api->tampil_data($id_barang);
            if (!$data) {
                throw new Exception("No data returned for ID: $id_barang");
            }
            return $data;
        } catch (Exception $e) {
            echo "Error fetching data for ID $id_barang: " . $e->getMessage();
        }
    }

    // Add new record
    public function tambah_data($data) {
        try {
            $result = $this->api->tambah_data($data);
            return $result;
        } catch (Exception $e) {
            echo "Error adding data: " . $e->getMessage();
        }
    }

    // Update a record
    public function ubah_data($data) {
        try {
            $result = $this->api->ubah_data($data);
            return $result;
        } catch (Exception $e) {
            echo "Error updating data: " . $e->getMessage();
        }
    }

    // Delete a record by ID
    public function hapus_data($id_barang) {
        $id_barang = $this->filter($id_barang); // Sanitize input
        try {
            $result = $this->api->hapus_data($id_barang);
            return $result;
        } catch (Exception $e) {
            echo "Error deleting data for ID $id_barang: " . $e->getMessage();
        }
    }

    // Destructor: Clean up resources
    public function __destruct() {
        unset($this->options, $this->api);
    }
}

// URI and location of the SOAP server
$uri = 'http://103.217.216.34:8000/';
$location = $uri . 'soap/server.php';

// Instantiate the Client class
$abc = new Client($uri, $location);

var_dump($abc->tampil_semua_data());
?>
