<?php

class Quick_Widgets{
    protected static $instance = null;   

    public static function get_instance(){
      if( !isset( static::$instance )){
        static::$instance = new static;
      }
      return static::$instance;
    }

    protected function __construct(){

        require_once ('quick-map-widget.php');
        //require_once ('quick-map-section-widget.php');

        add_action('elementor/widgets/widgets_registered',[$this, 'register_widgets']);
    }

    function register_widgets(){
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Quick_Map_Widget() );
            //\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Element_Section_Map() );

       }
    }

add_action('init','Quick_Widgets_init');
function Quick_Widgets_init(){
    Quick_Widgets::get_instance();
}