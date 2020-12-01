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


class WeatherRequest implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $curl = "";
    private $apiKey = "";

    public function setAPI(string $key)
    {
        $this->apiKey = $this->di->get("keystore")->getKey($key);
    }

    public function checkWeather(object $geoLocation)
    {
        // var_dump($geoLocation);
        // var_dump($geoLocation->getGeoLocation()["latitude"]);
        $lon = $geoLocation->getGeoLocation()->longitude;
        $lat = $geoLocation->getGeoLocation()->latitude;
        $this->geoInitCurl();
        $this->geoSetOptCurl($lat, $lon);
        $this->geoExecuteCurl();
        $this->geoCloseCurl();
    }

    public function checkWeatherMulti(string $latitude, string $longitude)
    {
        $multiRequests = [];

        for ($i = 0; $i < 5; $i++) {
            $unixTime = time() - ($i * 24 * 60 * 60);

            $multiRequests[] = 'https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=' . $latitude . '&lon=' . $longitude . '&dt=' . $unixTime . '&units=metric&appid=' . $this->apiKey;
        }

        $multiHandle = curl_multi_init();
        $curlArray = array();

        foreach ($multiRequests as $i => $url) {
            $curlArray[$i] = curl_init($url);
            curl_setopt($curlArray[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($multiHandle, $curlArray[$i]);
        }

        $running = null;
        do {
            usleep(10000);
            curl_multi_exec($multiHandle, $running);
        } while ($running > 0);

        $res = array();
        foreach ($multiRequests as $i => $url) {
            $res[$i] = json_decode(curl_multi_getcontent($curlArray[$i]));
        }

        foreach ($multiRequests as $i => $url) {
            curl_multi_remove_handle($multiHandle, $curlArray[$i]);
        }
        curl_multi_close($multiHandle);
        return $res;
    }

    private function geoInitCurl()
    {
        $this->curl = curl_init();
    }

    private function geoSetOptCurl($latitude, $longitude)
    {

        curl_setopt($this->curl, CURLOPT_URL, "https://api.openweathermap.org/data/2.5/onecall?lat=" . $latitude . "&lon=" . $longitude . "&units=metric&exclude=hourly,minutely&appid=" . $this->apiKey);
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

    public function getWeather()
    {
        return $this->geoLocation;
    }
}
