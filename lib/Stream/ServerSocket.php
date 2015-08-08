<?php
namespace David2M\PHPSocket\Stream;

use David2M\PHPSocket\Socket;
use David2M\PHPSocket\SocketException;

class ServerSocket extends Socket
{

    /**
     * @return ClientSocket
     *
     * @throws SocketException
     */
    public function accept()
    {
        if (($sock = socket_accept($this->sock)) === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return new ClientSocket($sock);
    }

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

    /**
     * @param int $backlog
     *
     * @return ServerSocket
     *
     * @throws SocketException
     */
    public function listen($backlog = 0)
    {
        if (socket_listen($this->sock, $backlog) === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $this;
    }

}