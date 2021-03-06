<?php

namespace InteractOne\LimitStates\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveStates implements ObserverInterface
{
    protected $stateFactory;
    protected  $countryFactory;
    protected  $scopeConfigInterface;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \InteractOne\LimitStates\Model\StateFactory $stateFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface
    )
    {
        $this->stateFactory = $stateFactory;
        $this->countryFactory = $countryFactory;
        $this->scopeConfigInterface = $scopeConfigInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $stateArray = $this->countryFactory->create()->setId('US')->getLoadedRegionCollection()->toOptionArray();
        // Remove 'Please select state' option from array
        unset($stateArray[0]);
        $ID = array_column($stateArray, 'value');
        $stateIndex = explode(',',$this->scopeConfigInterface->getValue('general/region/limit_states'));

        // Sets all states to false
        foreach ($ID as $stateRef) {
            $state = $this->stateFactory->create();
            $state->load($stateArray[$stateRef]['value'])->addData(
                array(
                    'name' => $stateArray[$stateRef]['title'],
                    'state_allowed' => false
                ));
            $state->save();
        }

        // Sets all selected state_allowed values to true
        foreach ($stateIndex as $stateRef) {
            $state = $this->stateFactory->create();
            $state->load($stateArray[$stateRef]['value'])->addData(
                array(
                    'name' => $stateArray[$stateRef]['title'],
                    'state_allowed' => true
                ));
            $state->save();
        }
    }


}