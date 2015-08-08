<?php
namespace David2M\PHPSocket;

abstract class Socket
{

    /* @var resource */
    protected $sock;

    /**
     * @param resource $sock
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($sock)
    {
        if (!is_resource($sock)) {
            throw new \InvalidArgumentException(__CLASS__ . '::__construct()::$sock must be a valid socket resource.');
        }

        $this->sock = $sock;
    }

    public function __destruct()
    {
        if (is_resource($this->sock)) {
            $this->close();
        }
    }

    /**
     * @return resource
     */
    public function getSock()
    {
        return $this->sock;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int) $this->sock;
    }

    public function clearError()
    {
        socket_clear_error($this->sock);
    }

    public function close()
    {
        socket_close($this->sock);
    }

    /**
     * @param int $level
     * @param int $optname
     *
     * @return mixed
     */
    public function getOption($level, $optname)
    {
        return socket_get_option($this->sock, $level, $optname);
    }

    /**
     * @param string $address
     * @param int|null $port
     *
     * @throws SocketException
     */
    public function getpeername(&$address, &$port = null)
    {
        if (socket_getpeername($this->sock, $address, $port) === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }
    }

    /**
     * @param string $address
     * @param int|null $port
     *
     * @throws SocketException
     */
    public function getsockname(&$address, &$port = null)
    {
        if (socket_getsockname($this->sock, $address, $port) === false) {
            throw new SocketException($this->strerror(), $this->lastError());
        }
    }

    /**
     * @return int
     */
    public function lastError()
    {
        return socket_last_error($this->sock);
    }

    /**
     * @return bool
     */
    public function setBlock()
    {
        return socket_set_block($this->sock);
    }

    /**
     * @return bool
     */
    public function setNonblock()
    {
        return socket_set_nonblock($this->sock);
    }

    /**
     * @param int $level
     * @param int $optname
     * @param mixed $optval
     *
     * @return bool
     */
    public function setOption($level, $optname, $optval)
    {
        return socket_set_option($this->sock, $level, $optname, $optval);
    }

    /**
     * @param int $how
     *
     * @return bool
     */
    public function shutdown($how = 2)
    {
        return socket_shutdown($this->sock, $how);
    }

    /**
     * @return string
     */
    public function strerror()
    {
        return socket_strerror($this->lastError());
    }

}