<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteQuickOrder
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2023 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\ElasticsuiteQuickOrder\Search;

/**
 * Custom Search Criteria Builder to return a \Smile\ElasticsuiteCore\Api\Search\SearchCriteriaInterface
 *
 * @category Smile
 * @package  Smile\ElasticsuiteQuickOrder
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class SearchCriteriaBuilder extends \Magento\Framework\Api\Search\SearchCriteriaBuilder
{
    /**
     * Overriden method to ensure the Elasticsuite SearchCriteria class will be built.
     *
     * @return string
     */
    protected function _getDataObjectType()
    {
        return \Smile\ElasticsuiteCore\Api\Search\SearchCriteriaInterface::class;
    }
}
