<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Forecast",
            "mount" => "weather",
            "handler" => "\Lefty\Weather\WeatherController",
        ],
    ]
];
