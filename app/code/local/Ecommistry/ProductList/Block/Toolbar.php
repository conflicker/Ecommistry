<?php

class Ecommistry_ProductList_Block_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{
	
	protected function _construct() {
		parent::_construct();
		
		$this->_availableMode['slider'] = $this->__('Slider');
	}	
	
}