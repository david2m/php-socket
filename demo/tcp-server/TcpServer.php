<?php
use David2M\PHPSocket\Stream\ServerSocket;
use David2M\PHPSocket\Stream\ClientSocket;
use David2M\PHPSocket\SocketException;

class TcpServer
{

    /* @var ServerSocket */
    protected $serverSocket;

    /* @var TcpListener[] */
    protected $listeners = [];

    /* @var resource[] */
    protected $read = [];

    /* @var resource[] */
    protected $write = [];

    /* @var resource[] */
    protected $except = [];

    /* @var ClientSocket[] */
    protected $clientSockets = [];

    public function __construct(ServerSocket $serverSocket)
    {
        $this->serverSocket = $serverSocket;
    }

    public function addListener(TcpListener $listener)
    {
        $this->listeners[] = $listener;
        return $this;
    }

    public function start($address, $port)
    {
        try {
            $this->serverSocket
                ->bind($address, $port)
                ->listen();

            $this->console('Listening for connections on port ' . $port . '...');

            $socketId = $this->serverSocket->getId();
            $this->read[$socketId] = $this->serverSocket->getSock();

            while (true) {
                $this->select(null);
            }
        }
        catch (SocketException $ex) {
            $this->console($ex->getMessage());
        }
    }

    private function select($tv_sec, $tv_usec = 0)
    {
        $read = $this->read;
        $write = $this->write;
        $except = $this->except;

        if (socket_select($read, $write, $except, $tv_sec, $tv_usec) === false) {
            throw new SocketException(socket_strerror(socket_last_error()), socket_last_error());
        }

        foreach ($read as $sock) {
            if ($sock === $this->serverSocket->getSock()) {
                $this->accept();
            }
            else {
                $clientSocket = $this->clientSockets[(int) $sock];
                $this->read($clientSocket);
            }
        }
    }

    /**
     * Accept a connection on the server socket.
     */
    private function accept()
    {
        try {
            $clientSocket = $this->serverSocket->accept();

            $socketId = $clientSocket->getId();
            $this->read[$socketId] = $clientSocket->getSock();
            $this->clientSockets[$socketId] = $clientSocket;

            foreach ($this->listeners as $listener) {
                $listener->onOpen($clientSocket);
            }
        }
        catch (SocketException $ex) {
            $this->console($ex->getMessage());
        }
    }

    private function read(ClientSocket $clientSocket)
    {
        try {
            $message = $clientSocket->read(256);

            if ($message === '') {
                $this->close($clientSocket);
            }
            else {
                foreach ($this->listeners as $listener) {
                    $listener->onMessage($clientSocket, $message);
                }
            }
        }
        catch (SocketException $ex) {
            $this->close($clientSocket);
            $this->console($ex->getMessage());
        }
    }

    private function close(ClientSocket $clientSocket)
    {
        $socketId = $clientSocket->getId();
        unset($this->read[$socketId]);
        unset($this->clientSockets[$socketId]);

        foreach ($this->listeners as $listener) {
            $listener->onClose($clientSocket);
        }

        $clientSocket->close();

        $this->console('Socket #' . $socketId . ' disconnected.');
    }

    private function console($message)
    {
        echo $message . "\r\n";
    }

}