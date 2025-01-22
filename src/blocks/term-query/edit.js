import { __ } from "@wordpress/i18n"

import { useBlockProps } from "@wordpress/block-editor"

export default function Edit({ attributes, setAttributes }) {
  return <p {...useBlockProps()}>{__("Term Query – hello from the editor!", "term-query")}</p>
}
