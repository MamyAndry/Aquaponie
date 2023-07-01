<?php
	defined('BASEPATH') or exit("No direct script entrance allowed");

	class Fish_pond extends CI_Model{
		/**
		 * @static PREFIX : For the table identification prefix
		 * @static LENGTH : Length of a identification id
		 * @static SEQUENCE : The sequence mapped for that table
		 * @static TABLE : The table mapping for that class
		*/

		public static $LENGTH = 7;
		public static $PREFIX = "POND";
		public static $SEQUENCE = "s_pond";
		public static $TABLE = "pond";

		public $id_pond;
		public $capacity;

		// Inona daholo ny informations azo lalaovina ato

		public function insert_fish_pond(  ){

		}
	}

?>