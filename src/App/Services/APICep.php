<?php
    namespace Project\Services;

class APICep
{

    public function getCEP($request, $response, $args)
    {
        $ch = curl_init();  
    
        curl_setopt($ch,CURLOPT_URL,"https://viacep.com.br/ws/04184000/json/unicode/");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //  curl_setopt($ch,CURLOPT_HEADER, false); 
    
        $output=curl_exec($ch);
    
        curl_close($ch);

        return $output;
    }
    
}   