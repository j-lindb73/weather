<?php
/**
 * Configuration file for DI container.
 */
return [
    // Services to add to the container.
    "services" => [
        "keystore" => [
            "shared" => true,
            //"callback" => "\Anax\Response\Response",
            "callback" => function () {
                $keystore = new \Lefty\KeyStore\KeyStore();
                $keystore->setDI($this);

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("keystore.php");
                $keys = $config["config"]["keys"];
                // var_dump($keys);
                // $keys = require ANAX_INSTALL_PATH . "/config/keystore.php";
                $keystore->setKeys($keys);
                // var_dump($keystore);

                return $keystore;
            }
        ],
    ],
];
