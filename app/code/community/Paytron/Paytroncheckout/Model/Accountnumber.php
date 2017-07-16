<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Paytron_Paytroncheckout_Model_Accountnumber extends Mage_Core_Model_Config_Data{

// Todo
// verify bank account number
// the problem now is how to get  the selected bank code
    
    protected $url = 'https://paytron.com.ng:8081/api/bankaccount/verify';



    private function verifyAccountNum(){        
        
        //this->getValue gets the account number on config save
        $postData = json_encode(["accountNumber" => $this->getValue(), "bankCode" => '564' ]); //test bank code
        
        $ch = curl_init($this->url);
        //set the url, POST data
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST,1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_POST,$postData);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
        curl_setopt($ch, CURLOPT_HEADER ,0); // DO NOT RETURN HTTP HEADERS
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1); // RETURN THE CONTENTS OF THE CALL
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // Timeout on connect (2 minutes)
        //execute post
        $result = curl_exec($ch);
        curl_close($ch);
        $json_body = json_decode($result);
        $response = (array) $json_body->data;    
        
        
        return $response;
        
    }

    
    
    
    
public function save() {   

        if(!$this->verifyAccountNum())//if account is not verified
        {
             Mage::getSingleton('core/session')->addError('your account number could not be verified!');
             return false;
        }

        return parent::save();  
    }
}