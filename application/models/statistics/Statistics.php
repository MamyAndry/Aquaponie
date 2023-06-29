<?php
	
	class Statistics extends CI_Model{

        public $list;

        public function __construct($list) {
            $this->$list = $list;
        }

        /**
		 * @author     Mamisoa
         * isoa
		 * @todo       get the average  value of a list of values
		**/

        function average(){
            $res = 0;
            for($i = 0 ; $i < count($this->list) ; $i++){
                $res = $res + $this->list[$i];
            }

            $res = $res / count($this->list);

            return $res;
        }

        /**
		 * @author     Mamisoa
		 * @todo       get the variance of a list of values
		 * 
		 */

        function variance(){
            $res = 0;
            $avg = average();

            for($i = 0 ; $i < count($list_o$this->listf_values) ; $i++){
                $res = $res + ( ( $this->list[$i] - $avg[0] ) ^ 2);
            }
            
            $res[0] = $res[0] / count($this->list);

            return $res;
        }

        /**
		 * @author     Mamisoa
		 * @todo       get the gap type of a list of values
		 * 
		 */

        function gap_type(){
            $var = variance();
            return sqrt($var);
        }

	}

?>