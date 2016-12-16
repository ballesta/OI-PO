<?php

if(!class_exists('TPLshortCode')):

	/**
	*
	*/
	class TPLshortCode
	{

		function __construct()
		{
			add_shortcode( 'tlpteam', array( $this, 'team_shortcode' ) );

		}

		function team_shortcode($atts , $content = ""){

			$col_A = array(1,2,3,4);

			global $TLPteam;
			$atts = shortcode_atts( array(
					'member' => 4,
					'col' => 3,
					'orderby' => 'date',
					'order'	=> 'DESC',
					'layout'	=> 1
				), $atts, 'tlpteam' );

			if(!in_array($atts['col'], $col_A)){
				$atts['col'] = 3;
			}
			if(!in_array($atts['layout'], array(1,2,3,'isotope'))){
				$atts['layout'] = 1;
			}

			$html = null;

			$args = array(
					'post_type' => 'team',
					'post_status'=> 'publish',
					'posts_per_page' => $atts['member'],
					'orderby' => $atts['orderby'],
					'order'   => $atts['order']
				);


			$teamQuery = new WP_Query( $args );

			   if ( $teamQuery->have_posts() ) {
			   		$html .= '<div class="tlp-container tlp-team tlp-layout-'.$atts['layout'].'">';
				   if($atts['layout'] == 'isotope') {
					   $html .= '<div class="button-group sort-by-button-group">
									<button data-sort-by="original-order">Default</button>
									  <button data-sort-by="name">Name</button>
									  <button data-sort-by="designation">Designation</button>
								  </div>';
					   $html .= '<div class="tlp-team-isotope">';
				   }
			    	$i= 1;
			    	$j= 1;
				    while ($teamQuery->have_posts()) : $teamQuery->the_post();
					    if($atts['layout'] != 'isotope'){
							if($i==1){
								$html .= '<div class="tlp-row">';
							}
						}
				      		$title = get_the_title();
				      		$pLink = get_permalink();
				      		$short_bio = get_post_meta( get_the_ID(), 'short_bio', true );
				      		$designation = get_post_meta( get_the_ID(), 'designation', true );

				      		if (has_post_thumbnail()){
				      			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'team-thumb');
                                @$imgSrc300x300=get_the_post_thumbnail( get_the_ID(), array( 250, 250, true ) );
				      			$imgSrc = $image[0];
				      		}else{
								$imgSrc = $TLPteam->assetsUrl .'images/demo.jpg';
				      		}
                            
				      		$sLink = unserialize(get_post_meta( get_the_ID(), 'social' , true));
							if($atts['layout'] != 'isotope') {
								$html .= "<div class='tlp-col-{$atts['col']} tplmember'>";
							}
								switch ($atts['layout']) {
									case 1:
										$html .= $this->layoutOne($title, $pLink, $imgSrc, $designation, $short_bio, $sLink);
									break;

									case 2:
										$html .= $this->layoutTwo($title, $pLink, $imgSrc, $designation, $short_bio, $sLink);
									break;

									case 3:
										$html .= $this->layoutThree($title, $pLink, $imgSrc300x300, $designation, $short_bio, $sLink);
									break;

									case 'isotope':
										$html .= $this->layoutIsotope($title, $pLink, $imgSrc, $designation);
									break;

									default:
										# code...
									break;
								}
							if($atts['layout'] != 'isotope') {
								$html .= '</div>'; //end col
								if($i == $atts['col'] || $j == $atts['member']){
									$html .='</div>'; // End row
								}
							}
							if($i == $atts['col']){
								$i = 0;
							}
							$j++;
							$i++;
				      endwhile;
				       wp_reset_postdata();
				     // end row
				   if($atts['layout'] == 'isotope') {
					   $html .= '</div>'; // end tlp-team-isotope
				   }
				   $html .= '</div>'; // end container
			   }else{
			   	$html .= "<p>".__('No member found',TPL_TEAM_SLUG)."</p>";
			   }
			return $html;
		}

		function layoutOne($title, $pLink, $imgSrc, $designation, $short_bio, $sLink){
			global $TLPteam;
			$settings = get_option($TLPteam->options['settings']);
			$html = null;
			 $html .= '<div class="thum"><img src="'.$imgSrc.'"></div>';
			  $html .= '<div class="short-desc">';
				if($settings['general']['link_detail_page'] == 'no') {
					$html .= '<h3 class="name">'. $title . '</h3>';
				}else{
					$html .= '<h3 class="name"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
				}
				if($designation){
					$html .= '<div class="designation">'.$designation.'</div>';
				}
                $html .= '</div>';
                 	$html .= '<div class="short-bio">';
    				if($short_bio){
    					$html .= '<p>'.$short_bio.'</p>';
    				}
				$html .= '</div>';
        			$html .= '<div class="tpl-social"><ul>';
        			if($sLink){
        				foreach ($sLink as $id => $link) {
        						$html .= "<li><a class='fa fa-$id' href='{$sLink[$id]}' title='$id' target='_blank'></a></li>";
        				}
        			}
        			$html .= '</ul></div>';
			return $html;
		}
		function layoutTwo($title, $pLink, $imgSrc, $designation, $short_bio, $sLink){
			global $TLPteam;
			$settings = get_option($TLPteam->options['settings']);
			$html = null;
            $html .= '<div class="tlp-theme-bg">';
				$html .= '<div class="tlp-item-right tlp50left tlp20">
					    	<div class="team_picture">
								<div class="team_img1 thum">
								 <img src="'.$imgSrc.'"alt="'.$title.'">
								</div>';
					$html .='</div>';
				$html .= '</div>';
				$html .='<div class="tlp-item-left tlp50left tlp80">
						    <div class="team_content_area">';
						if($settings['general']['link_detail_page'] == 'no') {
							$html .= '<h3 class="tlp-title">'.$title.'</h3>';
						}else{
                            $html .= '<h3 class="tlp-title"><a title="'.$title.'" href="'.$pLink.'">'.$title.'</a></h3>';
						}
						$html .='<div class="designation">'.$designation.'</div>';
						$html .='<div class="short-bio">
							    	<p>'.$short_bio.'</p>
							    </div>';
								$html .= '<div class="tpl-social"><ul>';
								if ($sLink) {
									foreach ($sLink as $id => $link) {
										$html .= "<li><a class='fa fa-$id' href='{$sLink[$id]}' title='$id' target='_blank'></a></li>";
									}
								}
								$html .= '</ul></div>';
							$html .='</div>
						</div>
                    </div>';// tlp theme bg
			return $html;
		}
		function layoutThree($title, $pLink, $imgSrc300x300, $designation, $short_bio, $sLink){
			global $TLPteam;
			$settings = get_option($TLPteam->options['settings']);
			$html = null;
			$html .= '<div class="tlp-item-right tlp50left tlp20">
					    <div class="team_picture">
					        <div class="team_img_50 thum">';
					        $html .= $imgSrc300x300;
				$html .= '</div>';		        	
				$html .= '</div>';
				$html .= '</div>';
				$html .='<div class="tlp-item-left tlp50left tlp80">
						    <div class="team_content_area">';
							if($settings['general']['link_detail_page'] == 'no') {
							    $html .= '<h3 class="tlp-title">'.$title.'</h3>';
							}else{
								$html .= '<h3 class="tlp-title"><a title="'.$title.'" href="'.$pLink.'">'.$title.'</a></h3>';
							}

							$html .='<div class="designation">'.$designation.'</div>
							    <div class="short-bio">
							    <p>'.$short_bio.'</p>
							    </div>';
								$html .= '<div class="tpl-social"><ul>';
								if ($sLink) {
									foreach ($sLink as $id => $link) {
										$html .= "<li><a class='fa fa-$id' href='{$sLink[$id]}' title='$id' target='_blank'></a></li>";
									}
								}
								$html .= '</ul></div>';
							$html .='</div>
						</div>';
			return $html;
		}

		function layoutIsotope($title, $pLink, $imgSrc, $designation){
			global $TLPteam;
			$settings = get_option($TLPteam->options['settings']);
			$html = null;
			$html .= '<div class="tlp-member">';
					$html .= '<div class="thum"><img src="'.$imgSrc.'"></div>';
					$html .= '<div class="short-desc">';
					if($settings['general']['link_detail_page'] == 'no') {
						$html .= '<h3 class="name">' . $title . '</h3>';
					}else{
						$html .= '<h3 class="name"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';

					}
					if($designation){
						$html .= '<div class="designation">'.$designation.'</div>';
					}
					$html .= '</div>
			</div>';
			return $html;
		}


	}

endif;
