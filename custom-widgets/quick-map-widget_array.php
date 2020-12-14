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
        $repeater->add_control(
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
        $repeater->add_control(
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

        $default_address = __( '6559 E. Northwest Highway Dallas TX 75231', 'elementor' );
        $repeater->add_control(
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
        $repeater->add_control(
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
        $repeater->add_control(
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
        $repeater->add_control(
            'hours',
            [
                'label' => 'Hours',
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Hours: <time>8am - 6pm</time>',
            ]
        );

        $repeater->add_control(
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
        $repeater->add_control(
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

        $repeater->add_control(
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

        $repeater->add_control(
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

        $repeater->add_control(
            'google_link',
            [
                'label' => __( 'Goole+ Link', 'elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://plus.google.com/', 'elementor' ),
                'default'=>[
                    'url'=>'',
                ]
            ]
        );
        $repeater->add_control(
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
            'addresses',
            [
                'type' => Controls_Manager::REPEATER,
                'label' => __( 'Maps', 'elementor-pro' ),
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ store }}}',
                //'placeholder' => $default_address,
                'default' => [
                    [
                        'store' => 'Quick N Clean Car Wash',
                        'marker_id' => '1',
                        'location' => $default_address,
                        'city' => 'Dallas',
                        'state' => 'Texas',
                        'hours' => 'Hours: <time>8am - 6pm</time>',
                        'phone' => '480-707-3531',
                        'fb_link' => '#',
                        'insta_link' => '#',
                        'yelp_link' => '#',
                        'google_link' => '#',
                        'learnmore_link' => '#',
                    ],
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'column',
            [
                'label' => __( 'No of Columns', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '100' => __( '1', 'elementor-pro' ),
                    '50' => __( '2', 'elementor-pro' ),
                    '33' => __( '3', 'elementor-pro' ),
                    '25' => __( '4', 'elementor-pro' ),
                    '20' => __( '5', 'elementor-pro' ),
                ],
                'default' => '50',
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

        if ( 0 === absint( $settings['zoom']['size'] ) ) {
            $settings['zoom']['size'] = 10;
        }

        if ( $settings['addresses'] ) {
            $map_id = $settings['map_id'];
            $zoom = (int) $settings['zoom']['size'];
            $column = $settings['column'];

            $svg_icon_fb = get_stylesheet_directory_uri() . '/svg-icon/icon-fb100.png';
            $svg_icon_insta = get_stylesheet_directory_uri() . '/svg-icon/icon-instagram100.png';
            $svg_icon_yelp = get_stylesheet_directory_uri() . '/svg-icon/icon-yelp100.png';
            $svg_icon_google = get_stylesheet_directory_uri() . '/svg-icon/icon-google100.png';

            $map_wrap_height = $settings['height']['size'];
            $map_wrap_unit = $settings['height']['unit'];
            //var_dump($map_wrap_height);

            $data_store_address = array();
            //create data object for store address
            foreach (  $settings['addresses'] as $key => $item ) {
                $data_store_address[] = array( $item['marker_id'], $item['location'], $item['store'], $item['phone'], $item['hours'] );
            }
            //$data_store_address = implode(",", $data_store_address);
            echo "<div class='elementor-column'>";
            foreach (  $settings['addresses'] as $key => $item ) {
                $marker_id = $item['marker_id'];
                $city_state = $item['city'] . ', ' . $item['state'];
                $location = $item['location'];
                $store_title = $item['store'];
                $hours = $item['hours'];
                $phone = $item['phone'];
                $fb_link = $item['fb_link']['url'];
                $insta_link = $item['insta_link']['url'];
                $yelp_link = $item['yelp_link']['url'];
                $google_link = $item['google_link']['url'];
                $learnmore = $item['learnmore_link']['url'];
                //var_dump($learnmore);

                echo "<div class='wpgmza-grid-row-$column wpgmaps_mlist_row wpgmza-grid-row wpgmaps_odd map-thumb-$marker_id' data-zoom='$zoom' id='wpgmza_marker_$marker_id' mapid='$map_id' data-marker-id='$marker_id' data-map-id='$map_id' mid='$marker_id' data-address='$location'>";
                echo "<p class='city-state'>$city_state</p>";
                echo "<div class='wpgmza-grid-item'>";

                echo "<div class='map-wrap' id='map-wrapper-$marker_id'></div>";

                echo "<div class='wpgmza-grid-item-content'>";

                echo "<div class='wpgmza-desc'>";
                echo "<p class='address-label'>". $location ."</p>";
                echo "<div class='hours-text'>$hours</div>";
                echo "<p class='phone-label'>Phone Number:</p><p class='phone-number'><span><img class='phone-icon' src='/wp-content/uploads/2020/09/cell-phone-red.svg' alt='$store_title - Contact Number' /></span><span class='contact-no'> $phone</span> </p>";
                echo "</div>";

                echo "<div class='store-social-media'>";
                echo "<ul><li><a class='social-links' href='javascript:void(0);' data-link='$fb_link'><img class='svg-icon' src='$svg_icon_fb' alt='$store_title - Facebook' /></a></li><li><a class='social-links' href='javascript:void(0);' data-link='$insta_link'><img class='svg-icon' src='$svg_icon_insta' alt='$store_title - Instagram' /></li><li><a class='social-links' href='javascript:void(0);' data-link='$yelp_link'><img class='svg-icon' src='$svg_icon_yelp' alt='$store_title - Yelp' /></li><li><a class='social-links' href='javascript:void(0);' data-link='$google_link'><img class='svg-icon' src='$svg_icon_google' alt='$store_title - Google Store' /></li></ul>";
                echo "</div>";

                echo "<div class='wpgmza-grid-footer'>";
                echo "<a href='javascript:void(0);' class='footer-links learn-more' data-link='$learnmore'><span>Learn More</span></a><a href='javascript:void(0);' class='wpgmza_gd footer-links directions' wpgm_addr_field='$location' gps=''><span>Get Directions</span></a>";
                echo "</div>";

                echo "</div>";

                echo "</div>";
                echo "</div>";


            }
            echo "</div>";
            ?>
            <script type="text/javascript">
                //console.log('https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA');
                //https://www.google.com/maps/dir/32.8482239,-97.2647168
                var quicknclean_marker_init = {
                    init: function(){
                        var addresses = [];

                        var addresses_data = {};
                        //var str_obj = {"address": "<?php echo $location; ?>", "title": "<?php echo $store_title;?>", };
                       //addresses.push(str_obj) echo implode(", ", $data );
                        <?php
                            foreach( $data_store_address as $data ){
                                ?> addresses.push({marker_id: "<?php echo $data[0]; ?>", address: "<?php echo $data[1]; ?>", store_title: "<?php echo $data[2]; ?>", phone: "<?php echo $data[3]; ?>", hours: "<?php echo $data[4]; ?>"});

                            <?php
                            }
                        ?>

                        return addresses;
                    }

                };

                jQuery(document).ready(function ($) {

                    var store_marker = quicknclean_marker_init.init();
                    console.log(store_marker);

                    $.each(store_marker, function (index, value) {
                        var marker_id = value.marker_id;
                        var location = value.address;
                        var store_title = value.store_title;
                        var zoom = <?php echo $zoom ?>;
                        //$('#wpgmza_marker_'+marker_id).attr();

                        var address = value.address;
                        address = address.replace(" ", "+");
                        address = address.trim();
                        //console.log(zoom);
                        var google_api = "https://maps.googleapis.com/maps/api/geocode/json?address=";
                        var api_key = "&key=AIzaSyAHsY6Eb6mAlU8R1mIEEXKxUKc-dEBbIWM";
                        var uri_address = google_api+address+api_key;

                        $.get( uri_address, function( data ) {
                            if(data.status === "OK"){
                                console.log(data.results);
                                var result = data.results[0];
                                var lng = result.geometry.location.lng;
                                var lat = result.geometry.location.lat;
                                var latlng = lat + ', ' + lng;
                                var $map_thumb = $('.map-thumb-'+index);
                                $map_thumb.attr('data-latlng', latlng);
                                $map_thumb.find('.wpgmza-grid-footer .wpgmza_gd').attr('wpgm_addr_field', location);
                                $map_thumb.find('.wpgmza-grid-footer .wpgmza_gd').attr('gps', latlng);
                                var myLatLng = {
                                    lat: lat,
                                    lng: lng
                                };
                                var map = new google.maps.Map(document.getElementById("map-wrapper-"+marker_id), {
                                    zoom: zoom,
                                    center: myLatLng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    disableDefaultUI: true
                                });
                                new google.maps.Marker({
                                    position: myLatLng,
                                    icon: '/wp-content/plugins/wp-google-maps/images/spotlight-poi2.png',
                                    map,
                                    label: { top: '0px', color: '#a60d0d', fontWeight: 'bold', fontSize: '14px', text: store_title }
                                });
                            }else{
                                console.log(data.status);
                            }

                        }).fail(function() {
                            console.log('Cannot load data, please check your connection!');
                        });
                    });
                });


            </script>

            <?php

        }

//        printf(
//            '<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',
//            rawurlencode( $item['location'] ),
//            absint( $settings['zoom']['size'] ),
//            esc_attr( $item['location'] )
//        );

        //echo '<div id="map" style="width:200px; height:200px;" />';
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