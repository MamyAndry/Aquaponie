<?php

	if( !function_exists('format_date') ){
		function format_date($date){
			return date("Y-m-d", strtotime($date));
		}
	}



?>