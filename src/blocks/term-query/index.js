import "./style.scss"

import { registerBlockType } from "@wordpress/blocks"
import { loop as icon } from "@wordpress/icons"

/**
 * Internal dependencies
 */
import Edit from "./edit"
import metadata from "./block.json"

const { name } = metadata

registerBlockType(name, {
  icon,
  edit: Edit
})
