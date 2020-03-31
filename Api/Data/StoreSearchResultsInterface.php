<?php


namespace Mageplaza\HelloWorld\Api\Data;

/**
 * Interface StoreSearchResultsInterface
 *
 * @package Mageplaza\HelloWorld\Api\Data
 */
interface StoreSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Store list.
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface[]
     */
    public function getItems();

    /**
     * Set Store_id list.
     * @param \Mageplaza\HelloWorld\Api\Data\StoreInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

