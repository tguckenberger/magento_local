<?php

namespace InteractOne\LimitStates\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $stateFactory;
    protected $_objectManager;
    protected  $countryFactory;
    protected  $scopeConfigInterface;

    public function __construct(
        \InteractOne\LimitStates\Model\State $stateFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory
    )
    {
        $this->stateFactory = $stateFactory;
        $this->countryFactory = $countryFactory;

    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $stateArray = $this->countryFactory->create()->setId('US')->getLoadedRegionCollection()->toOptionArray();
        unset($stateArray[0]);
        foreach ($stateArray as $stateRef) {
            $state = $this->stateFactory;
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