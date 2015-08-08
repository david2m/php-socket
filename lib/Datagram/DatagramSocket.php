<?php
namespace David2M\PHPSocket\Datagram;

use David2M\PHPSocket\Socket;
use David2M\PHPSocket\SocketException;

class DatagramSocket extends Socket
{

    /**
     * @param string $buf
     * @param int $len
     * @param int $flags
     * @param string $name
     * @param int $port
     *
     * @return int
     *
     * @throws SocketException
     */
    public function recvfrom(&$buf, $len, $flags, &$name, &$port = null)
    {
        $bytesReceived = socket_recvfrom($this->sock, $buf, $len, $flags, $name, $port);
        if ($bytesReceived === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $bytesReceived;
    }

    /**
     * @param string $buf
     * @param int $len
     * @param int $flags
     * @param string $address
     * @param int $port
     *
     * @return int
     *
     * @throws SocketException
     */
    public function sendto($buf, $len, $flags, $address, $port = 0)
    {
        $bytesSent = socket_sendto($this->sock, $buf, $len, $flags, $address, $port);
        if ($bytesSent === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $bytesSent;
    }

}