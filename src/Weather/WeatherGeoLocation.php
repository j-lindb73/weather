<?php

namespace Lefty\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
*
*
*/


class WeatherGeoLocation implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $curl = "";
    private $geoLocation = "";
    private $apiKey = "";


    public function setAPI(string $key)
    {
        $this->apiKey = $this->di->get("keystore")->getKey($key);
    }

    public function checkGeoLocation($ipAddress)
    {
        // $this->apiKey = $this->di->get("keystore")->getKey("ipstack");
        $this->geoInitCurl();
        $this->geoSetOptCurl($ipAddress);
        $this->geoExecuteCurl();
        $this->geoCloseCurl();
    }

    private function geoInitCurl()
    {
        $this->curl = curl_init();
    }

    private function geoSetOptCurl($ipAddress)
    {
        curl_setopt($this->curl, CURLOPT_URL, "http://api.ipstack.com/" . $ipAddress . "?access_key=" . $this->apiKey . "&fields=latitude,longitude,city");
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
    }

    private function geoExecuteCurl()
    {
        $this->geoLocation = json_decode(curl_exec($this->curl));
    }

    private function geoCloseCurl()
    {
        curl_close($this->curl);
    }

    public function getGeoLocation()
    {
        return $this->geoLocation;
    }

    public function setGeoLocation($geoLocation)
    {
        $this->geoLocation = $geoLocation;
    }

    public function geoLocationOK()
    {

        if (!empty($this->geoLocation->longitude)) {
            return true;
        }

        return false;
    }
}
