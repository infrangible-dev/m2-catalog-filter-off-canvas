<?php

declare(strict_types=1);

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2026 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace Infrangible\CatalogFilterOffCanvas\Test\Unit\Plugin\Catalog\Block\Product\ProductList;

use Infrangible\CatalogFilterOffCanvas\Plugin\Catalog\Block\Product\ProductList\Toolbar;
use Magento\Catalog\Block\Product\ProductList\Toolbar as Subject;
use Magento\Framework\View\Element\AbstractBlock;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\TestCase;

/**
 * Tests that the filter button is added to the top toolbar only.
 */
#[AllowMockObjectsWithoutExpectations]
class ToolbarTest extends TestCase
{
    /**
     * Tests the top and the bottom toolbar of a product list.
     *
     * @return void
     */
    public function testAfterFetchView(): void
    {
        $plugin = new Toolbar();

        self::assertSame('bottom', $plugin->afterFetchView($this->createSubject(true), 'bottom'));
        self::assertSame('<button/>top', $plugin->afterFetchView($this->createSubject(false), 'top'));
        self::assertFalse($plugin->isFirst());
        self::assertSame('again', $plugin->afterFetchView($this->createSubject(false), 'again'));
    }

    /**
     * Returns a toolbar with the filter block.
     *
     * @param bool $isBottom
     *
     * @return Subject
     */
    private function createSubject(bool $isBottom): Subject
    {
        $filterBlock = $this->createStub(AbstractBlock::class);
        $filterBlock->method('toHtml')->willReturn('<button/>');

        $subject = $this->createStub(Subject::class);
        $subject->method('getData')->willReturnCallback(
            static fn(string $key = ''): ?bool => $key === 'is_bottom' ? $isBottom : null
        );
        $subject->method('getChildBlock')->willReturn($filterBlock);

        return $subject;
    }
}
