<?php
// add_shortcode('photo_gallery', 'image_gallery_shortcode'); // use [photo_gallery] to display an unordered list of attached images
add_shortcode( 'cta', 'cta_shortcode' );
add_shortcode( 'calculator', 'calculator_shortcode' );

/**
 * @author https://pippinsplugins.com/image-gallery-short-code-using-post-attachments/
 */
function image_gallery_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
        'size' => ''
    ), $atts ) );

	$image_size = 'medium';
	if ( $size =! '' ) { $image_size = $size; }

	$images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_mime_type' => 'image',
		)
	);

	if ( $images ) {
		$gallery = '<ul class="gallery">';
		foreach ( $images as $image ) {
			$gallery .= '<li>';
				$gallery .= '<a href="' . wp_get_attachment_url($image->ID) . '" rel="shadowbox">';
					$gallery .= wp_get_attachment_image($image->ID, $image_size);
				$gallery .= '</a>';
			$gallery .= '</li>';
		}
		$gallery .= '</ul>';

		return $gallery;
	}

}



function cta_shortcode( $attrs ) {
	if ( ! is_plugin_active( 'advanced-custom-fields/acf.php' ) && ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		return '[Advanced Custom Fields Pro plugin required]';
	} else {
		$attrs = shortcode_atts(
			array(
				'id' => '-2222',
				'title' => '',
				'title-classes' => 'h2',
				'classes' => 'bg-white border-color-primary image-right box-shadow',
				'link-classes' => 'button tertiary',
				'card-classes' => '',
				'clickable' => 'false',
				'cta-style' => ''
				/**
				 * options: style-1, style-2, style-3, style-4
				 *
				 * style-1 = title h2, card, top-purple border, tertiary button, image right
				 * style-2 = title h2, card, top-purple border, tertiary button, image top
				 * style-3 = title h2, card, top-purple border, tertiary button, image bottom
				 * style-4 = title h2, primary button, no image, no border, secondary gradient background
				 * style-5 = title large, primary button, no image, no border, horizontal line, no padding on card, content centered
				 *
				**/
			),
			$attrs,
			'cta'
		);

		$ret = '';

		if ( $attrs['cta-style'] == 'style-1' ) {
			$attrs['title-classes'] = 'h2';
			$attrs['classes'] = 'bg-white border-color-primary image-right box-shadow';
			$attrs['link-classes'] = 'button tertiary';
			$attrs['card-classes'] = '';
		} elseif ( $attrs['cta-style'] == 'style-2' ) {
			$attrs['title-classes'] = 'h2';
			$attrs['classes'] = 'bg-white border-color-primary image-top box-shadow';
			$attrs['link-classes'] = 'button tertiary';
			$attrs['card-classes'] = '';
		} elseif ( $attrs['cta-style'] == 'style-3' ) {
			$attrs['title-classes'] = 'h2';
			$attrs['classes'] = 'bg-white border-color-primary image-bottom box-shadow';
			$attrs['link-classes'] = 'button tertiary';
			$attrs['card-classes'] = '';
		} elseif ( $attrs['cta-style'] == 'style-4' ) {
			$attrs['title-classes'] = 'h2';
			$attrs['classes'] = 'bg-gradient-secondary no-border no-image box-shadow rounded-corners';
			$attrs['link-classes'] = 'button primary';
			$attrs['card-classes'] = '';
		} elseif ( $attrs['cta-style'] == 'style-5' ) {
			$attrs['title-classes'] = 'large';
			$attrs['classes'] = 'no-border no-image hr';
			$attrs['link-classes'] = 'button primary';
			$attrs['card-classes'] = 'text-center p-0';
		}

		// get list by post id {$attrs['id']}
		$cta = get_post( $attrs['id'] );
		// if post/list exists
		if ( $cta ) :
			$cta_link_url = get_field( 'cta_link_url', $cta );
			$target = get_field( 'cta_open_in_new_tabwindow', $cta ) ? '_blank' : '_self';
			$img = get_the_post_thumbnail_url( $cta, 'large' );

			ob_start();
			?>
			<div id="<?php echo $cta->post_name; ?>" class="kyf-cta-container <?php echo $img ? 'has-image' : ''; ?> <?php echo $attrs['classes']; ?> <?php echo $attrs['clickable'] === 'true' ? 'all-clickable' : ''; ?>">

				<div class="kyf-cta-content-container <?php echo $attrs['card-classes']; ?>">
					<div class="kyf-cta-title <?php echo $attrs['title-classes']; ?>"><?php echo $attrs['title'] === '' ? $cta->post_title : $attrs['title']; ?></div>
					<div class="kyf-cta-content wysiwyg"><?php echo $cta->post_content; ?></div>
					<?php if ( $cta_link_url !== '' ) : ?>
						<div class="kyf-cta-link" style="<?php echo $attrs['cta-style'] === 'style-5' ? 'margin-top: 0;' : ''; ?>">
							<?php $classes_array = explode( ' ', $attrs['classes'] ); ?>
							<?php if ( in_array( 'hr', $classes_array ) ) : ?>
								<hr class="background-divider">
							<?php endif; ?>
							<a class="<?php echo $attrs['link-classes']; ?>" target="<?php echo $target; ?>" href="<?php echo $cta_link_url; ?>"><?php the_field( 'cta_link_text', $cta ); ?></a>
						</div>
					<?php endif; ?>
				</div>


				<?php if ( $img ) : ?>
					<div class="kyf-cta-image">
						<div class="absolute-fill kyf-extra-background"></div>
						<div class="absolute-fill" style="background-image:url('<?php echo $img; ?>');"></div>
					</div>
				<?php endif; ?>

				<?php if ( $attrs['clickable'] === 'true' ) :?>

					<a class="absolute-fill" target="<?php echo $target; ?>" href="<?php echo $cta_link_url; ?>"></a>
				<?php endif; ?>

			</div>
			<?php

			$ret = ob_get_contents();
			ob_end_clean();
		endif;

		return $ret;
	}
}

function calculator_shortcode( $attrs ) {
	$texts = array();
	$links = array();
	if ( have_rows( 'calculator_results_actions', 'option' ) ) {
		while ( have_rows( 'calculator_results_actions', 'option' ) ) {
			the_row();

			$texts[] = get_sub_field( 'calculator_results_actions_button_text' );
			$links[] = get_sub_field( 'calculator_results_actions_button_link' );
		}
	}

	$attrs = shortcode_atts(
		array(
			'header' => get_field( 'calculator_header', 'option' ),
			'subheader' => get_field( 'calculator_subheader', 'option' ),
			'calculate-button-text' => get_field( 'calculator_calculate_button_text', 'option' ),
			'results-message' => get_field( 'calculator_results_message', 'option' ),
			'results-actions-texts' => implode( ',', $texts ),
			'results-actions-links' => implode( ',', $links )
		),
		$attrs,
		'calculator'
	);

	$attr_texts = explode( ',', $attrs['results-actions-texts'] );
	$attr_links = explode( ',', $attrs['results-actions-links'] );

	ob_start();
	?>
	<div class="calculator box-shadow bg-white">
		<div class="calculator-fields">
			<div class="header s3"><?php echo $attrs['header']; ?></div>
			<p class="subheader"><?php echo $attrs['subheader']; ?></p>
			<form name="form-calculator">
				<input type="hidden" name="estimated-expense-percentage">
				<input type="hidden" name="managed-certificates-percentage">
				<fieldset>
					<label for="company-size">Company Size</label>
					<div class="input">
						<select name="company-size" placeholder="What's your company's employee size?" required></select>
					</div>
				</fieldset>
				<fieldset>
					<label for="company-industry">Industry</label>
					<div class="input">
						<select name="company-industry" placeholder="What's your company's industry?" required></select>
					</div>
				</fieldset>
				<fieldset>
					<label for="number-certificates">Number of Certificates</label>
					<div class="input">
						<input name="number-certificates" type="text" placeholder="How many digital certificates do you manage?">
					</div>
				</fieldset>
			</form>
			<div class="footer-actions">
				<a href="#" class="calculate-roi button"><?php echo $attrs['calculate-button-text']; ?></a>
			</div>
		</div>
		<div class="calculator-results" style="display: none;">
			<div class="header-actions"><a href="#" class="reset-roi-calculator">Reset</a></div>

			<div class="s4">Certificates</div>
			<!-- certificates bar graph w/key -->
			<div class="bar-graph-container gradient-secondary">
				<div class="bar-graph certificates">
					<div class="under"></div>
					<div class="over"></div>
				</div>
				<div class="bar-graph-key">
					<div class="over">
						<div class="key-block"></div>
						<div class="small">Your Certificate Count</div>
					</div>
					<div class="under">
						<div class="key-block"></div>
						<div class="small">Recommended Certificate Count</div>
					</div>
				</div>
			</div>
			<!-- <div class="s5">You would potentially have <span id="potential-certificates"></span> certificates managed with Keyfactor Command.</div> -->
			<div>Keyfactor Command gives you the freedom to manage <strong><span id="potential-certificates"></span></strong> certificates with no per-certificate management fees.</div>

			<hr>

			<div class="s4">Annual Savings</div>
			<!-- expense bar graph w/key -->
			<div class="bar-graph-container gradient-primary">
				<div class="bar-graph cost">
					<div class="under"></div>
					<div class="over"></div>
				</div>
				<div class="bar-graph-key">
					<div class="over">
						<div class="key-block"></div>
						<div class="small">Potential Cost</div>
					</div>
					<div class="under">
						<div class="key-block"></div>
						<div class="small">Current Cost</div>
					</div>
				</div>
			</div>
			<div>You would potentially save <strong><span id="potential-savings"></span></strong> with Keyfactor Command</div>

			<hr>

			<p class="small"><?php echo $attrs['results-message']; ?></p>
			<div class="footer-actions">
				<?php for ( $x = 0; $x < count( $attr_texts ); $x++ ) : ?>
					<a href="<?php echo $attr_links[$x]; ?>" class="button"><?php echo $attr_texts[$x]; ?></a>
				<?php endfor; ?>
			</div>
		</div>
	</div>
	<?php

	$ret = ob_get_contents();
	ob_end_clean();

	return $ret;
}

function print_menu_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'name' => null, ), $atts ) );
	return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}
add_shortcode( 'menu', 'print_menu_shortcode' );
?>
