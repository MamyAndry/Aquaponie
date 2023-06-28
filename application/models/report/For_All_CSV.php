<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package report
	 * Use report_pond from database
	 * 
	 * */

	class For_All_CSV extends CI_Model{

		public function readCSV() {
			$data = [];

            // Vérifier si un fichier a été soumis
			// echo ("coucouuu");

            if (isset($_POST['submit'])) {
                // Vérifier si le fichier a été correctement uploadé
                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    // Ouvrir le fichier en mode lecture
                    $file = fopen($_FILES['file']['tmp_name'], 'r');
                    
                    // Parcourir le file ligne par ligne
                    while(($ligne = fgetcsv($file)) !== false){
                        $data[] = $ligne;
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

		public function searchAverage($data){
            $weight = 0;
            $size = 0;
			for ($i=0; $i < count($data) ; $i++) { 
                $weight = $weight + $data[$i][0];
                $size = $size + $data[$i][1];
            }

            $resultat = [$weight/count($data), $size/count($data)];
            return $resultat;
		}

	}


?>