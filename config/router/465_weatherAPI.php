<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Forecast",
            "mount" => "weatherAPI",
            "handler" => "\Lefty\Weather\WeatherControllerAPI",
        ],
    ]
];
