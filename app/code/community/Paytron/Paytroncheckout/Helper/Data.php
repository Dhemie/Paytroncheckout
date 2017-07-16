<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Paytron_Paytroncheckout_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    public function getConfigData($node){
        $data = Mage::getStoreConfig('payment/paytroncheckout/'.$node);
        return $data;
    }
            
    function getProcessUrl() {
        return Mage::getUrl('paytroncheckout/payment/process', array('_secure' => false));
    }
    
    
}