<?php

$title = ! empty( $attributes['title'] ) ? $attributes['title'] : '';

echo '<div ' . get_block_wrapper_attributes() . '>';

	echo $title;
	echo '<h1 class="accordion">' . esc_html__( "Accordion – hello from the editor!", "wp-block-dev" ) . '</h1>';

echo '</div>';
