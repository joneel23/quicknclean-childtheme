<?php
/**
 * Created by PhpStorm.
 * User: WEB
 * Date: 8/31/2020
 * Time: 4:09 PM
 */

namespace Elementor;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

class Elementor_Quick_Map_Widget extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve google maps widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'quick_google_maps';
    }

    /**
     * Get widget title.
     *
     * Retrieve google maps widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'QuicknClean Google Maps', 'elementor' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve google maps widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-google-maps';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the google maps widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'basic' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'google', 'map', 'embed', 'location' ];
    }

    /**
     * Register google maps widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_map',
            [
                'label' => __( 'Map', 'elementor' ),
            ]
        );
        $repeater = new Repeater();
        $this->add_control(
            'store',
            [
                'label' => __( 'Store Title', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' => 'Quick N Clean Car Wash',
                'default' => 'Quick N Clean Car Wash',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'map_id',
            [
                'label' => __( 'Map ID', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' => 'Map ID',
                'default' => '1',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'marker_id',
            [
                'label' => __( 'Marker ID', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' => 'Marker ID',
                'default' => '1',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'marker_display',
            [
                'label' => __('Marker Display Type', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'gmap',
                'options' => [
                    'image' => __('Image Media', 'elementor'),
                    'gmap' => __('Google Map', 'elementor'),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $default_address = __( '6559 E. Northwest Highway Dallas TX 75231', 'elementor' );
        $this->add_control(
            'location',
            [
                'label' => __( 'Location', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' => $default_address,
                'default' => $default_address,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'city',
            [
                'label' => __( 'City', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' =>'Dallas',
                'default' => 'Dallas',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'state',
            [
                'label' => __( 'State', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' =>'Texas',
                'default' => 'Texas',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'hours',
            [
                'label' => 'Hours',
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Hours: <time>8am - 6pm</time>',
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => __( 'Phone Number', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,

                ],
                'placeholder' =>'480-707-3531',
                'default' => '480-707-3531',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'fb_link',
            [
                'label' => __( 'Facebook Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://facebook.com', 'elementor' ),
                'default'=>[
                    'url'=>'',
                ]
            ]
        );

        $this->add_control(
            'insta_link',
            [
                'label' => __( 'Instagram Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://instragram.com', 'elementor' ),
                'default'=>[
                    'url'=>'',
                ]
            ]
        );

        $this->add_control(
            'yelp_link',
            [
                'label' => __( 'Yelp Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://yelp.com', 'elementor' ),
                'default'=>[
                    'url'=>'',
                ]
            ]
        );

        $this->add_control(
            'google_link',
            [
                'label' => __( 'Google My Business', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://www.google.com/maps/', 'elementor' ),
                'default'=>[
                    'url'=>'',
                ]
            ]
        );
        $this->add_control(
            'learnmore_link',
            [
                'label' => __( 'Learn More Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://', 'elementor' ),
                'default'=>[
                    'url'=>'#',
                ]
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label' => __( 'Zoom', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'marker_layout',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Marker Layout', 'elementor-pro' ),
                'default' => 'grid-1',
                'options' => [
                    'grid-1' => __( 'Vertical', 'elementor-pro' ),
                    'grid-2' => __( 'Horizontal', 'elementor-pro' ),

                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_map_style',
            [
                'label' => __( 'Map', 'elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'map_filter' );

        $this->start_controls_tab( 'normal',
            [
                'label' => __( 'Normal', 'elementor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} iframe',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters_hover',
                'selector' => '{{WRAPPER}}:hover iframe',
            ]
        );

        $this->add_control(
            'hover_transition',
            [
                'label' => __( 'Transition Duration', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} iframe' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render google maps widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

//        if ( empty( $settings['address'] ) ) {
//            return;
//        }

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-image' );

        if ( 0 === absint( $settings['zoom']['size'] ) ) {
            $settings['zoom']['size'] = 10;
        }

        if ( $settings['location'] ) {
            $map_id = $settings['map_id'];
            $zoom = (int) $settings['zoom']['size'];
            //$column = $settings['column'];

            $svg_icon_fb = get_stylesheet_directory_uri() . '/svg-icon/icon-fb100.png';
            $svg_icon_insta = get_stylesheet_directory_uri() . '/svg-icon/icon-instagram100.png';
            $svg_icon_yelp = get_stylesheet_directory_uri() . '/svg-icon/icon-yelp100.png';
            $svg_icon_google = get_stylesheet_directory_uri() . '/svg-icon/icon-google100.png';

            $map_wrap_height = $settings['height']['size'];
            $map_wrap_unit = $settings['height']['unit'];
            //var_dump($map_wrap_height);

            $data_store_address = array();
            //create data object for store address

            $data_store_address[] = array( $settings['marker_id'], $settings['location'], $settings['store'], $settings['phone'], $settings['hours'] );


            //$data_store_address = implode(",", $data_store_address);
            echo "<div class='elementor-column'>";

                $marker_id = $settings['marker_id'];
                $city_state = $settings['city'] . ', ' . $settings['state'];
                $location = $settings['location'];
                $store_title = $settings['store'];
                $hours = $settings['hours'];
                $phone = $settings['phone'];
                $fb_link = $settings['fb_link']['url'];
                $insta_link = $settings['insta_link']['url'];
                $yelp_link = $settings['yelp_link']['url'];
                $google_link = $settings['google_link']['url'];
                $learnmore = $settings['learnmore_link']['url'];

                $marker_layout = $settings['marker_layout'];


                if( $marker_layout === 'grid-2'){
                    $city_state1 = "";
                    $city_state2 = "<p class='city-state'>$city_state</p>";
                } else{
                    $city_state1 = "<p class='city-state'>$city_state</p>";
                    $city_state2 = "";
                }
                //var_dump($learnmore);

                echo "<div class='marker-$marker_layout wpgmza-grid-row-100 wpgmaps_mlist_row wpgmza-grid-row wpgmaps_odd map-thumb-$marker_id' data-zoom='$zoom' id='wpgmza_marker_$marker_id' mapid='$map_id' data-marker-id='$marker_id' data-map-id='$map_id' mid='$marker_id' data-address='$location' data-store-title='$store_title'>";
                echo $city_state1;
                echo "<div class='wpgmza-grid-item'>";

                if( $settings['marker_display'] === 'image' ){
                    ?>
                    <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings); ?>
                    </div>
                    <?php
                }
                else {
                    echo "<div class='map-wrap' id='map-wrapper-$marker_id'></div>";
                }

                echo "<div class='wpgmza-grid-item-content'>";

                echo "<div class='wpgmza-desc'>";

                echo $city_state2;
                echo "<p class='address-label'>". $location ."</p>";
                echo "<div class='hours-text'>$hours</div>";
                echo "<p class='phone-label'>Phone Number:</p><p class='phone-number'><span><img class='phone-icon' src='/wp-content/uploads/2020/09/cell-phone-red.svg' alt='$store_title - Contact Number' /></span><span class='contact-no'> <a href='tel:$phone'>$phone</span> </p>";
                echo "</div>";

                echo "<div class='store-social-media'>";
                echo "<ul><li><a class='social-links' href='$fb_link' target='_blank' onclick='javascript:void(0);' data-link='$fb_link'><img class='svg-icon' src='$svg_icon_fb' alt='$store_title - Facebook' /></a></li><li><a class='social-links' href='$insta_link' onclick='javascript:void(0);' target='_blank' target='_blank' data-link='$insta_link'><img class='svg-icon' src='$svg_icon_insta' alt='$store_title - Instagram' /></li><li><a class='social-links' target='_blank' href='$yelp_link' onclick='javascript:void(0);' data-link='$yelp_link'><img class='svg-icon' src='$svg_icon_yelp' alt='$store_title - Yelp' /></li><li><a class='social-links' href='$google_link' target='_blank' onclick='javascript:void(0);' data-link='$google_link'><img class='svg-icon' src='$svg_icon_google' alt='$store_title - Google Store' /></li></ul>";
                echo "</div>";

                echo "<div class='wpgmza-grid-footer'>";
                echo "<a href='$learnmore' onclick='javascript:void(0);' class='footer-links learn-more' data-link='$learnmore'><span>Learn More</span></a><a href='javascript:void(0);' class='wpgmza_gd footer-links directions' wpgm_addr_field='$location' gps=''><span>Get Directions</span></a>";
                echo "</div>";

                echo "</div>";

                echo "</div>";
                echo "</div>";

            echo "</div>";
            ?>

            <?php

        }

    }

    /**
     * Render google maps widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {


    }
}