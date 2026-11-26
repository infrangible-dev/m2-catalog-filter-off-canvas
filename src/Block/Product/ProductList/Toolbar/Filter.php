<?php

declare(strict_types=1);

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2026 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Infrangible\CatalogFilterOffCanvas\Block\Product\ProductList\Toolbar;

use FeWeDev\Base\Json;
use Infrangible\CatalogFilterOffCanvas\Model\Config\Source\Direction;
use Infrangible\Core\Helper\Stores;
use Magento\Catalog\Model\Layer;
use Magento\Catalog\Model\Layer\Filter\Item;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\View\Element\Template;

/**
 * The filter button of the product list toolbar and the configuration of the off-canvas panel with the layered
 * navigation.
 */
class Filter extends Template
{
    /**
     * @param Template\Context $context
     * @param Resolver $layerResolver
     * @param Stores $storeHelper
     * @param Json $json
     * @param array $data
     * @phpstan-param array<string, mixed> $data
     */
    public function __construct(
        Template\Context $context,
        protected Resolver $layerResolver,
        protected Stores $storeHelper,
        protected Json $json,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Returns the applied filters of the product list.
     *
     * @return list<Item>
     */
    public function getActiveFilters(): array
    {
        $filters = [];

        foreach ($this->getLayer()->getState()->getFilters() as $filter) {
            if ($filter instanceof Item) {
                $filters[] = $filter;
            }
        }

        return $filters;
    }

    /**
     * Returns the number of applied filters.
     *
     * @return int
     */
    public function getActiveFilterCount(): int
    {
        return count($this->getActiveFilters());
    }

    /**
     * Returns the layer of the product list.
     *
     * @return Layer
     */
    protected function getLayer(): Layer
    {
        $layer = $this->_getData('layer');

        if (! $layer instanceof Layer) {
            $layer = $this->layerResolver->get();

            $this->setData('layer', $layer);
        }

        return $layer;
    }

    /**
     * Returns the side the panel opens from: left (default), right, top or bottom.
     *
     * @return string
     */
    public function getDirection(): string
    {
        $direction = $this->storeHelper->getStoreConfig('infrangible_catalogfilteroffcanvas/general/direction');

        return in_array($direction, Direction::DIRECTIONS, true) ? $direction : Direction::DIRECTIONS[ 0 ];
    }

    /**
     * Returns a value of the block data as string, for example a CSS class from the layout.
     *
     * @param string $key
     *
     * @return string
     */
    public function getDataString(string $key): string
    {
        $value = $this->getData($key);

        return is_scalar($value) ? (string)$value : '';
    }

    /**
     * Returns the configuration of the JavaScript component of the panel as JSON.
     *
     * @return string
     */
    public function getOffCanvasConfig(): string
    {
        return $this->json->encode(
            ['triggerButton' => '#filtersTriggerButton', 'direction' => $this->getDirection()]
        ) ?? '{}';
    }
}
