import "./editor.scss"

import classnames from "classnames"

import { __ } from "@wordpress/i18n"
import { useBlockProps, InspectorControls } from "@wordpress/block-editor"

import { PanelBody, ToggleControl, RangeControl } from "@wordpress/components"

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(props) {
  const { attributes, setAttributes } = props
  const { slidesPerView, autoplay, loop, pagination, navigation } = attributes

  const inspectorControls = (
    <InspectorControls>
      <PanelBody title={__("Slider settings", "wp-block-dev")}>
        <RangeControl
          label={__("Slides per view", "wp-block-dev")}
          value={slidesPerView}
          onChange={value => setAttributes({ slidesPerView: value })}
          min={1}
          max={6}
          required
        />
        <ToggleControl
          label={__("Autoplay", "wp-block-dev")}
          checked={autoplay}
          onChange={value => setAttributes({ autoplay: value })}
        />
        <ToggleControl
          label={__("Loop", "wp-block-dev")}
          checked={loop}
          onChange={value => setAttributes({ loop: value })}
        />
        <ToggleControl
          label={__("Pagination", "wp-block-dev")}
          checked={pagination}
          onChange={value => setAttributes({ pagination: value })}
        />
        <ToggleControl
          label={__("Navigation", "wp-block-dev")}
          checked={navigation}
          onChange={value => setAttributes({ navigation: value })}
        />
      </PanelBody>
    </InspectorControls>
  )

  const blockProps = useBlockProps({
    className: classnames("wp-block-dev-slider", {
      [`wp-block-dev-slider--slides-${slidesPerView}`]: slidesPerView
    })
  })

  return (
    <>
      {inspectorControls}
      <div {...blockProps} />
    </>
  )
}
