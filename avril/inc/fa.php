<?php
/**
 * Avril Font Awesome Compatibility Helpers
 */

if (! defined('ABSPATH') ) {
    exit;
}

if (! function_exists('avril_fa_map') ) {
    include_once __DIR__ . '/fa-map.php';
}

if (! function_exists('avril_has_icon') ) {
    function avril_has_icon( $icon )
    {
        $map = avril_fa_map();
        return isset($map[ $icon ]);
    }
}

if (! function_exists('avril_fa_class') ) {
    function avril_fa_class( $icon )
    {

        if (empty($icon) ) {
            return '';
        }

        $map = avril_fa_map();

        if (isset($map[ $icon ]) ) {
            $value = $map[ $icon ];

            if (is_array($value) && ! empty($value['class']) ) {
                return $value['class'];
            }

            if (is_string($value) ) {
                return $value;
            }
        }

        if (strpos($icon, 'fa-solid ') === 0 
            || strpos($icon, 'fa-regular ') === 0 
            || strpos($icon, 'fa-brands ') === 0 
        ) {
            return $icon;
        }

        return 'fa fa-' . ltrim(str_replace('fa-', '', $icon), '-');
    }
}

if (! function_exists('avril_fa_prefix') ) {
    function avril_fa_prefix( $icon )
    {
        $class = avril_fa_class($icon);
        $parts = preg_split('/\s+/', trim($class));
        return ! empty($parts[0]) ? $parts[0] : '';
    }
}

if (! function_exists('avril_icon_html') ) {
    function avril_icon_html( $icon, $attrs = array() )
    {

        $class = avril_fa_class($icon);

        if (isset($attrs['class']) ) {
            $class .= ' ' . $attrs['class'];
            unset($attrs['class']);
        }

        $html = '<i class="' . esc_attr(trim($class)) . '"';

        foreach ( $attrs as $key => $value ) {
            $html .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }

        $html .= '></i>';

        return $html;
    }
}

if (! function_exists('avril_icon') ) {
    function avril_icon( $icon, $attrs = array() )
    {
        echo avril_icon_html($icon, $attrs); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

if (! function_exists('avril_fa6_map') ) {
    function avril_fa6_map()
    {

        return array(
        'fa-home'       => 'fa-solid fa-house',
        'fa-clock-o'    => 'fa-solid fa-clock',
        'fa-calendar'   => 'fa-solid fa-calendar',
        'fa-user'       => 'fa-solid fa-user',
        'fa-search'     => 'fa-solid fa-magnifying-glass',
        'fa-heart'      => 'fa-solid fa-heart',
        'fa-star'       => 'fa-solid fa-star',
        'fa-facebook'   => 'fa-brands fa-facebook',
        'fa-twitter'    => 'fa-brands fa-twitter',
        );
    }
}