# Anax Weather Module

Install as Anax module
------------------------------------
This is how you install the module into an existing Anax installation, for example an installation of `[anax/anax](https://github.com/canax/anax)`.

There are two steps in the installation procedure, 1) first install the module using composer and then 2) integrate it into you Anax base installation.


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

Once API-key is collected create file ```data/PRIVATE_TOKEN``` containing ONLY the key in one row.

Additional keys can be configured in ```config/keystore.php```.

**API-keys used in this module that need to be configured**
Geographic localization: [ipstack](https://ipstack.com/)
Weather data: [OpenWeather global services](https://openweathermap.org/)

* Only free-of-charge subscription is used *


#### Styling ####

To get some control over styling, add following to css

```
#map {
    border: 1px solid black;
    height: 200px;
    width: 200px;
    z-index: 0;
}

.flex-container {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
  }

```