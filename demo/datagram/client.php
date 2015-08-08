<?php
require('../../vendor/autoload.php');

use David2M\PHPSocket\Datagram\DatagramFactory;

$server = '127.0.0.1';
$port = 9000;

$datagramFactory = new DatagramFactory();
$clientSocket = $datagramFactory->createClientSocket();

// Take some input.
echo 'Enter a message to send: ';
$input = fgets(STDIN);

$clientSocket->sendto($input, strlen($input), 0, $server, $port);

// Receive data from the server.
$reply = null;
$clientSocket->recvfrom($reply, 64, 0, $server);

echo "Reply: $reply\r\n\r\n";