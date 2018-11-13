<?php

/**
 * Widget Class -  Social Share
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

class Codexin_Social_Share_Widget extends WP_Widget {
	
	// setup the widget name, description, etc...
	public function __construct() {
		
		$widget_ops = array(
			'classname' 	=> esc_attr( 'codexin-social-share-widget' ),
			'description' 	=> esc_html__( 'Social Media Share for Posts or Pages', 'codexin' ),
		);
		parent::__construct( 'codexin_social_share_widget', esc_html__( 'Codexin: Social Media Share', 'codexin' ), $widget_ops );
		
	}
	
	// back-end display of widget
	public function form( $instance ) { 

		$title 	= ( ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'codexin' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_html__( 'Ex: Share', 'codexin' ) ?>">
		</p>
		
	<?php	

	}

	//Updating the widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance[ 'title' ] 	= ( ! empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );

		return $instance;
		
	}
	
	//front-end display of widget
	public function widget( $args, $instance ) {

		printf( '%s', $args['before_widget'] ); 
		$share_url = get_the_permalink();
		if( is_home() && ! is_front_page() ) {
			$share_url = get_permalink( get_option( 'page_for_posts' ) );
		}
		if( is_home() && is_front_page() ) {
			$share_url = home_url( '/' );
		}

		if( ! empty( $instance[ 'title' ] ) ) {			
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);			
		}

		?>

            <div class="share socials reveal-color-0 reveal-primary-btn">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $share_url );?>"><i class="fa fa-facebook"></i></a>
                <a target="_blank" href="https://twitter.com/home?status=<?php echo esc_url( $share_url ); ?>"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url( $share_url ); ?>"><i class="fa fa-google-plus"></i></a>
                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $share_url ); ?>"><i class="fa fa-linkedin"></i></a>       
            </div>


		<?php
		
		printf( '%s', $args['after_widget'] );

	}
	
}

add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Social_Share_Widget' );
} );