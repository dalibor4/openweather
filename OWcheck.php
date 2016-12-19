<?php

    require_once './includes/app.inc.php';
    require_once './libs/Weather.php';

    # OpenWeatherAPIKey, OpenWeatherAPIUrl set it in app.inc.php
    $OWC = new OWCredentials(OpenWeatherAPIKey, OpenWeatherAPIUrl);
    
    # OpenWeatherCity, OpenWeatherCountry set it in app.inc.php
    $params = array(
        'city'  =>  OpenWeatherCity,
        'country'  =>  OpenWeatherCountry
    );

    $OW = new OWPrepare($OWC);

    $output = $OW::Execute($OW->setUrlParams($params));
    
    $OWObj = json_decode($output);
    
    # Save just for code 200. For all other codes skip save and read it from last json file.
    if($OWObj->cod == 200) 
    {
        /*Save json file*/
        $OW::setWeatherToJsonFile($output);
    } 
    
    # Get json file and read it
    $OW::getWeatherFromJson();
