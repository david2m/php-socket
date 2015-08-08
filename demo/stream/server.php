<?php
use David2M\PHPSocket\Stream\StreamFactory;
use David2M\PHPSocket\SocketException;

require('../../vendor/autoload.php');

try {
    $factory = new StreamFactory();
    $serverSocket = $factory->createServerSocket();
    $serverSocket
        ->bind('127.0.0.1', 9000)
        ->listen();

    echo "Listening for connections on port 9000...\r\n";

    while (($clientSocket = $serverSocket->accept())) {
        echo "Client connected...\r\n";

        // Write data to the newly connected client.
        $clientSocket->write('Welcome to the server!');

        // Read data from the client.
        echo "Client said: " . $clientSocket->read(1024) . "\r\n";
    }
}
catch (SocketException $ex) {
    echo $ex->getMessage();
}