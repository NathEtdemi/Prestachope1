<?php
	class utilisateursDTO
	{
		private $nom;
		private $prenom;
                private $adresse;
                private $mail;
                private $motdepasse;
                private $admin;
                private $ban;
                private $timeBan;
                public function getNom() {
                    return $this->nom;
                }

                public function getPrenom() {
                    return $this->prenom;
                }

                public function getAdresse() {
                    return $this->adresse;
                }

                public function getMail() {
                    return $this->mail;
                }

                public function getMotdepasse() {
                    return $this->motdepasse;
                }

                public function getAdmin() {
                    return $this->admin;
                }

                public function getBan() {
                    return $this->ban;
                }

                public function getTimeBan() {
                    return $this->timeBan;
                }

                public function setNom($nom): void {
                    $this->nom = $nom;
                }

                public function setPrenom($prenom): void {
                    $this->prenom = $prenom;
                }

                public function setAdresse($adresse): void {
                    $this->adresse = $adresse;
                }

                public function setMail($mail): void {
                    $this->mail = $mail;
                }

                public function setMotdepasse($motdepasse): void {
                    $this->motdepasse = $motdepasse;
                }

                public function setAdmin($admin): void {
                    $this->admin = $admin;
                }

                public function setBan($ban): void {
                    $this->ban = $ban;
                }

                public function setTimeBan($timeBan): void {
                    $this->timeBan = $timeBan;
                }
        }
?>