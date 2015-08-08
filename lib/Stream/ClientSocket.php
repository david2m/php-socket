<?php
namespace David2M\PHPSocket\Stream;

use David2M\PHPSocket\Socket;
use David2M\PHPSocket\SocketException;

class ClientSocket extends Socket
{

    /**
     * @param string $address
     * @param int $port
     *
     * @return ClientSocket
     *
     * @throws SocketException
     */
    public function connect($address, $port = 0)
    {
        if (socket_connect($this->sock, $address, $port) === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $this;
    }

    /**
     * @param int $length
     * @param int $type
     *
     * @return string
     *
     * @throws SocketException
     */
    public function read($length, $type = PHP_BINARY_READ)
    {
        $data = socket_read($this->sock, $length, $type);
        if ($data === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $data;
    }

    /**
     * @param string $buf
     * @param int $len
     * @param int $flags
     *
     * @return int
     *
     * @throws SocketException
     */
    public function recv(&$buf, $len, $flags)
    {
        $bytesReceived = socket_recv($this->sock, $buf, $len, $flags);
        if ($bytesReceived === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $bytesReceived;
    }

    /**
     * @param string $buf
     * @param int $len
     * @param int $flags
     *
     * @return int
     *
     * @throws SocketException
     */
    public function send($buf, $len, $flags)
    {
        $bytesSent = socket_send($this->sock, $buf, $len, $flags);
        if ($bytesSent === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $bytesSent;
    }

    /**
     * @param string $buffer
     * @param int $length
     *
     * @return int
     *
     * @throws SocketException
     */
    public function write($buffer, $length = 0)
    {
        $length = ($length === 0) ? strlen($buffer) : $length;

        $bytesWritten = socket_write($this->sock, $buffer, $length);
        if ($bytesWritten === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }

        return $bytesWritten;
    }

}