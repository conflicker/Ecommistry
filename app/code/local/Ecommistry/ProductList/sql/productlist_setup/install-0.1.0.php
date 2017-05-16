<?php

$installer = $this;

$installer->startSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$attributeCode = 'handle_display';

$setup->removeAttribute('catalog_product', $attributeCode);
$setup->addAttribute('catalog_product', $attributeCode, array(
  'type'              => 'int',
  'backend'           => '',
  'frontend'          => '',
  'label'             => 'Handle Display',
  'input'             => 'boolean',
  'class'             => '',
  'source'            => 'eav/entity_attribute_source_boolean',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'visible'           => true,
  'required'          => false,
  'user_defined'      => false,
  'default'           => '',
  'searchable'        => false,
  'filterable'        => false,
  'comparable'        => false,
  'visible_on_front'  => false,
  'unique'            => false,
  'group'             => 'General'
));

$installer->endSetup();
