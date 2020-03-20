<?php
/**
 *
 * select * from core_resource where code like '%zendesk_setup%';
 * update core_resource set version = '2.0.6', data_version = '2.0.6' where code = 'zendesk_setup';
 *
 * select * from eav_attribute where entity_type_id IN (select entity_type_id from eav_entity_type where entity_type_code = 'customer');
 * select * from eav_attribute where attribute_code = 'zendesk_id';
 */

$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute("customer", "zendesk_id",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "Zendesk Id",
    "input"    => "text",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

));

$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "zendesk_id");
$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
$used_in_forms[]="adminhtml_checkout";
$attribute->setData("used_in_forms", $used_in_forms)
            ->setData("is_used_for_customer_segment", true)
            ->setData("is_system", 0)
            ->setData("is_user_defined", 1)
            ->setData("is_visible", 1)
            ->setData("sort_order", 100);
$attribute->save();
$installer->endSetup();
