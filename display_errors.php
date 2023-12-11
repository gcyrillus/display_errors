<?php
	/**
		* Plugin display_errors
		*
		* @package	PLX
		* @version	1.1
		* @date	09/11/23
		* @author gc-nomade
	**/
	class display_error extends plxPlugin {
		private $active; // etat actif/non actif
		
		public function __construct($default_lang) {
			# appel du constructeur de la classe plxPlugin (obligatoire)
			parent::__construct($default_lang);				
			
			# limite l'acces a l'ecran de configuration du plugin
			$this->setConfigProfil(PROFIL_ADMIN);			
			
			$this->active=$this->getParam("active");				
			
			# Declaration d'un hook (existant ou nouveau)
			$this->addHook('AdminPrepend','AdminPrepend');
			$this->addHook('Index','Index');
			$this->addHook('displayErrors','displayErrors');			
			
		}
		
		public function OnDeactivate() {
			# code à executer à la désactivation du plugin
			$this->setParam('active','0','numeric');
			$this->saveParams();			
		}
		
		
		# Affichage backend
		public function AdminPrepend(){
			$this->displayErrors();
			if($this->getParam('active') == '0') $this->aInfos['title'] = $this->getLang('L_NO').$this->getLang('L_ACTIVE').$this->aInfos['title'];
		}
		
		# Affichage frontend
		public function Index(){
			$this->displayErrors();			
		}
		
		# tente de mettre à jour la configuration PHP
		public function displayErrors(){
			if($this->getParam('active') == '1') {
				try {
					ini_set('display_errors',1);
					ini_set('display_startup_errors',1);
					error_reporting(E_ALL);
				}
				catch (Exception $e) {
					echo  $e->getMessage();
					$this->setParam('active','0',numeric);
					$this->saveParams();
					echo 'Plugin turned OFF ! Plugin ETEINT !';
				}			
			}	
		}
	}	
