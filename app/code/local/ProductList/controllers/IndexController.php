<?php

class Ecommistry_ProductList_IndexController extends Mage_Core_Controller_Front_Action
{
	public function preDispatch()
    {
        parent::preDispatch();
    }
	
	public function indexAction()
    {		
		
        $this->loadLayout();
        $this->renderLayout();
    }
}