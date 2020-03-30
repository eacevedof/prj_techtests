<?php
namespace League\Base;

/**
 * Permite el acceso al único endpoint pero tambien se puede reconfigurar
 * para consumir otro
 */
class Api
{
    const DEFAULT_ENDPOINT = "http://localhost:3600";
    const DEFAULT_TYPE = "fixture";
    
    private $url = "";
    private $type = "";
    private $params = [];
    
    /**
     * Customizar el endpoint  
     * @param type $url unico endpoint
     * @param type $type el set: fixture|match
     */
    public function __construct($url=self::DEFAULT_ENDPOINT,$type= self::DEFAULT_TYPE) 
    {
        $this->url = $url;
        $this->type = $type;
        $this->params = [];
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
    
    private function _get_with_params($url)
    {
        if(!$this->params)
            return $url;
        
        $tmp = [];
        foreach($this->params as $k => $v)
            $tmp[] = "$k=$v";
        
        $strparams = implode("&",$tmp);
        return $url."&".$strparams;
    }
    
    public function get_data()
    {
        $url = $this->url."?set=$this->type";
        $url = $this->_get_with_params($url);
        return $this->_get_response($url);
    }
    
    public function set_endpoint($url= self::DEFAULT_ENDPOINT)
    {
        $this->url = $url;
        return $this;
    }
    
    public function set_type($type=self::DEFAULT_TYPE)
    {
        $this->type = $type;
        return $this;
    }
    
    public function add_param($key,$val)
    {
        $this->params[$key] = $val;
        return $this;
    }
    
    public function reset_params(){$this->params = []; return $this;}
    
}
