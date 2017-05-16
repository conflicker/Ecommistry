<?php

class Ecommistry_ProductList_CustomerController extends Mage_Core_Controller_Front_Action
{   
   
    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        
        Mage::getSingleton('core/session')
                ->addSuccess($this->__('Oops, please login or create an account.'));
        }
    }
	
	public function indexAction() {
		$this->loadLayout();  
		$this->renderLayout();		
	}
   
}   