<?php 

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {  
    	echo '<pre>';
        array_map(function ($x) {
	            var_dump($x);
        }, func_get_args());
        echo '</pre>';
        die(1);
    }
}

if (!function_exists('strContains')) {
	function strContains($string,$substr){
		return strpos( $string,$substr) !== false;
	}
}


if (!function_exists('getPorts')) {
	/**
	 * function to return the available com port
	 * @return arrays comm_list
	 */
	function getPorts() { 
        $comm = shell_exec('mode'); 
        if(substr_count($comm,'COM')<1) { 
            $comm_list[0] = 'None'; 
        } else { 
            $conn = explode(' ',$comm); 
            $count = count($conn); 
            for($i=0;$i<$count;$i++) { 
                if(substr_count($conn[$i],'COM')<1) { 
                    $comm_list[$i] = ''; 
                } else { 
                    $comm_list[$i] = str_replace(':','',substr($conn[$i],0,5)).'-'; 
                } 
            } 
        } 
        $comm = implode('',$comm_list); 
        $comm = trim($comm); 
        $comm = trim(str_replace('-',' ',$comm)); 
        $comm_list = explode(' ',$comm); 
      return $comm_list ; 
    } 
}

if (!function_exists('getHtmlTable')) {
	/**
	 * Build HTML table from array
	 * @param   $array 
	 * @return  
	 */
	 function getHtmlTable($array){
	    // start table
	    $html = '<table width="40%" border="1">';
	    
	    // header row
	    foreach($array as $key=>$value){
	          $html .= '<tr>';
	            $html .= '<th>' . htmlspecialchars($key) . '</th>';
	            $html .= '<td>' . htmlspecialchars($value) . '</td>';
	          $html .= '</tr>';
	    }

	    // finish table and return it
	    $html .= '</table>';
	    return $html;
	}
}

if (!function_exists('getStringBetween')) {
	/**
	 * [get_string_between description]
	 * @param  [type] $string [description]
	 * @param  [type] $start  [description]
	 * @param  [type] $end    [description]
	 * @return [type]         [description]
	 */
	function getStringBetween($string, $start, $end){
	    $string = " ".$string;
	    $ini = strpos($string,$start);
	    if ($ini == 0) return "";
	    $ini += strlen($start);
	    $len = strpos($string,$end,$ini) - $ini;
	    return substr($string,$ini,$len);
	}
}

if (!function_exists('strToHex')) {
	/**
	 * @author Kamaro Lambert
	 * @method to convert strto hex
	 */
	function strToHex($string)
	{

	  //Force to Convert to string  
	  $string=strval($string);
	  $hex='';
	  for ($i=0; $i < strlen($string); $i++)
	  {
	  $hex .= sprintf("%02x",ord($string[$i]));
	  }
	  return str_split(strtoupper($hex),2);
	}
}


if (!function_exists('hexToStr')) {
	  /**
	   * @Author Kamaro Lambert
	   * @name hexToStr()
	   * @example Base_convert_lib->hexToStr()
	   * @param  string $hex
	   * Method to convert  Hexadecimal to string
	   */
	function hexToStr($hex){
		$hex = str_replace(' ', '', $hex);
		return hex2bin($hex);
	}
}

if (!function_exists('hexToByte')) {
	/**
	 * Convert HEX to byte (integer)
	 * @param   $hex 
	 * @return  integer
	 */
	function hexToByte($hex)
	{
	    // ignore non hex characters
	    $hex = preg_replace('/[^0-9A-Fa-f]/', '', $hex);
	    
	    // converted decimal value:
	    $dec = hexdec($hex);
	    
	    // maximum decimal value based on length of hex + 1:
	    // number of bits in hex number is 8 bits for each 2 hex -> max = 2^n
	    // use 'pow(2,n)' since '1 << n' is only for integers and therefore limited to integer size.
	    $max = pow(2, 4 * (strlen($hex) + (strlen($hex) % 2)));
	    
	    // complement = maximum - converted hex:
	    $_dec = $max - $dec;
	    
	    // if dec value is larger than its complement we have a negative value (first bit is set)
	    return $dec > $_dec ? -$_dec : $dec;
	}
}
