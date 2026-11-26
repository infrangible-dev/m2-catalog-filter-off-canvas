# Changelog

## 2.0.1

### Changed

- Supports PHP 8.1 again, like Magento 2.4.6: the Adobe Commerce Marketplace requires modules to allow every PHP
  version of the Magento versions they support.

## 2.0.0

### Breaking changes

- Requires Magento 2.4.6 or newer and PHP 8.2 or newer. Older versions of Magento and PHP 7.1 to 8.1 are no longer
  supported; use version 1.x for these.
- Requires `infrangible/m2-core` 5.0, `infrangible/m2-foundation` 3.0 and `fewedev/base` 2.4.3.
- All classes have native types and use constructor property promotion; the block `Toolbar\Filter` takes
  `FeWeDev\Base\Json` as well.
- The panel is started with the JavaScript component `Infrangible_CatalogFilterOffCanvas/js/filter-off-canvas` and
  `x-magento-init` instead of an inline script, and moved to the end of the body when it starts. Themes that style the
  panel through `.columns .sidebar-main` have to use `.sidebar-main.c-offcanvas`.
- The styles of js-offcanvas are in `_offcanvas.less` and only compiled once (into `styles-m.css`).

### Changed

- The icon of the filter button uses the icon font and the menu icon of the theme (`@icons__font-name`, `@icon-menu`)
  instead of a fixed `'luma-icons'`; in Luma the result is the same.

### Fixed

- On mobile devices the filters could not be opened: the panel showed only the "Shop By" toggle of Magento's layered
  navigation, and the menu button of the header lay above it and caught the tap. The panel now lies above the header
  and shows the filters directly.

### Added

- Translations in 24 locales.
- Unit tests.
