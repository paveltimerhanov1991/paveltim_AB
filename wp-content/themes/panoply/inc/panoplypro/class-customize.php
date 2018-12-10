<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class panoply_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		//require_once( trailingslashit( get_template_directory() ) . '/admin/newsgempro/section-pro.php' );
                get_template_part('inc/panoplypro/section-pro');
		// Register custom section types.
		$manager->register_section_type( 'panoply_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new panoply_Customize_Section_Pro(
				$manager,
				'pro-theme',
				array(
				     'priority' => 1,
					'title'    => esc_html__( 'Get Pro Version', 'panoply' ),
					'pro_text' => esc_html__( 'Go Pro','panoply' ),
					'pro_url'  => 'https://www.ydesignservices.com/product/premium-wordpress-themes/panoply/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'pro-theme-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/panoplypro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'pro-themecss-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/panoplypro/customize-controls.css' );
	}
}

// Doing this customizer thang!
panoply_Customize::get_instance();
