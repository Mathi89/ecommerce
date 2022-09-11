<?php
	
	class Email
	{
		
		private $mailer;

		public function __construct($host,$username,$port,$senha,$name)
		{
			
			$this->mailer = new PHPMailer;

			$this->mailer->isSMTP();                                      // Set mailer to use SMTP
			$this->mailer->Host = $host;  								  // host smtp da hospedagem
			$this->mailer->SMTPAuth = true;                               // Enable SMTP authentication
			$this->mailer->Username = $username;               			  // email de onde vai ser enviado
			$this->mailer->Password = $senha;                        	   // senha do email
                                                                          // Enable TLS encryption, `ssl` also accepted
			$this->mailer->Port = $port;                                   	 // TCP port to connect to

			$this->mailer->setFrom($username,$name);					// email e nome que ficará no seu email
			$this->mailer->isHTML(true);                               	   // Set email format to HTML
			$this->mailer->CharSet = 'UTF-8';

		}

		public function addAdress($email,$nome){
			$this->mailer->addAddress($email,$nome);
		}

		public function formatarEmail($info){
			$this->mailer->Subject = $info['assunto'];
			$this->mailer->Body    = $info['corpo'];
			$this->mailer->AltBody = strip_tags($info['corpo']);
		}
		public function cadastroEmail($info){
			$this->mailer->Subject = $info['assunto'];
			$this->mailer->Body    = $info['corpo'];
			$this->mailer->AltBody = strip_tags($info['corpo']);
		}

		public function enviarEmail(){
			if($this->mailer->send()){
				return true;
			}else{
				return false;
			}
		}

	}
?>