<?php
namespace David2M\PHPSocket\Stream;

use David2M\PHPSocket\SocketFactory;
use David2M\PHPSocket\SocketException;

class StreamFactory extends SocketFactory
{

    /**
     * @return ClientSocket
     *
     * @throws SocketException
     */
    public function createClientSocket()
    {
        return new ClientSocket($this->create(AF_INET, SOCK_STREAM, SOL_TCP));
    }

    /**
     * @return ServerSocket
     *
     * @throws SocketException
     */
    public function createServerSocket()
    {
        return new ServerSocket($this->create(AF_INET, SOCK_STREAM, SOL_TCP));
    }

}