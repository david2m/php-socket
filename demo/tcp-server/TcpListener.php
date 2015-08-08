<?php
use David2M\PHPSocket\Stream\ClientSocket;
use David2M\PHPSocket\SocketException;

interface TcpListener
{

    /**
     * @param ClientSocket $clientSocketSocket
     */
    public function onOpen(ClientSocket $clientSocketSocket);

    /**
     * @param ClientSocket $clientSocketSocket
     */
    public function onClose(ClientSocket $clientSocketSocket);

    /**
     * @param ClientSocket $clientSocket
     * @param string $message
     */
    public function onMessage(ClientSocket $clientSocket, $message);

    /**
     * @param ClientSocket $clientSocket
     * @param SocketException $ex
     */
    public function onError(ClientSocket $clientSocket, SocketException $ex);

}