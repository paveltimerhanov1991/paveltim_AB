<?php 
class panoply_Customizer_Range_Value_Control extends WP_Customize_Control {
	public $type = 'range-value';
	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 3.4.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'customizer-range-value-control', get_stylesheet_directory_uri() . '/inc/js/panoply-customizer-range-value-control.js', array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'customizer-range-value-control', get_stylesheet_directory_uri() . '/inc/css/panoply-customizer-range-value-control.css', array(), rand() );
	}
	/**
	 * Render the control's content.
	 *
	 * @author soderlind
	 * @version 1.2.0
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
				<span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); $this->link(); ?>>
				<span class="range-slider__value">0</span></span>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}
class panoply_Font_Selector extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'selector-font';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		}

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper in $this->render().
	 *
	 * @access protected
	 */
	protected function render_content() {
		$this_val = $this->value(); ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<select class="panoply-typography-select" <?php $this->link(); ?>>
				<option value="" 
				<?php
				if ( ! $this_val ) {
					echo 'selected="selected"';}
?>
><?php esc_html_e( 'Default', 'panoply' ); ?></option>
				<?php
				// Get Standard font options
				$std_fonts = panoply_get_standard_fonts();
				if ( ! empty( $std_fonts ) ) {
				?>
					<optgroup label="<?php esc_html_e( 'Standard Fonts', 'panoply' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $std_fonts as $font ) {
						?>
							<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php
				}?>
			</select>

		</label>

		<?php
	}
}
