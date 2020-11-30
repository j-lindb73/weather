<?php

namespace Lefty\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */


class WeatherIpValidation implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $ipAddress = "";
    private $isValid = false;
    private $isValidIPv4 = false;
    private $isValidIPv6 = false;
    private $isValidMessage = " is not a valid IP";
    private $hostname;
    private $geoLocation = [];

    public function __construct(string $value)
    {
        $this->ipAddress = $value;
        $this->validate();
        // if ($this->isValidIPv4) {
        //     $this->geoLocation($this->ipAddress);
        // }
    }


    private function validate()
    {
        if (filter_var($this->ipAddress, FILTER_VALIDATE_IP)) {
            $this->isValid = true;
            $this->isValidIPv4 = boolval(filter_var($this->ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4));
            $this->isValidIPv6 = boolval(filter_var($this->ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6));
            $this->isValidMessage = " is a valid IP address";
            $this->hostname = gethostbyaddr($this->ipAddress);
        }
    }

    public function isValidIPv4()
    {
        return $this->isValidIPv4;
    }

    public function isValidIPv6()
    {
        return $this->isValidIPv6;
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function getIp()
    {
        return $this->ipAddress;
    }

    public function getGeoLocation()
    {
        return $this->geoLocation;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function isValidMessage()
    {
        return $this->isValidMessage;
    }


    public function answer()
    {

        $data = [
            "isValid" => $this->isValid(),
            "isValidIPv4" => $this->isValidIPv4(),
            "isValidIPv6" => $this->isValidIPv6(),
            "isValidMessage" => $this->isValidMessage(),
            "ip" => $this->getIp(),
            "hostname" => $this->getHostname(),
            "geoLocation" => $this->getGeoLocation()
            ];

        return $data;
    }
}
