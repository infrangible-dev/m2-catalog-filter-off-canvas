<?php

declare(strict_types=1);

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2026 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Infrangible\CatalogFilterOffCanvas\Plugin\Catalog\Block\Product\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar as Subject;
use Magento\Framework\View\Element\AbstractBlock;

/**
 * Adds the filter button to the top toolbar of the product list; Magento renders the toolbar block above and below
 * the products.
 */
class Toolbar
{
    /** @var bool whether the button was not added yet in this request */
    private bool $isFirst = true;

    /**
     * Adds the filter button before the first toolbar that is not the bottom one.
     *
     * @param Subject $subject
     * @param string $result
     *
     * @return string
     */
    public function afterFetchView(Subject $subject, string $result): string
    {
        if ($subject->getData('is_bottom') || ! $this->isFirst) {
            return $result;
        }

        $filterBlock = $subject->getChildBlock('product_list_toolbar_filter');

        if (! $filterBlock instanceof AbstractBlock) {
            return $result;
        }

        $this->isFirst = false;

        return $filterBlock->toHtml() . $result;
    }

    /**
     * Checks whether the button was not added yet in this request.
     *
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->isFirst;
    }

    /**
     * Sets whether the button was not added yet in this request.
     *
     * @param bool $isFirst
     *
     * @return void
     */
    public function setIsFirst(bool $isFirst): void
    {
        $this->isFirst = $isFirst;
    }
}
