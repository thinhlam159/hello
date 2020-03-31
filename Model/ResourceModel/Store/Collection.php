<?php


namespace Mageplaza\HelloWorld\Model\ResourceModel\Store;

/**
 * Class Collection
 *
 * @package Mageplaza\HelloWorld\Model\ResourceModel\Store
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'store_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Mageplaza\HelloWorld\Model\Store::class,
            \Mageplaza\HelloWorld\Model\ResourceModel\Store::class
        );
    }
}

