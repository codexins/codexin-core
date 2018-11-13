<?php

/**
 * Widget Class -  Twitter Feed
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

class Codexin_Twitter_Widget extends WP_Widget {

	//setup the widget name, description, etc...
	public function __construct() {
		
		// Initializing the basic parameters
		$widget_ops = array(
			'classname' 	=> esc_attr( 'codexin-twitter-widget' ),
			'description' 	=> esc_html__( 'Displays Twitter Feeds', 'codexin' ),
		);
		parent::__construct( 'cx_twitter_widget', esc_html__( 'Codexin: Twitter Feed Widget', 'codexin' ), $widget_ops );

        // Fetching data from options page
        $this->options = get_option( 'codexin_options_twitter_api' );
		
	}

	// Back-end display of widget
	public function form( $instance ) {

		// Assigning or updating the values
		$title 			= ( ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
		$count 			= ( ! empty( $instance[ 'count' ] ) ? absint( $instance[ 'count' ] ) : esc_html__( '3', 'codexin' ) );
		$tw_profile 	= ( ! empty( $instance[ 'tw_profile' ] ) ? $instance[ 'tw_profile' ] : '' );
		$tw_name 		= ( ! empty( $instance[ 'tw_name' ] ) ? $instance[ 'tw_name' ] : '' );
		$tw_usr 		= ( ! empty( $instance[ 'tw_usr' ] ) ? $instance[ 'tw_usr' ] : '' );

		if ( empty( $this->options['tw_username'] ) || empty( $this->options['tw_acc_token'] ) || empty( $this->options['tw_acc_token_sec'] ) || empty( $this->options['tw_cons_key'] ) || empty( $this->options['tw_cons_secret'] ) ) {

			printf( '<p>%1$s<a href="%2$s" target="_blank"><strong>%3$s</strong></a>%4$s</p>', esc_html__( 'In order to use this Widget, please fill up the Twitter API Information in the "Twitter API" Section of ', 'codexin' ), esc_url( admin_url() .'admin.php?page=codexin-options&action=twitter_api' ), esc_html__( 'Codexin Core', 'codexin' ), esc_html__( ' and refresh this Page.', 'codexin' ) );

		} else {

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'codexin' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_html__( 'Ex: Twitter Feed', 'codexin' ) ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php echo esc_html__( 'Number of Tweets to Show:', 'codexin' ) ?></label>
			<input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>">
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $tw_profile, 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'tw_profile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw_profile' ) ); ?>" /> 
		    <label for="<?php echo esc_attr( $this->get_field_id( 'tw_profile' ) ); ?>"><?php echo esc_html__( 'Display Profile Picture?', 'codexin' ); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $tw_name, 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'tw_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw_name' ) ); ?>" /> 
		    <label for="<?php echo esc_attr( $this->get_field_id( 'tw_name' ) ); ?>"><?php echo esc_html__( 'Display Full Name?', 'codexin' ); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php esc_attr( checked( $tw_usr, 'on' ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'tw_usr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw_usr' ) ); ?>" /> 
		    <label for="<?php echo esc_attr( $this->get_field_id( 'tw_usr' ) ); ?>"><?php echo esc_html__( 'Display User Name?', 'codexin' ); ?></label>
		</p>


	<?php
		}
	}

	// Updating the widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		
		// Updating to the latest values
		$instance[ 'title' ] 		= ( ! empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'count' ] 		= ( ! empty( $new_instance[ 'count' ] ) ? absint( strip_tags( $new_instance[ 'count' ] ) ) : 0 );
		$instance[ 'tw_profile' ] 	= strip_tags( $new_instance[ 'tw_profile' ] );
		$instance[ 'tw_name' ] 		= strip_tags( $new_instance[ 'tw_name' ] );
		$instance[ 'tw_usr' ] 		= strip_tags( $new_instance[ 'tw_usr' ] );

		return $instance;
		
	}

	// Front-end display of widget
	public function widget( $args, $instance ) {
				
		printf( '%s', $args[ 'before_widget' ] );
		
		if( ! empty( $instance[ 'title' ] ) ) {
			printf( '%s' . apply_filters( 'widget_title', $instance[ 'title' ] ) . '%s', $args[ 'before_title' ], $args[ 'after_title' ]);			
		}

		// Retrieving values from options page
		$twitter_id 			= $this->options[ 'tw_username' ];
		$access_token 			= $this->options[ 'tw_acc_token' ];
		$access_token_secret 	= $this->options[ 'tw_acc_token_sec' ];
		$consumer_key 			= $this->options[ 'tw_cons_key' ];
		$consumer_secret 		= $this->options[ 'tw_cons_secret' ];

		// Retrieving the updated values
		$count 					= absint( $instance['count'] );
		$tw_name 				= $instance['tw_name'];
		$tw_usr 				= $instance['tw_usr'];
		$tw_profile 			= $instance['tw_profile'];

		// Check if all the fields are filled up
		if( $twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) {

			// Set transName 
			$transName = 'list_tweets_'. $args['widget_id'];

			// Set cache time
			$cacheTime = 10;
			delete_transient( $transName );

			// Check the transient condition
			if( false === ( $twitterData = get_transient( $transName ) ) ) {
			    // require the twitter auth class
			    @require_once 'twitteroauth/twitteroauth.php';
			    $twitterConnection = new TwitterOAuth(
					$consumer_key,			// Consumer Key
					$consumer_secret,   	// Consumer secret
					$access_token,       	// Access token
					$access_token_secret    // Access token secret
				);

				// Attempting to fetch data
			    $twitterData = $twitterConnection->get(
					'https://api.twitter.com/1.1/statuses/user_timeline.json',
					array(
						'screen_name'     => $twitter_id,
					    'count'           => $count,
					    'exclude_replies' => false
					)
				);

			    // Check if the API is up
			    if( $twitterConnection->http_code != 200 ) {
					$twitterData = get_transient( $transName );
			    }

			    // Save our new transient.
			    set_transient( $transName, $twitterData, 60 * $cacheTime );

			};

			// Passing the transient
			$cx_twitter = get_transient( $transName );
			if( $cx_twitter && is_array( $cx_twitter ) ) {
			?>
				<div class="twitter-widget">
					<div class="cx-tweets-container" id="twitter_<?php echo esc_attr( $args['widget_id'] ); ?>">
						<?php foreach( $cx_twitter as $cx_tweet ) { ?>
							<div class="twitter-feed-wrapper clearfix">
								<?php if( 'on' == $instance[ 'tw_profile' ] ) { ?>
									<div class="twitter-feed-left">
										<a href="<?php echo esc_url( '//twitter.com/'. esc_html( $cx_tweet->user->screen_name ) ); ?>" target="_blank">
											<img class="media-object" src="<?php echo esc_url( $cx_tweet->user->profile_image_url ); ?>" alt="twitter-user-profile">
										</a>
									</div>
								<?php } ?>
								<div class="twitter-feed-right">
									<?php if( ('on' == $instance[ 'tw_name' ] ) && ( 'on' == $instance[ 'tw_usr' ] ) ) { ?>
										<h4><?php echo esc_html( $cx_tweet->user->name ); ?> <a href="<?php echo esc_url( '//twitter.com/'. esc_html( $cx_tweet->user->screen_name ) ); ?>" class="twitter-user" target="_blank"><em>@<?php echo esc_html( $cx_tweet->user->screen_name ); ?></em></a></h4>
									<?php } elseif( 'on' == $instance[ 'tw_name' ] ) { ?>
										<h4><?php echo esc_html( $cx_tweet->user->name ); ?></h4>
									<?php  } elseif( 'on' == $instance[ 'tw_usr' ] ) { ?>
										<h4><a href="<?php echo esc_url( '//twitter.com/'. esc_html( $cx_tweet->user->screen_name ) ); ?>" class="twitter-user" target="_blank"><em>@<?php echo esc_html( $cx_tweet->user->screen_name ); ?></em></a></h4>
									<?php } ?>
									<p class="cx-tweet-text">
										<?php

										// Fetching tweet text and formatting
										$latestTweet = $cx_tweet->text;
										$latestTweet = preg_replace( '/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="//$1" target="_blank">https://$1</a>', $latestTweet );
										$latestTweet = preg_replace( '/@([a-z0-9_]+)/i', '<a href="//twitter.com/$1" target="_blank">@$1</a>', $latestTweet );
										$latestTweet = preg_replace( '/#(\w+)/', '<a href="//twitter.com/hashtag/$1?src=hash" target="_blank">#$1</a>', $latestTweet );
										printf( '%s', $latestTweet );
										?>
									</p>
									<?php
									// Fetching tweet time
									$twitterTime = strtotime( $cx_tweet->created_at );
									$cx_time = $this->tweet_time( $twitterTime );
									?>
									<p><a href="<?php echo esc_url( '//twitter.com/'. esc_html( $cx_tweet->user->screen_name ) ); ?>/statuses/<?php echo esc_html( $cx_tweet->id_str ); ?>" target="_blank" class="feed-time"><?php echo esc_html( $cx_time ); ?></a></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php 
			} else {
				echo '<div class="error"><p>' . esc_html__( 'Error: Please Provide Valid Twitter OAuth Information.', 'codexin' ) . '</p></div>';
			}
		} else {
			echo '<div class="error"><p>' . esc_html__( 'Error: Please Provide Valid Twitter OAuth Information.', 'codexin' ) . '</p></div>';
		}
		
		printf( '%s', $args[ 'after_widget' ] );

	}

	// Calculating tweet time
	public function tweet_time($time) {

		    $periods = array( "second", "minute", "hour", "day", "week", "month", "year", "decade" );
		    $lengths = array( "60","60","24","7","4.35","12","10" );

		    $now = time();
			$diff = $now - $time;

		    for( $j = 0; $diff >= $lengths[$j] && $j < count( $lengths )-1; $j++ ) {
				$diff /= $lengths[$j];
		    }

		    $diff = round( $diff );

		    if( $diff != 1 ) {
		        $periods[$j].= "s";
		    }

		    return "$diff $periods[$j] ago ";
		}

	}

// Registering the widget
add_action( 'widgets_init', function() {
	register_widget( 'Codexin_Twitter_Widget' );
} );