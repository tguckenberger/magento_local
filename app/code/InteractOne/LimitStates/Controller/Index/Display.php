<?php
namespace InteractOne\LimitStates\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
  public function __construct(
\Magento\Framework\App\Action\Context $context)
  {
    return parent::__construct($context);
  }

  public function execute()
  {


	$countryHelper = $this->_objectManager->get('Magento\Directory\Model\Config\Source\Country');
	$countryFactory = $this->_objectManager->get('Magento\Directory\Model\CountryFactory');
	$stateArray = $countryFactory->create()->setId('US')->getLoadedRegionCollection()->toOptionArray(); //Get all regions for the given ISO country code

     // var_dump($countryHelper);
      //var_dump($stateArray);
      //var_dump($countryFactory);
	var_dump($this->_objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('InteractOne/basic/enabled'));

    exit;
  }
}
