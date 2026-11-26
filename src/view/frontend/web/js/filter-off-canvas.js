/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2026 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */

define([
    'jquery',
    'offCanvas'
], function ($) {
    'use strict';

    /**
     * Turns the sidebar with the layered navigation into an off-canvas panel that the filter button opens.
     *
     * The panel is moved to the body: Magento's ".columns" are a stacking context of their own, inside which the
     * panel would stay below the header (on mobile devices the menu button of the header covered the filters).
     *
     * @param {{triggerButton: string, direction: string}} config
     * @param {HTMLElement} element the sidebar
     */
    return function (config, element) {
        $(element)
            .appendTo('body')
            .offcanvas({
                triggerButton: config.triggerButton,
                modifiers: config.direction + ', overlay'
            });
    };
});
