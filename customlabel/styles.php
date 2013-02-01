<?php

// aggregates styles for subtypes when types share style definitions

/**
* uncomment or add any additional style sheet inclusions here
*/

if (!function_exists('local_customlabel_get_styles')){
	function local_customlabel_get_styles(){

		$stylesdir = array();
		$basetypedir = dirname(__FILE__)."/type/";

		$styldir = opendir($basetypedir);
		while ($entry = readdir($styldir)){
			if ($entry != "." && $entry != "..") {
				$stylesdir[] = $entry;
			}
		}
		closedir($styldir);
		return $stylesdir;
	}
}


$styles = local_customlabel_get_styles();

if (!empty($styles)){
	foreach($styles as $atype){
		$typestylefile = dirname(__FILE__)."/type/{$atype}/customlabel.css";
		if (file_exists($typestylefile)){
			echo "\n";
			include_once($typestylefile);
		}
	}
}

