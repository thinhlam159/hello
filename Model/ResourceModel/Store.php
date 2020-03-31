<?php


namespace Mageplaza\HelloWorld\Model\ResourceModel;

/**
 * Class Store
 *
 * @package Mageplaza\HelloWorld\Model\ResourceModel
 */
class Store extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mageplaza_helloworld_store', 'store_id');
    }
}

