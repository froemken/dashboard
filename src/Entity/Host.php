<?php
namespace App\Entity;

/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 06.11.15
 * Time: 14:30
 */

class Host
{
    /**
     * @var string
     */
    protected $hostname = '';

    /**
     * @var int
     */
    protected $port = 80;

    /**
     * Returns the hostname
     *
     * @return string $hostname
     */
    public function getHostname() {
        return $this->hostname;
    }

    /**
     * Sets the hostname
     *
     * @param string $hostname
     * @return void
     */
    public function setHostname($hostname) {
        $this->hostname = (string)$hostname;
    }

    /**
     * Returns the port
     *
     * @return int $port
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * Sets the port
     *
     * @param int $port
     * @return void
     */
    public function setPort($port) {
        $this->port = (int)$port;
    }
}