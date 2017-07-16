<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Paytron_Paytroncheckout_Model_Currency
{
    public function toOptionArray(){
        return [
                ['value' => 'NGN' , 'label' => 'naira (NGN) '],
                ['value' => 'USD' , 'label' => 'dollars (US) '],
                ['value' => 'GBP' , 'label' => 'pounds (GBP) '],
                ['value' => 'EUR' , 'label' => 'euro (EUR) ']
        ];
    }
}