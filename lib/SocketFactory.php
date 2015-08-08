<?php
namespace David2M\PHPSocket;

class SocketFactory
{

    /**
     * @param int $domain
     * @param int $type
     * @param int $protocol
     *
     * @return resource
     *
     * @throws SocketException
     */
    public function create($domain, $type, $protocol)
    {
        $sock = socket_create($domain, $type, $protocol);

        if ($sock === false) {
            $lastError = socket_last_error();
            throw new SocketException(socket_strerror($lastError), $lastError);
        }

        return $sock;
    }

}