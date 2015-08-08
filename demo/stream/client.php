<?php
use David2M\PHPSocket\Stream\StreamFactory;
use David2M\PHPSocket\SocketException;

require('../../vendor/autoload.php');

try {
    $factory = new StreamFactory();
    $clientSocket = $factory->createClientSocket();

    $clientSocket->connect('127.0.0.1', 9000);

    // Read data from the server.
    echo $clientSocket->read(128);

    // Write data to the server.
    $clientSocket->write('My name is Bob.');
}
catch (SocketException $ex) {
    echo $ex->getMessage();
}