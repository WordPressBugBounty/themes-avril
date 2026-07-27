<?php
if (! class_exists('WP_Customize_Control') ) {
    return null;
}

/**
 * A class to add a fontawesome icons selector 
 */
class Avril_Icon_Picker_Control extends WP_Customize_Control
{

    private $icons = false;

    public function __construct( $manager, $id, $args = array(), $options = array() )
    {
        $this->icons = $this->Avril_get_icons();
        parent::__construct($manager, $id, $args);
    }

    /**
     * Render the content of the dropdown
     *
     * Adding the font-family styling to the select so that the font renders 
     *
     * @return HTML
     */
    public function render_content()
    {
        if (! empty($this->icons) ) {
            $saved_value = $this->value();

            if (function_exists('avril_fa_map') ) {
                $fa6_map = avril_fa_map();
                if (isset($fa6_map[ $saved_value ]) ) {
                    $saved_value = $fa6_map[ $saved_value ];
                }
            }
            ?>
      <label>
        <span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html($this->label); ?></span>
        <select <?php $this->link(); ?> style="font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Brands', Arial;">
            <?php
            foreach ( $this->icons as $k => $v ) {
                printf(
                    '<option value="%s" %s>%s</option>',
                    esc_attr($v),
                    selected($saved_value, $v, false),
                    esc_html($v)
                );
            }
            ?>
        </select>
      </label>
        <?php }
    }

    /** 
     * Get the list of Icons 
     *
     * @return string
     */
    function Avril_get_icons()
    {
        $map = function_exists('avril_fa_map') ? avril_fa_map() : array();

        $icons = array();
        $seen = array();

        foreach ( $map as $fa4 => $fa6 ) {
            if (! isset($seen[ $fa6 ]) ) {
                $seen[ $fa6 ] = true;
                $icons[ $fa4 ] = $fa6;
            }
        }

        return $icons;
    }
}
?>
