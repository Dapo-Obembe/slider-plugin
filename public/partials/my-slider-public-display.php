<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    My_Slider
 * @subpackage My_Slider/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h3><?php echo esc_html( ! empty( $content ) ) ? esc_html( $content ) : esc_html( get_option( 'my_slider_options' )['my_slider_title'] ); ?></h3>
<div class="my-slider flexslider 
<?php
echo isset( get_option( 'my_slider_options' )['my_slider_style'] ) ? esc_html( get_option( 'my_slider_options' )['my_slider_style'] ) : 'style-1';
?>
">
	<ul class="slides">
		<?php
			$args = array(
				'post_type'   => 'my-slider',
				'post_status' => 'publish',
				'post__in'    => $id,
				'orderby'     => $orderby,
			);

			$my_query = new WP_Query( $args );
			?>
		<?php

		if ( $my_query->have_posts() ) :
			while ( $my_query->have_posts() ) :
				$my_query->the_post();

				$button_text = get_post_meta( get_the_ID(), 'my_slider_link_text', true );
				$button_url  = get_post_meta( get_the_ID(), 'my_slider_link_url', true );
				?>
		<li>
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
				} else {
					// Show defualt image if the featured image was not used.
					$default_image_url = plugin_dir_url( __FILE__ ) . 'assets/images/default.jpg';
					echo "<img src='" . esc_url( $default_image_url ) . "' class='img-fluid wp-post-image' />";
				}
				?>
			<div class="mys-container">
				<div class="slider-details-container">
					<div class="wrapper">
						<div class="slider-title">
							<h2><?php the_title(); ?></h2>
						</div>
						<div class="slider-description">
							<div class="subtitle"><?php the_content(); ?></div>
							<button type="button">
								<a class="link" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ); ?></a>
							</button>
						</div>
					</div>
				</div>              
			</div>
		</li>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		<?php endif; ?>
	</ul>
</div>
