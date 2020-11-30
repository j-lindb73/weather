# Anax Weather Module

Install as Anax module
------------------------------------
This is how you install the module into an existing Anax installation, for example an installation of `[anax/anax](https://github.com/canax/anax)`.

(If you don't have an Anax installation you can use a light-weight installation for test. See  **ramverk1-me-v2** headline at the bottom)

There are two steps in the installation procedure, 1) first install the module using composer and then 2-3) integrate it into you Anax base installation.


### Step 1, install using composer.

Install the module using composer.

```
composer require lefty/weather
```

You will have to modify your composer file, by adding the following line to the autoload section under like this.

```
    "autoload": {
        "psr-4": {
            "Anax\\": "src/",
            "Lefty\\": "src/"
        }
    }
```
Once you have modified the composer file, you will need to do composer Update to activate namespace.
```
composer update
```

### Step 2, integrate into your Anax base.

Make use of scaffolding to integrate module parts in Anax

Run bash script
```
$ bash vendor/lefty/weather/.anax/scaffold/postprocess.d/6xx_weather.bash
```

### Step 3, API configuration

This module use data from APIs and require API-keys to function properly

Place API-key in file ```data/PRIVATE_TOKEN``` containing ONLY the key in one row.

Additional keys can be configured in ```config/keystore.php```.

**API-keys used in this module that need to be configured**

* Geographic localization: [ipstack](https://ipstack.com/)
* Weather data: [OpenWeather global services](https://openweathermap.org/)

Only free-of-charge subscription is used


ramverk1-me-v2
------------------------------------
Install a sample Anax site for test

```
$ anax create testsite ramverk1-me-v2
$ cd testsite
```

### License

This software carries a MIT license.