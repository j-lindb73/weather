<?php

namespace Lefty\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
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
        $this->controller = new WeatherController();
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

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertContains("Kolla vädret", $body);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionGetLocalIp()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "10.0.0.1");


        $res = $this->controller->indexActionGet();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertContains("Ingen väderinformation tillgänglig", $body);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionGetBadIp()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "8.8.8.8.8");


        $res = $this->controller->indexActionGet();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertContains("is not a valid IP", $body);
    }
    /**
     * Test the route "index".
     */
    public function testIndexActionGetNoIp()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "");


        $res = $this->controller->indexActionGet();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertNotContains("is not a valid IP", $body);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "8.8.8.8");
        // var_dump($request);

        $res = $this->controller->indexActionPost();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertContains("Kolla vädret", $body);
    }

        /**
     * Test the route "index".
     */
    public function testIndexActionPostLocalIp()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "10.0.0.1");


        $res = $this->controller->indexActionPost();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertContains("Ingen väderinformation tillgänglig", $body);
    }


    /**
     * Test the route "index".
     */
    public function testIndexActionPostBadIp()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "8.8.8.8.8");
        // var_dump($request);

        $res = $this->controller->indexActionPost();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertContains("is not a valid IP", $body);
    }

        /**
     * Test the route "index".
     */
    public function testIndexActionPostNoIp()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "");


        $res = $this->controller->indexActionPost();

        $body = $res->getBody();

        // var_dump($body);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        $this->assertNotContains("is not a valid IP", $body);
    }
}
