<?php

   /**
    *
    * register custom widgets
    *
    */

    add_action( 'widgets_init', 'martanian_oak_house_register_widgets' );
    function martanian_oak_house_register_widgets() {

        # "popular posts" custom widget
        register_widget( 'martanian_oak_house_popular_posts_widget' );

        # "call to action" custom widget
        register_widget( 'martanian_oak_house_call_to_action_widget' );

        # "alternative style menu" custom widget
        register_widget( 'martanian_oak_house_alternative_style_menu_widget' );
    }

   /**
    *
    * "popular posts" custom widget
    *
    */

    class martanian_oak_house_popular_posts_widget extends WP_Widget {

        /**
         *
         * constructor
         *
         */

         public function __construct() {

             parent::__construct(
                 'martanian_oak_house_popular_posts_widget',
                 esc_html( __( 'Oak House: Popular posts', 'martanian-oak-house' ) ),
                 array(
                     'classname' => 'martanian-oak-house-popular-posts-widget',
                     'description' => esc_html( __( 'This widget is dedicated to display your most popular posts by comment count.', 'martanian-oak-house' ) )
                 )
             );
         }

        /**
         *
         * widget form fields
         *
         */

         public function form( $instance ) {

             # get form fields values
             $instance = wp_parse_args(
                 ( array ) $instance,
                 array(
                     'title' => esc_html( __( 'Popular posts', 'martanian-oak-house' ) ),
                     'posts_number' => '3'
                 )
             );

             ?>
             <div class="martanian-oak-house-custom-widget-form">

                 <p>

                     <?php echo esc_html( __( 'Title', 'martanian-oak-house' ) ); ?>
                     <input class="widefat" name="<?php echo esc_attr( $this -> get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Posts number', 'martanian-oak-house' ) ); ?>
                     <select class="widefat" name="<?php echo esc_attr( $this -> get_field_name( 'posts_number' ) ); ?>">

                         <?php

                             # loop 1 - 10
                             for( $i = 1; $i < 11; $i++ ) {

                                 ?>
                                 <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $instance['posts_number'], $i ); ?>><?php echo esc_html( $i ); ?></option>
                                 <?php
                             }

                         ?>

                     </select>

                 </p>

             </div>
             <?php
         }

        /**
         *
         * update widget variables
         *
         */

         public function update( $new_instance, $instance ) {

             # all keys array
             $field_keys = array(
                 'url' => array(
                 ),
                 'attr' => array(
                     'posts_number'
                 ),
                 'text' => array(
                     'title'
                 )
             );

             # validate each field
             foreach( $field_keys as $field_type => $keys ) {

                 # validate each key
                 foreach( $keys as $key ) {

                     # read field type
                     switch( $field_type ) {

                         # urls
                         case 'url': $instance[$key] = $new_instance[$key] == '' ? '' : esc_url( $new_instance[$key] ); break;

                         # checkbox
                         case 'attr': $instance[$key] = esc_attr( $new_instance[$key] ); break;

                         # texts
                         case 'text': $instance[$key] = esc_html( $new_instance[$key] ); break;
                     }
                 }
             }

             # return result
             return( $instance );
         }

        /**
         *
         * custom filter - limit posts older than 30 days
         *
         */

         public function filter_where( $where = '' ) {

             #posts in the last 30 days
             $where .= " AND post_date > '". esc_html( date( 'Y-m-d', strtotime( '-30 days' ) ) ) ."'";

             # return result
             return( $where );
         }

        /**
         *
         * display widget
         *
         */

         public function widget( $args, $instance ) {

             # get form fields values
             $instance = wp_parse_args(
                 ( array ) $instance,
                 array(
                     'title' => esc_html( __( 'Limited offer', 'martanian-oak-house' ) ),
                     'posts_number' => 3
                 )
             );

             # get posts
             add_filter( 'posts_where', array( $this, 'filter_where' ) );
             query_posts( 'post_type=post&posts_per_page='. esc_attr( $instance['posts_number'] ) .'&orderby=comment_count&ignore_sticky_posts=1&order=DESC' );

             # before widget
             echo !empty( $args['before_widget'] ) ? $args['before_widget'] : '';

             ?>
             <div class="widget">

                 <?php

                     # do we have title set?
                     if( $instance['title'] != '' ) {

                         ?>
                         <h4><?php echo esc_html( $instance['title'] ); ?></h4>
                         <?php
                     }

                     # there's no any posts?
                     if( !have_posts() ) {

                         ?>
                         <p><?php echo esc_html( __( 'Not found any posts', 'martanian-oak-house' ) ); ?></p>
                         <?php
                     }

                     # display popular posts
                     else {

                         ?>
                         <ul class="posts-list">

                             <?php

                                 # posts loop
                                 while( have_posts() ) {

                                     # get the post object
                                     the_post();

                                     ?>
                                     <li>

                                         <a href="<?php the_permalink(); ?>">

                                             <?php

                                                 # do we have featured image?
                                                 if( martanian_oak_house_get_featured_image( get_the_ID() ) != '' ) {

                                                     ?>
                                                     <div class="images">

                                                         <div class="image">

                                                             <img src="<?php echo martanian_oak_house_get_featured_image( get_the_ID() ); ?>" alt="<?php the_title(); ?>" class="image-data-for-parent" />

                                                         </div>

                                                     </div>
                                                     <?php

                                                 # end of featured image
                                                 }

                                             ?>

                                             <span class="title"><?php the_title(); ?></span>

                                         </a>

                                     </li>
                                     <?php
                                 }

                             ?>

                         </ul>
                         <?php
                     }

                 ?>

             </div>
             <?php

             # reset the query
             wp_reset_query();

             # after widget
             echo !empty( $args['after_widget'] ) ? $args['after_widget'] : '';
         }

        /**
         *
         * end of widget methods
         *
         */
    }

   /**
    *
    * "call to action" widget counter
    *
    */

    $martanian_oak_house_call_to_action_widget_counter = 0;

   /**
    *
    * "call to action" custom widget
    *
    */

    class martanian_oak_house_call_to_action_widget extends WP_Widget {

        /**
         *
         * constructor
         *
         */

         public function __construct() {

             parent::__construct(
                 'martanian_oak_house_call_to_action_widget',
                 esc_html( __( 'Oak House: Call to action', 'martanian-oak-house' ) ),
                 array(
                     'classname' => 'martanian-oak-house-call-to-action-widget',
                     'description' => esc_html( __( 'This widget is dedicated to display "call to action" box.', 'martanian-oak-house' ) )
                 )
             );
         }

        /**
         *
         * widget form fields
         *
         */

         public function form( $instance ) {

             # get form fields values
             $instance = wp_parse_args(
                 ( array ) $instance,
                 array(
                     'title' => esc_html( __( 'Still have any questions?', 'martanian-oak-house' ) ),
                     'content' => 'Quaeque nonumes doce est eu, antio pam compre.',
                     'button_text' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
                     'button_url' => '#',
                     'button_icon' => '',
                     'button_in_new_tab' => '',
                     'background_image_url' => '',
                     'screen_1200_more' => 'background-position: 125% bottom;'. "\n" .'background-size: auto 100%;',
                     'screen_992_1199' => 'background-position: 205% bottom;'. "\n" .'background-size: auto 100%;',
                     'screen_768_991' => 'background-position: 108% 11%;'. "\n" .'background-size: auto 180%;',
                     'screen_431_767' => 'background-position: 109% 10%;'. "\n" .'background-size: 200px auto;',
                     'screen_430_less' => 'background-position: center 260px;'. "\n" .'background-size: auto 350px;'
                 )
             );

             ?>
             <div class="martanian-oak-house-custom-widget-form">

                 <p>

                     <?php echo esc_html( __( 'Title', 'martanian-oak-house' ) ); ?>
                     <input class="widefat" name="<?php echo esc_attr( $this -> get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Content', 'martanian-oak-house' ) ); ?>
                     <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr( $this -> get_field_name( 'content' ) ); ?>"><?php echo esc_html( $instance['content'] ); ?></textarea>

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Button text', 'martanian-oak-house' ) ); ?>
                     <input class="widefat" name="<?php echo esc_attr( $this -> get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['button_text'] ); ?>" />

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Button URL', 'martanian-oak-house' ) ); ?>
                     <input class="widefat" name="<?php echo esc_attr( $this -> get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['button_url'] ); ?>" />

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Button icon', 'martanian-oak-house' ) ); ?>
                     <input class="widefat" name="<?php echo esc_attr( $this -> get_field_name( 'button_icon' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['button_icon'] ); ?>" />

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Open button URL in new tab?', 'martanian-oak-house' ) ); ?>
                     <br />

                     <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this -> get_field_id( 'button_in_new_tab' ) ); ?>" <?php checked( $instance[ 'button_in_new_tab' ], 'on' ); ?> name="<?php echo esc_attr( $this -> get_field_name( 'button_in_new_tab' ) ); ?>">
                     <label for="<?php echo esc_attr( $this -> get_field_id( 'button_in_new_tab' ) ); ?>"><?php echo esc_html( __( 'Yes, open button URL in new tab', 'martanian-oak-house' ) ); ?></label>

                 </p>

                 <div class="image-upload">

                     <?php

                         # do we have an image set?
                         if( $instance['background_image_url'] != '' ) {

                             ?>
                             <div class="image-preview">

                                 <img src="<?php echo esc_url( $instance['background_image_url'] ); ?>" />

                             </div>
                             <?php
                         }

                     ?>

                     <p><?php echo esc_html( __( 'Widget background image', 'martanian-oak-house' ) ); ?></p>

                     <input type="text" class="widefat martanian-oak-house-media-url" name="<?php echo esc_attr( $this -> get_field_name( 'background_image_url' ) ); ?>" id="<?php echo esc_attr( $this -> get_field_id( 'background_image_url' ) ); ?>" value="<?php echo esc_url( $instance['background_image_url'] ); ?>">
                     <input type="button" class="button martanian-oak-house-media-button" value="<?php echo esc_attr( __( 'Select image', 'martanian-oak-house' ) ); ?>" />

                 </div>

                 <p>

                     <?php echo esc_html( __( 'Responsive image: more than 1200px width screens', 'martanian-oak-house' ) ); ?>
                     <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr( $this -> get_field_name( 'screen_1200_more' ) ); ?>"><?php echo esc_html( $instance['screen_1200_more'] ); ?></textarea>

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Responsive image: 992px - 1199px width screens', 'martanian-oak-house' ) ); ?>
                     <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr( $this -> get_field_name( 'screen_992_1199' ) ); ?>"><?php echo esc_html( $instance['screen_992_1199'] ); ?></textarea>

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Responsive image: 768px - 991px width screens (tablets)', 'martanian-oak-house' ) ); ?>
                     <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr( $this -> get_field_name( 'screen_768_991' ) ); ?>"><?php echo esc_html( $instance['screen_768_991'] ); ?></textarea>

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Responsive image: 431px - 767px width screens (smartphones)', 'martanian-oak-house' ) ); ?>
                     <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr( $this -> get_field_name( 'screen_431_767' ) ); ?>"><?php echo esc_html( $instance['screen_431_767'] ); ?></textarea>

                 </p>

                 <p>

                     <?php echo esc_html( __( 'Responsive image: less than 430px width screens (small smartphones)', 'martanian-oak-house' ) ); ?>
                     <textarea class="widefat" rows="8" cols="20" name="<?php echo esc_attr( $this -> get_field_name( 'screen_430_less' ) ); ?>"><?php echo esc_html( $instance['screen_430_less'] ); ?></textarea>

                 </p>

             </div>
             <?php
         }

        /**
         *
         * update widget variables
         *
         */

         public function update( $new_instance, $instance ) {

             # all keys array
             $field_keys = array(
                 'url' => array(
                     'button_url',
                     'background_image_url'
                 ),
                 'attr' => array(
                     'button_icon',
                     'button_in_new_tab',
                     'screen_1200_more',
                     'screen_992_1199',
                     'screen_768_991',
                     'screen_767_less'
                 ),
                 'text' => array(
                     'title',
                     'content',
                     'button_text'
                 )
             );

             # validate each field
             foreach( $field_keys as $field_type => $keys ) {

                 # validate each key
                 foreach( $keys as $key ) {

                     # read field type
                     switch( $field_type ) {

                         # urls
                         case 'url': $instance[$key] = $new_instance[$key] == '' ? '' : esc_url( $new_instance[$key] ); break;

                         # checkbox
                         case 'attr': $instance[$key] = esc_attr( $new_instance[$key] ); break;

                         # texts
                         case 'text': $instance[$key] = esc_html( $new_instance[$key] ); break;
                     }
                 }
             }

             # return result
             return( $instance );
         }

        /**
         *
         * display widget
         *
         */

         public function widget( $args, $instance ) {

             # get the widget counter
             global $martanian_oak_house_call_to_action_widget_counter;

             # get form fields values
             $instance = wp_parse_args(
                 ( array ) $instance,
                 array(
                     'title' => esc_html( __( 'Still have any questions?', 'martanian-oak-house' ) ),
                     'content' => 'Quaeque nonumes doce est eu, antio pam compre.',
                     'button_text' => esc_html( __( 'Contact us!', 'martanian-oak-house' ) ),
                     'button_url' => '#',
                     'button_icon' => '',
                     'button_in_new_tab' => '',
                     'background_image_url' => '',
                     'screen_1200_more' => 'background-position: 125% bottom;'. "\n" .'background-size: auto 100%;',
                     'screen_992_1199' => 'background-position: 205% bottom;'. "\n" .'background-size: auto 100%;',
                     'screen_768_991' => 'background-position: 108% 11%;'. "\n" .'background-size: auto 180%;',
                     'screen_431_767' => 'background-position: 109% 10%;'. "\n" .'background-size: 200px auto;',
                     'screen_430_less' => 'background-position: center 260px;'. "\n" .'background-size: auto 350px;'
                 )
             );

             # before widget
             echo !empty( $args['before_widget'] ) ? $args['before_widget'] : '';

             # update widget counter
             $martanian_oak_house_call_to_action_widget_counter++;

             ?>
             <div class="widget call-to-action-widget" data-call-to-action-widget-id="<?php echo esc_attr( $martanian_oak_house_call_to_action_widget_counter ); ?>">

                 <div class="call-to-action-widget-styles">@media (max-width: 430px) { .widget.call-to-action-widget[data-call-to-action-widget-id="<?php echo esc_attr( $martanian_oak_house_call_to_action_widget_counter ); ?>"] { <?php echo esc_html( $instance['screen_430_less'] ); ?> }} @media (min-width: 431px) and (max-width: 767px) { .widget.call-to-action-widget[data-call-to-action-widget-id="<?php echo esc_attr( $martanian_oak_house_call_to_action_widget_counter ); ?>"] { <?php echo esc_html( $instance['screen_431_767'] ); ?> }} @media (min-width: 768px) and (max-width: 991px) { .widget.call-to-action-widget[data-call-to-action-widget-id="<?php echo esc_attr( $martanian_oak_house_call_to_action_widget_counter ); ?>"] { <?php echo esc_html( $instance['screen_768_991'] ); ?> }} @media (min-width: 992px) and (max-width: 1199px) { .widget.call-to-action-widget[data-call-to-action-widget-id="<?php echo esc_attr( $martanian_oak_house_call_to_action_widget_counter ); ?>"] { <?php echo esc_html( $instance['screen_992_1199'] ); ?> }} @media (min-width: 1200px) { .widget.call-to-action-widget[data-call-to-action-widget-id="<?php echo esc_attr( $martanian_oak_house_call_to_action_widget_counter ); ?>"] { <?php echo esc_html( $instance['screen_1200_more'] ); ?> }}</div>

                 <?php

                     # background image url
                     if( !empty( $instance['background_image_url'] ) ) {

                         ?>
                         <img src="<?php echo esc_url( $instance['background_image_url'] ); ?>" class="image-data-for-parent" alt="" />
                         <?php
                     }

                     # widget title
                     if( !empty( $instance['title'] ) ) {

                         ?>
                         <h3><?php echo do_shortcode( esc_html( $instance['title'] ) ); ?></h3>
                         <?php
                     }

                     # widget content
                     if( !empty( $instance['content'] ) ) echo wpautop( do_shortcode( esc_html( $instance['content'] ) ) );

                     # button
                     if( !empty( $instance['button_url'] ) && ( !empty( $instance['button_text'] ) || !empty( $instance['button_icon'] ) ) ) {

                         ?>
                         <p>

                             <a href="<?php echo esc_url( $instance['button_url'] ); ?>" class="button button-fill" target="<?php echo esc_attr( $instance['button_in_new_tab'] == 'on' ? '_blank' : '_self' ); ?>">

                                 <span>

                                     <?php

                                         # button text
                                         if( !empty( $instance['button_text'] ) ) echo esc_html( $instance['button_text'] );

                                         # button icon
                                         if( !empty( $instance['button_icon'] ) ) {

                                             ?>
                                             <i class="<?php echo esc_attr( $instance['button_icon'] ); ?>"></i>
                                             <?php
                                         }

                                     ?>

                                 </span>

                             </a>

                         </p>
                         <?php
                     }

                 ?>

             </div>
             <?php

             # after widget
             echo !empty( $args['after_widget'] ) ? $args['after_widget'] : '';
         }

        /**
         *
         * end of widget methods
         *
         */
    }

   /**
    *
    * "alternative style menu" custom widget
    *
    */

    class martanian_oak_house_alternative_style_menu_widget extends WP_Widget {

       /**
        *
        * constructor
        *
        */

        public function __construct() {

            parent::__construct(
                'martanian_oak_house_alternative_style_menu_widget',
                esc_html( __( 'Oak House: Alternative style menu', 'martanian-oak-house' ) ),
                array(
                    'classname' => 'martanian-oak-house-alternative-style-menu-widget',
                    'description' => esc_html( __( 'This widget is dedicated to display sidebar menu with alternative style option.', 'martanian-oak-house' ) ),
                    'customize_selective_refresh' => true
                )
            );
        }

       /**
        *
        * display widget
        *
        */

        public function widget( $args, $instance ) {

            # get menu
          		$nav_menu = !empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

          		# if there's no menu, return
            if( !$nav_menu ) return;

          		# title filter
          		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this -> id_base );

            # before widget
            echo !empty( $args['before_widget'] ) ? $args['before_widget'] : '';

            ?>
            <section class="sidebar-menu">

                <?php

                  		# title
                    echo !empty( $instance['title'] ) ? $args['before_title'] . $instance['title'] . $args['after_title'] : '';

                    # show the menu
                  		wp_nav_menu( apply_filters( 'widget_nav_menu_args', array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => '' ), $nav_menu, $args, $instance ) );

                ?>

            </section>
            <?php

            # after widget
            echo !empty( $args['after_widget'] ) ? $args['after_widget'] : '';
       	}

       /**
        *
        * update widget variables
        *
        */

        public function update( $new_instance, $old_instance ) {

            # create the results array
            $instance = array();

            # do we have the title?
            if( !empty( $new_instance['title'] ) ) $instance['title'] = sanitize_text_field( $new_instance['title'] );

            # do we have the nav menu?
            if( !empty( $new_instance['nav_menu'] ) ) $instance['nav_menu'] = ( int ) $new_instance['nav_menu'];

            # return result
            return $instance;
        }

       /**
        *
        * widget form fields
        *
        */

        public function form( $instance ) {

            # get global variables
            global $wp_customize;

            # get current options for title and nav_menu
          		$title = isset( $instance['title'] ) ? $instance['title'] : '';
          		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

          		# get menus array
          		$menus = wp_get_nav_menus();

          		# if no menus exists, direct the user to go and create some.
          		?>
          		<p class="nav-menu-widget-no-menus-message" style="<?php echo esc_html( !empty( $menus ) ? 'display: none;' : '' ); ?>">

                <?php

                    # get the url to menus page
                    $url = $wp_customize instanceof WP_Customize_Manager ? 'javascript: wp.customize.panel( "nav_menus" ).focus();' : admin_url( 'nav-menus.php' );

                    # show the message
                    echo esc_html( __( 'No menus have been created yet.', 'martanian-oak-house' ) ) .' <a href="'. esc_attr( $url ) .'">'. esc_html( __( 'Create some', 'martanian-oak-house' ) ) .'</a>.';

                ?>

          		</p>

          		<div class="nav-menu-widget-form-controls" style="<?php echo esc_html( empty( $menus ) ? 'display: none;' : '' ); ?>">

                <p>

                				<label for="<?php echo esc_attr( $this -> get_field_id( 'title' ) ); ?>"><?php echo esc_html( __( 'Title:', 'martanian-oak-house' ) ); ?></label>
                				<input type="text" class="widefat" id="<?php echo esc_attr( $this -> get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this -> get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"/>

             			</p>

             			<p>

                    <label for="<?php echo esc_attr( $this -> get_field_id( 'nav_menu' ) ); ?>"><?php echo esc_html( __( 'Select Menu:', 'martanian-oak-house' ) ); ?></label>
                				<select id="<?php echo esc_attr( $this -> get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this -> get_field_name( 'nav_menu' ) ); ?>">

                        <option value="0">&mdash; <?php echo esc_html( __( 'Select', 'martanian-oak-house' ) ); ?> &mdash;</option>
                   					<?php

                            # walk for each menu
                            foreach( $menus as $menu ) {

                                ?>
                          						<option value="<?php echo esc_attr( $menu -> term_id ); ?>" <?php selected( $nav_menu, $menu -> term_id ); ?>><?php echo esc_html( $menu -> name ); ?></option>
                                <?php

                            # end of loop
                            }

                        ?>

                    </select>

             			</p>

          			   <?php

                    # if widget is managed inside customizer tool
                    if( $wp_customize instanceof WP_Customize_Manager ) {

                        ?>
                    				<p class="edit-selected-nav-menu" style="<?php echo esc_html( !$nav_menu ? 'display: none;' : '' ); ?>">

                            <button type="button" class="button"><?php echo esc_html( __( 'Edit Menu', 'martanian-oak-house' ) ); ?></button>

                    				</p>
                        <?php
                    }

                ?>

          		</div>
          		<?php
       	}

       /**
        *
        * end of widget methods
        *
        */
    }

   /**
    *
    * end of file.
    *
    */

?>