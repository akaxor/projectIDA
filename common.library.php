<?php
function trim_string($str) {
	$str = str_replace("å", "&aring;", $str); 	//för att byta ut tecken mot teckenentitter
	$str = str_replace("ä", "&auml;", $str);
	$str = str_replace("ö", "&ouml;", $str);
	$str = str_replace("Å", "&Aring;", $str);
	$str = str_replace("Ä", "&Auml;", $str);
	$str = str_replace("Ö", "&Ouml;", $str);
	$str = strip_tags($str); 		//rensar strängen från html taggar, Javascript och PHP
	$str = nl2br($str); 						//radbrytningarna i formuläret behålls
	return $str;
}


//Syftar till att skapa mysqli_result för att efterlikna mysql_result
function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
//Snällt copyPastead från "http://stackoverflow.com/questions/2089590/mysqli-equivalent-of-mysql-result"
//då mysqli inte hade samma funktion #nyttÄrInteAlltidBättre
?>