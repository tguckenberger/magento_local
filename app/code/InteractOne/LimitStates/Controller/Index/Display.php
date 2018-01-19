<?php
namespace InteractOne\LimitStates\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
    protected $stateFactory;
    private $_objectManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \InteractOne\LimitStates\Model\StateFactory $stateFactory,
        \Magento\Framework\ObjectManagerInterface $objectmanager

    )
    {
        $this->stateFactory = $stateFactory;
        $this->_objectManager = $objectmanager;
        return parent::__construct($context);
    }
    public function execute() {
        $countryFactory = $this->_objectManager->get('Magento\Directory\Model\CountryFactory');
//        // TODO: get rid of first index
        $stateArray = $countryFactory->create()->setId('US')->getLoadedRegionCollection()->toOptionArray();
        // TODO: don't use object manager directly
        $stateIndex = $this->_objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('general/region/limit_states');
        // TODO: make the stateIndex definition one line
        $stateIndex = explode(',',$stateIndex);
        // Set all states to false
//        foreach ($stateArray as $stateRef) {
//            // TODO: Update data to set it as false, DON'T ADD NEW DATA
//            $state = $this->stateFactory->create();
//            $state->setData(array(
//                'name' => $stateRef['title'],
//                'state_allowed' => false
//            ));
//            $state->save();
//        }
//        echo '<br><br>';
        // Set selected states to true
        foreach ($stateIndex as $stateRef) {
            // Update selected states to be true
            $state = $this->stateFactory->create();
            $state->load($stateArray[$stateRef]['value'])->addData(
                array(
                    'name' => $stateArray[$stateRef]['title'],
                    'state_allowed' => True
                ));
            $state->save();
        }
    }
}
