<?php
/**
 * Created by PhpStorm.
 * User: tristanguckenberger
 * Date: 1/18/18
 * Time: 11:14 AM
 */

namespace InteractOne\LimitStates\Model\ResourceModel;

class State extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }
    protected function _construct()
    {
        $this->_init('interactone_states', 'state_id');
    }
}