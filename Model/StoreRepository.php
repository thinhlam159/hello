<?php


namespace Mageplaza\HelloWorld\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Mageplaza\HelloWorld\Api\Data\StoreSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Mageplaza\HelloWorld\Api\Data\StoreInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Mageplaza\HelloWorld\Api\StoreRepositoryInterface;
use Mageplaza\HelloWorld\Model\ResourceModel\Store\CollectionFactory as StoreCollectionFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Mageplaza\HelloWorld\Model\ResourceModel\Store as ResourceStore;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

/**
 * Class StoreRepository
 *
 * @package Mageplaza\HelloWorld\Model
 */
class StoreRepository implements StoreRepositoryInterface
{

    protected $storeFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $storeCollectionFactory;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $resource;

    private $storeManager;

    protected $extensibleDataObjectConverter;
    protected $dataStoreFactory;


    /**
     * @param ResourceStore $resource
     * @param StoreFactory $storeFactory
     * @param StoreInterfaceFactory $dataStoreFactory
     * @param StoreCollectionFactory $storeCollectionFactory
     * @param StoreSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceStore $resource,
        StoreFactory $storeFactory,
        StoreInterfaceFactory $dataStoreFactory,
        StoreCollectionFactory $storeCollectionFactory,
        StoreSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->storeFactory = $storeFactory;
        $this->storeCollectionFactory = $storeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataStoreFactory = $dataStoreFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Mageplaza\HelloWorld\Api\Data\StoreInterface $store
    ) {
        /* if (empty($store->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $store->setStoreId($storeId);
        } */
        
        $storeData = $this->extensibleDataObjectConverter->toNestedArray(
            $store,
            [],
            \Mageplaza\HelloWorld\Api\Data\StoreInterface::class
        );
        
        $storeModel = $this->storeFactory->create()->setData($storeData);
        
        try {
            $this->resource->save($storeModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the store: %1',
                $exception->getMessage()
            ));
        }
        return $storeModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($storeId)
    {
        $store = $this->storeFactory->create();
        $this->resource->load($store, $storeId);
        if (!$store->getId()) {
            throw new NoSuchEntityException(__('Store with id "%1" does not exist.', $storeId));
        }
        return $store->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->storeCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Mageplaza\HelloWorld\Api\Data\StoreInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Mageplaza\HelloWorld\Api\Data\StoreInterface $store
    ) {
        try {
            $storeModel = $this->storeFactory->create();
            $this->resource->load($storeModel, $store->getStoreId());
            $this->resource->delete($storeModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Store: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($storeId)
    {
        return $this->delete($this->get($storeId));
    }
}

