<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/Bar.php
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/modules/bar.php
 *
 * @package  TribeEventsCalendar
 * @version 4.6.19
 */
?>

<?php

$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

$current_url = tribe_events_get_current_filter_url();
?>

<?php do_action( 'tribe_events_bar_before_template' ) ?>
<div id="tribe-events-bar">

	<form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action="<?php echo esc_attr( tribe_get_events_link() ); ?>">

		<div class="form-col">
			<strong class="uppercase"><?php esc_html_e('Search','dk_insider'); ?></strong>
			<em><strong><?php printf( esc_html__( '%s', 'dk_insider' ), tribe_get_event_label_plural() ); ?></strong> <?php esc_html_e('happening now everywhere','dk_insider'); ?></em>
		</div>

		<?php if ( ! empty( $filters ) ) { ?>
		<div class="form-col tribe-bar-filters">
	
			<?php foreach ( $filters as $filter ) : ?>
				<div class="<?php echo esc_attr( $filter['name'] ) ?>-filter">
					<label class="label-<?php echo esc_attr( $filter['name'] ) ?>" for="<?php echo esc_attr( $filter['name'] ) ?>"><?php echo esc_attr( $filter['caption'] ) ?></label>
						<?php echo wp_kses( $filter['html'], array(
					    'input' => array(
					        'type' => array(),
					        'value' => array(),
					        'name' => array(),
					        'id' => array(),
					        'class' => array(),
					        'placeholder' => array(),
					    ),
					    'label' => array(
					        'for' => array(),
					        'id' => array(),
					        'class' => array(),
					    ),
					    'div' => array(
					        'id' => array(),
					        'class' => array(),
					    ),
					)); ?>
				</div>
			<?php endforeach; ?>
			<div class="tribe-bar-submit">
				<input
					class="tribe-events-button tribe-no-param"
					type="submit"
					name="submit-bar"
					aria-label="<?php printf( esc_attr__( 'Submit %s search', 'dk_insider' ), tribe_get_event_label_plural() ); ?>"
					value="<?php printf( esc_attr__( 'Find %s', 'dk_insider' ), tribe_get_event_label_plural() ); ?>"
				/>
			</div>
			<!-- .tribe-bar-submit -->
		
		</div><!-- .tribe-bar-filters -->
		<?php } // if ( !empty( $filters ) ) ?>

	</form>
	<!-- #tribe-bar-form -->

</div><!-- #tribe-events-bar -->
<?php
do_action( 'tribe_events_bar_after_template' );
