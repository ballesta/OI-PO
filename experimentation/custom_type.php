<?php
abstract class Custom_type
{
	abstract  function affiche();
}

class Sujet_DGE extends Custom_type
{
	public $code = "xxx";

	function __construct()
	{
	    $this->libelle = "Sujet-dge";
		$this->code = "sujet-dge";
	}

	// Fonction concrete definissant la fonction abstraite
    function affiche()
	{
		echo $this->libelle, ': ', $this->libelle;
	}
}

$sujet_dge = new Sujet_DGE("un sujet a traiter");
$sujet_dge->affiche();









?>