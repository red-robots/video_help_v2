<?php
/*
*   @package VideoHelpV2
*/

namespace Inc;

final class Init
{
    /**
     *  Store all the classes inside an array
     *  @return array   Full list of classes
     */

    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,            
        ];
    }

    /**
     * Loop through the classes and initialize them
     */

    public static function register_services()
    {
        foreach( self::get_services() as $class ){
            $service = self::instantiate( $class );
            if( method_exists( $class , 'register' ) ){
                $service->register();
            }
        }
    }

    private static function instantiate( $class )
    {
        $service = new $class();

        return $service;    
    }
}
