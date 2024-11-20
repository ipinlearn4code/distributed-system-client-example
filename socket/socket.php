<?php
// Membuat socket
if (!($sock = socket_create(AF_INET, SOCK_STREAM, 0))) {
    // Penanganan error
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}
echo "Socket created \n----\n";

// Mendapatkan IP address target host dari internet
$address = gethostbyname('www.google.com');
//$address = '127.0.0.1'; // Untuk localhost

// Koneksi ke server
if (!socket_connect($sock, $address, 80)) {
    // Penanganan error
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Could not connect: [$errorcode] $errormsg \n");
}
echo "Connection established \n";

// Mengirim pesan ke server
$message = "GET / HTTP/1.1\r\n\r\n";
if (!socket_send($sock, $message, strlen($message), 0)) {
    // Penanganan error
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Could not send data: [$errorcode] $errormsg \n");
}
echo "Message send successfully \n-----------\n";

// Menerima balasan dari server
if (socket_recv($sock, $buf, 2045, MSG_WAITALL) === FALSE) {
    // Penanganan error
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Could not receive data: [$errorcode] $errormsg \n");
}
echo $buf . "\n---\n";

// Menutup socket
socket_close($sock);
?>