<?php

declare(strict_types=1);

namespace Infrangible\CatalogFilterOffCanvas\Model\Config\Source;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Direction implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => 'left', 'label' => __('Left')],
            ['value' => 'right', 'label' => __('Right')],
            ['value' => 'top', 'label' => __('Top')],
            ['value' => 'bottom', 'label' => __('Bottom')]
        ];
    }
}
