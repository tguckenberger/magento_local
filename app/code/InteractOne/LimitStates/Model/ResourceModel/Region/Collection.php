<?php

namespace \InteractOne\LimitStates\Model\ResourceModel\Region;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Config\ScopeInterface;
use Magento\Framework\App\State;

class Collection extends Magento\Directory\Model\ResourceModel\Region\Collection
{    
    protected $_scopeConfig;
    protected $_scope;
    protected $_appState;

    public function __construct(ScopeConfigInterface $scopeConfig, ScopeInterface $scope, State $appState) {
	$this->_scopeConfig = $scopeConfig;
	$this->_scope = $scope;
	$this->_appState = $appState;
	}


    public function addCountryFilter($countryId)
    {
        if (!empty($countryId)) {
            if (is_array($countryId)) {
                $this->addFieldToFilter('main_table.country_id', ['in' => $countryId]);
            } else {
                $this->addFieldToFilter('main_table.country_id', $countryId);
            }
        }

	$allowedRegions = $this->_scopeConfig->getValue('InteractOne/basic/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
	if($this->scope->getCurrentScope() != \Magento\Framework\App\Area::AREA_ADMINHTML 
	&& $this->appState->getAreaCode() != \Magento\Framework\App\Area::AREA_ADMINHTML){
		if($countryId == "US" || in_array("US", $countryId) || (is_array($countryId) && implode($countryId) == "US")) {
                $this->addUSRegionNameFilter(explode(",", $allowedRegions));
            }
	}

        return $this;
    }

    public function addUSRegionNameFilter($regionName){

	if (!empty($regionName)) {
            if (is_array($regionName)) {
                $this->addFieldToFilter(array('main_table.default_name', 'main_table.country_id'), array(
                  array('in' => $regionName),
                  array('neq' => 'US')
                ));
            } else {
                $this->addFieldToFilter(array('main_table.default_name', 'main_table.country_id'), array(
                  array('eq' => $regionName),
                  array('neq' => 'US')
                ));
            }
        }
        return $this;



    }

}
