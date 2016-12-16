
<?php 
$dataf= get_option('bsp_style_settings_f') ;
$datati= get_option('bsp_style_settings_ti') ;
$datat= get_option('bsp_style_settings_t') ;
$datala= get_option('bsp_style_settings_la') ;
$dataform= get_option('bsp_style_settings_form') ;
$datafd=get_option('bsp_forum_display') ;
$datacss=get_option('bsp_css') ;

?>



/*  1 ----------------------  forum list backgrounds --------------------------*/
<?php 
$field=$dataf['Forum ContentBackground color - odd numbers'] ;
if (!empty ($field)) {
?>
#bbpress-forums ul.odd
 {
 background-color: <?php echo $field ;?>  ;
 }
<?php } ?>

<?php 
$field=$dataf['Forum ContentBackground color - even numbers'] ;
if (!empty ($field)) {
?>
#bbpress-forums ul.even
  {
 background-color: <?php echo $field ; ?>;
 }
<?php } ?>


 
 /*  2 ----------------------  headers backgrounds --------------------------*/

<?php 
$field=$dataf['Forum/Topic Headers/FootersBackground Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-header,
#bbpress-forums li.bbp-footer 
 {
 background-color: <?php echo $field ;?> ;
 }
<?php } ?>
 
 
 
 
 /*  3 ----------------------  Font - Forum headings --------------------------*/
 
<?php 
$field=$dataf['Forum Headings FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums ul.forum-titles
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Forum Headings FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums ul.forum-titles
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataf['Forum Headings FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums ul.forum-titles
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Forum Headings FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums ul.forum-titles
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums ul.forum-titles
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums ul.forum-titles
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>

 
 /*  4 ----------------------  Font - breadcrumb --------------------------*/
 

 
 
 
 <?php 
$field=$dataf['Breadcrumb FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-breadcrumb p
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Breadcrumb FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-breadcrumb p
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataf['Breadcrumb FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-breadcrumb p
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Breadcrumb FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-breadcrumb p
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-breadcrumb p
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-breadcrumb p
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 
 
  /*  5 ----------------------  Font - links --------------------------*/
 
<?php 
$field=$dataf['LinksLink Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums a:link
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['LinksVisited Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums a:visited
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 
 <?php 
$field=$dataf['LinksHover Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums a:hover
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 


 /*  6 ----------------------  Font - Forum and category lists --------------------------*/
 
<?php 
$field=$dataf['Forum and Category List FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-forum-title
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$dataf['Forum and Category List FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-forum-title
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Forum and Category List FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-forum-title
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-forum-title
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-forum-title
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 
 
 
 
 
 /*  7 ----------------------  Font - Sub Forum lists --------------------------*/
 
<?php 
$field=$dataf['Sub Forum List FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-forums-list li
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$dataf['Sub Forum List FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-forums-list li
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Sub Forum List FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-forums-list li
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-forums-list li
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-forums-list li
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 
  /*  8 ----------------------  Font - forum description --------------------------*/
 
/*Note we also set bsp-forum-content as if add descriptions are set in forum display, then we need to replicate these settings */ 
  
<?php 
$field=$dataf['Forum Description FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-forum-content, 
#bbpress-forums .bsp-forum-content,
#bbpress-forums .bbp-forum-info .bbp-forum-content
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Forum Description FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-forum-content,
#bbpress-forums .bsp-forum-content,
#bbpress-forums .bbp-forum-info .bbp-forum-content
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataf['Forum Description FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-forum-content,
#bbpress-forums .bsp-forum-content,
#bbpress-forums .bbp-forum-info .bbp-forum-content
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Forum Description FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-forum-content,
#bbpress-forums .bsp-forum-content,
#bbpress-forums .bbp-forum-info .bbp-forum-content
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-forum-content,
#bbpress-forums .bsp-forum-content,
#bbpress-forums .bbp-forum-info .bbp-forum-content
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-forum-content,
 #bbpress-forums .bsp-forum-content,
 #bbpress-forums .bbp-forum-info .bbp-forum-content
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 
 
  /*  9 ----------------------  Font - Freshness --------------------------*/
 
<?php 
$field=$dataf['Freshness FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-forum-freshness, 
#bbpress-forums .bbp-topic-freshness
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$dataf['Freshness FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-forum-freshness, 
#bbpress-forums .bbp-topic-freshness
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Freshness FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-forum-freshness, 
#bbpress-forums .bbp-topic-freshness

 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-forum-freshness,
#bbpress-forums .bbp-topic-freshness
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-forum-freshness,
 #bbpress-forums .bbp-topic-freshness
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 /*  10 ----------------------  Font - Freshness Author--------------------------*/
 
<?php 
$field=$dataf['Freshness Author FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-topic-freshness-author
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$dataf['Freshness FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-topic-freshness-author
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Freshness FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-topic-freshness-author
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-topic-freshness-author
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-topic-freshness-author
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 
 
 
  /*  11 ----------------------  Forum boarder --------------------------*/
 
<?php 
$field1=$dataf['Forum BorderLine width'] ;
$field2=$dataf['Forum BorderLine style'] ;
$field3=$dataf['Forum BorderColor'] ;

if (!empty ($field1) || !empty ($field2) ||!empty ($field3)) {
	if (empty ($field1)) $field1 = '1px' ;
	if (is_numeric($field1)) $field1=$field1.'px' ;
	if (empty ($field2)) $field2 = 'solid' ;
	$field=$field1.' '.$field2.' '.$field3
?>

#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-topics,
#bbpress-forums .bbp-reply-header,
#bbpress-forums div.odd,
#bbpress-forums div.even,
#bbpress-forums ul.bbp-replies


  {
Border:  <?php echo $field ; ?> ;
 }
 
#bbpress-forums li.bbp-header,
#bbpress-forums li.bbp-body ul.forum,
#bbpress-forums li.bbp-body ul.topic,
#bbpress-forums li.bbp-footer,
#bbpress-forums ul.forum,


{
 
 Border-top:  <?php echo $field ; ?> ;
 
 }
 
 
#bbpress-forums li.bbp-footer


{
 
 Border-bottom:  <?php echo $field ; ?> ;
 
 }
 
 
 
 
<?php } ?>



 /*   12 ----------------------  Font - topic count --------------------------*/
 
<?php 
$field=$dataf['Topic Count FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums li.bbp-forum-topic-count
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Topic Count FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-forum-topic-count
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataf['Topic Count FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-forum-topic-count
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Topic Count FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums li.bbp-forum-topic-count
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums li.bbp-forum-topic-count
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums li.bbp-forum-topic-count
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>



 /*  13 ----------------------  Font - Post counts --------------------------*/
 
<?php 
$field=$dataf['Post Count FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums li.bbp-forum-reply-count
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Post Count FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-forum-reply-count
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataf['Post Count FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-forum-reply-count
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataf['Post Count FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums li.bbp-forum-reply-count
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums li.bbp-forum-reply-count
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums li.bbp-forum-reply-count
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>

 
/*********_________________TOPIC INDEX___________________________________________*/ 




/*  1 ----------------------  Font - pagination --------------------------*/
 
<?php 
$field=$datati['Pagination FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-pagination
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Pagination FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-pagination
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datati['Pagination FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-pagination
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Pagination FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-pagination
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-pagination
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums .bbp-pagination
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>


/*  2 ----------------------  Font - voice/post count --------------------------*/
 
<?php 
$field=$datati['Voice/Post Count FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums li.bbp-topic-voice-count, li.bbp-topic-reply-count
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Voice/Post Count FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-topic-voice-count, li.bbp-topic-reply-count
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datati['Voice/Post Count FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-topic-voice-count, li.bbp-topic-reply-count
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Voice/Post Count FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums li.bbp-topic-voice-count, li.bbp-topic-reply-count
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums li.bbp-topic-voice-count, li.bbp-topic-reply-count
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums li.bbp-topic-voice-count, li.bbp-topic-reply-count
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>

 /*  3 ----------------------  topic title Font - links --------------------------*/
 
<?php 
$field=$datati['Topic Title LinksLink Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums a.bbp-topic-permalink:link
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Topic Title LinksVisited Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums a.bbp-topic-permalink:visited
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datati['Topic Title LinksHover Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums a.bbp-topic-permalink:hover
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 

/*  4 ----------------------  Font - Topic Title --------------------------*/
 
<?php 
$field=$datati['Topic Title FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-topic-title
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datati['Topic Title FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-topic-title
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Topic Title FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-topic-title
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-topic-title
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums .bbp-topic-title
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 /*  5 ----------------------  Font - template notice --------------------------*/
 
<?php 
$field=$datati['Template Notice FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-template-notice p
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Template Notice FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-template-notice
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datati['Template Notice FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-template-notice
 
 {
Font-Family::  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Template Notice FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-template-notice
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-template-notice
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums .bbp-template-notice
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>

/*  6 ----------------------  Font - template background --------------------------*/
 
<?php 
$field=$datati['Template NoticeBackground color'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-template-notice
 
 {
background-color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 



/*  7 ----------------------  Font - template border --------------------------*/
 
<?php 

$field1=$datati['Template Notice BorderLine width'] ;
$field2=$datati['Template Notice BorderLine style'] ; ;
$field3=$datati['Template Notice BorderLine color'] ;

if (!empty ($field1) || !empty ($field2) ||!empty ($field3)) {
	if (empty ($field1)) $field1 = '1px' ;
	if (is_numeric($field1)) $field1=$field1.'px' ;
	//if (empty ($field2)) $field2 = 'solid' ;
	$field=$field1.' '.$field2.' '.$field3
?>
#bbpress-forums .bbp-template-notice
 
 {
Border:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
/*  8 ----------------------  Font - Started by --------------------------*/
 
<?php 
$field=$datati['Topic Started bySize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-topic-started-by
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Topic Started byColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-topic-started-by
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datati['Topic Started byFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-topic-started-by
 
 {
Font-Family::  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Topic Started byStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-topic-started-by
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-topic-started-by
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums .bbp-topic-started-by
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>
/*  9 ----------------------  sticky/super sticky background --------------------------*/


<?php 
$field=$datati['Sticky Topic/ReplyBackground color - sticky topic'] ;
if (!empty ($field)) {
?>


.bbp-topics ul.sticky,
.bbp-forum-content ul.sticky {
	background-color: <?php echo $field ;?> !important;
}
<?php } ?>

<?php 
$field=$datati['Sticky Topic/ReplyBackground color - super sticky topic'] ;
if (!empty ($field)) {
?>
.bbp-topics-front ul.super-sticky,
.bbp-topics ul.super-sticky {
	background-color: <?php echo $field ;?> !important;
}

<?php } ?>




/*  10. ----------------------  Font - forum info notice (also does topic info)--------------------------*/
 
<?php 
$field=$datati['Forum Information FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums div.bbp-template-notice.info .bbp-forum-description,
#bbpress-forums div.bbp-template-notice.info .bbp-topic-description 
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Forum Information FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.bbp-template-notice.info .bbp-forum-description,
#bbpress-forums div.bbp-template-notice.info .bbp-topic-description 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datati['Forum Information FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.bbp-template-notice.info .bbp-forum-description,
#bbpress-forums div.bbp-template-notice.info .bbp-topic-description 
 
 {
Font-Family::  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datati['Forum Information FontStyle'] ;

if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums div.bbp-template-notice.info .bbp-forum-description,
#bbpress-forums div.bbp-template-notice.info .bbp-topic-description 
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums div.bbp-template-notice.info .bbp-forum-description,
#bbpress-forums div.bbp-template-notice.info .bbp-topic-description 
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else { ?>
 #bbpress-forums div.bbp-template-notice.info .bbp-forum-description,
#bbpress-forums div.bbp-template-notice.info .bbp-topic-description 
 
 {
Font-weight:  normal ; 
 }
 
 
 <?php
}
 
}

?>

/* 11 ----------------------  Font - forum info background  (also does topic info)--------------------------*/
 
<?php 
$field=$datati['Forum InformationBackground color'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.bbp-template-notice.info
 
 {
background-color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 



/*  12 ----------------------  Font - forum info border  (also does topic info)--------------------------*/
 
<?php 

$field1=$datati['Forum Information BorderLine width'] ;
$field2=$datati['Forum Information BorderLine style'] ; ;
$field3=$datati['Forum Information BorderLine color'] ;

if (!empty ($field1) || !empty ($field2) ||!empty ($field3)) {
	if (empty ($field1)) $field1 = '1px' ;
	if (is_numeric($field1)) $field1=$field1.'px' ;
	//if (empty ($field2)) $field2 = 'solid' ;
	$field=$field1.' '.$field2.' '.$field3
?>
#bbpress-forums div.bbp-template-notice.info
 
 {
Border:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 




 


/*********_________________TOPIC/REPLY___________________________________________*/ 


 
 /*  1 ----------------------topic/reply backgrounds   --------------------------*/

<?php 
$field=$datat['Topic/Reply ContentBackground color - odd numbers'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.odd
 {
 background-color: <?php echo $field ; ?> ;
 }
<?php } ?>

<?php 
$field=$datat['Topic/Reply ContentBackground color - even numbers'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.even
  {
background-color: <?php echo $field ; ?> ;
 }
 <?php } ?>
 
  /*  2 ----------------------  Topic/reply header background --------------------------*/
 
<?php 
$field=$datat['Topic/Reply HeaderBackground color'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.bbp-reply-header,
#bbpress-forums div.bbp-topic-header

  {
background-color: <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 
 
 
 /*  3 ----------------------  Trash/Spam backgrounds --------------------------*/
 
<?php 
$field=$datat['Trash/Spam ContentBackground color - odd numbers'] ;
if (!empty ($field)) {
?>
#bbpress-forums .status-trash.odd,
#bbpress-forums .status-spam.odd 
 {
 background-color: <?php echo $field ; ?> ;
 }
<?php } ?>

<?php 
$field=$datat['Trash/Spam ContentBackground color - even numbers'] ;
if (!empty ($field)) {
?>
#bbpress-forums .status-trash.even,
#bbpress-forums .status-spam.even
  {
background-color: <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 /*  4 ----------------------  Closed Topic backgrounds --------------------------*/
 
<?php 
$field=$datat['Closed Topic ContentBackground color'] ;
if (!empty ($field)) {
?>
#bbpress-forums .status-closed,
#bbpress-forums .status-closed a
  {
background-color: <?php echo $field ; ?> ;
 }
 <?php } ?>
 
  /*  5 ----------------------  Font - topic/reply date --------------------------*/
 

 
 
 
 <?php 
$field=$datat['Topic/Reply Date FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-reply-post-date

 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Topic/Reply Date FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-reply-post-date
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datat['Topic/Reply Date FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-reply-post-date
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Topic/Reply Date FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-reply-post-date
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-reply-post-date
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>
 #bbpress-forums .bbp-reply-post-date
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>

 
 
 /*  6 ----------------------  Font - topic/reply text --------------------------*/
 

 
 <?php 
$field=$datat['Topic/Reply Text FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-topic-content, 
#bbpress-forums .bbp-reply-content
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Topic/Reply Text FontColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-topic-content, 
#bbpress-forums .bbp-reply-content
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datat['Topic/Reply Text FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-topic-content, 
#bbpress-forums .bbp-reply-content
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Topic/Reply Text FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-topic-content,
#bbpress-forums .bbp-reply-content
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-topic-content,
#bbpress-forums .bbp-reply-content
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>
#bbpress-forums .bbp-topic-content,
#bbpress-forums .bbp-reply-content
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 /*  7 ----------------------  Font - Author name --------------------------*/
 
<?php 
$field=$datat['Author Name FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums a.bbp-author-name
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datat['Author Name FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums a.bbp-author-name
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Author Name FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums a.bbp-author-name
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums a.bbp-author-name
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums a.bbp-author-name
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
  /*  8 ----------------------  Font - reply permalink --------------------------*/
 
<?php 
$field=$datat['Reply Link FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums a.bbp-reply-permalink
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datat['Reply Link FontFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums a.bbp-reply-permalink
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Reply Link FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums a.bbp-reply-permalink
 
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums a.bbp-reply-permalink
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums a.bbp-reply-permalink
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
  /*  9 ----------------------  Font - author role --------------------------*/
 
<?php 
$field=$datat['Author RoleSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums div.bbp-reply-author .bbp-author-role
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datat['Author RoleColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.bbp-reply-author .bbp-author-role

 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datat['Author RoleFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums div.bbp-reply-author .bbp-author-role
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Author RoleStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums div.bbp-reply-author .bbp-author-role
 
 {
Font-Style:  italic ; 
 }
<?php }
else {?>
 #bbpress-forums div.bbp-reply-author .bbp-author-role
 
 {
Font-Style:  normal ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums div.bbp-reply-author .bbp-author-role
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
 #bbpress-forums div.bbp-reply-author .bbp-author-role
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
  /*  10 ----------------------  Font - author role --------------------------*/
 
<?php 
$field=$datat['Topic HeaderSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datat['Topic HeaderColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author

 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datat['Topic HeaderFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datat['Topic HeaderStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author
 
 {
Font-Style:  italic ; 
 }
<?php }
else {?>
 #bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author
 
 {
Font-Style:  normal ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author
 
 {
Font-weight:  bold ; 
 }
 <?php }
 else {?>
#bbpress-forums li.bbp-header .bbp-reply-content,
#bbpress-forums li.bbp-header  .bbp-reply-author,
#bbpress-forums li.bbp-footer .bbp-reply-content,
#bbpress-forums li.bbp-footer  .bbp-reply-author
 
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 /*********_________________TOPIC REPLY FORM___________________________________________*/ 
 
  /*  1 ----------------------  Topic/reply Labels --------------------------*/
 
<?php 
$field=$dataform['LabelsSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums .bbp-form label
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataform['LabelsColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-form label

 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$dataform['LabelsFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums .bbp-form label
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataform['LabelsStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums .bbp-form label
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums .bbp-form label
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>
#bbpress-forums .bbp-form label
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 /*  2 ----------------------  Text area background --------------------------*/
 
 
 <?php 
$field=$dataform['Text areaBackground Color'] ;
if (!empty ($field)) {
?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums input[type="text"]:focus, textarea:focus,
#bbpress-forums .quicktags-toolbar
 
 {
background-color:  <?php echo $field ; ?> ;
 }
 
 <?php } ?>
 
 /*  3 ----------------------  Text area font --------------------------*/
 
<?php 
$field=$dataform['Text areaSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums .quicktags-toolbar ,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$dataform['Text areaColor'] ;
if (!empty ($field)) {
?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums .quicktags-toolbar ,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content


 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$dataform['Text areaFont'] ;
if (!empty ($field)) {
?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums .quicktags-toolbar ,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$dataform['Text areaStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums .quicktags-toolbar ,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums .quicktags-toolbar ,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>
#bbpress-forums input[type="text"], textarea, 
#bbpress-forums .quicktags-toolbar ,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 /*  4 ----------------------  button background --------------------------*/

 <?php 
$field=$dataform['ButtonBackground Color'] ;
if (!empty ($field)) {
?>

#bbpress-forums .button {
  background-color: <?php echo $field ; ?> ;
  
}

 <?php } ?>
 
 <?php 
$field=$dataform['ButtonText Color'] ;
if (!empty ($field)) {
?>

#bbpress-forums .button {
  color: <?php echo $field ; ?> ;
  
}

 <?php } ?>
 
 /*********_________________LATEST ACTIVITY WIDGET___________________________________________*/ 
 
  /*  2 ----------------------  Widget title --------------------------*/
 
<?php 


$field=$datala['Widget TitleSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
.bsp-la-title h3
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 
<?php 
$field=$datala['Widget TitleColor'] ;
if (!empty ($field)) {
?>
.bsp-la-title h3

 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datala['Widget TitleFont'] ;
if (!empty ($field)) {
?>

.bsp-la-title h3
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Widget TitleStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>

.bsp-la-title h3

{
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
.bsp-la-reply-topic-title
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>

.bsp-la-reply-topic-title
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
 
 
 /*  2 ----------------------  topic/reply title --------------------------*/
 
<?php 


$field=$datala['Topic TitleSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
.bsp-la-reply-topic-title
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 

 
 <?php 
$field=$datala['Topic TitleFont'] ;
if (!empty ($field)) {
?>

.bsp-la-reply-topic-title
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Topic TitleStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>

.bsp-la-reply-topic-title

{
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
.bsp-la-reply-topic-title
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>

.bsp-la-reply-topic-title
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
   /*  3 ----------------------  Text font --------------------------*/
 
<?php 
$field=$datala['Text fontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
.bsp-la-text
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datala['Text fontColor'] ;
if (!empty ($field)) {
?>
.bsp-la-text

 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datala['Text fontFont'] ;
if (!empty ($field)) {
?>
.bsp-la-text
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Text fontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
.bsp-la-text
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
.bsp-la-text
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>
.bsp-la-text
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
  /*  4 ----------------------  Topic author Font --------------------------*/
 
<?php 


$field=$datala['Topic author FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
.bsp-la-topic-author
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datala['Topic author FontFont'] ;
if (!empty ($field)) {
?>

.bsp-la-topic-author
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Topic author FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>

.bsp-la-topic-author

{
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
.bsp-la-topic-author
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>

.bsp-la-reply-topic-title
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
  /*  5 ----------------------  Freshness Font--------------------------*/
 
<?php 
$field=$datala['Freshness FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
.bsp-la-freshness
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 <?php 
$field=$datala['Freshness FontColor'] ;
if (!empty ($field)) {
?>
.bsp-la-freshness

 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 

 
 <?php 
$field=$datala['Freshness FontFont'] ;
if (!empty ($field)) {
?>
.bsp-la-freshness
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Freshness FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>
.bsp-la-freshness
 {
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
.bsp-la-text
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>
.bsp-la-text
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 /*  6 ----------------------  Forum Font --------------------------*/
 
<?php 


$field=$datala['Forum FontSize'] ;
if (!empty ($field)) {
if (is_numeric($field)) $field=$field.'px' ;
?>
.bsp-la-forum-title
 
 {
font-size:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
  
 <?php 
$field=$datala['Forum FontFont'] ;
if (!empty ($field)) {
?>

.bsp-la-forum-title
 
 {
Font-Family:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Forum FontStyle'] ;
if (!empty ($field)) {
if (strpos($field,'Italic') !== false) {
?>

.bsp-la-forum-title

{
Font-Style:  italic ; 
 }
 <?php } 

if (strpos($field,'Bold') !== false) {
?>
.bsp-la-forum-title
 
 {
Font-weight:  bold ; 
 }
 <?php }
else {?>

.bsp-la-forum-title
 {
Font-weight:  normal ; 
 }
 <?php
 }
 }
 ?>
 
 
  /*  5 ----------------------  Topic-reply links --------------------------*/
 
<?php 
$field=$datala['Topic-reply linksLink Color'] ;
if (!empty ($field)) {
?>
a:link.bsp-la-reply-topic-title
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
<?php 
$field=$datala['Topic-reply linksVisited Color'] ;
if (!empty ($field)) {
?>
a:visited.bsp-la-reply-topic-title 
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 
 <?php 
$field=$datala['Topic-reply linksHover Color'] ;
if (!empty ($field)) {
?>
a:hover.bsp-la-reply-topic-title 
 
 {
color:  <?php echo $field ; ?> ;
 }
 <?php } ?>
 
 
 
 
 
 
 /*********_________________FORUM DISPLAY___________________________________________*/ 
 
 
 /*----------------------  Move breadcrumb --------------------------*/
 <?php 
$field = (!empty($datafd['move_subscribe']) ? $datafd['move_subscribe'] : '');
if (!empty ($field)) {
?>
.subscription-toggle  {	
	float:right ;
 }
 <?php } ?>
 
 
  /*----------------------  forum description styling --------------------------*/
 
#bbpress-forums div.bsp-forum-content {
clear:both;
margin-left: 0px ;
padding: 0 0 0 0 ;
	}
	
 /*----------------------  Rounded corners --------------------------*/
 
 
<?php 
$field = (!empty($datafd['rounded_corners'] ) ? $datafd['rounded_corners']  : '');
if (!empty ($field)) {
?>	
	.bbp-forums , .bbp-topics  , .bbp-replies  {
	
border-top-left-radius: 10px ;
border-top-right-radius: 10px ;
border-bottom-left-radius: 10px ;
border-bottom-right-radius: 10px ;
	}
	



<?php
}	?>


/*----------------------  custom css--------------------------*/
<?php

$field=$datacss['css'] ;
if (!empty ($field)) {
echo $field ;	
}


?>





 
 
