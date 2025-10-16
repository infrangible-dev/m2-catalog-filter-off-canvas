<?php

declare(strict_types=1);

namespace Infrangible\CatalogFilterOffCanvas\Block\Product\ProductList\Toolbar;

use Infrangible\Core\Helper\Stores;
use Magento\Framework\View\Element\Template;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Filter extends Template
{
    /** @var \Magento\Catalog\Model\Layer\Resolver */
    private $layerResolver;

    /** @var Stores */
    private $storeHelper;

    public function __construct(
        Template\Context $context,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        Stores $storeHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );

        $this->layerResolver = $layerResolver;
        $this->storeHelper = $storeHelper;
    }

    /**
     * @return \Magento\Catalog\Model\Layer\Filter\Item[]
     */
    public function getActiveFilters(): array
    {
        $filters = $this->getLayer()->getState()->getFilters();

        if (! is_array($filters)) {
            $filters = [];
        }

        return $filters;
    }

    protected function getLayer(): \Magento\Catalog\Model\Layer
    {
        if (! $this->hasData('layer')) {
            $this->setData(
                'layer',
                $this->layerResolver->get()
            );
        }

        return $this->_getData('layer');
    }

    public function getDirection(): string
    {
        return $this->storeHelper->getStoreConfig('infrangible_catalogfilteroffcanvas/general/direction');
    }
}
