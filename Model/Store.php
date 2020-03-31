<?php


namespace Mageplaza\HelloWorld\Model;

use Magento\Framework\Api\DataObjectHelper;
use Mageplaza\HelloWorld\Api\Data\StoreInterface;
use Mageplaza\HelloWorld\Api\Data\StoreInterfaceFactory;

/**
 * Class Store
 *
 * @package Mageplaza\HelloWorld\Model
 */
class Store extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'mageplaza_helloworld_store';
    protected $storeDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param StoreInterfaceFactory $storeDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Mageplaza\HelloWorld\Model\ResourceModel\Store $resource
     * @param \Mageplaza\HelloWorld\Model\ResourceModel\Store\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        StoreInterfaceFactory $storeDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Mageplaza\HelloWorld\Model\ResourceModel\Store $resource,
        \Mageplaza\HelloWorld\Model\ResourceModel\Store\Collection $resourceCollection,
        array $data = []
    ) {
        $this->storeDataFactory = $storeDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve store model with store data
     * @return StoreInterface
     */
    public function getDataModel()
    {
        $storeData = $this->getData();
        
        $storeDataObject = $this->storeDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $storeDataObject,
            $storeData,
            StoreInterface::class
        );
        
        return $storeDataObject;
    }
}

