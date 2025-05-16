'use strict';

/**
 * Backend_Dashboard_WidgetManager
 */
class Backend_Dashboard_WidgetManager
{
    constructor() {
        this.sizing = Backend_Dashboard_Sizing.instance();
        this.helpers = Backend_Dashboard_Helpers.instance();
    }

    static instance() {
        return this.$instance || (this.$instance = new this);
    }

    createWidget(store, rows, row, type, defaultConfig, fullWidth) {
        if (fullWidth && row.widgets.length > 0) {
            return false;
        }

        const totalRowWidgetsWidth = this.sizing.totalWidgetsWidth(row.widgets);
        const availableWidth = this.sizing.totalColumns - totalRowWidgetsWidth;

        if (availableWidth < this.sizing.minWidth) {
            return false;
        }

        const newWidgetWidth = fullWidth
            ? this.sizing.totalColumns
            : Math.min(availableWidth, 4);

        const configuration = {
            type: type
        };

        if (typeof defaultConfig === 'object') {
            Object.assign(configuration, defaultConfig);
        }

        const newWidget = {
            _unique_key: this.helpers.makeUniqueKey(rows),
            configuration: configuration,
            width: newWidgetWidth,
        };

        row.widgets.push(newWidget);
        store.setSystemDataFlag(newWidget, 'needsConfiguration', true)

        return true;
    }
}
