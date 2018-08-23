<?php	 		 	
/*
-----------------------------------------------------------------------------------

 	Plugin Name: Recent Comments Widget For Sidebar/Footer
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your recent comments
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'OrangeIdea_load_recent_posts_comments_widgets');

function OrangeIdea_load_recent_posts_comments_widgets()
{
	register_widget('OrangeIdea_Recent_Posts_Comments_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class OrangeIdea_Recent_Posts_Comments_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function __construct() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'OrangeIdea_recent_posts_comments_widget', 'description' => __( 'OrangeIdea: Recent Comments', 'qoon-creative-wordpress-portfolio-theme' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'OrangeIdea_recent_posts_comments_widget' );

		/* Create the widget. */		
		// $this->__construct( 'OrangeIdea_recent_posts_comments_widget', 'OrangeIdea: Recent Comments ', $widget_ops);
		parent::__construct( 'OrangeIdea_recent_posts_comments_widget', 'OrangeIdea: Recent Comments ', $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$number_of_posts_to_show = $instance['number_of_posts_to_show'];

	// Before widget (defined by theme functions file)
	echo $before_widget;
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>
    <ul class="comments_widget_ul">
	<?php
    // Loop
	$args = array(
	'status'       => 'approve',
	'number'       => $number_of_posts_to_show,
	);
	
	// The Query
	$comments_query = new WP_Comment_Query;
	$comments = $comments_query->query( $args );
	
	// Comment Loop
	if ( $comments ) {
		foreach ( $comments as $comment ) {
			$e_mail = $comment->comment_author_email;
			$comment_date = get_comment_date( get_option( 'date_format' ), $comment->comment_ID );
			?>
            
        <li class="oi_recent_comment_post_holder">
            <div class="oi_recent_comment_post">
                <div class="oi_widget_post_content">
                    <?php $height = strlen($comment->comment_content);?>
                    <div class="oi_post_content_content"><a  href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php echo substr($comment->comment_content,0,100); if($height>100){echo '...';}  ?> </a></div>
                </div>
                <div class="oi_widget_comment_author"><?php echo $comment->comment_author;?>,  <span class="comment_date"><?php echo $comment_date?></span></div>
            </div>
        </li>	
		<?php }
	} else {
		echo 'No comments found.';
	}

	?>
   </ul>
	<?php	 		 	

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['number_of_posts_to_show'] = stripslashes( $new_instance['number_of_posts_to_show']);

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Recent Comments' , 'qoon-creative-wordpress-portfolio-theme' ), 'number_of_posts_to_show' => '3' );
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qoon-creative-wordpress-portfolio-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>


	<!-- Number of Posts: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'number_of_posts_to_show' ); ?>"><?php _e('Number of comments to show:', 'qoon-creative-wordpress-portfolio-theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_posts_to_show' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts_to_show' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['number_of_posts_to_show'] ), ENT_QUOTES)); ?>" />
	</p>

	<?php	 		 	
	}
}
?>