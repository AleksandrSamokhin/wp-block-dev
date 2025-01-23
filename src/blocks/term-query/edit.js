import { __ } from "@wordpress/i18n"

import { useBlockProps, InspectorControls } from "@wordpress/block-editor"

import { PanelBody, ToggleControl, RangeControl, SelectControl } from "@wordpress/components"

import ServerSideRender from "@wordpress/server-side-render"

export default function Edit({ attributes, setAttributes }) {
  const { postsToShow, order, orderBy, columns, columnsGap, rowsGap, displayTitle, displayCount, displayPagination } =
    attributes

  const blockProps = useBlockProps({
    className: `wp-block-dev-term-query--columns-${columns}`,
    style: {
      gap: `${rowsGap}px ${columnsGap}px`
    }
  })

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Term Query settings", "wp-block-dev")}>
          <RangeControl
            label={__("Number of Terms", "wp-block-dev")}
            value={postsToShow}
            onChange={value => setAttributes({ postsToShow: value })}
            min={1}
            max={20}
            __nextHasNoMarginBottom={true}
          />
          <SelectControl
            label={__("Order By", "deoblocks")}
            value={orderBy}
            options={[
              { label: __("Name", "deoblocks"), value: "name" },
              { label: __("Count", "deoblocks"), value: "count" }
            ]}
            onChange={value => setAttributes({ orderBy: value })}
            __nextHasNoMarginBottom={true}
          />
          <SelectControl
            label={__("Order", "deoblocks")}
            value={order}
            options={[
              { label: __("Ascending", "deoblocks"), value: "asc" },
              { label: __("Descending", "deoblocks"), value: "desc" }
            ]}
            onChange={value => setAttributes({ order: value })}
            __nextHasNoMarginBottom={true}
          />
        </PanelBody>
        <PanelBody title={__("Display Settings", "wp-block-dev")}>
          <RangeControl
            label={__("Columns", "wp-block-dev")}
            value={columns}
            onChange={value => setAttributes({ columns: value })}
            min={0}
            max={6}
            __nextHasNoMarginBottom={true}
          />
          <RangeControl
            label={__("Columns Gap", "wp-block-dev")}
            value={columnsGap}
            onChange={value => setAttributes({ columnsGap: value })}
            min={0}
            __nextHasNoMarginBottom={true}
          />
          <RangeControl
            label={__("Rows Gap", "wp-block-dev")}
            value={rowsGap}
            onChange={value => setAttributes({ rowsGap: value })}
            min={0}
            __nextHasNoMarginBottom={true}
          />
          <ToggleControl
            label={__("Display Title", "wp-block-dev")}
            checked={displayTitle}
            onChange={() => setAttributes({ displayTitle: !displayTitle })}
            __nextHasNoMarginBottom={true}
          />
          <ToggleControl
            label={__("Display Count", "wp-block-dev")}
            checked={displayCount}
            onChange={() => setAttributes({ displayCount: !displayCount })}
            __nextHasNoMarginBottom={true}
          />
          <ToggleControl
            label={__("Display Pagination", "wp-block-dev")}
            checked={displayPagination}
            onChange={() => setAttributes({ displayPagination: !displayPagination })}
            __nextHasNoMarginBottom={true}
          />
        </PanelBody>
      </InspectorControls>
      <div {...blockProps}>
        <ServerSideRender block="wp-block-dev/term-query" attributes={attributes} />
      </div>
    </>
  )
}
