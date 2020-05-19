<?php

if (class_exists('WP_Customize_Control') && !class_exists('WP_Customizer_Tracking_Codes_Control_Code_Mirror')) {

    class WP_Customizer_Tracking_Codes_Control_Code_Mirror extends WP_Customize_Control
    {
        public $type = 'wp_customizer_tracking_codes_control_code_mirror';
        public static $wp_kses_atts = array(
            'code' => []
        );

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