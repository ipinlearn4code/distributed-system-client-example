<?php
class Client {
    private $api;

    public function __construct($uri, $location) {
        try {
            $options = array('location' => $location, 'uri' => $uri);
            $this->api = new SoapClient(NULL, $options);
            echo "Connected to SOAP Server\n";
        } catch (SoapFault $fault) {
            echo "Connection Failed: " . $fault->getMessage();
        }
    }

    // Method to get all data
    public function tampil_semua_data() {
        try {
            $response = $this->api->tampil_semua_data();
            var_dump($response); // Display the data
            return $response;
        } catch (SoapFault $fault) {
            echo "Error: " . $fault->getMessage();
        }
    }

    // Method to get data by id
    public function tampil_data($id_barang) {
        try {
            $response = $this->api->tampil_data($id_barang);
            var_dump($response);
            return $response;
        } catch (SoapFault $fault) {
            echo "Error: " . $fault->getMessage();
        }
    }

    // Method to add data
    public function tambah_data($data) {
        try {
            $this->api->tambah_data($data);
            echo "Data added successfully\n";
        } catch (SoapFault $fault) {
            echo "Error: " . $fault->getMessage();
        }
    }

    // Method to update data
    public function ubah_data($data) {
        try {
            $this->api->ubah_data($data);
            echo "Data updated successfully\n";
        } catch (SoapFault $fault) {
            echo "Error: " . $fault->getMessage();
        }
    }

    // Method to delete data
    public function hapus_data($id_barang) {
        try {
            $this->api->hapus_data($id_barang);
            echo "Data deleted successfully\n";
        } catch (SoapFault $fault) {
            echo "Error: " . $fault->getMessage();
        }
    }

    public function __destruct() {
        unset($this->api);
    }
}

// Replace 'localhost' with your actual URI if it's hosted on a different server
$uri = 'http://192.168.41.3:8085/soap/';
$location = $uri . 'server.php';
$uwiw = "KONTOL";
$client = new Client($uri, $location);
var_dump($uwiw);
// Call the tampil_semua_data method
$client->tambah_data($uwiw);
?>
