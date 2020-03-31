<?php


namespace Mageplaza\HelloWorld\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface StoreRepositoryInterface
 *
 * @package Mageplaza\HelloWorld\Api
 */
interface StoreRepositoryInterface
{

    /**
     * Save Store
     * @param \Mageplaza\HelloWorld\Api\Data\StoreInterface $store
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Mageplaza\HelloWorld\Api\Data\StoreInterface $store
    );

    /**
     * Retrieve Store
     * @param string $storeId
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($storeId);

    /**
     * Retrieve Store matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mageplaza\HelloWorld\Api\Data\StoreSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Store
     * @param \Mageplaza\HelloWorld\Api\Data\StoreInterface $store
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Mageplaza\HelloWorld\Api\Data\StoreInterface $store
    );

    /**
     * Delete Store by ID
     * @param string $storeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($storeId);
}

