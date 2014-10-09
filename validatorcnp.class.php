<?php

    class cnp {

        private $cod; 

		
        public function cnp($value = 0) //verifica lungimea si daca e 13 split-eaza stringul, daca < 13 afiseaza eroare
        {
            if(is_numeric($value)&&strlen($value)==13)
                $this->cod = str_split($value);
			elseif(!is_numeric($value)||strlen($value)<13)
			{
				echo "Lungime incorecta, CNP-ul trebuie sa aiba 13 cifre!";
				die;
				}
        }
		
        public function getSex() // intoarce sexul in functie de prima cifra
        {
            if($this->cod){
			
                if($this->cod[0]==2||$this->cod[0]==4||$this->cod[0]==6) return 'Femeie';
                elseif($this->cod[0]==1||$this->cod[0]==3||$this->cod[0]==5) return 'Barbat';
				elseif($this->cod[0]==7) return 'Rezident';
				elseif($this->cod[0]==8) return 'Rezidenta';
				elseif($this->cod[0]==9) return 'Cetatean/a strain/a';
                    
            }
        }

        public function getMonth($text=false) //intoarce luna nasterii
        {
            if($text) return date('F', mktime(0, 0, 0, $this->cod[3].$this->cod[4]));
            return $this->cod[3].$this->cod[4];
        }

        public function getYear() //intoarce anul nasterii
        {
            switch ($this->cod[0]) {
			    case 1: case 2: default: $an = 19; break;
			    case 3: case 4: $an = 18; break;
			    case 5: case 6: $an = 20; break;
		    }
            return $an.$this->cod[1].$this->cod[2];
        }

        public function getDay() // intoarce ziua nasterii
        {
            return $this->cod[5].$this->cod[6];
        }

        public function getAge() //calculeaza si intoarce varsta
        {
            $year_diff  = date("Y") - $this->getYear();
            $month_diff = date("m") - $this->getMonth();
            $day_diff   = date("d") - $this->getDay();

            if ($day_diff < 0 || $month_diff < 0) $year_diff--;
            return $year_diff;
        }

        public function getCity() //intoarce locul nasterii, primul array-key setat la 1, ORDINEA OFICIALA, idioata, a statului roman
        {
            $city = array(01=>'Alba', 'Arad', 'Arges', 'Bacau', 'Bihor', 'Bistrita',
            'Botosani', 'Brasov', 'Braila', 'Buzau', 'Caras Severin', 'Cluj',
            'Constanta', 'Covasna', 'Dambovita', 'Dolj', 'Galati', 'Gorj', 'Hargita',
            'Hunedoara', 'Ialomita', 'Iasi', 'Ilfov', 'Maramures', 'Mehedinti',
            'Mures', 'Neamt', 'Olt', 'Prahova', 'Satu Mare', 'Salaj', 'Sibiu',
            'Suceava', 'Teleorman', 'Timis', 'Tulcea', 'Vaslui', 'Valcea', 'Vrancea', 'Bucuresti', 
			'Bucuresti Sect. 1', 'Bucuresti Sect. 2', 'Bucuresti Sect. 3', 'Bucuresti Sect. 4',
			'Bucuresti Sect. 5', 'Bucuresti Sect. 6', 'Calarasi', 'Giurgiu');
	
            $codoras = $this->cod[7].$this->cod[8];
			
            if(array_key_exists($codoras, $city)) return $city[$codoras];
        }

        public function KeyCheck() // ruleatea zilei za algoritmul si verifica validitate zilei si lunii nasterii
        {
            $testkey = str_split(279146358279); //split-eaza cheia de verificare
			
			$rez = array();
			
			for ($i=0; $i <= 11; $i++) {
			
				$rez[$i]= $testkey[$i]*$this->cod[$i]; //inmulteste fiecare cifra din cnp cu corespondentul din cheie
			
			}
			
			$checksum = array_sum($rez);

			if($this->cod[12]==$checksum%11 /*verifica daca ultima cifra din cnp egala cu mod11 din algoritm*/ && $this->getDay() <= 31 && $this->getMonth() <= 12) {
			
				return true;
			
			} else {
			
				return false;
			}
    }
}
?>

