<?php
if( !class_exists( 'TPLfrontEnd' ) ) :

	class TPLfrontEnd {

        function __construct(){
            add_action( 'wp_enqueue_scripts', array($this, 'tlp_front_end') );
            add_filter( 'the_content', array($this,'team_content') );
            add_action( 'wp_head', array($this, 'custom_css') );
        }

        function custom_css(){
            global $TLPteam;
            $settings = get_option($TLPteam->options['settings']);
            $pc = (@$settings['general']['primary']['color'] ? @$settings['general']['primary']['color'] : '#0367bf');
            echo "<style>";
            echo '.tlp-team .short-desc {';
                echo 'background: '.$pc;
            echo '}';
            echo '.tlp-team .tpl-social li a.fa {';
                echo 'background: '.$pc;
            echo '}';
            echo "</style>";
            if(@$settings['genaral']['css']){
                echo "<style>";
                echo $settings['genaral']['css'];
                echo "</style>";
            }
        }

	function tlp_front_end(){
            global $TLPteam;
            wp_enqueue_style( 'tlp-fontawsome', $TLPteam->assetsUrl .'css/font-awesome/css/font-awesome.min.css' );
            wp_enqueue_style( 'tlpstyle', $TLPteam->assetsUrl . 'css/tlpstyle.css' );
            wp_enqueue_script( 'tpl-team-isotope-js', $TLPteam->assetsUrl . 'js/isotope.pkgd.js', array('jquery'), '2.2.2', true);
            wp_enqueue_script( 'tpl-team-isotope-imageload-js', $TLPteam->assetsUrl . 'js/imagesloaded.pkgd.min.js', array('jquery'), '3.2.0', true);
            wp_enqueue_script( 'tpl-team-front-end', $TLPteam->assetsUrl . 'js/front-end.js', null, null, true);
        }

        function team_content($content){
            global $post;

            $tel = get_post_meta( $post->ID, 'telephone', true );
            $loc = get_post_meta( $post->ID, 'location', true );
            $email = get_post_meta( $post->ID, 'email', true );
            $url = get_post_meta( $post->ID, 'web_url', true );
            $s = unserialize(get_post_meta( get_the_ID(), 'social' , true));

            $html = null;
            $html .="<div class='tlp-single-details'>";
            $html .= '<ul class="short-desc">';
                if($tel){
                    $html .="<li class='telephone'>".__('<strong>Tel:</strong>',TPL_TEAM_SLUG)." $tel</li>";
                }if($loc){
                    $html .="<li class='location'>".__('<strong>Location:</strong>',TPL_TEAM_SLUG)." $loc</li>";
                }if($email){
                    $html .="<li class='email'>".__('<strong>Email:</strong>',TPL_TEAM_SLUG)." $email</li>";
                }if($url){
                    $html .="<li class='web_url'>".__('<strong>URL:</strong>',TPL_TEAM_SLUG)."$url</li>";
                }
            $html .= "</ul>";

        $s = unserialize(get_post_meta( get_the_ID(), 'social' , true));

        $html .= '<ul class="tpl-social">';
            if($s){
                foreach ($s as $id => $link) {
                        $html .= "<li><a class='fa fa-$id' href='{$s[$id]}' title='$id' target='_blank'></a></li>";
                }
            }
        $html .= '</ul>';

        $html .="</div>";

            if(is_singular('team')){
                $content = $content .$html;
            }
            return $content;
        }

	}
endif;
