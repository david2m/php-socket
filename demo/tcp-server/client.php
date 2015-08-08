<?php
use David2M\PHPSocket\Stream\StreamFactory;
use David2M\PHPSocket\SocketException;

require('../../vendor/autoload.php');

try {
    $factory = new StreamFactory();
    $clientSocket = $factory->createClientSocket();

    $clientSocket->connect('127.0.0.1', 9000);

    // Read data from the server.
    echo $clientSocket->read(128) . "\r\n";

    while (true) {
        // Take some input.
        echo 'Message: ';
        $message = fgets(STDIN);

        // Write data to the server.
        $clientSocket->write($message);
    }
}
catch (SocketException $ex) {
    echo $ex->getMessage();
}