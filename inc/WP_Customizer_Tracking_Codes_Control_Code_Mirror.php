<?php

if (class_exists('WP_Customize_Control') && !class_exists('WP_Customizer_Tracking_Codes_Control_Code_Mirror')) {

    class WP_Customizer_Tracking_Codes_Control_Code_Mirror extends WP_Customize_Control
    {
        public $type = 'wp_customizer_tracking_codes_control_code_mirror';
        public static $wp_kses_atts = array(
            'code' => []
        );

        public function enqueue() {

            wp_enqueue_style( 'wp-codemirror' );
            // wp_enqueue_style( 'code-editor' );
            wp_enqueue_script( 'wp-codemirror' );

            wp_enqueue_style( 'wp-customizer-tracking-codes-code-mirror-css', WP_CUSTOMIZER_TRACKING_CODES_URL . 'assets/code-mirror.css', array(), '1.0' );
            wp_enqueue_script( 'wp-customizer-tracking-codes-code-mirror-js', WP_CUSTOMIZER_TRACKING_CODES_URL . 'assets/code-mirror.js', array('jquery', 'wp-codemirror'), '1.0', true );
        }

        public function render_content()
        {

            $input_id = '_customize-input-' . $this->id;
            $description_id = '_customize-description-' . $this->id;
            $describedby_attr = (!empty($this->description)) ? ' aria-describedby="' . esc_attr($description_id) . '" ' : '';

            if (!empty($this->label)) {
                ?>
                <label class="customize-control-title" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_html($this->label); ?></label>
                <?php
            }

            if (!empty($this->description)) {
                ?>
                <span class="description customize-control-description" <?php echo esc_attr($description_id); ?>><?php echo wp_kses($this->description, self::$wp_kses_atts); ?></span>
                <?php
            }

            ?>

            <textarea
                    class="wp-customizer-tracking-codes-control-code-mirror"
                    id="<?php echo esc_attr($input_id); ?>"
                    rows="5"
                <?php echo $describedby_attr; ?>
                <?php $this->input_attrs(); ?>
                <?php $this->link(); ?>
            ><?php echo esc_textarea($this->value()); ?></textarea>

            <?php

        }
    }

}