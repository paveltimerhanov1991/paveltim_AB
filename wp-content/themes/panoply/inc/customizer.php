<?php
function panoply_themes_customizer($wp_customize) {
require get_template_directory() . '/inc/customizer-controls.php';	
require get_template_directory() . '/inc/panoply-customizerclass.php';	
	$wp_customize->remove_section('background_image');
	$pages  =  get_pages();
	$option_pages = array();
	$option_pages[0] = esc_html__( 'Select page', 'panoply' );
	foreach( $pages as $p ){
		$option_pages[ $p->ID ] = $p->post_title;
	}
	for ( $i = 1; $i <= 10 ; $i++) { 
		if($i%2 == 0){
		$panoply_shop_count_choice[$i] = $i; 
		}
	}
	for ( $bi = 1; $bi <= 10 ; $bi++) { 
		if($bi%3 == 0){
		$panoply_blog_count_choice[$bi] = $bi; 
		}
	}
	$panoply_categories = get_categories(array('hide_empty' => 0));
	foreach ($panoply_categories as $panoply_category) {
		$panoply_cat[$panoply_category->term_id] = $panoply_category->cat_name;
	}
//Footer section
/*------------------------------------------------------------------------*/
    /*  Site Options
    /*------------------------------------------------------------------------*/
		$wp_customize->add_panel( 'panoply_footer_options',
			array(
				'priority'       => 23,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Footer Settings', 'panoply' ),
			    'description'    => '',
			)
		);

		/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_footer_settings' ,
			array(
				'priority'    => 4,
				'title'       => esc_html__( 'Social icon settings', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_footer_options',
			)
		);
$wp_customize->add_setting(
'fb_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'fb_link',
array(
   'label' => esc_html__('Facebook url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'tw_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'tw_link',
array(
   'label' => esc_html__('Twitter url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'gp_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'gp_link',
array(
   'label' => esc_html__('Google plus url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'insta_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'insta_link',
array(
   'label' => esc_html__('Instagram url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'skype_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'skype_link',
array(
   'label' => esc_html__('Skype url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'pin_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'pin_link',
array(
   'label' => esc_html__('Pinterest url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'flickr_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'flickr_link',
array(
   'label' => esc_html__('Flickr url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'vimeo_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'vimeo_link',
array(
   'label' => esc_html__('Vimeo url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'youtube_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'youtube_link',
array(
   'label' => esc_html__('Youtube url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'dribbble_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'dribbble_link',
array(
   'label' => esc_html__('Dribbble url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'linkedin_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'linkedin_link',
array(
   'label' => esc_html__('Linkedin url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'tumblr_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'tumblr_link',
array(
   'label' => esc_html__('Tumblr url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);

$wp_customize->add_setting(
'rss_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'rss_link',
array(
   'label' => esc_html__('Rss url', 'panoply'),
   'section' => 'panoply_footer_settings',
   'type' => 'text',
)
);
//Footer tag line
		/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_footer_tagline' ,
			array(
				'priority'    => 4,
				'title'       => esc_html__( 'Footer tagline setting', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_footer_options',
			)
		);
		$wp_customize->add_setting(
'footer_tagline',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'footer_tagline',
array(
   'label' => esc_html__('Footer tagline', 'panoply'),
   'section' => 'panoply_footer_tagline',
   'type' => 'text',
)
);
//Copyright
		/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_footer_copyright' ,
			array(
				'priority'    => 4,
				'title'       => esc_html__( 'Copyright setting', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_footer_options',
			)
		);
		$wp_customize->add_setting(
'footer_copyright',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'footer_copyright',
array(
   'label' => esc_html__('Copyright text', 'panoply'),
   'section' => 'panoply_footer_copyright',
   'type' => 'textarea',
)
);
/*------------------------------------------------------------------------*/
    /*  Panoply sections
    /*------------------------------------------------------------------------*/
		$wp_customize->add_panel( 'panoply_section',
			array(
				'priority'       => 22,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Panoply section', 'panoply' ),
			    'description'    => '',
			)
		);

		/* Global Settings
		----------------------------------------------------------------------*/
		//Hero section
		$wp_customize->add_section( 'panoply_hero_section' ,
			array(
				'priority'    => 1,
				'title'       => esc_html__( 'Section: Hero', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		$wp_customize->add_setting(
			'panoply_hero_heading',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_hero_heading',
				array(
					'settings'		=> 'panoply_hero_heading',
					'section'		=> 'panoply_hero_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
					$wp_customize->add_setting(
					'banner_hero_Section_display',
					array(
					'default' => '0',
					'sanitize_callback' => 'panoply_sanitize_checkbox',
					'transport'   => 'refresh',
					)
					);
				$wp_customize->add_control(
				'banner_hero_Section_display',
				array(
					'section' => 'panoply_hero_section',
				   'type' => 'checkbox',
				   'description' => esc_html__( 'If display section on home page click on checkbox','panoply' ),
				)
				);
				$wp_customize->add_setting(
        'slider_items',
        array(
            'sanitize_callback' => 'panoply_sanitize_repeatable_data_field',
            'transport' => 'refresh', // refresh or postMessage
            'default' => apply_filters( 'panoply_default_slider_items', array(
                    array(
                        'content_layout_1' =>'',
                        'media'=> array(
                            'url' => get_template_directory_uri() . '/assets/images/hero.jpg',
                            'id' => ''
                        )
                    )
                )
            )
        ) );

    $wp_customize->add_control(
        new panoply_Customize_Repeatable_Control(
            $wp_customize,
            'slider_items',
            array(
                'label'     => esc_html__('Hero Item', 'panoply'),
                'description'   => '',
                'section'       => 'panoply_hero_section',
                'live_title_id' => 'title', // apply for input text and textarea only
                'title_format'  => esc_html__('[live_title]', 'panoply'), // [live_title]
                'max_item'      => 3, // Maximum item can add                
                'fields'    => array(
                    'content_layout_1' => array(
                        'title' => esc_html__('Title', 'panoply'),
                        'type'  =>'text',
                    ),
					'content_layout_2' => array(
                        'title' => esc_html__('Sub Title', 'panoply'),
                        'type'  =>'text',
                    ),
                    'media' => array(
                        'title' => esc_html__('Background Image', 'panoply'),
                        'type'  =>'media',
                        'default' => array(
                            'url' => '',
                            'id' => ''
                        )
                    ),
                    'button_label' => array(
                        'title' => esc_html__('First Button Label', 'panoply'),
                        'type'  =>'text',
                    ),
					'button_url' => array(
                        'title' => esc_html__('First Button Url', 'panoply'),
                        'type'  =>'text',
                    ),
					 'button_label_2' => array(
                        'title' => esc_html__('Second Button Label', 'panoply'),
                        'type'  =>'text',
                    ),
					'button_url_2' => array(
                        'title' => esc_html__('Second Button Url', 'panoply'),
                        'type'  =>'text',
                    ),

                ),

            )
        )
    );
		//
		$wp_customize->add_section( 'panoply_about_page_section' ,
			array(
				'priority'    => 2,
				'title'       => esc_html__( 'Section: About Us', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		$wp_customize->add_setting(
			'panoply_about_header',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_about_header',
				array(
					'settings'		=> 'panoply_about_header',
					'section'		=> 'panoply_about_page_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
'panoply_about_section_id',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_about_section_id',
array(
   'type' => 'text',
   'label' => esc_html__('Section ID:', 'panoply'),
   'section' => 'panoply_about_page_section',
   'description' => esc_html__( 'The section id, we will use this for link anchor.','panoply' ),
)
);
$wp_customize->add_setting(
'panoply_about_section_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_about_section_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_about_page_section',   
)
);
$wp_customize->add_setting(
'panoply_about_section_subtitle',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_about_section_subtitle',
array(
   'type' => 'text',
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_about_page_section',   
)
);
$wp_customize->add_setting(
			'panoply_about_page',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_about_page',
				array(
					'settings'		=> 'panoply_about_page',
					'section'		=> 'panoply_about_page_section',
					'label'			=> esc_html__( 'Section Content', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
'panoply_aboutus',
array(
'default' => esc_html__( 'Select Pages', 'panoply' ),
'sanitize_callback' => 'panoply_sanitize_text'
)
);
$wp_customize->add_control(
'panoply_aboutus',
array(
   'label' => esc_html__('About Us', 'panoply'),
   'section' => 'panoply_about_page_section',
   'type'  =>'select',
   'choices' => $option_pages,
   'description' => esc_html__( 'Select page if you want display in about section','panoply' ),
  
)
);
$wp_customize->add_setting(
'panoply_aboutus_var',
array(
'default' =>'select',
'sanitize_callback' => 'panoply_sanitize_text'
)
);
$wp_customize->add_control(
'panoply_aboutus_var',
array(
   'label' => esc_html__('Select Style', 'panoply'),
   'section' => 'panoply_about_page_section',
   'type'  =>'select',
    'choices' => array(
        'select' => esc_html__( 'Select', 'panoply' ),
        'leftimg' => esc_html__( 'Left image', 'panoply' ),
        'rightimg' => esc_html__( 'Right image', 'panoply' ),
		'hideimg' => esc_html__( 'Hide image', 'panoply' ),
		),
   
  
)
);

//services
/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_services_page_section' ,
			array(
				'priority'    => 3,
				'title'       => esc_html__( 'Section: Services', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		
		$wp_customize->add_setting(
			'panoply_service_heading',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_service_heading',
				array(
					'settings'		=> 'panoply_service_heading',
					'section'		=> 'panoply_services_page_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
		$wp_customize->add_setting(
'panoply_services_id',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_services_id',
array(
   'type' => 'text',
   'label' => esc_html__('Section id', 'panoply'),
   'section' => 'panoply_services_page_section', 
   'description' => esc_html__( 'The section id, we will use this for link anchor.','panoply' ),  
)
);
$wp_customize->add_setting(
'panoply_services_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_services_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_services_page_section', 
    
)
);
$wp_customize->add_setting(
'panoply_services_sub_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_services_sub_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_services_page_section', 
    
)
);
$wp_customize->add_setting('panoply_services_bgimg',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_image',
'transport'   => 'refresh',
) );

$wp_customize->add_control(
new WP_Customize_Image_Control(
   $wp_customize,
   'panoply_services_bgimg',
   array(
       'label' => esc_html__('Background image', 'panoply'),
       'section' => 'panoply_services_page_section',
       'settings' => 'panoply_services_bgimg'
   )
)
);
$wp_customize->add_setting(
			'panoply_servicecontent_heading',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_servicecontent_heading',
				array(
					'settings'		=> 'panoply_servicecontent_heading',
					'section'		=> 'panoply_services_page_section',
					'label'			=> esc_html__( 'Section content', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
        'panoply_service_page',
        array(
            'sanitize_callback' => 'panoply_sanitize_repeatable_data_field',
            'transport' => 'refresh', // refresh or postMessage
        ) );

    $wp_customize->add_control(
        new panoply_Customize_Repeatable_Control(
            $wp_customize,
            'panoply_service_page',
            array(
                'label'     => esc_html__('Service content', 'panoply'),
                'description'   => '',
                'section'       => 'panoply_services_page_section',
                'live_title_id' => 'title', // apply for input text and textarea only
                'title_format'  => esc_html__('[live_title]', 'panoply'), // [live_title]
                'max_item'      => 4, // Maximum item can add                
                'fields'    => array(
				'page_id' => array(
                        'title' => esc_html__('Content page', 'panoply'),
                        'type'  =>'select',
                        'options' => $option_pages
                    ),
					'icon' => array(
                        'title' => esc_html__('Font icon', 'panoply'),
                        'type'  =>'icon',
                    ),
					'linksingle' => array(
                        'title' => esc_html__('Link to single page', 'panoply'),
                        'type'  =>'checkbox',
                        'default' => 1,
                    ),
                ),

            )
        )
    );
//Gallery section
/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_gallery_page_section' ,
			array(
				'priority'    => 9,
				'title'       => esc_html__( 'Section: Gallery', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		
		$wp_customize->add_setting(
			'panoply_gallery_heading',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_gallery_heading',
				array(
					'settings'		=> 'panoply_gallery_heading',
					'section'		=> 'panoply_gallery_page_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
		$wp_customize->add_setting(
'panoply_gallery_id',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_gallery_id',
array(
   'type' => 'text',
   'label' => esc_html__('Section id', 'panoply'),
   'section' => 'panoply_gallery_page_section', 
   'description' => esc_html__( 'The section id, we will use this for link anchor.','panoply' ),  
)
);
$wp_customize->add_setting(
'panoply_gallery_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_gallery_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_gallery_page_section', 
    
)
);
$wp_customize->add_setting(
'panoply_gallery_sub_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_gallery_sub_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_gallery_page_section', 
    
)
);
$wp_customize->add_setting(
			'panoply_gallerycontent_heading',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_gallerycontent_heading',
				array(
					'settings'		=> 'panoply_gallerycontent_heading',
					'section'		=> 'panoply_gallery_page_section',
					'label'			=> esc_html__( 'Section content', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting( 'gallery_source_page',
        array(
            'sanitize_callback' => 'panoply_sanitize_text',
            'default'           => '',
        )
    );
    $wp_customize->add_control( 'gallery_source_page',
        array(
            'label'     	=> esc_html__('Select Gallery Page', 'panoply'),
            'section' 		=> 'panoply_gallery_page_section',
            'type'          => 'select',
            'priority'      => 60,
            'choices'       => $option_pages,
            'description'   => esc_html__('Select a page which have content contain gallery.', 'panoply'),
        )
    );
	 // Gallery Display
    $wp_customize->add_setting( 'gallery_display',
        array(
            'sanitize_callback' => 'panoply_sanitize_text',
            'default'           => 'default',
        )
    );
    $wp_customize->add_control( 'gallery_display',
        array(
            'label'     	=> esc_html__('Display', 'panoply'),
            'section' 		=> 'panoply_gallery_page_section',
            'type'          => 'select',
            'priority'      => 70,
            'choices'       => array(
                'grid'      => esc_html__('Grid', 'panoply'),
                'carousel'    => esc_html__('Carousel', 'panoply'),
                'slider'      => esc_html__('Slider', 'panoply'),
            )
        )
    );
//Light box
$wp_customize->add_setting(
					'lightbox',
					array(
					'default' => '0',
					'sanitize_callback' => 'panoply_sanitize_checkbox',
					'transport'   => 'refresh',
					)
					);
				$wp_customize->add_control(
				'lightbox',
				array(
				    'label' => esc_html__('Active lightBox', 'panoply'),
					'section' => 'panoply_gallery_page_section',
				   'type' => 'checkbox',
				   'priority'      => 74,
				)
				);
//Item spacing
$wp_customize->add_setting(
'item_spacing',
array(
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'item_spacing',
array(
   'label' => esc_html__('Item Spacing', 'panoply'),
   'section' => 'panoply_gallery_page_section',
   'type' => 'text',
   'priority'      => 71,
)
);
//layout column
$wp_customize->add_setting(
'gallery_col',
array(
'sanitize_callback' => 'panoply_sanitize_choices',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'gallery_col',
 array(
            'label'     	=> esc_html__('Layout columns', 'panoply'),
            'section' 		=> 'panoply_gallery_page_section',
            'priority'      => 72,
            'type'          => 'select',
            'choices'       => array(
                '1'      => 1,
                '2'      => 2,
                '3'      => 3,
                '4'      => 4,
                '5'      => 5,
                '6'      => 6,
            )

        )
);
//layout column
$wp_customize->add_setting(
'gallery_responsivecol',
array(
'sanitize_callback' => 'panoply_sanitize_choices',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'gallery_responsivecol',
 array(
            'label'     	=> esc_html__('Responsive layout columns', 'panoply'),
            'section' 		=> 'panoply_gallery_page_section',
            'priority'      => 73,
            'type'          => 'select',
            'choices'       => array(
                '1'      => 1,
                '2'      => 2,
                '3'      => 3,                
            )

        )
);
//End gallery
///Shop section settings
$wp_customize->add_section( 'panoply_shop_page_section' ,
			array(
				'priority'    => 4,
				'title'       => esc_html__( 'Section: Shop', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		$wp_customize->add_setting(
			'panoply_shop_header',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_shop_header',
				array(
					'settings'		=> 'panoply_shop_header',
					'section'		=> 'panoply_shop_page_section',
					'label'			=> esc_html__( 'Section Settings', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
'shoppage_Section_id',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'shoppage_Section_id',
array(
   'label' => esc_html__('Section Id', 'panoply'),
   'section' => 'panoply_shop_page_section',
   'type' => 'text',
   'description' => esc_html__( 'The section id, we will use this for link anchor.','panoply' ),
)
);
$wp_customize->add_setting(
'shoppage_Section',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'shoppage_Section',
array(
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_shop_page_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'shoppage_Section_sub_title',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'shoppage_Section_sub_title',
array(
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_shop_page_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
			'panoply_shop_product_count_header',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_shop_product_count_header',
				array(
					'settings'		=> 'panoply_shop_product_count_header',
					'section'		=> 'panoply_shop_page_section',
					'label'			=> esc_html__( 'Section Content', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
		'panoply_shop_page_count',
		array(
			'default'			=> '4',
			'sanitize_callback' => 'panoply_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		new panoply_shopdropdown_select(
		$wp_customize,
		'panoply_shop_page_count',
		array(
			'settings'		=> 'panoply_shop_page_count',
			'section'		=> 'panoply_shop_page_section',
			'label'			=> esc_html__( 'Number of product to show', 'panoply' ),
			'choices'       => $panoply_shop_count_choice
		)
		)
	);
//load more settings
	$wp_customize->add_setting(
		'panoply_shop_loadmore',
		array(
			'default'			=> 'hide',
			'sanitize_callback' => 'panoply_sanitize_choices'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
 $wp_customize,'panoply_shop_loadmore',array(
    'label'      => __( 'Load more shop button', 'panoply' ),
    'settings'   => 'panoply_shop_loadmore',
    'section'    => 'panoply_shop_page_section',
    'type'    => 'select',
    'choices' => array(
        'ajax' => esc_html__( 'Ajax load', 'panoply' ),
        'link' => esc_html__( 'Custom link', 'panoply' ),
        'hide' => esc_html__( 'Hide', 'panoply' ),
    )
)
) );
$wp_customize->add_setting(
'shop_more_text',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'shop_more_text',
array(
   'label' => esc_html__('Custom load more button label', 'panoply'),
   'section' => 'panoply_shop_page_section',
   'type' => 'text',
)
);
//link
$wp_customize->add_setting(
'shop_more_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'shop_more_link',
array(
   'label' => esc_html__('Custom load more shop link', 'panoply'),
   'section' => 'panoply_shop_page_section',
   'type' => 'text',
)
);	
	$wp_customize->add_setting(
			'panoply_shop_desc',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_desc(
				$wp_customize,
				'panoply_shop_desc',
				array(
					'settings'		=> 'panoply_shop_desc',
					'section'		=> 'panoply_shop_page_section',
					'description'	=>__('If display Product section  please install <a target="_blank" href="https://wordpress.org/plugins/woocommerce/">Woocommerce plugin</a> plugin', 'panoply' )			
				)
			)
		);
	//Blog section
	$wp_customize->add_section( 'panoply_blog_section' ,
			array(
				'priority'    => 6,
				'title'       => esc_html__( 'Section: Blog', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		$wp_customize->add_setting(
			'panoply_blog_header',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_blog_header',
				array(
					'settings'		=> 'panoply_blog_header',
					'section'		=> 'panoply_blog_section',
					'label'			=> esc_html__( 'Section Settings', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
'blog_Section_id',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'blog_Section_id',
array(
   'label' => esc_html__('Section id', 'panoply'),
   'section' => 'panoply_blog_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'blog_Section',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'blog_Section',
array(
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_blog_section',
   'type' => 'text',
)
);
//
$wp_customize->add_setting(
'blog_Section_sub_title',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'blog_Section_sub_title',
array(
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_blog_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
		'panoply_blog_count',
		array(
			'default'			=> '3',
			'sanitize_callback' => 'panoply_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		new panoply_shopdropdown_select(
		$wp_customize,
		'panoply_blog_count',
		array(
			'settings'		=> 'panoply_blog_count',
			'section'		=> 'panoply_blog_section',
			'label'			=> esc_html__( 'Number of post to show', 'panoply' ),
			'choices'       => $panoply_blog_count_choice
		)
		)
	);
	//load more settings
	$wp_customize->add_setting(
		'panoply_blog_loadmore',

		array(
			'default'			=> 'hide',
			'sanitize_callback' => 'panoply_sanitize_choices'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
 $wp_customize,'panoply_blog_loadmore',array(
    'label'      => __( 'Load more posts button', 'panoply' ),
    'settings'   => 'panoply_blog_loadmore',
    'section'    => 'panoply_blog_section',
    'type'    => 'select',
    'choices' => array(
        'ajax' => esc_html__( 'Ajax load', 'panoply' ),
        'link' => esc_html__( 'Custom link', 'panoply' ),
        'hide' => esc_html__( 'Hide', 'panoply' ),
    )
)
) );
$wp_customize->add_setting(
'news_more_text',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'news_more_text',
array(
   'label' => esc_html__('Custom load more button label', 'panoply'),
   'section' => 'panoply_blog_section',
   'type' => 'text',
)
);
//link
$wp_customize->add_setting(
'news_more_link',
array(
'default' => '',
'sanitize_callback' => 'esc_url_raw',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'news_more_link',
array(
   'label' => esc_html__('Custom load more posts link', 'panoply'),
   'section' => 'panoply_blog_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
			'panoply_blog_select_recent',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_blog_select_recent',
				array(
					'settings'		=> 'panoply_blog_select_recent',
					'section'		=> 'panoply_blog_section',
					'label'			=> esc_html__( 'Blog Page settings', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting( 'blog_sidebar_settings', array(
  'capability' => 'edit_theme_options',
  'default' => 'right',
  'sanitize_callback' => 'panoply_sanitize_radio',
) );

$wp_customize->add_control( 'blog_sidebar_settings', array(
  'type' => 'radio',
  'section' => 'panoply_blog_section', // Add a default or your own section
  'label' => esc_html__( 'Blog sidebar settings','panoply' ),
  'choices' => array(
    'left' => esc_html__( 'Left sidebar','panoply' ),
    'right' => esc_html__( 'Right sidebar','panoply' ),
    'full' => esc_html__( 'Full width','panoply' ),
  ),
) );
//Call to action
$wp_customize->add_section( 'panoply_calltoaction_section' ,
			array(
				'priority'    => 7,
				'title'       => esc_html__( 'Section: Call to action', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		$wp_customize->add_setting(
			'panoply_calltoaction_header',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_calltoaction_header',
				array(
					'settings'		=> 'panoply_calltoaction_header',
					'section'		=> 'panoply_calltoaction_section',
					'label'			=> esc_html__( 'Call to action section', 'panoply' ),
				)
			)
		);
		$wp_customize->add_setting(
'calltoaction_Section_display',
array(
'default' => '0',
'sanitize_callback' => 'panoply_sanitize_checkbox',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'calltoaction_Section_display',
array(
     'section' => 'panoply_calltoaction_section',
   'type' => 'checkbox',
   'description' => esc_html__( 'If display calltoaction section on home page click on checkbox','panoply' ),
)
);
$wp_customize->add_setting(
'calltoaction_Section_title',
array(
'default' => '',

'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'calltoaction_Section_title',
array(
   'label' => esc_html__('Call to action title', 'panoply'),
   'section' => 'panoply_calltoaction_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'calltoaction_Section_subtitle',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'calltoaction_Section_subtitle',
array(
   'label' => esc_html__('Call to action subtitle', 'panoply'),
   'section' => 'panoply_calltoaction_section',
   'type' => 'textarea',
)
);
$wp_customize->add_setting(
'calltoaction_button_name',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'calltoaction_button_name',
array(
   'label' => esc_html__('Button name', 'panoply'),
   'section' => 'panoply_calltoaction_section',
   'type' => 'text',
)
);
$wp_customize->add_setting(
'calltoaction_button_url',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'calltoaction_button_url',
array(
   'label' => esc_html__('Button url', 'panoply'),
   'section' => 'panoply_calltoaction_section',
   'type' => 'text',
)
);
$wp_customize->add_setting('calltoaction_bgimg',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_image',
'transport'   => 'refresh',
) );

$wp_customize->add_control(
new WP_Customize_Image_Control(
   $wp_customize,
   'calltoaction_bgimg',
   array(
       'label' => esc_html__('Background image', 'panoply'),
       'section' => 'panoply_calltoaction_section',
       'settings' => 'calltoaction_bgimg'
   )
)
);
//Contact us
$wp_customize->add_section( 'panoply_contact_section' ,
			array(
				'priority'    => 8,
				'title'       => esc_html__( 'Section: Contact Us', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		$wp_customize->add_setting(
			'panoply_contact_header',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_contact_header',
				array(
					'settings'		=> 'panoply_contact_header',
					'section'		=> 'panoply_contact_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
'contact_section_id',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'contact_section_id',
array(
   'label' => esc_html__('Section Id', 'panoply'),
   'section' => 'panoply_contact_section',
   'type' => 'text',
   'description' => esc_html__( 'The section id, we will use this for link anchor.','panoply' ),
)
);
$wp_customize->add_setting(
'contact_title',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'contact_title',
array(
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_contact_section',
   'type' => 'text',   
)
);
$wp_customize->add_setting(
'contact_sub_title',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'contact_sub_title',
array(
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_contact_section',
   'type' => 'text',   
)
);
$wp_customize->add_setting(
			'panoply_contact_cf7_guide',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_contact_cf7_guide',
				array(
					'settings'		=> 'panoply_contact_cf7_guide',
					'section'		=> 'panoply_contact_section',
					'label'			=> esc_html__( 'Contact Form 7 settings', 'panoply' ),
				)
			)
		);
		$wp_customize->add_setting(
			'panoply_contact_desc',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_desc(
				$wp_customize,
				'panoply_contact_desc',
				array(
					'settings'		=> 'panoply_contact_desc',
					'section'		=> 'panoply_contact_section',
					'description'	=>__('In order to display contact form please install <a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> plugin and then copy the contact form shortcode and paste it here, the shortcode will be like this <code>[contact-form-7 id="xxxx" title="Example Contact Form"]</code>', 'panoply' )			
				)
			)
		);
		// Contact Form 7 Shortcode
		$wp_customize->add_setting( 'panoply_contact_cf7',
			array(
				'sanitize_callback' => 'panoply_sanitize_text',
				'default'           => '',
			)
		);
		$wp_customize->add_control( 'panoply_contact_cf7',
			array(
			'type' => 'text',
				'label'     	=> esc_html__('Contact Form 7 Shortcode.', 'panoply'),
				'section' 		=> 'panoply_contact_section',
				'description'   => '',
			)
		);
$wp_customize->add_setting(
			'panoply_contact_detail',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_contact_detail',
				array(
					'settings'		=> 'panoply_contact_detail',
					'section'		=> 'panoply_contact_section',
					'label'			=> esc_html__( 'Section Content', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
'contact_email',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'contact_email',
array(
   'label' => esc_html__('Contact email id', 'panoply'),
   'section' => 'panoply_contact_section',
   'type' => 'text',
   'input_attrs' => array(
    'placeholder' => esc_html__( 'email@example.com','panoply' ),
  ),
)
);
$wp_customize->add_setting(
'contact_address',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'contact_address',
array(
   'label' => esc_html__('Contact address', 'panoply'),
   'section' => 'panoply_contact_section',
   'type' => 'text',
   'input_attrs' => array(
    
  ),
)
);
$wp_customize->add_setting(
'contact_phone',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);
$wp_customize->add_control(
'contact_phone',
array(
   'label' => esc_html__('Contact phone no', 'panoply'),
   'section' => 'panoply_contact_section',
   'type' => 'text',
   'input_attrs' => array(
    
  ),
)
);
//mapsettings
$wp_customize->add_setting(
			'panoply_contact_map',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_contact_map',
				array(
					'settings'		=> 'panoply_contact_map',
					'section'		=> 'panoply_contact_section',
					'label'			=> esc_html__( 'Contact map settings', 'panoply' ),
				)
			)
		);
		$wp_customize->add_setting(
			'contact_map',
			array(
			'default' => '',
			'sanitize_callback' => 'panoply_allowhtml_string',
			'transport'   => 'refresh',
			)
			);
			$wp_customize->add_control(
			'contact_map',
			array(
			   'label' => esc_html__('Iframe code', 'panoply'),
			   'section' => 'panoply_contact_section',
			   'type' => 'textarea',
			)
		);
//Client testimonials
/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_testimonials_section' ,
			array(
				'priority'    =>5,
				'title'       => esc_html__( 'Section: Testimonials', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
		
		$wp_customize->add_setting(
			'panoply_testimonials_label',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_service_id',
				array(
					'settings'		=> 'panoply_testimonials_label',
					'section'		=> 'panoply_testimonials_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
		
$wp_customize->add_setting(
'panoply_testimonials_id',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(
'panoply_testimonials_id',
array(
   'type' => 'text',
   'label' => esc_html__('Section Id:', 'panoply'),
   'section' => 'panoply_testimonials_section', 
   'description' => esc_html__( 'The section id, we will use this for link anchor.','panoply' ),
    
)
);
$wp_customize->add_setting(
'panoply_testimonials_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(

'panoply_testimonials_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section title', 'panoply'),
   'section' => 'panoply_testimonials_section', 
    
)
);
$wp_customize->add_setting(
'panoply_testimonials_sub_title',array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_text',
'transport'   => 'refresh',
)
);

$wp_customize->add_control(

'panoply_testimonials_sub_title',
array(
   'type' => 'text',
   'label' => esc_html__('Section sub title', 'panoply'),
   'section' => 'panoply_testimonials_section', 
    
)
);
$wp_customize->add_setting(
			'panoply_testimonials_content',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_testimonials_content',
				array(
					'settings'		=> 'panoply_testimonials_content',
					'section'		=> 'panoply_testimonials_section',
					'label'			=> esc_html__( 'Section Content', 'panoply' ),
				)
			)
		);
		
		for( $i = 1; $i < 9; $i++ ){
	$wp_customize->add_setting(
			'panoply_testimonials_content'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_testimonials_content'.$i,
				array(
					'settings'		=> 'panoply_testimonials_content'.$i,
					'section'		=> 'panoply_testimonials_section',
					'label'			=> esc_html__( 'Testimonial ', 'panoply' ).$i
				)
			)
		);
		
$wp_customize->add_setting(
			'panoply_user_name'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'panoply_user_name'.$i,
			array(
				'settings'		=> 'panoply_user_name'.$i,
				'section'		=> 'panoply_testimonials_section',
				'type'			=> 'text',
				'label'			=> esc_html__( 'Name', 'panoply' )
			)
		);
		$wp_customize->add_setting(
			'panoply_user_desig'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'panoply_user_desig'.$i,
			array(
				'settings'		=> 'panoply_user_desig'.$i,
				'section'		=> 'panoply_testimonials_section',
				'type'			=> 'text',
				'label'			=> esc_html__( 'Designation', 'panoply' )
			)
		);
		$wp_customize->add_setting(
			'panoply_user_text'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'panoply_user_text'.$i,
			array(
				'settings'		=> 'panoply_user_text'.$i,
				'section'		=> 'panoply_testimonials_section',
				'type'			=> 'textarea',
				'label'			=> esc_html__( 'Text', 'panoply' )
			)
		);
$wp_customize->add_setting('client_image'.$i,array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_image',
'transport'   => 'refresh',
) );

$wp_customize->add_control(
new WP_Customize_Image_Control(
   $wp_customize,
   'client_image'.$i,
   array(
       'label' => esc_html__('Image ', 'panoply').$i,
       'section' => 'panoply_testimonials_section',
       'settings' => 'client_image'.$i,
   )
)
);
//reorder section
$wp_customize->add_section( 'panoply_reorder_section' ,
			array(
				'priority'    => 10,
				'title'       => esc_html__( 'Reorder sections', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_section',
			)
		);
        $wp_customize->add_setting(
			'panoply_reorder_heading',
			array(
				'default'			=> '',
				'sanitize_callback' => 'panoply_sanitize_text'
			)
		);
		$wp_customize->add_control(
			new panoply_Customize_Heading(
				$wp_customize,
				'panoply_reorder_heading',
				array(
					'settings'		=> 'panoply_reorder_heading',
					'section'		=> 'panoply_reorder_section',
					'label'			=> esc_html__( 'Section settings', 'panoply' ),
				)
			)
		);
$wp_customize->add_setting(
        'allsection',
        array(
            'sanitize_callback' => 'panoply_sanitize_repeatable_data_field',
            'transport' => 'refresh', // refresh or postMessage
        ) );

    $wp_customize->add_control(
        new panoply_Customize_Repeatable_Control(
            $wp_customize,
            'allsection',
            array(
                'label'     => esc_html__('Reorder section', 'panoply'),
                'description'   => '',
                'section'       => 'panoply_reorder_section',
                'live_title_id' => 'title', // apply for input text and textarea only
                'title_format'  => esc_html__('[live_title]', 'panoply'), // [live_title]
                'max_item'      => 9, // Maximum item can add                
                'fields'    => array(
				'order_type' => array(
                        'title' => esc_html__('Reorder section', 'panoply'),
                        'type'  =>'select',
                        'options' => array(
                            'banner'     => esc_html__('Banner section', 'panoply'),
                            'aboutus' => esc_html__('Aboutus section', 'panoply'),
                            'services'       => esc_html__('Services section', 'panoply'),
							'shop'       => esc_html__('Shop section', 'panoply'),
							'testimonials'       => esc_html__('Testimonial section', 'panoply'),
							'blog'       => esc_html__('Blog section', 'panoply'),
							'calltoaction'       => esc_html__('Call to action section', 'panoply'),
							'contactus'       => esc_html__('Contactus section', 'panoply'),
							'gallery'       => esc_html__('Gallery section', 'panoply'),
                        )
                    ),
                ),

            )
        )
    );
	//end
}
$wp_customize->add_panel( 'panoply_header_options',
			array(
				'priority'       => 50,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Header logo Settings', 'panoply' ),
			    'description'    => '',
			)
		);

		/* Global Settings
		----------------------------------------------------------------------*/
		$wp_customize->add_section( 'panoply_header_settings' ,
			array(
				'priority'    => 4,
				'title'       => esc_html__( 'Logo settings', 'panoply' ),
				'description' => '',
				'panel'       => 'panoply_header_options',
			)
		);
$wp_customize->add_setting(
'logo_placement',
array(
'default' => '',
'sanitize_callback' => 'panoply_sanitize_radio',
'transport'   => 'refresh',
)
);
$wp_customize->add_control( 'logo_placement', array(
  'type' => 'radio',
  'section' => 'panoply_header_settings', // Add a default or your own section
  'label' => esc_html__( 'Logo settings','panoply' ),
  'choices' => array(
    'left' => esc_html__( 'Left','panoply' ),
    'right' => esc_html__( 'Right','panoply' ),
    'full' => esc_html__( 'Center','panoply' ),
  ),
) );
$wp_customize->add_panel( 'panoply_typography_options',
			array(
				'priority'       => 50,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => esc_html__( 'Typography', 'panoply' ),
			    'description'    => '',
			)
		);
//Typography
	$wp_customize->add_section(
   'typography_settings',
   array(
       'title' => esc_html__('Typography font size', 'panoply'),
       'priority' => 1,
	   'panel'       => 'panoply_typography_options',
   )
);
$wp_customize->add_setting(
'heading_h1',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));

$wp_customize->add_control( new panoply_Customizer_Range_Value_Control( $wp_customize, 'heading_h1', array(
	'type'     => 'range-value',
	'section'  => 'typography_settings',
	'settings' => 'heading_h1',
	'label'    => esc_html__( 'H1 font size','panoply' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 70,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
) ) );
//h2
$wp_customize->add_setting(
'heading_h2',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));

$wp_customize->add_control( new panoply_Customizer_Range_Value_Control( $wp_customize, 'heading_h2', array(
	'type'     => 'range-value',
	'section'  => 'typography_settings',
	'settings' => 'heading_h2',
	'label'    => esc_html__( 'H2 font size','panoply' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 70,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
) ) );
$wp_customize->add_setting(
'heading_h3',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));

$wp_customize->add_control( new panoply_Customizer_Range_Value_Control( $wp_customize, 'heading_h3', array(
	'type'     => 'range-value',
	'section'  => 'typography_settings',
	'settings' => 'heading_h3',
	'label'    => esc_html__( 'H3 font size','panoply' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 70,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
) ) );
$wp_customize->add_setting(
'heading_h4',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));

$wp_customize->add_control( new panoply_Customizer_Range_Value_Control( $wp_customize, 'heading_h4', array(
	'type'     => 'range-value',
	'section'  => 'typography_settings',
	'settings' => 'heading_h4',
	'label'    => esc_html__( 'H4 font size','panoply' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 70,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
) ) );

$wp_customize->add_setting(
'heading_h5',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));

$wp_customize->add_control( new panoply_Customizer_Range_Value_Control( $wp_customize, 'heading_h5', array(
	'type'     => 'range-value',
	'section'  => 'typography_settings',
	'settings' => 'heading_h5',
	'label'    => esc_html__( 'H5 font size','panoply' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 70,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
) ) );
$wp_customize->add_setting(
'heading_h6',array(
'default' => '',
'sanitize_callback' => 'sanitize_text_field',
'transport'=> 'refresh',));

$wp_customize->add_control( new panoply_Customizer_Range_Value_Control( $wp_customize, 'heading_h6', array(
	'type'     => 'range-value',
	'section'  => 'typography_settings',
	'settings' => 'heading_h6',
	'label'    => esc_html__( 'H6 font size','panoply' ),
	'input_attrs' => array(
		'min'    => 1,
		'max'    => 70,
		'step'   => 1,
		'suffix' => 'px', //optional suffix
  	),
) ) );
//body font
$wp_customize->add_section(
   'bodytypography_settings',
   array(
       'title' => esc_html__('Body font family', 'panoply'),
       'priority' => 2,
	   'panel'       => 'panoply_typography_options',
   )
);
$wp_customize->add_setting(
			'panoply_h1_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new panoply_Font_Selector(
				$wp_customize, 'panoply_h1_font', array(
					'label'    => esc_html__( 'H1 font family', 'panoply' ),
					'section'  => 'bodytypography_settings',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);
		$wp_customize->add_setting(
			'panoply_h2_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new panoply_Font_Selector(
				$wp_customize, 'panoply_h2_font', array(
					'label'    => esc_html__( 'H2 font family', 'panoply' ),
					'section'  => 'bodytypography_settings',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);
		$wp_customize->add_setting(
			'panoply_h3_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new panoply_Font_Selector(
				$wp_customize, 'panoply_h3_font', array(
					'label'    => esc_html__( 'H3 font family', 'panoply' ),
					'section'  => 'bodytypography_settings',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);
		$wp_customize->add_setting(
			'panoply_h4_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new panoply_Font_Selector(
				$wp_customize, 'panoply_h4_font', array(
					'label'    => esc_html__( 'H4 font family', 'panoply' ),
					'section'  => 'bodytypography_settings',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);
		$wp_customize->add_setting(
			'panoply_h5_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new panoply_Font_Selector(
				$wp_customize, 'panoply_h5_font', array(
					'label'    => esc_html__( 'H5 font family', 'panoply' ),
					'section'  => 'bodytypography_settings',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);
		$wp_customize->add_setting(
			'panoply_h6_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new panoply_Font_Selector(
				$wp_customize, 'panoply_h6_font', array(
					'label'    => esc_html__( 'H6 font family', 'panoply' ),
					'section'  => 'bodytypography_settings',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);
}
add_action('customize_register', 'panoply_themes_customizer');
/* add settings to create various social media text areas. */
function panoply_customizer_script() {
	wp_enqueue_script( 'panoply-customizer-script', get_template_directory_uri() .'/inc/js/customizer-scripts.js', array('jquery'),'', true  );
	wp_enqueue_style( 'font-awesome-customizer', get_template_directory_uri() .'/css/font-awesome.css');	
	wp_enqueue_style( 'panoply-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
}
add_action( 'customize_controls_enqueue_scripts', 'panoply_customizer_script' );
if( class_exists( 'WP_Customize_Control' ) ):
class panoply_Customize_Heading extends WP_Customize_Control {

    public function render_content() {
    	?>

        <?php if ( !empty( $this->label ) ) : ?>
            <h3 class="panoply-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif; ?>
    <?php }
}
class panoply_Customize_desc extends WP_Customize_Control {

    public function render_content() {
    	?>

        <?php if ( !empty( $this->description ) ) : ?>
            <p class="description"><?php echo wp_kses_post( $this->description ); ?></p>
        <?php endif; ?>
    <?php }
}
class panoply_Fontawesome_Icon_Chooser extends WP_Customize_Control{
	public $type = 'icon';

	public function render_content(){
		?>
            <label>
                <div class="panoply-selected-icon">
                	<i class="fa <?php echo esc_attr($this->value()); ?>"></i>
                	<span><i class="fa fa-angle-down"></i></span>
                </div>

                <ul class="panoply-icon-list">
                	<?php
                	$hashone_font_awesome_icon_array = panoply_font_awesome_icon_array();
                	foreach ($hashone_font_awesome_icon_array as $hashone_font_awesome_icon) {
							$icon_class = $this->value() == $hashone_font_awesome_icon ? 'icon-active' : '';
							echo '<li class='.esc_attr($icon_class).'><i class="'.esc_attr($hashone_font_awesome_icon).'"></i></li>';
						}
                	?>
                </ul>
                <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
            </label>
		<?php
	}
}
class panoply_shopdropdown_select extends WP_Customize_Control{
	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select class="panoply-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html($label) . '</option>';
                    ?>
                </select>
            </label>
		<?php
	}
}
endif;
function panoply_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
function panoply_sanitize_text($input) {
   return wp_kses_post($input);
}
function panoply_sanitize_checkbox( $checked ) {
  if ( $checked == 1 ) {
        return 1;
    } else {
        return '';
    }
}
function panoply_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}
function panoply_allowhtml_string($string) {
        $allowed_tags = array(    
        'a' => array(
        'href' => array(),
        'title' => array()),
        'img' => array(
        'src' => array(),  
        'alt' => array(),),
        'iframe' => array(
        'src' => array(),  
        'frameborder' => array(),
        'allowfullscreen' => array(),
        'width' => array(),
	'height' => array(),
         ),
        'p' => array(),
	
        'br' => array(),
        'em' => array(),
        'strong' => array(),);
        return wp_kses($string,$allowed_tags);

    }
function panoply_sanitize_radio( $input, $setting ) {
  // Ensure input is a slug.
  $input = sanitize_key( $input );
  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function panoply_customize_controls_enqueue_scripts(){
    wp_localize_script( 'customize-controls', 'C_Icon_Picker',
        apply_filters( 'c_icon_picker_js_setup',
            array(
                'search'    => esc_html__( 'Search', 'panoply' ),
                'fonts' => array(
                    'font-awesome' => array(
                        // Name of icon
                        'name' => esc_html__( 'Font Awesome', 'panoply' ),
                        // prefix class example for font-awesome fa-fa-{name}
                        'prefix' => 'fa',
                        // font url
                        'url' => get_template_directory_uri() .'/css/font-awesome.min.css',
                        // Icon class name, separated by |
                        'icons' => 'fa-500px|fa-adjust|fa-adn|fa-align-center|fa-align-justify|fa-align-left|fa-align-right|fa-amazon|fa-ambulance|fa-american-sign-language-interpreting|fa-anchor|fa-android|fa-angellist|fa-angle-double-down|fa-angle-double-left|fa-angle-double-right|fa-angle-double-up|fa-angle-down|fa-angle-left|fa-angle-right|fa-angle-up|fa-apple|fa-archive|fa-area-chart|fa-arrow-circle-down|fa-arrow-circle-left|fa-arrow-circle-o-down|fa-arrow-circle-o-left|fa-arrow-circle-o-right|fa-arrow-circle-o-up|fa-arrow-circle-right|fa-arrow-circle-up|fa-arrow-down|fa-arrow-left|fa-arrow-right|fa-arrow-up|fa-arrows|fa-arrows-alt|fa-arrows-h|fa-arrows-v|fa-asl-interpreting|fa-assistive-listening-systems|fa-asterisk|fa-at|fa-audio-description|fa-automobile|fa-backward|fa-balance-scale|fa-ban|fa-bank|fa-bar-chart|fa-bar-chart-o|fa-barcode|fa-bars|fa-battery-0|fa-battery-1|fa-battery-2|fa-battery-3|fa-battery-4|fa-battery-empty|fa-battery-full|fa-battery-half|fa-battery-quarter|fa-battery-three-quarters|fa-bed|fa-beer|fa-behance|fa-behance-square|fa-bell|fa-bell-o|fa-bell-slash|fa-bell-slash-o|fa-bicycle|fa-binoculars|fa-birthday-cake|fa-bitbucket|fa-bitbucket-square|fa-bitcoin|fa-black-tie|fa-blind|fa-bluetooth|fa-bluetooth-b|fa-bold|fa-bolt|fa-bomb|fa-book|fa-bookmark|fa-bookmark-o|fa-braille|fa-briefcase|fa-btc|fa-bug|fa-building|fa-building-o|fa-bullhorn|fa-bullseye|fa-bus|fa-buysellads|fa-cab|fa-calculator|fa-calendar|fa-calendar-check-o|fa-calendar-minus-o|fa-calendar-o|fa-calendar-plus-o|fa-calendar-times-o|fa-camera|fa-camera-retro|fa-car|fa-caret-down|fa-caret-left|fa-caret-right|fa-caret-square-o-down|fa-caret-square-o-left|fa-caret-square-o-right|fa-caret-square-o-up|fa-caret-up|fa-cart-arrow-down|fa-cart-plus|fa-cc|fa-cc-amex|fa-cc-diners-club|fa-cc-discover|fa-cc-jcb|fa-cc-mastercard|fa-cc-paypal|fa-cc-stripe|fa-cc-visa|fa-certificate|fa-chain|fa-chain-broken|fa-check|fa-check-circle|fa-check-circle-o|fa-check-square|fa-check-square-o|fa-chevron-circle-down|fa-chevron-circle-left|fa-chevron-circle-right|fa-chevron-circle-up|fa-chevron-down|fa-chevron-left|fa-chevron-right|fa-chevron-up|fa-child|fa-chrome|fa-circle|fa-circle-o|fa-circle-o-notch|fa-circle-thin|fa-clipboard|fa-clock-o|fa-clone|fa-close|fa-cloud|fa-cloud-download|fa-cloud-upload|fa-cny|fa-code|fa-code-fork|fa-codepen|fa-codiepie|fa-coffee|fa-cog|fa-cogs|fa-columns|fa-comment|fa-comment-o|fa-commenting|fa-commenting-o|fa-comments|fa-comments-o|fa-compass|fa-compress|fa-connectdevelop|fa-contao|fa-copy|fa-copyright|fa-creative-commons|fa-credit-card|fa-credit-card-alt|fa-crop|fa-crosshairs|fa-css3|fa-cube|fa-cubes|fa-cut|fa-cutlery|fa-dashboard|fa-dashcube|fa-database|fa-deaf|fa-deafness|fa-dedent|fa-delicious|fa-desktop|fa-deviantart|fa-diamond|fa-digg|fa-dollar|fa-dot-circle-o|fa-download|fa-dribbble|fa-dropbox|fa-drupal|fa-edge|fa-edit|fa-eject|fa-ellipsis-h|fa-ellipsis-v|fa-empire|fa-envelope|fa-envelope-o|fa-envelope-square|fa-envira|fa-eraser|fa-eur|fa-euro|fa-exchange|fa-exclamation|fa-exclamation-circle|fa-exclamation-triangle|fa-expand|fa-expeditedssl|fa-external-link|fa-external-link-square|fa-eye|fa-eye-slash|fa-eyedropper|fa-facebook|fa-facebook-f|fa-facebook-official|fa-facebook-square|fa-fast-backward|fa-fast-forward|fa-fax|fa-feed|fa-female|fa-fighter-jet|fa-file|fa-file-archive-o|fa-file-audio-o|fa-file-code-o|fa-file-excel-o|fa-file-image-o|fa-file-movie-o|fa-file-o|fa-file-pdf-o|fa-file-photo-o|fa-file-picture-o|fa-file-powerpoint-o|fa-file-sound-o|fa-file-text|fa-file-text-o|fa-file-video-o|fa-file-word-o|fa-file-zip-o|fa-files-o|fa-film|fa-filter|fa-fire|fa-fire-extinguisher|fa-firefox|fa-first-order|fa-flag|fa-flag-checkered|fa-flag-o|fa-flash|fa-flask|fa-flickr|fa-floppy-o|fa-folder|fa-folder-o|fa-folder-open|fa-folder-open-o|fa-font|fa-fonticons|fa-fort-awesome|fa-forumbee|fa-forward|fa-foursquare|fa-frown-o|fa-futbol-o|fa-gamepad|fa-gavel|fa-gbp|fa-ge|fa-gear|fa-gears|fa-genderless|fa-get-pocket|fa-gg|fa-gg-circle|fa-gift|fa-git|fa-git-square|fa-github|fa-github-alt|fa-github-square|fa-gitlab|fa-gittip|fa-glass|fa-glide|fa-glide-g|fa-globe|fa-google|fa-google-plus|fa-google-plus-square|fa-google-wallet|fa-graduation-cap|fa-gratipay|fa-group|fa-h-square|fa-hacker-news|fa-hand-grab-o|fa-hand-lizard-o|fa-hand-o-down|fa-hand-o-left|fa-hand-o-right|fa-hand-o-up|fa-hand-paper-o|fa-hand-peace-o|fa-hand-pointer-o|fa-hand-rock-o|fa-hand-scissors-o|fa-hand-spock-o|fa-hand-stop-o|fa-hard-of-hearing|fa-hashtag|fa-hdd-o|fa-header|fa-headphones|fa-heart|fa-heart-o|fa-heartbeat|fa-history|fa-home|fa-hospital-o|fa-hotel|fa-hourglass|fa-hourglass-1|fa-hourglass-2|fa-hourglass-3|fa-hourglass-end|fa-hourglass-half|fa-hourglass-o|fa-hourglass-start|fa-houzz|fa-html5|fa-i-cursor|fa-ils|fa-image|fa-inbox|fa-indent|fa-industry|fa-info|fa-info-circle|fa-inr|fa-instagram|fa-institution|fa-internet-explorer|fa-intersex|fa-ioxhost|fa-italic|fa-joomla|fa-jpy|fa-jsfiddle|fa-key|fa-keyboard-o|fa-krw|fa-language|fa-laptop|fa-lastfm|fa-lastfm-square|fa-leaf|fa-leanpub|fa-legal|fa-lemon-o|fa-level-down|fa-level-up|fa-life-bouy|fa-life-buoy|fa-life-ring|fa-life-saver|fa-lightbulb-o|fa-line-chart|fa-link|fa-linkedin|fa-linkedin-square|fa-linux|fa-list|fa-list-alt|fa-list-ol|fa-list-ul|fa-location-arrow|fa-lock|fa-long-arrow-down|fa-long-arrow-left|fa-long-arrow-right|fa-long-arrow-up|fa-low-vision|fa-magic|fa-magnet|fa-mail-forward|fa-mail-reply|fa-mail-reply-all|fa-male|fa-map|fa-map-marker|fa-map-o|fa-map-pin|fa-map-signs|fa-mars|fa-mars-double|fa-mars-stroke|fa-mars-stroke-h|fa-mars-stroke-v|fa-maxcdn|fa-meanpath|fa-medium|fa-medkit|fa-meh-o|fa-mercury|fa-microphone|fa-microphone-slash|fa-minus|fa-minus-circle|fa-minus-square|fa-minus-square-o|fa-mixcloud|fa-mobile|fa-mobile-phone|fa-modx|fa-money|fa-moon-o|fa-mortar-board|fa-motorcycle|fa-mouse-pointer|fa-music|fa-navicon|fa-neuter|fa-newspaper-o|fa-object-group|fa-object-ungroup|fa-odnoklassniki|fa-odnoklassniki-square|fa-opencart|fa-openid|fa-opera|fa-optin-monster|fa-outdent|fa-pagelines|fa-paint-brush|fa-paper-plane|fa-paper-plane-o|fa-paperclip|fa-paragraph|fa-paste|fa-pause|fa-pause-circle|fa-pause-circle-o|fa-paw|fa-paypal|fa-pencil|fa-pencil-square|fa-pencil-square-o|fa-percent|fa-phone|fa-phone-square|fa-photo|fa-picture-o|fa-pie-chart|fa-pied-piper|fa-pied-piper-alt|fa-pied-piper-pp|fa-pinterest|fa-pinterest-p|fa-pinterest-square|fa-plane|fa-play|fa-play-circle|fa-play-circle-o|fa-plug|fa-plus|fa-plus-circle|fa-plus-square|fa-plus-square-o|fa-power-off|fa-print|fa-product-hunt|fa-puzzle-piece|fa-qq|fa-qrcode|fa-question|fa-question-circle|fa-question-circle-o|fa-quote-left|fa-quote-right|fa-ra|fa-random|fa-rebel|fa-recycle|fa-reddit|fa-reddit-alien|fa-reddit-square|fa-refresh|fa-registered|fa-remove|fa-renren|fa-reorder|fa-repeat|fa-reply|fa-reply-all|fa-resistance|fa-retweet|fa-rmb|fa-road|fa-rocket|fa-rotate-left|fa-rotate-right|fa-rouble|fa-rss|fa-rss-square|fa-rub|fa-ruble|fa-rupee|fa-safari|fa-save|fa-scissors|fa-scribd|fa-search|fa-search-minus|fa-search-plus|fa-sellsy|fa-send|fa-send-o|fa-server|fa-share|fa-share-alt|fa-share-alt-square|fa-share-square|fa-share-square-o|fa-shekel|fa-sheqel|fa-shield|fa-ship|fa-shirtsinbulk|fa-shopping-bag|fa-shopping-basket|fa-shopping-cart|fa-sign-in|fa-sign-language|fa-sign-out|fa-signal|fa-signing|fa-simplybuilt|fa-sitemap|fa-skyatlas|fa-skype|fa-slack|fa-sliders|fa-slideshare|fa-smile-o|fa-snapchat|fa-snapchat-ghost|fa-snapchat-square|fa-soccer-ball-o|fa-sort|fa-sort-alpha-asc|fa-sort-alpha-desc|fa-sort-amount-asc|fa-sort-amount-desc|fa-sort-asc|fa-sort-desc|fa-sort-down|fa-sort-numeric-asc|fa-sort-numeric-desc|fa-sort-up|fa-soundcloud|fa-space-shuttle|fa-spinner|fa-spoon|fa-spotify|fa-square|fa-square-o|fa-stack-exchange|fa-stack-overflow|fa-star|fa-star-half|fa-star-half-empty|fa-star-half-full|fa-star-half-o|fa-star-o|fa-steam|fa-steam-square|fa-step-backward|fa-step-forward|fa-stethoscope|fa-sticky-note|fa-sticky-note-o|fa-stop|fa-stop-circle|fa-stop-circle-o|fa-street-view|fa-strikethrough|fa-stumbleupon|fa-stumbleupon-circle|fa-subscript|fa-subway|fa-suitcase|fa-sun-o|fa-superscript|fa-support|fa-table|fa-tablet|fa-tachometer|fa-tag|fa-tags|fa-tasks|fa-taxi|fa-television|fa-tencent-weibo|fa-terminal|fa-text-height|fa-text-width|fa-th|fa-th-large|fa-th-list|fa-themeisle|fa-thumb-tack|fa-thumbs-down|fa-thumbs-o-down|fa-thumbs-o-up|fa-thumbs-up|fa-ticket|fa-times|fa-times-circle|fa-times-circle-o|fa-tint|fa-toggle-down|fa-toggle-left|fa-toggle-off|fa-toggle-on|fa-toggle-right|fa-toggle-up|fa-trademark|fa-train|fa-transgender|fa-transgender-alt|fa-trash|fa-trash-o|fa-tree|fa-trello|fa-tripadvisor|fa-trophy|fa-truck|fa-try|fa-tty|fa-tumblr|fa-tumblr-square|fa-turkish-lira|fa-tv|fa-twitch|fa-twitter|fa-twitter-square|fa-umbrella|fa-underline|fa-undo|fa-universal-access|fa-university|fa-unlink|fa-unlock|fa-unlock-alt|fa-unsorted|fa-upload|fa-usb|fa-usd|fa-user|fa-user-md|fa-user-plus|fa-user-secret|fa-user-times|fa-users|fa-venus|fa-venus-double|fa-venus-mars|fa-viacoin|fa-viadeo|fa-viadeo-square|fa-video-camera|fa-vimeo|fa-vimeo-square|fa-vine|fa-vk|fa-volume-control-phone|fa-volume-down|fa-volume-off|fa-volume-up|fa-warning|fa-wechat|fa-weibo|fa-weixin|fa-whatsapp|fa-wheelchair|fa-wheelchair-alt|fa-wifi|fa-wikipedia-w|fa-windows|fa-won|fa-wordpress|fa-wpbeginner|fa-wpforms|fa-wrench|fa-xing|fa-xing-square|fa-y-combinator|fa-y-combinator-square|fa-yahoo|fa-yc|fa-yc-square|fa-yelp|fa-yen|fa-yoast|fa-youtube|fa-youtube-play|fa-youtube-square',
                    ),
                )

            )
        )
    );
}

add_action( 'customize_controls_enqueue_scripts', 'panoply_customize_controls_enqueue_scripts' );
?>