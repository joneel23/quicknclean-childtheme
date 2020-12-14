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

        $default_address = __( 'London Eye, London, United Kingdom', 'elementor' );
        $this->add_control(
            'address',
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

        if ( empty( $settings['address'] ) ) {
            return;
        }

        if ( 0 === absint( $settings['zoom']['size'] ) ) {
            $settings['zoom']['size'] = 10;
        }
    //style="width: 100%; overflow: hidden; height: 300px;"
//        printf(
//            '<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',
//            rawurlencode( $settings['address'] ),
//            absint( $settings['zoom']['size'] ),
//            esc_attr( $settings['address'] )
//        );
        echo '<div class="wpgmaps_mlist_row wpgmza-grid-row wpgmaps_odd" mapid="1" id="wpgmza_marker_2" mid="2" data-marker-id="2" data-map-id="1" data-latlng="32.7200882, -97.44119889999999" data-address="3525 Alta Mere Dr, Fort Worth, TX, USA">
	<div class="wpgmza-grid-item "><div class="wpgmza-grid-footer"><a href="javascript:void(0);" class="wpgmza_gd" wpgm_addr_field="3525 Alta Mere Dr, Fort Worth, TX, USA" gps="32.7200882,-97.44119889999999">Directions</a><div></div></div>';

        echo '<div id="map" style="width:200px; height:200px;" />';

        ?>
            <script type="text/javascript">
                //console.log('https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA');

                function getLatLng() {
                    var xhttp = new XMLHttpRequest();

                    var address = '3525+Alta+Mere+Dr,+Fort+Worth,+TX,+USA';
                    address = address.replace(" ", "+");
                    address = address.trim();
                    var google_api = "https://maps.googleapis.com/maps/api/geocode/json?address=";
                    var api_key = "&key=AIzaSyAHsY6Eb6mAlU8R1mIEEXKxUKc-dEBbIWM";
                    var uri_address = google_api+address+api_key;

                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
//                            document.getElementById("demo").innerHTML =
                            //console.log(this.responseText);
                        }
                    };

                    xhttp.open("GET", uri_address, true);
                    xhttp.send();
                }
                getLatLng();

                window.onload = function () {

                    var myLatLng = {
                        lat: -25.363,
                        lng: 131.044
                    };
                    var map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 4,
                        center: myLatLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        disableDefaultUI: true
                    });
                    new google.maps.Marker({
                        position: myLatLng,
                        icon: '/wp-content/plugins/wp-google-maps/images/spotlight-poi2.png',
                        map,
                        label: { position: 'relative', top: '-10px', color: '#a60d0d', fontWeight: 'bold', fontSize: '14px', text: 'Your text here' }
                    });


                }

            </script>
        <?php

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
        ?>
        <# if ( settings.addresses.length ) { #>

            <# _.each( settings.addresses, function( item ) { #>

                <div class="elementor-custom-embed elementor-repeater-item-{{ item._id }}"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{{ item.location }}}&amp;t=m&amp;z={{{ settings.zoom.size }}}&amp;output=embed&amp;iwloc=near" aria-label="{{{ item.location }}}"></iframe></div>
                <# }); #>

                    <# } #>
        <?php
    }
}