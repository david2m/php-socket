<?php
use David2M\PHPSocket\Stream\StreamFactory;
use David2M\PHPSocket\SocketException;

require('../../vendor/autoload.php');
require('TcpServer.php');
require('TcpListener.php');
require('App.php');

try {
    $factory = new StreamFactory();
    $serverSocket = $factory->createServerSocket();

    $tcpServer = new TcpServer($serverSocket);
    $tcpServer->addListener(new App());

    $tcpServer->start('127.0.0.1', 9000);
}
catch (SocketException $ex) {
    echo $ex->getMessage();
}