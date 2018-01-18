<?php

namespace InteractOne\LimitStates\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Region {
    public function toOptionArray() {
        $allowedRegions = array();
        foreach(Mage::getModel('directory/region_api')->items("US") as $region) {
            $allowedRegions[] = array('value' => $region["name"], 'label' =>$region["name"]);
        }
        Mage::log($allowedRegions);
        return $allowedRegions;
    }
}
