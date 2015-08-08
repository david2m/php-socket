<?php
namespace David2M\PHPSocket\Datagram;

use David2M\PHPSocket\SocketFactory;
use David2M\PHPSocket\SocketException;

class DatagramFactory extends SocketFactory
{

    /**
     * @return DatagramSocket
     *
     * @throws SocketException
     */
    public function createClientSocket()
    {
        return new DatagramSocket($this->create(AF_INET, SOCK_DGRAM, SOL_UDP));
    }

    /**
     * @return ServerSocket
     *
     * @throws SocketException
     */
    public function createServerSocket()
    {
        return new ServerSocket($this->create(AF_INET, SOCK_DGRAM, SOL_UDP));
    }

}