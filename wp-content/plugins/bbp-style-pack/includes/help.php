<?php

function bsp_help() {
 ?>
			
						<table class="form-table">
					
					<tr valign="top">
						<th colspan="2">
						
						<h3>
						<?php _e ('Help' , 'bbp-style-pack' ) ; ?>
						</h3>


						
 						
<h4><span style="color:blue"><?php _e('Colors', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e("Colors are entered as a color eg 'red' or a hex number for that color eg '#ff0000'", 'bbp-style-pack'); ?>

 </p>

<p>
<?php _e('See', 'bbp-style-pack'); ?>
<a href = "http://www.w3schools.com/html/html_colornames.asp" target="_blank"> www.w3schools.com/html/html_colornames.asp</a>
<?php _e('for further info', 'bbp-style-pack'); ?>
  </p>

<p/>


<h4><span style="color:blue"><?php _e('Font', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e("Fonts can be single  eg 'Arial' or or a font family such as 'arial, Times, serif'", 'bbp-style-pack'); ?>
</p>

<p>
<?php _e('Where a font has more than one word such as Times New Roman, the it must be entered with double quotes eg "Times New Roman"', 'bbp-style-pack'); ?>
</p>

<p>
<?php _e('See', 'bbp-style-pack'); ?>
<a href = "http://www.w3schools.com/css/css_font.asp" target="_blank"> www.w3schools.com/css/css_font.asp</a>
<?php _e('for further info', 'bbp-style-pack'); ?>
</p>

<p/>


<h4><span style="color:blue"><?php _e('Font Size', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e("Fonts can be specified as absolute-size eg 'medium', relative size eg 'larger', length eg '12px' or '0.8em' or as a percentage eg 80%", 'bbp-style-pack'); ?>
</p>

<p>
<?php _e('A good explanation  is contained in', 'bbp-style-pack'); ?>
<a href = "https://developer.mozilla.org/en-US/docs/Web/CSS/font-size" target="_blank"> https://developer.mozilla.org/en-US/docs/Web/CSS/font-size</a> </p>

<p> 
<?php _e("bbpress uses px eg '12px', but the choice is yours !", 'bbp-style-pack'); ?>


<p/>

<h4><span style="color:blue"><?php _e('Border style', 'bbp-style-pack' ) ; ?></span></h4>

<p>
<?php _e('Borders can be specified as solid, dashed, dotted, groove, ridge, inset & outset', 'bbp-style-pack'); ?>
</p>

<p>
<?php _e('Common values are solid, dashed, dotted', 'bbp-style-pack'); ?>
</p>

<p>
<?php _e('Values groove, ridge, inset & outset need a border wider than 1px (5px is a good start point) for the effect to work', 'bbp-style-pack'); ?>
</p>
<p>
<?php _e('See', 'bbp-style-pack'); ?>
<a href = "http://www.w3schools.com/css/css_border.asp" target="_blank"> www.w3schools.com/css/css_border.asp</a> 
<?php _e('for further info', 'bbp-style-pack'); ?>
</p>





 
 <?php
}
