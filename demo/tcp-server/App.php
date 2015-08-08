<?php
use David2M\PHPSocket\Stream\ClientSocket;
use David2M\PHPSocket\SocketException;

class App implements TcpListener
{

    public function onOpen(ClientSocket $clientSocket)
    {
        // Send message to the client telling them they are connected to the app.
        $clientSocket->write('You are connected to the app!');
    }

    public function onClose(ClientSocket $clientSocket)
    {
        // Disconnect client from app.
    }

    public function onMessage(ClientSocket $clientSocket, $message)
    {
        // Handle messages sent by the client.
        echo 'Client #' . $clientSocket->getId() . ': ' . $message . "\r\n";
    }

    public function onError(ClientSocket $client, SocketException $ex)
    {
        // Handle the exception.
    }

}