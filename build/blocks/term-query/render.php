<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$posts_to_show = isset($attributes['postsToShow']) ? $attributes['postsToShow'] : 3;
$order = isset($attributes['order']) ? $attributes['order'] : 'DESC';
$order_by = isset($attributes['orderBy']) ? $attributes['orderBy'] : 'name';
// $columns = isset($attributes['orderBy']) ? $attributes['orderBy'] : 'name';
$wrapper_classes = 'wp-block-dev-term-query';

if ( $attributes['columns'] ) {
	$wrapper_classes .= ' columns-' . $attributes['columns'];
}

?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => esc_attr( $wrapper_classes ) ) ); ?>>
	<?php esc_html_e( 'Term Query – hello from a dynamic block!', 'term-query' ); ?>
</div>
