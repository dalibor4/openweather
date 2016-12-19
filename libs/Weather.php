<?php

class OWCredentials 
{
    #OW stands for OpenWeather
    private $_OWAPIKey;
    private $_OWAPIUrl;

    function __construct( $_OWAPIKey, $_OWAPIUrl ) 
    {
        if(empty( $_OWAPIKey ) ) 
        {
            throw new \Exception('No OpenWeather API given');
        }
        
        if(empty( $_OWAPIUrl ) ) 
        {
            throw new \Exception('No OpenWeather URL given');
        }
        
        $this->_OWAPIKey = $_OWAPIKey;
        $this->_OWAPIUrl = $_OWAPIUrl;
    }

    public function getOWApi() 
    {
        return $this->_OWAPIKey;
    }

    public function getOWUrl() 
    {
        return $this->_OWAPIUrl;
    }

}

class OWPrepare 
{   
    private $_credentials;

    function __construct(OWCredentials $credentials) 
    {
        $this->_credentials = array(
                'key' => $credentials->getOWApi(),
                'url' => $credentials->getOWUrl(),
            );        
    }
    
    public function setUrlParams( $params = array() )
    {
        $url = $this->_credentials['url'] 
                . '?q=' . urlencode($params['city']) . ',' . urlencode($params['country']) 
                . '&appid=' . $this->_credentials['key'] ; 
        
        return $url;
    }

    static function Execute($url) 
    {
        $curl = curl_init($url);
        
        curl_setopt($curl,CURLOPT_URL,$url);        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $curl_response = curl_exec($curl);
        
        if ($curl_response === false) 
        {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('Error occured during curl exec. Additioanl info: ' . var_export($info));
        }

        curl_close($curl);
        
        $decoded = json_decode($curl_response);
        
        return $curl_response;
    }
    
    static function setWeatherToJsonFile($output) 
    {
        file_put_contents(APP_DATA_PATH . '/' . time() . '.json', $output);
    }
    
    static function getWeatherFromJson() 
    {
        $jsons = scandir(APP_DATA_PATH, SCANDIR_SORT_DESCENDING); 
        $json = file_get_contents(APP_DATA_PATH . '/' . $jsons[0]);
                
        echo $json;
    }
}