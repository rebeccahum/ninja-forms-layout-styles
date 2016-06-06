<?php

final class NF_Styles_Admin_Views_PluginSettings
{
    private $dir = 'PluginSettings';

    private $data;

    public function __construct( $data = array() )
    {
        $this->data = $data;
    }

    public function get_var( $var )
    {
        if( ! isset( $this->data[ $var ] ) ) return FALSE;

        return $this->data[ $var ];
    }

    public function get_part( $part = '', $data = array() )
    {
        if( ! isset( $part ) ) return FALSE;

        NF_Styles::template( trailingslashit( $this->dir ) . $part . '.html.php', array( 'view' => $this, 'data' => $data ) );
    }

    public function get_field_name( $data )
    {
        return 'style[' . $this->get_var( 'tab' ) . '][' . $data[ 'section' ] . '][' . $data[ 'name' ] . ']';
    }

    public function get_field_id( $data )
    {
        return 'style_' . $this->get_var( 'tab' ) . '_' . $data[ 'section' ] . '_' . $data[ 'name' ];
    }

    public function get_field_value( $data )
    {
        return $data[ 'value' ];
    }

}
