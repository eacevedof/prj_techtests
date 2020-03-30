<?php
namespace League\Base;

class Api
{
    const DEFAULT_ENDPOINT = "http://localhost:3600";
    const DEFAULT_TYPE = "fixture";
    
    private $url = "";
    private $type = "";
    
    /**
     * Customizar el endpoint  
     * @param type $url unico endpoint
     * @param type $type el set: fixture|match
     */
    public function __construct($url=self::DEFAULT_ENDPOINT,$type= self::DEFAULT_TYPE) 
    {
        $this->url = $url;
        $this->type = $type;
    }
 
    private function _get_response($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);  
    }
    
    public function get_data()
    {
        $url = $this->url."?set=$this->type";
        return $this->_get_response($url);
    }
    
    public function set_endpoint($url= self::DEFAULT_ENDPOINT)
    {
        $this->url = $url;
    }
    
    public function set_type($type=self::DEFAULT_TYPE)
    {
        $this->type = $type;
    }
    
}
