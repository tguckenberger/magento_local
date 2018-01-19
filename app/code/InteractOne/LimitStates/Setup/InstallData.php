<?php

namespace InteractOne\LimitStates\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_stateFactory;
    protected $_objectManager;

    public function __construct(
        \InteractOne\LimitStates\Model\State $stateFactory,
        \Magento\Framework\ObjectManagerInterface $objectmanager
    )
    {
        $this->_stateFactory = $stateFactory;
        $this->_objectManager = $objectmanager;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $countryFactory = $this->_objectManager->get('Magento\Directory\Model\CountryFactory');
        $stateArray = $countryFactory->create()->setId('US')->getLoadedRegionCollection()->toOptionArray();
        unset($stateArray[0]);
        foreach ($stateArray as $stateRef) {
            $state = $this->_stateFactory;
            $state->setData(array(
                'name' => $stateRef['title'],
                'state_allowed' => false
            ));
            try {
                $state->save();
            } catch (\Exception $e) {
            }
        }
    }
}