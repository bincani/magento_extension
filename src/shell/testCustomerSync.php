<?php
/**
php -f testCustomerSync.php

*/
//require_once './../abstract.php';
require_once './../../../../shell/abstract.php';

class Mage_Shell_Test extends Mage_Shell_Abstract {

    public function run() {
        try {
            echo sprintf("%s->syncronize\n", __METHOD__);
            Mage::getModel('zendesk/customer')->syncronize();
        }
        catch(Exception $ex) {
            echo sprintf("Error: %s\n", $ex->getMessage());
        }
    }
}
$shell = new Mage_Shell_Test();
$shell->run();
