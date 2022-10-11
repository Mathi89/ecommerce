<?php 
 namespace Views;
 class MainView
{

	private $fileName;
	private $header;
	private $footer;
	

	public function __construct($fileName,$header = 'header',$footer = 'footer'){
		$this->fileName = $fileName;
		$this->header = $header;
		$this->footer = $footer;
	}

	public function render($arr = []){
		@$id_user = $_SESSION['id_user'];
		@$nome= $_SESSION['nome'];
		@$email = $_SESSION['email'];
		@$pass = $_SESSION['password'];
		@$cargo = $_SESSION['cargo'];
		@$telefone = $_SESSION['telefone'];
		@$logo = $_SESSION['logo'];
		$qtdCart = \FeaturesCart::getTotalItenCart();
		$empresa = \Painel::getCellPhoneBd();

	
		include(BASE_DIR_PAINEL. 'templates/padrao01/' .$this->header.'.php');
		// if($this->header == 'settingsH'){ include('pages/templates/padraoconfig01/'.$this->header.'.php');}
		include('pages/'.$this->fileName.'.php');
		// if($this->footer == 'settingsF' ){ include('pages/templates/padraoconfig01/'.$this->footer.'.php');}
		include(BASE_DIR_PAINEL. 'templates/padrao01/' .$this->footer.'.php');
	 
	}
}

?>