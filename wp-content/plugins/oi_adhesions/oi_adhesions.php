<?php
/*
Plugin Name: OI Adhesion
Description: Envoie formulaire pdf rempli joint à un mail après création adhésion.
Version:     1.0
Author:      Bernard BALLESTA
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: OI
*/
 
defined( 'ABSPATH' ) 
or die( '<h1>Syntaxe programme correcte</h1>'
      . '<h3>vous pouvez intégrer ce plugin dans le site</h3>' );

OI_adhesion::init();

// Classe statique contenant et isolant les extensions propres à l'OI 
class OI_adhesion
{
	// Initialisation
	static function init()
	{
		// Hook: après création adhésion
		// Envoie formulaire pdf rempli joint à un mail
		add_action( 'vfbp_after_save_entry', 'OI_adhesion::filter_vfbp_after_save_entry', 10, 2 );
		// Envoi e_mail 
		add_action( 'wp_mail_failed'	, 'OI_adhesion::wp_mail_failed', 10, 2 );
		//add_filter( 'wp_mail_from_name'	, 'OI_adhesion::wp_mail_from_name');
		//add_filter( 'wp_mail_from'		, 'OI_adhesion::wp_mail_from');
	}
	
	static function wp_mail_from_name() 
	{
		return 'Flore Naiman';
	}	
	
	static function wp_mail_from() 
	{
		return 'flore.naiman@observatoire-immateriel.com';
	}		

	static function wp_mail_failed(WP_error $erreur)
	{
		//OI::affiche($erreur,'Erreur Mail');	
	}
	
	
	// Envoie formulaire pdf rempli de l'adhésion joint à un mail
	static function filter_vfbp_after_save_entry( $entry_id, $form_id ) 
	{
		// execute some custom code here
		$formulaire_adhesion = 1;
		if ($form_id == $formulaire_adhesion)
		{
			$champs_adhesion = self::lis_adhesion($entry_id);
			foreach($champs_adhesion as $champ)
			{
				$key = $champ->meta_key;
				$value = $champ->meta_value;
				switch ($key)
				{
					case '_vfb_field-6' : $societe 			= $value; break;
					case '_vfb_field-7' : $secteur_activite = $value; break;
					case '_vfb_field-52': $nom        	 	= $value; break;
					case '_vfb_field-53': $prenom        	= $value; break;
					case '_vfb_field-9' : $fonction         = $value; break;
					case '_vfb_field-10': $nationalite      = $value; break;
					case '_vfb_field-54': $adresse          = $value; break;
					case '_vfb_field-57': $code_postal      = $value; break;
					case '_vfb_field-56': $ville           	= $value; break;
					case '_vfb_field-55': $pays           	= $value; break;
					case '_vfb_field-12': $telephone        = $value; break;
					case '_vfb_field-13': $portable         = $value; break;
					case '_vfb_field-4' : $e_mail           = $value; break;
					case '_vfb_field-14': $interet			= $value; break;
					case '_vfb_field-3' : $formule			= $value; break;					
				}
			}
			self::edite_adhesion_en_pdf
				(	$entry_id,
					$societe 		 ,	
					$secteur_activite, 
					$nom        	 , 	
					$prenom        	 ,
					$fonction        ,  
					$nationalite     ,  
					$adresse         ,  
					$code_postal     ,  
					$ville           , 	
					$pays            ,	
					$telephone       ,  
					$portable        ,  
					$e_mail          ,  
					$interet		 ,	
					$formule		 	
				);
		}		
	}       
	
	static function lis_adhesion($entry_id)
	{
		// Base de données gérée par Wordpress
		global $wpdb;
		// Champs du formulaire à partir de la table postmeta de wordpress
		$sql = 
		"
			SELECT *
			FROM $wpdb->postmeta
			WHERE post_id = $entry_id
		";
		//echo $sql,'<hr>';
		$champs_adhesion = $wpdb->get_results($sql, OBJECT);
		//OI::affiche($champs_adhesion, 'champs_adhesion');
		return $champs_adhesion;
	}
	
	static function edite_adhesion_en_pdf
				(	$entry_id,
					$societe 		 ,	
					$secteur_activite, 
					$nom        	 , 	
					$prenom        	 ,
					$fonction        ,  
					$nationalite     ,  
					$adresse         ,  
					$code_postal     ,  
					$ville           , 	
					$pays            ,	
					$telephone       ,  
					$portable        ,  
					$e_mail          ,  
					$interet		 ,	
					$formule		 		
				)
	{
		// Convert in PDF
		require_once(dirname(__FILE__).'/vendor/autoload.php');
		
		$style=
		'
		<style type="text/css">
			.marges 
			{
				margin-left: 50px;
				margin-right: 100px;
			}	
			.centre 
			{
				margin-left: 50px;
				margin-right: 100px;
			}			
			th, td
			{
				padding: 2px;
				font-size: 12pt;
			}
			p 
			{
				align="center"
			}
		</style>';
		//$date = date('j F Y');
		setlocale(LC_TIME, "fr_FR");
		$date = strftime ('%e %B %G');
		$annee = date('Y');
		
		//global 	$formule_choisie;
		//$formule_choisie = sans_espaces('Entreprises:Accès au Cercle des amis de l’Observatoire 250 € HT (300 € TTC)');	
		$formule_choisie = self::sans_espaces($formule);		
		// TEXTES DEMANDE D'ADHESION
		$texte =
		 $style
		.self::page ('Association régie par la loi du 1er juillet 1901<br>'
					.'N°SIREN: 508293677- APE: 7022Z<br>'
					.'<h1 style="color:blue">DEMANDE D\'ADHESION</h1>')
		.'	<table align="center">'
		.    	    self::ligne('Société' 						, $societe 			)
		.    	    self::ligne('Secteur d’activité'			, $secteur_activite )
		.    	    self::ligne('Nom'							, $nom       		)
		.    	    self::ligne('Prénoms'				        , $prenom       	)
		.    	    self::ligne('Fonction'	        			, $fonction         )
		.    	    self::ligne('Nationalité' 					, $nationalite      )
		.    	    self::ligne('Adresse'          				, $adresse          )
		.    	    self::ligne('Code postal'          			, $code_postal      )
		.    	    self::ligne('Ville'          				, $ville      		)
		.    	    self::ligne('Pays'          				, $pays      		)
		.    	    self::ligne('Téléphone'         			, $telephone        )
		.    	    self::ligne('Portable'          			, $portable        	)
		.    	    self::ligne('e_mail'  						, $e_mail           )
		.    	    self::ligne('Intérêt pour le(s) actif(s) :' , $interet          )
		.'   	</table>'
		.       self::centre('<h3>COTISATION ANNUELLE</h3>')
		.  '<table align="center">'
		. self::formules(
				$formule_choisie,
				'ENTREPRISES',
				[
					[
					'Accès au Cercle des amis de l’Observatoire', 
					 '250 € HT (300€ TTC)',
					'(accès gratuit à nos événements<br>et à l’Académie de l’Immatériel pour 1 an)',
					'Entreprises:Accès au Cercle des amis de l’Observatoire 250 € HT (300 € TTC)'
					],
					[
					'TPE et professions libérales',
					'750 € HT (900 € TTC)',
					'',
					'Entreprises:: TPE & Professions Libérales 750 € HT 9 00 € TTC)'

					],
					[
					'De 20 à 250 salariés',
					'2 000 € HT (2 400 € TTC)',
					'',
					'Entreprises: 20 à 250 salariés 2 000 € HT (2 400 € TTC)'

					],
					[
					'Plus de 250 salariés',
					'5 000 € HT (6 000 € TTC)',
					'',
					'Entreprises: + de 250 salariés 5 000 € HT (6 000 € TTC)'

					]
				])	
		. self::formules(
				$formule_choisie,
				'CABINETS DE CONSEIL / AUDIT',
				[
					[
					'TPE et professions libérales', 
					'1 000 € HT (1 200 € TTC)',
					'',
					''

					],
					[
					'De 20 à 250 salariés', 
					'2 000 € HT (2 400 € TTC)',
					'',
					'Cabinets de conseil / audit: TPE et professions libérales 1 000 € HT (1 200 € TTC)'
					],
					[
					'De 250 à 5 000 salariés', 
					'5 000 € HT (6 000 € TTC)',
					'',
					'Cabinets de conseil / audit: de 250 à 5 000 salariés 5 000 € HT (6 000 € TTC)'
					],
					[
					'Plus de 5 000 salariés', 
					'9 000 € HT (10 800 € TTC)',
					'',
					'Cabinets de conseil / audit: plus de 5 000 salariés'
					]
				])	
		.'</table>'			
		.'</page>'
		.self::page()
		.  '<table align="center">'
		. 	self::formules
				(
				$formule_choisie,
				'UNIVERSITES / ECOLES / CENTRES DE RECHERCHE',
				[
					[
					'Accès au Cercle des amis de l’Observatoire', 
					'250 € HT (300 € TTC)',
					'(accès gratuit à nos événements<br>et à l’Académie de l’Immatériel pour 1 an)',
					'Universités / Ecoles / Centres de recherche: Accès au Cercle des amis de l’Observatoire 250 € HT (300 € TTC)'
					],
					[
					'Autres', 
					'2 000 € HT (2 400 € TTC)',
					'',
					'Universités / Ecoles / Centres de recherche: Autres 2 000 € HT (2 400 € TTC)'
					]
				])				

		. self::formules(
				$formule_choisie,
				'ASSOCIATIONS',
				[
					[
					'Associations', 
					'250 € HT (300 € TTC)',
					'',
					'Associations: 250 € HT (300 € TTC)'
					]
				])				
		. self::formules(
				$formule_choisie,
				'ADMINISTRATIONS / ORGANISMES PUBLICS',
				[
					[
					'Moins de 20 salariés', 
					'1 000 € HT (1 200 € TTC)',
					'',
					'Administrations / Organismes publics: moins de 20 salariés 1 000€ HT ( 1 200 € TTC)'
					],
					[
					'De 20 à 250 salariés', 
					'2 000 € HT (2 400 € TTC)',
					'',
					'Administrations / Organismes publics:de 20 à 250 salariés 2 000€ HT ( 2 400 € TTC)'
					],
					[
					'De 250 à 5 000 salariés', 
					'5 000 € HT (6 000 € TTC)',
					'',
					'Administrations / Organismes publics: de 250 à 5 000 salariés 5 000€ HT ( 6 000 € TTC)'
					],
					[
					'Plus de 5 000 salariés', 
					'9 000 € HT (10 800 € TTC)',
					'',
					'Administrations / Organismes publics: plus de 5 000 salariés 9 000€ HT ( 10 800 € TTC)'
					],
				])				
		. self::formules(
				$formule_choisie,
				'BIENFAITEURS',
				[
					[
					'Bienfaiteurs', 
					'> 10 000 € HT (12 000 € TTC)',
					'',
					'Bienfaiteurs: 10 000€ HT et plus .... '
					]
				])				
		. self::formules(
				$formule_choisie,
				'PERSONNES PHYSIQUES',
				[
					[
					'Etudiants (1)', 
					'50 € HT (60 € TTC)',
					'',
					'Personnes physiques: Etudiant 50€ HT ( 60 € TTC)'
					],
					[
					'Personne physique, à titre personnel', 
					'250 € HT (300 € TTC)',
					'',
					'Personnes physiques: 250€ HT (300 € TTC)'
					]
				])				
		.'</table>'
		. '<br>'
		.self::centre('<small>Cocher la case correspondant à la nature de votre cotisation</small>')
		.self::centre('<small>(1) Fournir copie carte étudiant</small>')
		.'</page>'
		//----
		.self::page()
		.self::centre('<h3>PROCEDURE D\'ADHESION</h3>')
		.'<table class=centre  >'
		.'	<tr>'
		.'		<td>'
		.'          Le formulaire d’adhésion doit être adressé par courrier à l’adresse suivante :'
		.'		</td>'
		.'	</tr>'

		.'	<tr>'
		.'		<td>'
		.          self::centre('Observatoire de l’Immatériel C/O INPI<br>'
						 .'15 rue des Minimes<br>'
						 .'CS 50001 - 92677 Courbevoie Cedex<br><br>')
		.'		</td>'
		.'	</tr>'
		
		.'	<tr>'
		.'		<td>'
		.'			Le Bureau de L\'Observatoire de l’Immatériel statuera sur votre demande d\'adhésion et sa<br> '
		.'			décision vous sera notifiée par email.<br>L’adhésion se fait pour une année civile '
		.'          (du 1er janvier au 31 décembre).<br> '
		.'			Elle est renouvelable d’une année sur l’autre par tacite reconduction, sauf dénonciation<br>'
		.'           avec préavis de 30 jours '
		.'			par lettre recommandée A/R à l’adresse ci-dessus.<br>'
		.'		</td>'
		.'	</tr>'
		
		.'	<tr>'
		.'		<td>'
		.'			Formulaire d’adhésion pour l’année civile '. $annee .'<br><br>'
		.'			Fait à Paris, le ' . $date .'<br><br>'
		.'			Nom, prénom, qualité du signataire et nom de l\'entreprise adhérente et signature<br>'
		.'			Ou Nom, prénom de la personne physique adhérente et signature<br> '
		.'			(mention "lu et approuvé, bon pour adhésion")<br><br>'
		.'			Lu et approuvé, bon pour adhésion<br>'		
		.'		</td>'
		.'	</tr>'
		.'</table>'
		.'</page>';
		//echo $texte;
		//exit();
		
		try
		{
			$html2pdf = new HTML2PDF('P', 'A4', 'fr');
			// $html2pdf->setModeDebug();
			$html2pdf->setDefaultFont('Arial');
			//$html2pdf->writeHTML($texte, isset($_GET['vuehtml']));
			$html2pdf->writeHTML($texte);
			$fichier_adhesion_pdf = dirname(__FILE__) . '/adhesions_generees/' . 'adhesion_' . $entry_id . '.pdf';
			// http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:output
			$html2pdf->Output($fichier_adhesion_pdf,'F');
			self::envoie_mail($e_mail, $fichier_adhesion_pdf);
			//self::envoie_mail($e_mail, 'adhesions_generees/' . 'adhesion_' . $entry_id . '.pdf');
		}
		catch(HTML2PDF_exception $e) 
		{
			echo $e;
			exit;
		}
	}

	static function envoie_mail($e_mail, $fichier_adhesion_pdf)
	{
		$subject = "Votre adhésion à l’Observatoire de l’Immatériel";
		$message =
		"
		Madame, Monsieur,<br>
		<br>
		Votre adhésion est validée : Bienvenue à l’Observatoire de l’Immatériel !<br>
		Il vous reste une dernière étape avant de finaliser cette procédure : remplir, signer et renvoyer à<br>
		flore.naiman@observatoire-immateriel.com le formulaire d’adhésion en pdf – qui a été pré-rempli<br>
		avec les informations que vous nous avez transmises. Il se trouve en pièce jointe de ce mail.<br>
		En retour, vous recevrez :
		<ul>
			<li>La facture liée à votre paiement</li>
			<li>Vos login et mot de passe pour le compte adhérent</li>
		</ul>
		<br>
		Bien cordialement,<br>
		Flore Naiman<br>
		Déléguée Générale de l’Observatoire de l’Immatériel
		";
		
		//$message =
		//"Adhésion ...";
		
		//echo "Envoi mail:<br>";
		//echo $e_mail,'<br>',
		//	 $subject ,'<br>', 
		//	 $message , '<br>',
		//	 $headers = 'Content-type: text/html', '<br>',
		//	 $fichier_adhesion_pdf,'<br>'
		//	 ;
			
		$headers   = [];	
		//$headers[] = 'Content-type: text/html';
		//$headers[] = 'From: Flore Naiman <flore.naiman@observatoire-immateriel.com>';
							
		//$r=	wp_mail ($e_mail,
		//			 $subject , 
		//			 $message,  
		//			 $headers,
		//			 [$fichier_adhesion_pdf]
		//			);
		//			
		//if ($r == false)
		//{
		//	echo "***Erreur envoi mail***<br>";
		//	echo $e_mail,'<br>',
		//		 $subject ,'<br>', 
		//		 $message , '<br>',
		//		 $headers , '<br>',
		//		 $fichier_adhesion_pdf,'<br>'
		//		 ;
		//}
	
		// Utilise directement PHPMailer.
		// Comme wp_mail() de Wordpress mais sans l'interférence des hooks des autre plugins.
	
		global $phpmailer;
	    // (Re)create it, if it's gone missing
		if ( ! ( $phpmailer instanceof PHPMailer ) ) {
		    //echo 'crée phpmailer<br> ';
			require_once ABSPATH . WPINC . '/class-phpmailer.php';
			require_once ABSPATH . WPINC . '/class-smtp.php';
			$phpmailer = new PHPMailer( true );
		}
		//OI::affiche($phpmailer,'$phpmailer init');
	    // Empty out the values that may be set
		try {
			$phpmailer->ClearAllRecipients();
			$phpmailer->ClearAttachments();
			$phpmailer->ClearCustomHeaders();
			$phpmailer->ClearReplyTos();
			$phpmailer->IsMail();
			$phpmailer->CharSet = "UTF-8";
			$phpmailer->From      	= 'flore.naiman@observatoire-immateriel.com';
			$phpmailer->FromName  	= 'Flore Naiman';
			$phpmailer->Subject   	= $subject;
			$phpmailer->Body      	= $message;
			$phpmailer->ContentType = 'text/html';
			$phpmailer->IsHTML( true );
			// Adhérent
			$phpmailer->AddAddress( $e_mail );
			// Copie Flore Naiman
			$phpmailer->AddAddress( 'flore.naiman@observatoire-immateriel.com' );

			// Copie bb pour la fin des tests
			$phpmailer->AddAddress( 'bernard@ballesta.fr' );

			$phpmailer->AddAttachment( $fichier_adhesion_pdf);
			//OI::affiche($phpmailer,'$phpmailer remplis avant envoi'); // exit();		

			// Send!
			$r = $phpmailer->Send();
			//OI::affiche($phpmailer, 'phpmailer');			
		} catch ( phpmailerException $e ) {
			echo "<h3>***Erreur envoi mail***</h3>";	 
			echo  $e->getCode()		, '<br>',
				  $e->getMessage()	, '<br>',
				  $e_mail;
			OI::affiche($phpmailer, 'phpmailer');
		}		
		return;
	}
	
	static function page($texte = '')
	{
		return
		'<page>'
		.'   <page_footer>'
		.'     <table align="center">'
		.'        <tr>'
		.'            <td align="center">'
		.'               Siège social :<br>'
		.'               Observatoire de l’Immatériel – INPI<br>'
		.'               15, rue des Minimes<br>'
		.'               CS50001 - 92677 Courbevoie Cedex<br>'
		.'            </td>'
		.'        </tr>'
		.'     </table>'
		.'   </page_footer>'
		.'<table align="center">'
		.'	<tr>'
		.'		<td align="center">'
		. 			self::image('oi.png')
		.'			<br>'
		.           $texte
		.'		</td>'
		.'	</tr>'
		.'</table>';
	}

	static function image($image)
	{
		$r= "<img src=$image style=\"width:250px;\">";
		return $r;
	}

	static function ligne($c1, $c2)
	{
		$r = '<tr>'
		   . '  <td>'
		   .       $c1
		   . '  </td>'
		   . '  <td>'
		   .       $c2
		   . '  </td>'
		   . '</tr>';
		return $r;   
	}	
	
	static function centre($texte)
	{
		return 
		 '<table align="center">'
		.'	<tr>'
		.'		<td>'
		.			$texte
		.'		</td>'
		.'	</tr>'
		.'</table>';	
	}	

	static function formules($formule_choisie, $categorie, $options)
	{
		$f = '';
		foreach($options as $option)
		{
			$f .=  self::formule($formule_choisie,$option);
		}
		$r =  "<tr><td colspan=2 align=center><h4>$categorie</h4></td></tr>"
		   .      $f;
		return $r;
	}
	
	static function formule($formule_choisie, $option)
	{
		//echo '<pre><code>';
		//print_r($option);
		//echo '</code></pre>';
		//global $formule_choisie;
		if ( self::sans_espaces($option[3]) == $formule_choisie)
		{
			$image="coche.png";
		}
		else
		{
			$image="non_coche.png";
		}
		$r=
			 '<tr>'
		   . '    <td  style="width:60%;">'
		   . '       <img src=' . $image . ' style="width:18px;"> ' . $option[0]
		   . '    </td>'
		   . '    <td style="width:60%;">'
		   .          $option[1]
		   . '    </td>'
		   . '</tr>';

		if ( $option[2] != '')
		{
			$r .= '<tr>'
			   . '    <td style="width:60%;">'
			   .         '<small>' . $option[2] . '</small>'
			   . '    </td>'
			   . '    <td style="width:60%;">'
			   . '    </td>'
			   . '</tr>';
		}
		//$r .= '<tr>'
		//   . '    <td colspan=2 style="width:60%;">'
		//   .         '<small>' . $option[3] . '</small>'
		//   . '    </td>'
		//   . '</tr>';
		return $r;
	}

	static function sans_espaces($texte)
	{
		$r = str_replace(' ', '', $texte);
		return $r;
	}
}	        	
?>