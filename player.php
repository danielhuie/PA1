<?php
	class Player {
		private $PlayerName;
		private $GP;
		private $FGP;
		private $TPP;
		private $FTP;
		private $PPG;

		function Player($PlayerName, $GP, $FGP, $TPP, $FTP, $PPG) {
			$this->PlayerName = $PlayerName;
			$this->GP = $GP;
			$this->FGP = $FGP;
			$this->TPP = $TPP;
			$this->FTP = $FTP;
			$this->PPG = $PPG;
		}

		public function GetPlayerName() {
			return $this->PlayerName;
		}

		public function GetGP() {
			return $this->GP;
		}

		public function GetFGP() {
			return $this->FGP;
		}

		public function GetTPP() {
			return $this->TPP;
		}

		public function GetFTP() {
			return $this->FTP;
		}

		public function GetPPG() {
			return $this->PPG;
		}
	}
?>