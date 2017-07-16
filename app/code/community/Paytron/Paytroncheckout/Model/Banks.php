<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Paytron_Paytroncheckout_Model_Banks
{   
    
    protected $url = 'http://moneywave.herokuapp.com/banks';


    private function getBanks(){        
        $ch = curl_init($this->url);
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST,1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
        curl_setopt($ch, CURLOPT_HEADER ,0); // DO NOT RETURN HTTP HEADERS
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1); // RETURN THE CONTENTS OF THE CALL
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // Timeout on connect (2 minutes)
        //execute post
        $result = curl_exec($ch);
        curl_close($ch);
        $json_body = json_decode($result);
        $banks = (array) $json_body->data;    
        
        
        return $banks;
        
    }

    
    
    public function toOptionArray(){
        
         $banks = $this->getBanks();
         $selectBank = [];
         
         foreach ($banks as $code => $bank ){
             array_push($selectBank, ['value' => $code , 'label' => $bank ]);
         }
        
        return $selectBank;
    }
}
