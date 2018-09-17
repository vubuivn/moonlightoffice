<section class="sidebar">

    <?php

        # sidebar for blog
        if( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'blog-sidebar' ) ) dynamic_sidebar( 'blog-sidebar' );

    ?>

</section>