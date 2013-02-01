<?php

require_once ($CFG->dirroot."/mod/customlabel/type/customtype.class.php");

/**
*
*
*/

class customlabel_type_definition extends customlabel_type{

    function __construct($data){
    	global $CFG;
    	
        parent::__construct($data);
        $this->type = 'definition';
        $this->fields = array();
        
		$field = new StdClass;
        $field->name = 'definition';
        $field->type = 'textarea';
        $field->rows = 20;
        $this->fields['definition'] = $field;
        
		if (!isset($data->subdefsnum)){
			// second chance, get it from stored data
			$storeddata = ($CFG->usesafestorage) ? json_decode(base64_decode(@$this->data->safecontent)) : json_decode(@$this->data->content) ;
	        $subdefsnum = (!empty($storeddata->subdefsnum)) ? $storeddata->subdefsnum : 0 ;
	    } else {
	    	$subdefsnum = $data->subdefsnum;
	    }

		$field = new StdClass;        
        $field->name = 'subdefsnum';
        $field->type = 'textfield';
        $field->size = 4;
        $field->default = 0;
        $this->fields['subdefsnum'] = $field;

		for($i = 0 ; $i < $subdefsnum; $i++){
			$field = new StdClass;
	        $field->name = 'subdef'.$i;
	        $field->type = 'textarea';
	        $field->size = 60;
	        $this->fields['subdef'.$i] = $field;
	    }
    }
    
    function preprocess_data(){

		$this->data->subdeflist = "<ul>\n";
		for ($i = 0 ; $i < $this->data->subdefsnum; $i++){		
			$key = 'subdef'.$i;
	        $this->data->subdeflist .= (isset($this->data->$key)) ? '<li class="custombox-subdefinition definition"><span class="custombox-subdefinition-caption definition">'.get_string('subdef'.$i, 'customlabel').'</span><br/>'.$this->data->$key."</li>\n" : '' ;
		}
		$this->data->subdeflist .= "</ul>\n";
		$this->data->rowspan = 2 + $this->data->subdefsnum;
    }
}
 
?>