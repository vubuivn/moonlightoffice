<?php

   /**
    *
    * custom class to support work with
    * theme modificators
    *
    */

    class martanian_oak_house_theme_mods_supporter {

       /**
        *
        * theme mods slug
        *
        */

        public $base = 'martanian_oak_house_section_';

       /**
        *
        * check if theme mod exists
        *
        */

        public function theme_mod_exists( $name ) {

            # get all theme mods
            $mods = get_theme_mods();

            # if theres no any theme mod
            if( $mods == false ) return false;

            # work with each mod
            foreach( $mods as $mod_key => $mod_value ) {

                # do we have it?
                if( $mod_key === $this -> base . $name ) return true;
            }

            # nothing found
            return false;
        }

       /**
        *
        * get theme mod value
        *
        */

        public function get_mod_value( $name, $default ) {

            # check if mod exists
            if( $this -> theme_mod_exists( $name ) ) return( get_theme_mod( $this -> base . $name, '' ) );

            # theme mod doesnt exists
            else return( $default );
        }

       /**
        *
        * end of methods
        *
        */
    }

?>