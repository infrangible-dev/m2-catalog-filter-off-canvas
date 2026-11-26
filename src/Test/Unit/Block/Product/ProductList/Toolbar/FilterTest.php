<?php

declare(strict_types=1);

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2026 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Infrangible\CatalogFilterOffCanvas\Test\Unit\Block\Product\ProductList\Toolbar;

use FeWeDev\Base\Json;
use Infrangible\CatalogFilterOffCanvas\Block\Product\ProductList\Toolbar\Filter;
use Infrangible\Core\Helper\Stores;
use Magento\Catalog\Model\Layer;
use Magento\Catalog\Model\Layer\Filter\Item;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\Layer\State;
use Magento\Framework\View\Element\Template\Context;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Tests the filter button and the configuration of the off-canvas panel.
 */
#[AllowMockObjectsWithoutExpectations]
class FilterTest extends TestCase
{
    /**
     * Returns configured directions and the direction the panel uses.
     *
     * @return array<string, array{string|null, string}>
     */
    public static function directionProvider(): array
    {
        return [
            'left'    => ['left', 'left'],
            'right'   => ['right', 'right'],
            'bottom'  => ['bottom', 'bottom'],
            'unknown' => ['middle', 'left'],
            'none'    => [null, 'left']
        ];
    }

    /**
     * Tests the direction in the configuration of the panel.
     *
     * @dataProvider directionProvider
     *
     * @param string|null $configured
     * @param string $expected
     *
     * @return void
     */
    #[DataProvider('directionProvider')]
    public function testOffCanvasConfig(?string $configured, string $expected): void
    {
        $block = $this->createBlock($configured, []);

        self::assertSame($expected, $block->getDirection());
        self::assertSame(
            '{"triggerButton":"#filtersTriggerButton","direction":"' . $expected . '"}',
            $block->getOffCanvasConfig()
        );
    }

    /**
     * Tests the number of applied filters.
     *
     * @return void
     */
    public function testActiveFilterCount(): void
    {
        $block = $this->createBlock(
            'left',
            [$this->createStub(Item::class), $this->createStub(Item::class), 'not an item']
        );

        self::assertSame(2, $block->getActiveFilterCount());
    }

    /**
     * Tests the CSS classes from the layout as strings.
     *
     * @return void
     */
    public function testDataString(): void
    {
        $block = $this->createBlock('left', []);
        $block->setData('labelClass', 'filter-trigger-label');
        $block->setData('countClass', ['no', 'string']);

        self::assertSame('filter-trigger-label', $block->getDataString('labelClass'));
        self::assertSame('', $block->getDataString('countClass'));
        self::assertSame('', $block->getDataString('missing'));
    }

    /**
     * Returns the block with the configured direction and the applied filters.
     *
     * @param string|null $direction
     * @param list<mixed> $filters
     *
     * @return Filter
     */
    private function createBlock(?string $direction, array $filters): Filter
    {
        $storeHelper = $this->createStub(Stores::class);
        $storeHelper->method('getStoreConfig')->willReturn($direction);

        $state = $this->createStub(State::class);
        $state->method('getFilters')->willReturn($filters);

        $layer = $this->createStub(Layer::class);
        $layer->method('getState')->willReturn($state);

        $layerResolver = $this->createStub(Resolver::class);
        $layerResolver->method('get')->willReturn($layer);

        return new Filter($this->createStub(Context::class), $layerResolver, $storeHelper, new Json());
    }
}
