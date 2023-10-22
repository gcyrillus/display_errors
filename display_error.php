<?php
	/**
		* Plugin display_error
		*
		* @package	PLX
		* @version	1.0
		* @date	22/10/23
		* @author gc-nomade
	**/
	class display_error extends plxPlugin {
		private $active;
		
		public function __construct($default_lang) {
			# appel du constructeur de la classe plxPlugin (obligatoire)
			parent::__construct($default_lang);
			
			
			
			# limite l'acces a l'ecran de configuration du plugin
			# PROFIL_ADMIN , PROFIL_MANAGER , PROFIL_MODERATOR , PROFIL_EDITOR , PROFIL_WRITER
			$this->setConfigProfil(PROFIL_ADMIN);
			
			
			$this->active=$this->getParam("active");
			
			
			
			# Declaration d'un hook (existant ou nouveau)
			$this->addHook('AdminPrepend','AdminPrepend');
			$this->addHook('Index','Index');
			$this->addHook('displayErrors','displayErrors');
			
			
		}
		
		# Activation / desactivation
		public function OnActivate() {
			# code à executer à l’activation du plugin
		}
		public function OnDeactivate() {
			# code à executer à la désactivation du plugin
			$this->setParam('active','0',numeric);
			$this->saveParams();
		}
		
		
		########################################
		# HOOKS
		########################################
		
		
		########################################
		# AdminPrepend
		########################################
		# Description:
		public function AdminPrepend(){
			$this->displayErrors();
			
		}
		
		########################################
		# Index
		########################################
		# Description:
		public function Index(){
			$this->displayErrors();
			
		}
		
		########################################
		# displayErrors
		########################################
		# Description:
		public function displayErrors(){
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