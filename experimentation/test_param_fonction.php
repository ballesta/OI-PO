<?php

function test($t, $f)
{
	foreach($t as $e)
		$f($e);
}

test ([1,2,3,4],
	  // Fonction anomyme
      function($e)
	  {
		echo $e,'<br>';
	  }
	  );


?>