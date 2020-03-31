<?php


namespace Mageplaza\HelloWorld\Model\Data;

use Mageplaza\HelloWorld\Api\Data\StoreInterface;

/**
 * Class Store
 *
 * @package Mageplaza\HelloWorld\Model\Data
 */
class Store extends \Magento\Framework\Api\AbstractExtensibleObject implements StoreInterface
{

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId()
    {
        return $this->_get(self::STORE_ID);
    }

    /**
     * Set store_id
     * @param string $storeId
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Mageplaza\HelloWorld\Api\Data\StoreExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Mageplaza\HelloWorld\Api\Data\StoreExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Mageplaza\HelloWorld\Api\Data\StoreExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get content
     * @return string|null
     */
    public function getContent()
    {
        return $this->_get(self::CONTENT);
    }

    /**
     * Set content
     * @param string $content
     * @return \Mageplaza\HelloWorld\Api\Data\StoreInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}

