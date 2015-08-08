<?php
namespace David2M\PHPSocket\Datagram;

use David2M\PHPSocket\SocketException;

class ServerSocket extends DatagramSocket
{

    /**
     * @param string $address
     * @param int $port
     *
     * @return ServerSocket
     *
     * @throws SocketException
     */
    public function bind($address, $port = 0)
    {
        if (socket_bind($this->sock, $address, $port) === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $this;
    }

}