<?php
namespace InteractOne\LimitStates\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
    protected $stateFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Interactone\LimitStates\Model\StateFactory $stateFactory
    )
    {
        $this->stateFactory = $stateFactory;
        return parent::__construct($context);
    }

    public function execute() {
        $countryFactory = $this->_objectManager->get('Magento\Directory\Model\CountryFactory');
        $stateArray = $countryFactory->create()->setId('US')->getLoadedRegionCollection()->toOptionArray(); //Get all regions for the given ISO country code

        $stateIndex = $this->_objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('InteractOne/basic/enabled');
        var_dump($stateArray[$stateIndex]);



        $state = $this->stateFactory->create();
        $state->setData(array(
            'name' => "shitandgiggles",
            'state_allowed' => true
        ));
        $state->save();
        exit;
    }
}
