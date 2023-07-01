<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if( ! function_exists('get_sequence_value') ){

		function get_sequence_value( $seq_name ){
			$query = "select nextval(%s)";
			$CI =& get_instance();
			$query = sprintf($query, $CI->db->escape($seq_name));
			$query = $CI->db->query($query);
			$result = $query->result_array();
			return $result[0]["nextval"];
		}

	}

	if( !function_exists('create_primary_key') ){
		function create_primary_Key( $prefix, $sequence, $length ){
			$sequence_value = get_sequence_value($sequence);
			$seq_length = strlen( $sequence_value );
			$left = $length - strlen($prefix);
			$id = fill_zero($sequence_value, $left);
			$id = $prefix.$id;
			return $id;
		}
	}

	if( !function_exists('fillZero') ){
		function fill_zero( $value, $length ){
			$result = "";
			for( $i = 1; $i <= $length - strlen($value) ; $i++ ){
				$result = $result."0";
			}
			$result = $result.$value;
			return $result;
		}
	}
	if ( !function_exists('get_unities') ){
		function get_unities(){
			$sql = "select * from unite order by id_unite";
			$CI =& get_instance();
			$query = $CI->db->query($sql);
			$result = $query->result_array();
			return $result;
		}
	}

?>
