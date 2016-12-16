<?php
/**
 * http://www.kathyisawesome.com/simple-user-listing/  
 * The Template for displaying Author Search
 *
 * Override this template by copying it to yourtheme/simple-user-listing/search-author.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Nom particulier recherché?
$search = ( get_query_var( 'as' ) ) ? 
				get_query_var( 'as' )	// Nom recherché passé en paramètre de la requete  
				: 
				'';						// Pas de nom particulier: afficher tout
?>

<div class="author-search">
	<h2>Recherche membres par noms </h2>
	<hr>
		<form method="get" id="sul-searchform" action="<?php the_permalink() ?>">
			<label for="as" 
				   class="assistive-text">
						Nom: &nbsp; 
			</label>
			<input type="text" 
			       class="field" 
				   name="as" 
				   id="sul-s" 
				   placeholder="Membre recherché" 
			       value="<?php echo $search; ?>"/>
			<input type="submit" 
			       class="submit" 
				   id="sul-searchsubmit" value="Rechercher membres" />
		</form>
		<hr>
	<?php
	if( $search ){ ?>
		<h2>Liste des membres dont le nom contient: <em> <?= $search ?> </em></h2>
		<a href="<?php the_permalink(); ?>">
			Retour à la liste des membres
			<br>
		</a>
	<?php } ?>
</div> <!-- .author-search -->