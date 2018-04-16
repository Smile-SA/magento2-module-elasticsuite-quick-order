<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteQuickOrder
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2018 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteQuickOrder\Model\ResourceModel\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product\Visibility;

/**
 * Custom Resource model for Product Suggest.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteQuickOrder
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class Suggest extends \Magento\QuickOrder\Model\ResourceModel\Product\Suggest
{
    /**
     * @var \Magento\QuickOrder\Model\CatalogPermissions\Permissions
     */
    private $permissions;

    /**
     * @var \Magento\Framework\DB\Helper
     */
    private $dbHelper;

    /**
     * Suggest constructor.
     *
     * @param \Magento\QuickOrder\Model\CatalogPermissions\Permissions        $permissions        Catalog Permissions
     * @param \Magento\Framework\Search\Adapter\Mysql\TemporaryStorageFactory $tempStorageFactory Temporary Storage
     * @param \Magento\Framework\DB\Helper                                    $dbHelper           DB Helper
     */
    public function __construct(
        \Magento\QuickOrder\Model\CatalogPermissions\Permissions $permissions,
        \Magento\Framework\Search\Adapter\Mysql\TemporaryStorageFactory $tempStorageFactory,
        \Magento\Framework\DB\Helper $dbHelper
    ) {
        $this->permissions = $permissions;
        $this->dbHelper    = $dbHelper;

        parent::__construct($permissions, $tempStorageFactory, $dbHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function prepareProductCollection(
        \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection,
        $fulltextSearchResults,
        $resultLimit,
        $query
    ) {
        $productCollection->addAttributeToSelect(ProductInterface::NAME);

        // This was done in legacy code by joining on temporary storage table.
        $productIds = [];
        foreach ($fulltextSearchResults as $document) {
            $productIds[] = (int) $document->getSource()['entity_id'] ?? null;
        }
        $productCollection->addIdFilter($productIds);

        // Legacy : Apply catalog permissions to collection.
        $this->permissions->applyPermissionsToProductCollection($productCollection);

        $productCollection->setPageSize($resultLimit);

        // Legacy : Filter results on SKU and NAME fields only.
        $query = $this->dbHelper->escapeLikeValue($query, ['position' => 'any']);
        $productCollection->addAttributeToFilter([
            ['attribute' => ProductInterface::SKU, 'like' => $query],
            ['attribute' => ProductInterface::NAME, 'like' => $query],
        ]);

        // Legacy : exclude from collection hidden in catalog products with required custom options.
        $productCollection->addAttributeToFilter(
            [
                ['attribute' => 'required_options', 'neq' => 1],
                [
                    'attribute' => \Magento\Catalog\Api\Data\ProductInterface::VISIBILITY,
                    'in' => [
                        Visibility::VISIBILITY_IN_SEARCH,
                        Visibility::VISIBILITY_IN_CATALOG,
                        Visibility::VISIBILITY_BOTH,
                    ],
                ],
            ]
        );

        return $productCollection;
    }
}
