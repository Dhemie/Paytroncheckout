<?php
class Paytron_Paytroncheckout_Model_PaymentMethod extends Mage_Payment_Model_Method_Abstract {

  protected $_code = "paytroncheckout";
    
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('paytroncheckout/payment/redirect', array('_secure' => false));
  }
}