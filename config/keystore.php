<?php

return [
    "keys" => [
        "apiKey" =>  file_get_contents(ANAX_INSTALL_PATH."/data/PRIVATE_TOKEN"),
        "ipstack" =>  file_get_contents(ANAX_INSTALL_PATH."/data/PRIVATE_TOKEN"),
        "openweathermap" =>  file_get_contents(ANAX_INSTALL_PATH."/data/PRIVATE_TOKEN2"),
    ]
];
