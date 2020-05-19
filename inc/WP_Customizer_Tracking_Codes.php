<?php

if (!class_exists('WP_Customizer_Tracking_Codes')) {

    class WP_Customizer_Tracking_Codes
    {
        private static $instance = null;

        function __construct()
        {
            add_action('customize_register', array($this, 'register_customize_sections'));
            add_action('wp_head', array($this, 'the_head'));
            add_action('wp_footer', array($this, 'the_foot'));
            add_action($this->get_the_body_open_hook(), array($this, 'the_body_open'), 1);
        }

        public function get_the_body_open_hook(){
            $the_body_open_hook = trim(get_theme_mod('wp-customizer-tracking-codes-body-open-hook'));
            return !empty($the_body_open_hook) ? $the_body_open_hook : 'wp_body_open';
        }

        /**
         * @param WP_Customize_Manager $wp_customize
         */
        public function register_customize_sections($wp_customize)
        {
            $this->require_custom_controls();
            $this->tracking_codes_section($wp_customize);
        }

        public function require_custom_controls()
        {
            require_once WP_CUSTOMIZER_TRACKING_CODES_DIR . '/inc/WP_Customizer_Tracking_Codes_Control_Code_Mirror.php';
        }

        /**
         * Tracking Codes Section
         *
         * Adds the section and its settings and controls.
         *
         * @source https://www.raddy.co.uk/blog/wordpress-customizer-api-editable-sections-theme-development/
         *
         * @param WP_Customize_Manager $wp_customize
         */
        private function tracking_codes_section($wp_customize)
        {

            $code_mirror_description = sprintf(__('Press %1$s when cursor is in the editor to toggle full screen editing.', 'wp-customizer-tracking-codes'), '<code>F11</code>');

            /**
             * Panel
             */

            $wp_customize->add_panel('wp-customizer-tracking-codes-panel', array(
                'title' => __('Tracking Codes'),
                'priority' => 2,
            ));


            /**
             * Head
             */

            // Section
            $wp_customize->add_section('wp-customizer-tracking-codes-section-head', array(
                'title' => __('Head', 'wp-customizer-tracking-codes'),
                'panel' => 'wp-customizer-tracking-codes-panel',
            ));

            // Setting
            $wp_customize->add_setting('wp-customizer-tracking-codes-head', array(
                'default' => '',
            ));

            // Control
            $wp_customize->add_control(new WP_Customizer_Tracking_Codes_Control_Code_Mirror($wp_customize, 'wp-customizer-tracking-codes-head-control', array(
                'label' => __('Head', 'wp-customizer-tracking-codes'),
                'description' => $code_mirror_description,
                'section' => 'wp-customizer-tracking-codes-section-head',
                'settings' => 'wp-customizer-tracking-codes-head',
            )));


            /**
             * Body Open
             */

            // Section
            $wp_customize->add_section('wp-customizer-tracking-codes-section-body-open', array(
                'title' => __('Body Open', 'wp-customizer-tracking-codes'),
                'panel' => 'wp-customizer-tracking-codes-panel',
            ));

            // Setting
            $wp_customize->add_setting('wp-customizer-tracking-codes-body-open', array(
                'default' => '',
            ));

            // Control
            $wp_customize->add_control(new WP_Customizer_Tracking_Codes_Control_Code_Mirror($wp_customize, 'wp-customizer-tracking-codes-body-open-control', array(
                'label' => __('Body Open', 'wp-customizer-tracking-codes'),
                'description' => $code_mirror_description,
                'section' => 'wp-customizer-tracking-codes-section-body-open',
                'settings' => 'wp-customizer-tracking-codes-body-open',
            )));


            /**
             * Foot Code
             */

            // Section
            $wp_customize->add_section('wp-customizer-tracking-codes-section-foot', array(
                'title' => __('Foot', 'wp-customizer-tracking-codes'),
                'panel' => 'wp-customizer-tracking-codes-panel',
            ));

            // Setting
            $wp_customize->add_setting('wp-customizer-tracking-codes-foot', array(
                'default' => '',
            ));

            // Control
            $wp_customize->add_control(new WP_Customizer_Tracking_Codes_Control_Code_Mirror($wp_customize, 'wp-customizer-tracking-codes-foot-control', array(
                'label' => __('Foot', 'wp-customizer-tracking-codes'),
                'description' => $code_mirror_description,
                'section' => 'wp-customizer-tracking-codes-section-foot',
                'settings' => 'wp-customizer-tracking-codes-foot',
            )));


            /**
             * Custom Hooks
             */

            // Section
            $wp_customize->add_section('wp-customizer-tracking-codes-section-custom-hooks', array(
                'title' => __('Custom Hooks', 'wp-customizer-tracking-codes'),
                'panel' => 'wp-customizer-tracking-codes-panel',
            ));

            // Setting
            $wp_customize->add_setting('wp-customizer-tracking-codes-body-open-hook', array(
                'default' => '',
            ));

            // Control
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'wp-customizer-tracking-codes-body-open-hook-control', array(
                'label' => __('Body Open Hook', 'wp-customizer-tracking-codes'),
                'description' => sprintf(__('If the Body Open contents are not printed for you that means your theme does not call the %s function. If so you can define your custom action hook in here.', 'wp-customizer-tracking-codes'), '<code>wp_body_open()</code>'),
                'section' => 'wp-customizer-tracking-codes-section-custom-hooks',
                'settings' => 'wp-customizer-tracking-codes-body-open-hook',
                'type' => 'text'
            )));



        }

        public function the_head()
        {
            echo get_theme_mod('wp-customizer-tracking-codes-head');
        }

        public function the_body_open()
        {
            echo get_theme_mod('wp-customizer-tracking-codes-body-open');
        }

        public function the_foot()
        {
            echo get_theme_mod('wp-customizer-tracking-codes-foot');
        }

        public static function get_instance()
        {
            if (self::$instance == null) {
                self::$instance = new WP_Customizer_Tracking_Codes();
            }

            return self::$instance;
        }

        private function debug()
        {
            if ($_SERVER['REMOTE_ADDR'] == '81.213.178.117') {
                die(class_exists('WP_Customize_Control') ? 'yes' : 'no');
            }
        }

    }

}