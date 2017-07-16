<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Paytron_Paytroncheckout_PaymentController extends Mage_Core_Controller_Front_Action
{
    
    public function redirectAction()
    {
        $this->loadLayout();   
        $this->renderLayout();
    }
    
    
    public function processAction(){
      //$paymentMethod = Mage::getSingleton('paytroncheckout/paymentMethod');
            
        $paymentStatus = $this->getRequest()->get("paytron-res");
        $orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
        $order   = Mage::getSingleton('sales/order')->loadByIncrementId($orderId);

        if(strtoupper($paymentStatus)  !== 'SUCCESS' ){
            $order->setState( Mage_Sales_Model_Order::STATE_HOLDED, true);
            $redirect_url = 'checkout/onepage/failure';
        }else{
            $order->setState( Mage_Sales_Model_Order::STATE_PROCESSING, true);
            $redirect_url = 'checkout/onepage/success';
        }
              
      $order->save();
      Mage::getSingleton('ravecheckout/order')->resetOrder();
      Mage_Core_Controller_Varien_Action::_redirect($redirect_url, array('_secure' => false));   
    }
    
    
    
    
    
    
    
    
}