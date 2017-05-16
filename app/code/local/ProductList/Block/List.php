<?php

class Ecommistry_ProductList_Block_List extends Mage_Catalog_Block_Product_Abstract
{	
	protected $_defaultToolbarBlock = 'ecommistry_productlist/toolbar';
	
	protected $_productCollection;
	
	protected function _getProductCollection() {
			
		if (is_null($this->_productCollection)) {
			
			$limit = Mage::getStoreConfig('ecommistry/configuration/limit');			
				
			$collection = Mage::getResourceModel('catalog/product_collection')
					->addAttributeToSelect('*')
					->addStoreFilter()
					->addAttributeToFilter('status', array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED))
					->addAttributeToFilter('handle_display', 1)                					
					->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds())
					->setPageSize($limit);			
			
			Mage::getSingleton('cataloginventory/stock')
				->addInStockFilterToCollection($collection);				
			
				
			$this->_productCollection = $collection;
		
        }
        return $this->_productCollection;
		
		
	}
	
	public function getLoadedProductCollection() {
		
		return $this->_getProductCollection();
		
	}
	
	public function getToolbarBlock()
    {
        if ($blockName = $this->getToolbarBlockName()) {
            if ($block = $this->getLayout()->getBlock($blockName)) {
                return $block;
            }
        }
        $block = $this->getLayout()->createBlock($this->_defaultToolbarBlock, microtime());
		
        return $block;
    }
	
	public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }
	
	public function getMode()
    {
        return $this->getChild('toolbar')->getCurrentMode();
    }	
	
	protected function _beforeToHtml()
    {
        $toolbar = $this->getToolbarBlock();

        // called prepare sortable parameters
        $collection = $this->_getProductCollection();

        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }
        if ($dir = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }
        if ($modes = $this->getModes()) {			
            $toolbar->setModes($modes);
        }

        // set collection to toolbar and apply sort
        $toolbar->setCollection($collection);

        $this->setChild('toolbar', $toolbar);      
        $this->_getProductCollection()->load();

        return parent::_beforeToHtml();
    }
	
	/*
	* Load css and js files if this block is called.
	*/	
	public function addItem($type, $path)
	{
		$head = $this->getLayout()->getBlock('head');
		
		if($type == 'css') {
			$head->addCss($path);
		}elseif($type == 'javascript') {
			$head->addItem('skin_js', $path);
		}
		return true;
	}

	
}