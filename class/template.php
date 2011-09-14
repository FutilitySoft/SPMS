<?php
/*
 * Template Parser Version 1
 *
 * Todo: Caching functions
 *		 if then else statements in templates
 * 
 * Created: 25/04/2005
 *
 * Author: Dan Taylor
 *
 * Version: 1.0.0
 *
 */

class templateparser
{
	// Variables
	var $tplfolder = '';
	var $tplname = '';
	var $tplbuffer = '';
	var $vars = array();
	var $arraynames = array();
	var $tplextension;
	
	// Constructor
	function templateparser($directory, $extension = 'tpl')
	{
		$this->tplextension = $extension;
		$this->tplfolder = $directory;
	}
	
	/**
	 * Display the template
	 */
	function tpl_display_tpl()
	{
		//echo 'Display Template: '.$this->tplname.'<br />';
		echo $this->tplbuffer;
	}
	
	function tpl_get_buff()
	{
		return $this->tplbuffer;
	}
	
	function tpl_register_var($value, $key)
	{
		$this->tpl_reg_var($key, $value);
	}

	function tpl_reg_var($key, $value)
	{
		$this->vars[$key] = $value;
		return true;
	}
	function tpl_reg_vars($key, $value)
	{
		$this->vars[$key] = $value;
	}
	function tpl_reg_array($name, $vararray)
	{
		//echo "<h1> Array: ".$name."</h1>";
		$this->arraynames[] = $name;
		// Treat all arrays as top level right now
		$i = 0;
		foreach ($vararray as $key => $value)
		{
			//echo $key."=>".$value['id']."<br>";
			$this->vars[$name][$key] = $value;
		}
		//echo "<h1> End Array: ".$name."</h1>";
	}
	
	function tpl_set_name($tplname)
	{
		$this->tplname = $tplname;
	}
	
	function tpl_parse_all ()
	{
		//print_r($this->vars);
		$this->tplbuffer = $this->tpl_read_tpl();
		$this->tpl_parse_vars();
		$this->tpl_parse_loops();
	}
	
	function tpl_read_tpl($includefile = '', $doinc = 0)
	{
		if($includefile == '')
		{
			$file = $this->tplfolder.$this->tplname.'.'.$this->tplextension;
			$doinc = 1;
		}
		else
		{
			$file = $this->tplfolder.$includefile.'.'.$this->tplextension;
		}
		
		// Check if file exists
		if(file_exists($file))
		{
			unset($buffer);	
			// Read File
			$handle = fopen($file, "r");
			$buffer = fread($handle, filesize($file));
			fclose($handle);
			if($buffer)
			{
				/*
				// Do includes now
				$start = strpos($this->tplbuffer, "<loop=\"".$this->arraynames[$i]."\">")+strlen("<loop=\"".$this->arraynames[$i]."\">");
				// Find End point
				$end = strpos($this->tplbuffer, "</loop=\"".$this->arraynames[$i]."\">");
				// Get Temp string
				$temp = substr($this->tplbuffer, $start, $end-$start);
				*/
				if($doinc)
				{
					// Get includes now
					preg_match_all("/\<include=\"(.+)\">/",$buffer, $matches);
					//print_r($matches);
					for($i = 0; $i < sizeof($matches[1]); $i++)
					{
						$incfile = $this->tpl_read_tpl($matches[1][$i]);
						//die($incfile);
						$buffer = preg_replace("/".$matches[0][$i]."/",$incfile,$buffer);
					}
				}
				return $buffer;
			}
			else
			{
				die ('Could not read template: '.$file);
			}
		}
		else
		{
			// Display Error
			die('Template Error: '.$file.' does not exist!');
		}
	}
	
	function tpl_parse_vars()
	{
		// Get all array keys 
        $arr_keys = array_keys( $this->vars );
        foreach ($arr_keys as $key)
		{
			//echo $key;
			$search = '{'.$key.'}';
			if(!is_array($this->vars[$key]))
			{
				$this->tplbuffer = str_replace($search, $this->vars[$key], $this->tplbuffer);
			}
		}
	}
	
	function tpl_parse_loops()
	{
		$i = 0;
		while(isset($this->arraynames[$i]))
		{
			// Init Vars
			$compiled = NULL;
			$start = NULL;
			$end = NULL;
			$modstart = NULL;
			$modend = NULL;
			// Initialise Matches array
			$matches = array();
			$chunk = NULL;
			
			// Find Start Point
			$start = strpos($this->tplbuffer, "<loop=\"".$this->arraynames[$i]."\">");
			
			if($start) // We have an opening bracket
			{
				// Find start point without <loop="whatever">
				$modstart = $start+strlen("<loop=\"".$this->arraynames[$i]."\">");
				// Find End point
				$end = strpos($this->tplbuffer, "</loop=\"".$this->arraynames[$i]."\">");
				if(!$end)
				{
					die("Template Error: Cannot find closing loop for <loop=\"".$this->arraynames[$i]."\">");
				}
				// Find Modified end point, without </loop="whatever">
				$modend = $end-$start-strlen("</loop=\"".$this->arraynames[$i]."\">");
				// Get the chunk of template we want to loop
				
				//$tmpchunk = $chunk; // Make a working copy to use 
				
				$chunk = substr($this->tplbuffer, $modstart, $modend);
				// Find all loop variables
				preg_match_all("/\{".$this->arraynames[$i]."\.([a-zA-Z]+)\}/",$chunk, $matches);
				
				//	Init Loop Var
				$j = 0;
				while(isset($this->vars[$this->arraynames[$i]][$j]))
				{
					$chunk = substr($this->tplbuffer, $modstart, $modend);
					for($k = 0; $k < sizeof($matches[0]); $k++)
					{
						// create cleaned code with correct info in there 
						$chunk = str_replace($matches[0][$k], $this->vars[$this->arraynames[$i]][$j][$matches[1][$k]], $chunk);
						
					}
					// Add to compiled var, 
					$compiled .= $chunk;
					$j++;
				}
				
				//die("End: $end ".strlen($this->tplbuffer).$this->tplbuffer{$end});
				//die (substr($this->tplbuffer, $start, $end-$start));
				// We've got a compiled chunk, lets replace it in $this->tplbuffer
				$this->tplbuffer = str_replace(substr($this->tplbuffer, $start, $end-$start+strlen("</loop=\"".$this->arraynames[$i]."\">")),$compiled, $this->tplbuffer);
			//if($this->arraynames[$i] == 'news')
					//die("Compiled - ".$this->tplbuffer);
			}
			// Incriment I for array name loop			
			$i++;
		}	
	}
}
?>
