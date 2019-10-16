<?php
    namespace Project\Services;

class APICep
{

    public function getCEP($request, $response, $args)
    {
        $ch = curl_init();  
        $metadata = $request->getParsedBody();
        $url = "https://viacep.com.br/ws/".$metadata['id']."/json/unicode/";
    
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //  curl_setopt($ch,CURLOPT_HEADER, false); 
    
        $output=curl_exec($ch);
    
        curl_close($ch);

        return $output;
    }
    
}   