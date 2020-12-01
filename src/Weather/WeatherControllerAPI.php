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
class WeatherControllerAPI implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize(): void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }


        /**
    * This is the index method action, it handles:
    * ANY METHOD mountpoint
    * ANY METHOD mountpoint/
    * ANY METHOD mountpoint/index
    *
    * @return object
    */
    public function indexActionGet(): array
    {
        $request     = $this->di->get("request");
        $iptocheck = $request->getGet("ip") ?? "";


        // Validate IP
        $ipAddress = new WeatherIpValidation($iptocheck);
        $data = $ipAddress->answer();

        // Get IP location
        $geoLocation = new WeatherGeoLocation($iptocheck);
        $geoLocation->setDI($this->di);
        $geoLocation->setAPI("ipstack");
        $geoLocation->checkGeoLocation($iptocheck);
        $locationInfo = $geoLocation->getGeoLocation();


        // Get Weather information
        if ($geoLocation->geoLocationOK() == true) {
            $weatherRequest = new WeatherRequest("openweathermap");
            $weatherRequest->setDI($this->di);
            $weatherRequest->setAPI("openweathermap");
            $weatherRequest->checkWeather($geoLocation);
            $weatherInfo = (array)$weatherRequest->getWeather();

            // Get Weather information Historical Data
            $weatherInfoHist = array("weatherInfoHistorical" => $weatherRequest->checkWeatherMulti($locationInfo->latitude, $locationInfo->longitude));
            $weatherInfo = array_merge($weatherInfo, $weatherInfoHist);



            // Merge location data with ip data
            $data = array_merge($data, (array)$locationInfo);
            $weatherArray = array("weatherInfo" => (array)$weatherInfo);
            $data = array_merge($data, $weatherArray);
            // $data = array_merge($data, (array)$weatherInfo);
        }

        return [$data];
    }

    /**
    * This is the index method action, it handles:
    * ANY METHOD mountpoint
    * ANY METHOD mountpoint/
    * ANY METHOD mountpoint/index
    *
    * @return object
    */
    public function indexActionPost(): array
    {
        $request     = $this->di->get("request");
        $iptocheck = $request->getPost("ip") ?? "";


        // Validate IP
        $ipAddress = new WeatherIpValidation($iptocheck);
        $data = $ipAddress->answer();

        // Get IP location
        $geoLocation = new WeatherGeoLocation($iptocheck);
        $geoLocation->setDI($this->di);
        $geoLocation->setAPI("ipstack");
        $geoLocation->checkGeoLocation($iptocheck);
        $locationInfo = $geoLocation->getGeoLocation();


        // Get Weather information
        if ($geoLocation->geoLocationOK() == true) {
            $weatherRequest = new WeatherRequest("openweathermap");
            $weatherRequest->setDI($this->di);
            $weatherRequest->setAPI("openweathermap");
            $weatherRequest->checkWeather($locationInfo->latitude, $locationInfo->longitude);
            $weatherInfo = (array)$weatherRequest->getWeather();

            // Get Weather information Historical Data
            $weatherInfoHist = array("weatherInfoHistorical" => $weatherRequest->checkWeatherMulti($locationInfo->latitude, $locationInfo->longitude));
            $weatherInfo = array_merge($weatherInfo, $weatherInfoHist);


            // Merge location data with ip data
            $data = array_merge($data, (array)$locationInfo);
            $weatherArray = array("weatherInfo" => (array)$weatherInfo);
            $data = array_merge($data, $weatherArray);
        }

        return [$data];
    }
}
