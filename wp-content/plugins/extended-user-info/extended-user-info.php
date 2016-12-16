<?php
/*
Plugin Name: Extended User Info
Plugin URI: http://joeboydston.com/extended-user-info/
Description: Plugin is for adding a user title to the WP user profile
Author: Don Kukral
Version: 1.4
Author URI: http://d0nk.com
*/
class Champs_utilisateurs
{
	function __construct()
	{
		// -- Accroche les traitements aux filtre WordPress
		
		// https://codex.wordpress.org/Plugin_API/Action_Reference/show_user_profile 
		add_action('show_user_profile'		, 'extended_user_info_fields');
		add_action('edit_user_profile'		, 'extended_user_info_fields');
		add_action('personal_options_update', 'save_extended_user_info_fields');
		add_action('edit_user_profile_update', 'save_extended_user_info_fields');
	}
	
	function ajoute_titre($titre)
	{
		$this->titre = $titre;
	}
	
	function ajoute_champ($id, $titre)
	{
		$champs[] = [$id, $titre];
	}
	
	function affiche()
	{
		echo "<h3>$this->titre</h3>";
		echo '<table class="form-table">';
		$this->affiche_champs();
    	echo '</table>';
		
	}

	function affiche_champs()
	{
		foreach($this->champs as $champ)
		{
			$this->affiche_champ($champ);
		}
	}

	function affiche_champ($champ)
	{
		$id=$champ[0];
		$libelle = $champ[1]; 
		echo '<tr>'																				;
		echo '	<th><label for="extended_user_info_', $id, '">',  $libelle, '</label></th>'     ;
		echo '	<td>'                                                                           ;
		echo '		<input type="text"'                                                         ;
		echo '			   name="extended_user_info_', $id, '"'                                 ;
		echo '			   id="extended_user_info_', $id, '"'                                   ;
		echo '			   value="', esc_attr(get_user_meta($user->id,                          
					                          "extended_user_info_" . $id,              		
											  True))                                    		;
		echo '			   class="regular-text"/>'                                              ;
		echo '	</td>'                                                                          ;
		echo '</tr>'                                                                            ;
	}

	function sauvegarde_champs($user_id)
	{
		foreach($this->champs as $champ)
		{
			$id=$champ[0];
			$libelle = $champ[1]; 
			update_user_meta($user_id, 
			                 'extended_user_info_' . $id, 
							 $_POST['extended_user_info_' . $id ]);
		}
	}
	
} // Class

ini_set("display_errors", "1");
error_reporting(E_ALL);
// Crée la définition des champs
$champs_utilisateur = new Champs_utilisateurs();
$champs_utilisateur->ajoute_titre("Téléphone			, Réseaux sociaux");
$champs_utilisateur->ajoute_champ('title'				, 'Titre');
$champs_utilisateur->ajoute_champ('phone_number'		, 'Téléphone fixe');
$champs_utilisateur->ajoute_champ('mobile_phone_number'	, 'Téléphone mobile');
$champs_utilisateur->ajoute_champ('facebook_page'		, 'Page Facebook');
$champs_utilisateur->ajoute_champ('twitter_id'			, 'Twitter ID');

// Aucun changement à faire dans le code suivant.

function extended_user_info_fields ($user) 
{ 
    //print_r()
	$champs_utilisateur->affiche_champs($user);
	
/*	
	<tr>
    <th><label for="extended_user_info_title">Titre, fonction</label></th>
    <td>
		<input type="text" 
			   name="extended_user_info_title" 
			   id="extended_user_info_title" 
			   value="<?php echo esc_attr(get_user_meta($user->id, 
			                              "extended_user_info_title", 
										  True)); 
					 ?>" 
			   class="regular-text"/>
		<br/>
		<span class="description">
			<?php _e("Please enter user title"); ?>
		</span>
    </td>
    </tr>
	
    <tr>
		<th><label for="extended_user_info_phone_number">Téléphone fixe</label></th>
		<td>
			<input type="text" name="extended_user_info_phone_number" id="extended_user_info_phone_number" value="<?php echo esc_attr(get_user_meta($user->id, "extended_user_info_phone_number", True)); ?>" class="regular-text"/><br/>
			<span class="description"><?php _e("Please enter phone number"); ?></span>
		</td>
    </tr>

    <tr>
		<th><label for="extended_user_info_phone_number">Téléphone mobile</label></th>
		<td>
			<input type="text" name="extended_user_info_mobile_phone_number" id="extended_user_info_mobile_phone_number" value="<?php echo esc_attr(get_user_meta($user->id, "extended_user_info_mobile_phone_number", True)); ?>" class="regular-text"/><br/>
			<span class="description"><?php _e("Please enter mobile phone number"); ?></span>
		</td>
    </tr>
    <tr>
    <th><label for="extended_user_info_facebook_page"> Page Facebook</label></th>
    <td>
    <input type="text" name="extended_user_info_facebook_page" id="extended_user_info_facebook_page" value="<?php echo esc_attr(get_user_meta($user->id, "extended_user_info_facebook_page", True)); ?>" class="regular-text"/><br/>
    <span class="description"><?php _e("Please enter Facebook page URL"); ?></span>
    </td>
    </tr>
    <tr>
    <th><label for="extended_user_info_twitter_id">Twitter ID</label></th>
    <td>
    <input type="text" name="extended_user_info_twitter_id" id="extended_user_info_twitter_id" value="<?php echo esc_attr(get_user_meta($user->id, "extended_user_info_twitter_id", True)); ?>" class="regular-text"/><br/>
    <span class="description"><?php _e("Please enter Twitter ID"); ?></span>
    </td>
    </tr>
    <tr>
    <th><label for="extended_user_info_tagline">Tagline</label></th>
    <td>
    <input type="text" name="extended_user_info_tagline" id="extended_user_info_tagline" value="<?php echo esc_attr(get_user_meta($user->id, "extended_user_info_tagline", True)); ?>" class="regular-text" maxlength="140"/><br/>
    <span class="description"><?php _e("Please enter a Tag Line"); ?></span>
    </td>
    </tr>
    </table>
*/
}

function save_extended_user_info_fields($user_id) 
{
    if ( current_user_can( 'edit_user', $user_id ) )
	{
		$champs_utilisateur->sauvegarde_champs();
	}
	else
	{ 
		return false; 
	}

	
/*	
	// https://codex.wordpress.org/Function_Reference/update_user_meta 
	//               User id   Key(field name)                           Valeur du champ
	//               --------
    update_user_meta($user_id, 'extended_user_info_title'        		, $_POST['extended_user_info_title'        ]);
    update_user_meta($user_id, 'extended_user_info_phone_number' 		, $_POST['extended_user_info_phone_number' ]);
    update_user_meta($user_id, 'extended_user_info_mobile_phone_number' , $_POST['extended_user_info_mobile_phone_number' ]);
    update_user_meta($user_id, 'extended_user_info_facebook_page'		, $_POST['extended_user_info_facebook_page']);
    update_user_meta($user_id, 'extended_user_info_twitter_id'   		, $_POST['extended_user_info_twitter_id'   ]);
*/
}
?>
