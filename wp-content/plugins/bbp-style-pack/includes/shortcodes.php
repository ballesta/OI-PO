<?php

// shortcodes functions

add_shortcode('bsp-display-topic-index', 'bsp_display_topic_index');  
add_shortcode('bsp-display-newest-users', 'bsp_display_newest_users'); 
add_shortcode('bsp-display-forum-index', 'bsp_display_selected_forum'); 


function bsp_display_topic_index($attr, $content = '' ) {

		// Sanity check required info
		if ( !empty( $content ) || ( empty( $attr['show'] )  || !is_numeric( $attr['show'] ) ) )
			return $content;
			
		
		// Unset globals
		bsp_unset_globals();
		global $show ;
		global $post_parent__in ;
		global $forum ;
		global $forumcheck ;
		global $stickies ;
		global $display ;
		$show=$attr['show']	;
		
		if (!empty( $attr['forum'])) {
		$forumcheck = 'y' ;
		//we have forum(s)
		//see if more than one forum
			if ( !is_numeric( $attr['forum'] ) ) {
					//it is a list of forums (or rubbish!) so we need to create a post_parent_in array
					
					$post_parent__in = $attr['forum'];
					$forum = '' ; // to nullify it
				}
			//or it's a single forum so 
			else {
				$forum=$attr['forum'] ;
				$post_parent__in =''; //to set up a null post parent in
			
			}
			
			//so now we have the forum(s) in either $forum or $post_parent__in
		
		
		
		}
		
		if (!empty( $attr['show_stickies'])) $stickies=$attr['show_stickies'] ;
		if (!empty( $attr['template'])) $display=$attr['template'] ;
		
		
		// Filter the query
		if ( ! bbp_is_topic_archive() ) {
			add_filter( 'bbp_before_has_topics_parse_args', 'bsp_display_topic_index_query' ) ;
		}

		// Start output buffer
		bsp_start( 'bbp_topic_archive' );

		// Output template
		global $display ;
		if ($display== 'short') {
			?>
			<div id="bbpress-forums">
			<?php
			if ( bbp_is_topic_tag() ) bbp_topic_tag_description();
				if ( bbp_has_topics() ) bbp_get_template_part( 'loop',       'topics'    ); 
				else  bbp_get_template_part( 'feedback',   'no-topics' ); ?>
			</div>
		<?php
		}
		else bbp_get_template_part( 'content', 'archive-topic' );

		// Return contents of output buffer
		return bsp_end();
	}
 
	function bsp_start( $query_name = '' ) {

		// Set query name
		bbp_set_query_name( $query_name );

		// Start output buffer
		ob_start();
	}
	
	function bsp_end() {

		// Unset globals
		bsp_unset_globals();

		// Reset the query name
		bbp_reset_query_name();

		// Return and flush the output buffer
		return ob_get_clean();
	}
	
	function bsp_unset_globals() {
		$bbp = bbpress();

		// Unset global queries
		$bbp->forum_query  = new WP_Query();
		$bbp->topic_query  = new WP_Query();
		$bbp->reply_query  = new WP_Query();
		$bbp->search_query = new WP_Query();

		// Unset global ID's
		$bbp->current_view_id      = 0;
		$bbp->current_forum_id     = 0;
		$bbp->current_topic_id     = 0;
		$bbp->current_reply_id     = 0;
		$bbp->current_topic_tag_id = 0;

		// Reset the post data
		wp_reset_postdata();
	}
	
	function bsp_display_topic_index_query( $args = array() ) {
		global $post_parent__in ;
		global $forum ;
		global $forumcheck ;
		if (!empty ($forumcheck)) {
			$args['post_parent'] = '';
			$args ['post_parent__in'] = explode(",",$post_parent__in);
		}
		
		global $stickies ;
		if (!empty ($stickies)) $args['show_stickies'] = $stickies ;
		else $args['show_stickies'] = false ;
		global $show ;
		$args['author']        = 0;
		$args['order']         = 'DESC';
		$args['posts_per_page'] = $show ;
		$args['max_num_pages'] = 1;
		
		
		
		return $args;
	}
	
	

// adds a shortcode that displays the latest wordpress registered
	
	
Function bsp_display_newest_users ($attr) {
if ( is_numeric( $attr['show'] ))  $number=$attr['show'] ;
else $number = 5 ;
	$users = get_users( array( 'orderby' => 'registered', order => 'desc', number => $number )); 
	$heading1= __('Newest users','bbp-style-pack')  ; 
	$heading2= __('Date joined','bbp-style-pack')  ; 
	echo '<table><th align=left>'.$heading1.'</th><th align=left>'.$heading2.'</th>' ;
	
	foreach ( $users as $user ) {
		$date=date_i18n("jS M Y", strtotime($user->user_registered )); 
		echo '<tr><td>' . esc_html( $user->display_name ).'</td>' ;
		echo '<td>'.$date.'</td>' ;
		echo '</tr>' ;
	}
	echo '</table>' ;
}


//adds a shortcode to display the index from a single forum
function bsp_display_selected_forum($attr, $content = '' ) {

		// Sanity check required info
		if ( !empty( $content ) || ( empty( $attr['forum'] )  ) )
		//$content = 'no forum(s) set ' ;
		return $content;
		
		// Unset globals
		bsp_unset_globals();
		global $forum ;
		if (!empty( $attr['forum'])) $forum=$attr['forum'] ;
		
		if ($attr['breadcrumb'] == 'no' ) {
		add_filter ('bbp_no_breadcrumb', 'bsp_no_breadcrumb');
		}	

		if ($attr['search'] == 'no' ) {
		add_filter ('bbp_allow_search', 'bsp_no_search');
		}			
		
		// Filter the query
		if ( ! bbp_is_forum_archive() ) {
			add_filter( 'bbp_before_has_forums_parse_args', 'bsp_display_forum' ) ;
		}
		
		
		// Start output buffer
		bsp_start( 'bbp_forum_archive' );
		

		// Output template
		bbp_get_template_part( 'content', 'archive-forum' );

		// Return contents of output buffer
		return bsp_end();
	}
	
function bsp_display_forum( $args ) {
		global $forum ;
		
		
		// split the string into pieces
		$forums = explode(',', $forum);
				
		$args['post__in'] = $forums;
		$args['post_parent'] = '' ;
		$args['orderby'] = 'post__in'  ;
		return $args ;
}



function bsp_no_search () {
return false ;
}


