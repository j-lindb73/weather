<?php

namespace Lefty\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherRequestTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // Use a different cache dir for unit test
        // $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->weather = new WeatherRequest();
        $this->weather->setDI($this->di);


        // $this->weather->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testCheckWeather()
    {

        $geoLocation = new WeatherGeoLocation();

        $geoL = (object) [
            "latitude" => 56.16122055053711,
            "longitude" => 15.586899757385254,
            "city" => "Karlskrona"
        ];

        $geoLocation->setGeoLocation($geoL);



        $this->weather->checkWeather($geoLocation);
        // $this->weather->checkWeather("10","10");

        $res = $this->weather->getWeather();

        $this->assertContains("Invalid API key", $res->message);
    }

    /**
     * Test the route "index".
     */
    public function testCheckWeatherMulti()
    {
        $res = $this->weather->checkWeatherMulti("10", "10");


        $this->assertContains("Invalid API key", $res[0]->message);
    }
}
