<?php

date_default_timezone_set('Europe/Belgrade');

define('APP_ROOT_PATH', realpath(__DIR__ . '/..'));

#OpenWeather data
#Define OpenWeatherAPIKey. Replace '' with your API key. For example: define('OpenWeatherAPIKey', '72a13481bb6908e9967a026ecce16560');
define('OpenWeatherAPIKey', '');
#Define OpenWeatherCountry. Replace '' with country code. For example: define('OpenWeatherCountry', 'RS');
define('OpenWeatherCountry', '');
#Define OpenWeatherCity. Replace '' with city code. For example: define('OpenWeatherCity', 'Novi Sad');
define('OpenWeatherCity', '');
define('OpenWeatherAPIUrl', 'http://api.openweathermap.org/data/2.5/weather');

define('PORTAL_NAME', 'OpenWeatherMap');

#Create data dir inside root dir (just for this example)
#Better solution is to create data dir above root dir
$_tmp = APP_ROOT_PATH . '/data/';
if ( !is_dir($_tmp) ) {
    mkdir($_tmp, 0777, true);
    chmod($_tmp, 0777);
}
define('APP_DATA_PATH', realpath($_tmp));
