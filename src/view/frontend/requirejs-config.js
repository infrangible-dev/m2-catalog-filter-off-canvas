/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2026 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

const config = {
    map: {
        '*': {
            catalogFilterOffCanvas: 'Infrangible_CatalogFilterOffCanvas/js/filter-off-canvas'
        }
    },
    paths: {
        'offCanvas': 'Infrangible_CatalogFilterOffCanvas/js/js-offcanvas.pkgd.min'
    },
    shim: {
        'offCanvas': {
            'deps': ['jquery']
        }
    }
};
