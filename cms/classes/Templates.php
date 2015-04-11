<?php

class Templates {
    var $templates=array();
    var $values=array();
    var $dirname;

    function Templates($dirname) {
        $this->dirname=$dirname;
    }
    
    function clear(){
    	$this->templates = array();
    }

    function add($templatename) {
        array_push($this->templates,$this->dirname.$templatename);
    }
    
    function setvalue($name,$value) 
    {
        $this->values[$name]=$value;
    }
    
    function show() 
    {
        $values=$this->values;        
        while ($template=array_shift($this->templates)) 
		{
      		//echo $template;
            include($template);
        }
        $this->templates=array();
        flush();
    }
}
