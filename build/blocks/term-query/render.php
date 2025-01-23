<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

 $wrapper_classes = 'wp-block-term-query';
$output = '<div ' . get_block_wrapper_attributes( array( 'class' => $wrapper_classes ) ) . '>';
$output .= '<p>' . esc_html__( 'Term Query – hello from a dynamic block!', 'term-query' ) . '</p>';
echo $output;
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Term Query – hello from a dynamic block!', 'term-query' ); ?>
</p>
