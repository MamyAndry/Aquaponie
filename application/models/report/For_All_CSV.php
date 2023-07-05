<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package report
	 * Use report_pond from database
	 * 
	 * */

	class For_All_CSV extends CI_Model{

		public function readCSV($name, $number) {
			$data = [];

            if (isset($_POST['submit'])) {
                // Vérifier si le fichier a été correctement uploadé
                echo $name;
                if (isset($_FILES[$name]) && $_FILES[$name]['error'] === UPLOAD_ERR_OK) {
                    // Ouvrir le fichier en mode lecture
                    $file = fopen($_FILES[$name]['tmp_name'], 'r');
                    
                    // Parcourir le file ligne par ligne
                    while(($ligne = fgetcsv($file)) !== false){
                        $data[] = $ligne;
                    }

                    if (is_array($data)) {
                        if (is_array($data[0])) {
                
                            if (count($data[0]) > $number) {
                                throw new Exception("Recheck the number of columns, there are too many for this!");
                            }
                        } else {
                            throw new Exception("Invalid data format, expecting a two-dimensional array.");
                        }
                    }else if(count($data) < 1){
                        throw new Exception("Please recheck the data!");
                    }
					
                    // Fermer le file
                    fclose($file);
                } else {
					throw new Exception("Error when loading the file ?");
                }
            } else {
				throw new Exception("Error when loading the file ?");
            }
			return $data;
        }

		public function searchAveragePond($data){
            $weight = 0;
            $size = 0;
			for ($i=0; $i < count($data) ; $i++) { 
                $weight = $weight + floatval($data[$i][0]);
                $size = $size + floatval($data[$i][1]);
            }

            $resultat = [ $weight /count($data), $size/count($data) ];
            return $resultat;
		}

        public function searchAverageField($data){
            $weight = 0;
            var_dump($data);
			for ($i=0; $i < count($data) ; $i++) { 
                $weight = $weight + floatval($data[$i]);
            }
            $resultat = $weight / count($data);
            return $resultat;
		}
	}


?>