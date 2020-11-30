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

                // var_dump($keys);
                $keys = require ANAX_INSTALL_PATH . "/test/config/keystore.php";
                // var_dump($keys);
                $keystore->setKeys($keys);
                // var_dump($keystore);

                return $keystore;
            }
        ],
    ],
];
