# Infrangible Catalog Filter Off Canvas

Moves the layered navigation of category and search result pages into an off-canvas panel: a **Filters** button in
the toolbar above the product list opens it, the product list gets the full page width.

## How it works

- The button is added to the top toolbar of the product list and shows the number of applied filters.
- The sidebar with the layered navigation slides in as a panel with a background overlay, from the left, right, top or
  bottom of the screen ([js-offcanvas](https://github.com/vmitsaras/js-offcanvas) 1.2.11, bundled).
- The panel lies above the whole page, also above the header. On mobile devices it shows the filters directly,
  without the "Shop By" toggle of Magento's layered navigation.
- The panel is started with `x-magento-init` (`Infrangible_CatalogFilterOffCanvas/js/filter-off-canvas`), without
  inline scripts.

The layout handles `catalog_category_view` and `catalogsearch_result_index` add the block `product_list_toolbar_filter`
to the toolbar. Its containers `prior`, `content` and `additional` (also in the button and the script block) take
additional blocks; the CSS classes of the button are arguments (`triggerFilterClass`, `labelClass`, `countClass`) of
the block `product_list_toolbar_filter_button_content_content`.

## Configuration

Stores > Configuration > Infrangible Solutions > Catalog Filter Off Canvas > General > **Direction**: the side the panel
slides in from, **Left** (default), **Right**, **Top** or **Bottom**. The setting can be changed per website and store
view.

## Requirements

- Magento Open Source or Adobe Commerce 2.4.6 or newer with the Luma theme or a theme based on it
- PHP 8.1 or newer

## Installation

```bash
composer require infrangible/m2-catalog-filter-off-canvas
bin/magento module:enable Infrangible_CatalogFilterOffCanvas
bin/magento setup:upgrade
```

In production mode, also run `bin/magento setup:di:compile` and `bin/magento setup:static-content:deploy`.

## License

Infrangible Catalog Filter Off Canvas is licensed under the MIT License - see the LICENSE file for details.
