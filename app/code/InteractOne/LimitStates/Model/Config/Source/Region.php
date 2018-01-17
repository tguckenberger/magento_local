<?php

namespace InteractOne\LimitStates\Model\Config\Source;

use Magento\Directory\Model\CountryFactory;

class Region implements \Magento\Framework\Option\ArrayInterface {

    protected $_country;

    public function __construct(CountryFactory $countryFactory) {
        $this->_country = $countryFactory;
    }

    // Returns an array of states, via country code US.
    public function toOptionArray() {
            $stateArray = $this->_country->create()->setID('US')->getLoadedRegionCollection()->toOptionArray();
            $stateArray = array_slice($stateArray, 1, count($stateArray)-1);
            return $stateArray;
    }

}
