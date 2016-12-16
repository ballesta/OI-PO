<?php
class Fichier
{
	function __construct($n)
	{
 
		$cr=  fopen($n, "w");
		if ($cr != false)
			$this->fichier = $cr;
		else 
			die( "cree fichier $n<br>");
	}

	function write($t)
	{
		$cr = fwrite ($this->fichier, $t);
		if ($cr == false)
		{
			echo "write<br>", htmlentities($t), "<hr>";
			die ("write");
		}
		
	}

	function ferme()
	{
		$cr = fclose ($this->fichier);
		if ($cr == false)
		{
			echo "write<br>", htmlentities($t), "<hr>";
			die ("ferme");
		}
	}
}
?>