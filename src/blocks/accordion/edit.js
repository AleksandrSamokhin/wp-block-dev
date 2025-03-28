/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n"

import { TextControl, PanelBody } from "@wordpress/components"

import { InspectorControls } from "@wordpress/block-editor"

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from "@wordpress/block-editor"

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import "./editor.scss"

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Inspector settings", "wp-block-dev")}>
          <TextControl
            __nextHasNoMarginBottom
            __next40pxDefaultSize
            label="Additional CSS Class"
            value={attributes.title}
            onChange={value => setAttributes({ title: value })}
          />
        </PanelBody>
      </InspectorControls>
      <p {...useBlockProps()}>
        {attributes.title && attributes.title}
        <h1>{__("Accordion – hello from the editor!", "accordion")}</h1>
      </p>
    </>
  )
}
