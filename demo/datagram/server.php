<?php
require('../../vendor/autoload.php');

use David2M\PHPSocket\Datagram\DatagramFactory;

$datagramFactory = new DatagramFactory();

$serverSocket = $datagramFactory->createServerSocket();
$serverSocket->bind('127.0.0.1', 9000);

while (true) {
    echo "Waiting for data... \n";

    // Receive some data.
    $buf = $clientIp = $clientPort = null;
    $serverSocket->recvfrom($buf, 128, 0, $clientIp, $clientPort);
    echo "($clientIp:$clientPort) - " . $buf . "\r\n";

    // Send back the data to the client
    $message = 'Welcome to the server!';
    $serverSocket->sendto($message, strlen($message), 0, $clientIp, $clientPort);
}