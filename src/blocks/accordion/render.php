<?php

$title = ! empty( $attributes['title'] ) ? $attributes['title'] : '';

echo '<div ' . get_block_wrapper_attributes() . '>';

	echo $title;
	echo esc_html__( "Accordion – hello from the editor!", "wp-block-dev" );

echo '</div>';
