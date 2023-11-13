"use strict";

/**
 * Sight
 */
function csSight() {
  /**
   * WordPress dependencies
   */
  var __ = wp.i18n.__;
  var addFilter = wp.hooks.addFilter;
  var _wp$components = wp.components,
      RangeControl = _wp$components.RangeControl,
      ToggleControl = _wp$components.ToggleControl,
      SelectControl = _wp$components.SelectControl,
      TabPanel = _wp$components.TabPanel,
      BaseControl = _wp$components.BaseControl;
  /**
   * Add fields to Block Settings.
   *
   * @param {JSX}    fields Original block.
   * @param {Object} props  Block data.
   * @param {Object} config Block config.
   *
   * @return {JSX} Block.
   */

  function setStandardBlockSettings(fields, props, config) {
    var attributes = props.attributes,
        setAttributes = props.setAttributes,
        isFieldVisible = props.isFieldVisible;
    return /*#__PURE__*/React.createElement("div", null, fields, 'standard' === attributes['layout'] ? /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement(BaseControl, {
      label: __("Number of Columns")
    }, /*#__PURE__*/React.createElement(TabPanel, {
      activeClass: "active-tab",
      className: "sight-responsive-tabs",
      tabs: [{
        name: 'pc',
        title: __("PC")
      }, {
        name: 'tablet',
        title: __("Tablet")
      }, {
        name: 'mobile',
        title: __("Mobile")
      }]
    }, function (tab) {
      return /*#__PURE__*/React.createElement("div", null, 'pc' === tab.name && isFieldVisible('standard_columns_pc', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['standard_columns_pc'],
        min: 1,
        max: 6,
        onChange: function onChange(val) {
          setAttributes({
            'standard_columns_pc': val
          });
        }
      }) : null, 'tablet' === tab.name && isFieldVisible('standard_columns_tablet', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['standard_columns_tablet'],
        min: 1,
        max: 6,
        onChange: function onChange(val) {
          setAttributes({
            'standard_columns_tablet': val
          });
        }
      }) : null, 'mobile' === tab.name && isFieldVisible('standard_columns_mobile', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['standard_columns_mobile'],
        min: 1,
        max: 6,
        onChange: function onChange(val) {
          setAttributes({
            'standard_columns_mobile': val
          });
        }
      }) : null);
    })), /*#__PURE__*/React.createElement(BaseControl, {
      label: __("Gap between Items (px)")
    }, /*#__PURE__*/React.createElement(TabPanel, {
      activeClass: "active-tab",
      className: "sight-responsive-tabs",
      tabs: [{
        name: 'pc',
        title: __("PC")
      }, {
        name: 'tablet',
        title: __("Tablet")
      }, {
        name: 'mobile',
        title: __("Mobile")
      }]
    }, function (tab) {
      return /*#__PURE__*/React.createElement("div", null, 'pc' === tab.name && isFieldVisible('standard_gap_posts_pc', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['standard_gap_posts_pc'],
        min: 0,
        max: 250,
        onChange: function onChange(val) {
          setAttributes({
            'standard_gap_posts_pc': val
          });
        }
      }) : null, 'tablet' === tab.name && isFieldVisible('standard_gap_posts_tablet', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['standard_gap_posts_tablet'],
        min: 0,
        max: 250,
        onChange: function onChange(val) {
          setAttributes({
            'standard_gap_posts_tablet': val
          });
        }
      }) : null, 'mobile' === tab.name && isFieldVisible('standard_gap_posts_mobile', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['standard_gap_posts_mobile'],
        min: 0,
        max: 250,
        onChange: function onChange(val) {
          setAttributes({
            'standard_gap_posts_mobile': val
          });
        }
      }) : null);
    }))) : null);
  }

  addFilter('sight.blockSettings.fields', 'sight/standardBlockSettings/set/fields', setStandardBlockSettings, 15);
  /**
   * Add fields to Block Settings.
   *
   * @param {JSX}    fields Original block.
   * @param {Object} props  Block data.
   * @param {Object} config Block config.
   *
   * @return {JSX} Block.
   */

  function setJustifiedBlockSettings(fields, props, config) {
    var attributes = props.attributes,
        setAttributes = props.setAttributes,
        isFieldVisible = props.isFieldVisible;
    return /*#__PURE__*/React.createElement("div", null, fields, 'justified' === attributes['layout'] ? /*#__PURE__*/React.createElement("div", null, isFieldVisible('justified_filter_items', config, attributes) ? /*#__PURE__*/React.createElement(ToggleControl, {
      label: __("Display category filter"),
      checked: attributes['justified_filter_items'],
      onChange: function onChange(val) {
        setAttributes({
          'justified_filter_items': val
        });
      }
    }) : null, isFieldVisible('justified_pagination_type', config, attributes) ? /*#__PURE__*/React.createElement(SelectControl, {
      label: __("Pagination type"),
      value: attributes['justified_pagination_type'],
      options: [{
        value: 'none',
        label: __('None')
      }, {
        value: 'ajax',
        label: __('Load More')
      }, {
        value: 'infinite',
        label: __('Infinite Load')
      }],
      onChange: function onChange(val) {
        setAttributes({
          'justified_pagination_type': val
        });
      }
    }) : null, /*#__PURE__*/React.createElement(BaseControl, {
      label: __("Image Height (px)")
    }, /*#__PURE__*/React.createElement(TabPanel, {
      activeClass: "active-tab",
      className: "sight-responsive-tabs",
      tabs: [{
        name: 'pc',
        title: __("PC")
      }, {
        name: 'tablet',
        title: __("Tablet")
      }, {
        name: 'mobile',
        title: __("Mobile")
      }]
    }, function (tab) {
      return /*#__PURE__*/React.createElement("div", null, 'pc' === tab.name && isFieldVisible('justified_image_height_pc', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['justified_image_height_pc'],
        min: 1,
        max: 5000,
        onChange: function onChange(val) {
          setAttributes({
            'justified_image_height_pc': val
          });
        }
      }) : null, 'tablet' === tab.name && isFieldVisible('justified_image_height_tablet', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['justified_image_height_tablet'],
        min: 1,
        max: 5000,
        onChange: function onChange(val) {
          setAttributes({
            'justified_image_height_tablet': val
          });
        }
      }) : null, 'mobile' === tab.name && isFieldVisible('justified_image_height_mobile', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['justified_image_height_mobile'],
        min: 1,
        max: 5000,
        onChange: function onChange(val) {
          setAttributes({
            'justified_image_height_mobile': val
          });
        }
      }) : null);
    })), /*#__PURE__*/React.createElement(BaseControl, {
      label: __("Gap between Items (px)")
    }, /*#__PURE__*/React.createElement(TabPanel, {
      activeClass: "active-tab",
      className: "sight-responsive-tabs",
      tabs: [{
        name: 'pc',
        title: __("PC")
      }, {
        name: 'tablet',
        title: __("Tablet")
      }, {
        name: 'mobile',
        title: __("Mobile")
      }]
    }, function (tab) {
      return /*#__PURE__*/React.createElement("div", null, 'pc' === tab.name && isFieldVisible('justified_gap_posts_pc', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['justified_gap_posts_pc'],
        min: 0,
        max: 250,
        onChange: function onChange(val) {
          setAttributes({
            'justified_gap_posts_pc': val
          });
        }
      }) : null, 'tablet' === tab.name && isFieldVisible('justified_gap_posts_tablet', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['justified_gap_posts_tablet'],
        min: 0,
        max: 250,
        onChange: function onChange(val) {
          setAttributes({
            'justified_gap_posts_tablet': val
          });
        }
      }) : null, 'mobile' === tab.name && isFieldVisible('justified_gap_posts_mobile', config, attributes) ? /*#__PURE__*/React.createElement(RangeControl, {
        value: attributes['justified_gap_posts_mobile'],
        min: 0,
        max: 250,
        onChange: function onChange(val) {
          setAttributes({
            'justified_gap_posts_mobile': val
          });
        }
      }) : null);
    }))) : null);
  }

  addFilter('sight.blockSettings.fields', 'sight/justifiedBlockSettings/set/fields', setJustifiedBlockSettings, 15);
}

csSight();