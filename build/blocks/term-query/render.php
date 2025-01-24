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

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'taxonomy' => 'property_location',
	'number' => absint( $posts_to_show ),
	'order' => esc_html( $order ),
	'orderby' => esc_html( $order_by ),
	'hide_empty' => false,
	'offset' => ( $paged - 1 ) * $posts_to_show,
);

$term_query = new WP_Term_Query( $args );
$terms = $term_query->get_terms();

$total_terms = wp_count_terms($args['taxonomy'], array( 'hide_empty' => false ));
$total_pages = ceil( $total_terms / $posts_to_show );

if (empty($terms)) {
	return '';
}


?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => esc_attr( $wrapper_classes ) ) ); ?>>
	<?php foreach ($terms as $term) : ?>
		<article class="wp-block-dev-term-query__term">

		<?php $image_id = get_term_meta( $term->term_id, 'location_taxonomy_image', true );
			if ($image_id) {
				$image = wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'wp-block-dev-term-query__image' ) );

				if ($image) {
					echo '<a href="' . esc_url( get_term_link( $term ) ) . '">';
					echo $image;
					echo '<span class="wp-block-dev-term-query__overlay" style="background: linear-gradient(0deg, rgb(2, 6, 23) 0%, rgba(0,0,0,0) 100%);"></span>';
					echo '</a>';
				}
			}
			?>

			<?php if ( !empty( $attributes['displayTitle'] ) ) : ?>
				<span><?php echo esc_html( $term->name ); ?></span>
			<?php endif; ?>
			
			<?php if ( !empty( $attributes['displayCount'] ) ) : ?>
				<span>
					<?php printf( _n( '%s property', '%s properties', $term->count, 'wp-block-dev' ), $term->count ); ?>
				</span>
			<?php endif; ?>

		</article>
	<?php endforeach; ?>

		<?php if ( !empty( $attributes['displayPagination'] ) ) : ?>
			<?php if ( $total_pages > 1 ) : ?>
				<nav class="wp-block-dev-term-query__pagination">
					<?php
					echo paginate_links( array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => 'page/%#%',
						'current' => $paged,
						'total' => $total_pages,
						'prev_text' => esc_html__('&laquo; Previous', 'wp-block-dev'),
						'next_text' => esc_html__('Next &raquo;', 'wp-block-dev')
					) );
					?>
				</nav>
			<?php endif; ?>
		<?php endif; ?>

</div>
