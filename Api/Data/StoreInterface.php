<?php


namespace Mageplaza\HelloWorld\Api\Data;

/**
 * Interface StoreInterface
 *
 * @package Mageplaza\HelloWorld\Api\Data
 */
interface StoreInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CONTENT = 'content';
    const STORE_ID = 'store_id';
    const STORE_ID = 'Store_id';

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface
     */
    public function setStoreId($storeId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Mageplaza\HelloWorld\Api\Data\StoreExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Mageplaza\HelloWorld\Api\Data\StoreExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Mageplaza\HelloWorld\Api\Data\StoreExtensionInterface $extensionAttributes
    );

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface
     */
    public function setContent($content);
}

