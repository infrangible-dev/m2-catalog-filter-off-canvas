<?php

declare(strict_types=1);

namespace Infrangible\CatalogFilterOffCanvas\Plugin\Catalog\Block\Product\ProductList;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Toolbar
{
    private $isFirst = true;

    public function afterFetchView(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        string $result
    ): string {
        if (! $subject->getData('is_bottom')) {
            if ($this->isFirst) {
                $this->setIsFirst(false);

                $filterBlock = $subject->getChildBlock('product_list_toolbar_filter');

                if ($filterBlock) {
                    return $filterBlock->toHtml() . $result;
                }
            }
        }

        return $result;
    }

    public function isFirst(): bool
    {
        return $this->isFirst;
    }

    public function setIsFirst(bool $isFirst): void
    {
        $this->isFirst = $isFirst;
    }
}
