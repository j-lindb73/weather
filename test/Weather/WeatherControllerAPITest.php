<?php

namespace Lefty\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class WeatherControllerAPITest extends TestCase
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

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new WeatherControllerAPI();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }


    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {

        $request = $this->di->get("request");
        $request->setGet("ip", "8.8.8.8");

        $res = $this->controller->indexActionGet();
        $this->assertInternalType("array", $res);

        // var_dump($res);
        // echo($res[0]["ip"]);
        $json = $res[0];
        $exp = "8.8.8.8";
        $this->assertContains($exp, $json["ip"]);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {

        $request = $this->di->get("request");
        $request->setPost("ip", "8.8.8.8");

        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        // var_dump($res);
        // echo($res[0]["ip"]);
        $json = $res[0];
        $exp = "8.8.8.8";
        $this->assertContains($exp, $json["ip"]);
    }
}
