<?php
class Painel
{
    public static $cargos = [
		'0' => 'Administrador',
		'1' => 'Sub Administrador',
		'2' => 'Desenvolvedor',
        '3' => 'Comercial',
		'4' => 'Representante'
	];

	public static $statusUser = [
		'0' => 'Desativado',
		'1' => 'Ativo',
		'2' => 'Suspenso Temporariamente',
        '3' => 'Pendente',
	];

	public static $turnos = [
		'0' => 'Manhã',
		'1' => 'Tarde',
		'2' => 'Noite',
	];

	public static $status_prospect = [
		'0' => 'Marcou visita',
		'1' => 'Sem interesse',
		'2' => 'Número não existe',
		'3' => 'Não atendeu',      
		'4' => 'Retornar',    
		'5' => 'Whatsapp não existe',
		'6' => 'Instagram não existe',
		'7' => 'Email não existe',
		'8' => 'Mensagem enviada',
		'9' => 'Email enviado',
		'10' => 'Linkedin não existe',
	];

    public static function logado()
	{
		return isset($_SESSION['login']) ? true : false;
	}

	public static function uploadImgUser($file)
	{
		$formatoArquivo = explode('.', $file['name']);
		$imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
		if (move_uploaded_file($file['tmp_name'], BASE_DIR_IMG . '/imguser/' . $imagemNome))
			return $imagemNome;
		else
			return false;
	}

	public static function deleteImgUser($file)
	{
		@unlink(BASE_DIR_IMG . '/imguser/' . $file);
	}

	public static function imagemValida($imagem)
	{
		if (
			$imagem['type'] == 'image/jpeg' ||
			$imagem['type'] == 'image/jpg' ||
			$imagem['type'] == 'image/png'
		) {

			$tamanho = intval($imagem['size'] / 1024);
			if ($tamanho < 500)
				return true;
			else
				return false;
		} else {
			return false;
		}
	}

	public static function selectAll($tabela, $start = null, $end = null)
	{
		if ($start == null && $end == null) {
			$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC");
			$sql->execute();
		} else {
			$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC LIMIT $start,$end");
			$sql->execute();
		}


		return $sql->fetchAll();
	}
	
	public static function selectAllQuery($tabela, $query = null, $array = null)
	{
		if ($query != null && $array != null) {
			$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` $query");
			$sql->execute($array);
		} else {
			$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC");
			$sql->execute();
		}


		return $sql->fetchAll();
	}

	public static function select($table, $query = '', $arr = '')
	{
		if ($query != false) {
			$sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
			$sql->execute($arr);
		} else {
			$sql = MySql::conectar()->prepare("SELECT * FROM `$table`");
			$sql->execute();
		}
		return $sql->fetch();
	}

    public static function logar($table2, $query, $arr1, $arr2)
	{
		
			$sql = MySql::conectar()->prepare("SELECT * FROM `$table2` WHERE $query");
			$sql->execute(array($arr1, sha1($arr2)));
			if ($sql->rowCount() == 1) {
			$info = $sql->fetch();

			$sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empresas` WHERE id = ?");
			$sql2->execute(array($info['id_empresa']));
			if ($sql2->rowCount() == 1) {
				
			
				$data = ['ok'];

				date_default_timezone_set('America/Sao_Paulo');
				$sql = MySql::conectar()->prepare("INSERT INTO `acesso_users` VALUES (null,?,?,?,?) ");
				if ($sql->execute(array($info['id'], date('Y-m-d'), date('H:i:s'), $info['id_empresa']))) {
                   
						$data = ['ok'];
					} else {
						$data = ['error'];
					}

					
				} else {
					$data = ['error'];
				}
				
					if ($data == 'error') {
					return json_encode($data);
					} else {
						return $info;
					}
			};
			
		
	}

    public static function loggout()
	{
		session_destroy();
		header('Location: '.INCLUDE_PATH_LOGIN);
		die();
	}

    public static function redirect($url)
	{
		echo '<script>location.href="' . $url . '"</script>';
		die();
	}

    public static function alertfixed($tipo, $mensagem)
	{
		if ($tipo == 'sucesso') {
			echo '<div class="box-alert2 sucesso"><i class="fa fa-check"></i> ' . $mensagem . '</div>';
		} else if ($tipo == 'error') {
			echo '<div class="box-alert2 error"><i class="fa fa-times"></i> ' . $mensagem . '</div>';
		} else if ($tipo == 'atencao') {
			echo '<div class="box-alert2 atencao"><i class="fa fa-warning"></i> ' . $mensagem . '</div>';
		}
	}

    function format_number($n, $precision = 1)
	{
		if ($n < 999) {
			// 0 - 900
			$n_format = number_format($n);
			$suffix = '';
			$arr = $n_format . $suffix;
		} else if ($n < 9999999) {
			// 0.9k-850k
			$n_format = number_format($n / 1000);
			$suffix = 'K';
			$arr = $n_format . $suffix;
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
			$arr = $n_format . $suffix;
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
			$arr = $n_format . $suffix;
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
			$arr = $n_format . $suffix;
		}
		return $arr;
	}

	function dataEmPortugues ($timestamp, $hours = FALSE, $timeZone = "America/Sao_Paulo") {

		$dia_num = date("w", $timestamp);// Dia da semana.
	
		if($dia_num == 0){
		$dia_nome = "Domingo";
		}elseif($dia_num == 1){
		$dia_nome = "Segunda";
		}elseif($dia_num == 2){
		$dia_nome = "Terça";
		}elseif($dia_num == 3){
		$dia_nome = "Quarta";
		}elseif($dia_num == 4){
		$dia_nome = "Quinta";
		}elseif($dia_num == 5){
		$dia_nome = "Sexta";
		}else{
		$dia_nome = "Sábado";
		}
	
		$dia_mes = date("d", $timestamp);// Dia do mês
	
		$mes_num = date("m", $timestamp);// Nome do mês
	
		if($mes_num == 01){
		$mes_nome = "Janeiro";
		}elseif($mes_num == 02){
		$mes_nome = "Fevereiro";
		}elseif($mes_num == 03){
		$mes_nome = "Março";
		}elseif($mes_num == 04){
		$mes_nome = "Abril";
		}elseif($mes_num == 05){
		$mes_nome = "Maio";
		}elseif($mes_num == 06){
		$mes_nome = "Junho";
		}elseif($mes_num == 07){
		$mes_nome = "Julho";
		}elseif($mes_num == '08'){
		$mes_nome = "Agosto";
		}elseif($mes_num == '09'){
		$mes_nome = "Setembro";
		}elseif($mes_num == '10'){
		$mes_nome = "Outubro";
		}elseif($mes_num == '11'){
		$mes_nome = "Novembro";
		}else{
		$mes_nome = "Dezembro";
		}
		$ano = date("Y", $timestamp);// Ano
	
		date_default_timezone_set($timeZone); // Set time-zone
		$hora = date ("H:i", $timestamp);
	
		if ($hours) {
			return $dia_nome.", ".$dia_mes." de ".$mes_nome." de ".$ano." - ".$hora;
		}
		else {
			return $dia_nome.", ".$dia_mes." de ".$mes_nome." de ".$ano;
		}
	}


	public static function delete($table,$where,$arr)
	{
		$delete = \MySql::conectar()->prepare("DELETE FROM `$table`  $where");
		if($delete->execute($arr)){
			$res = [true];
		}else{
			$res = [false];
		}
		return $res;
	}

	public static function update($arr,$single = false){
		$certo = true;
		$first = false;
		$nome_tabela = $arr['nome_tabela'];

		$query = "UPDATE `$nome_tabela` SET ";
		foreach ($arr as $key => $value) {
			$nome = $key;
			$valor = $value;
			if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
				continue;
			if($value == ''){
				$certo = false;
				break;
			}
			
			if($first == false){
				$first = true;
				$query.="$nome=?";
			}
			else{
				$query.=",$nome=?";
			}

			$parametros[] = $value;
		}

		if($certo == true){
			if($single == false){
				$parametros[] = $arr['id'];
				$sql = MySql::conectar()->prepare($query.' WHERE id=?');
				$sql->execute($parametros);
			}else{
				$sql = MySql::conectar()->prepare($query);
				$sql->execute($parametros);
			}
		}
		return $certo;
	}


    public static function insert($arr)
	{

		$certo = true;
		$nome_tabela = $arr['nome_tabela'];
		
		$query = "INSERT INTO `$nome_tabela` VALUES (null";
		foreach ($arr as $key => $value) {
			$nome = $key;
			$valor = $value;
			
				if ($nome == 'acao' || $nome == 'nome_tabela' )
				continue;

		

			if ($value == '' && $value != null ) {
				$certo = false;
				break;
			}

	
			$query .= ",?";
			$parametros[] = $value;
		}

		
			$query .= ")";
		
		
		if ($certo == true) {
			$sql = MySql::conectar()->prepare($query);
			$sql->execute($parametros);
			// if($nome_tabela == 'tb_admin.fluxo_cadencia.pontos_contato'){
			// 	$ultimo_id = \MySql::conectar()->LastInsertId();
			// $sql = MySql::conectar()->prepare("UPDATE `$nome_tabela` SET ordem = ? WHERE id_empresa = ? AND reference_p = ?");
			// $sql->execute(array($ultimo_id,$_SESSION['id_empresa'],$arr['reference_p']));
			// }
			
		}
		return $certo;
	}


    public static function gerarChave($email)
	{
		$data = array();
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin_users` WHERE `email` = ?");
		$sql->execute(array($email));
		if ($sql->rowCount() == 1) {
			$info = $sql->fetch();
			if ($info['confirmado'] == 'on') {
				$chave = sha1($info['id'] . $info['pass']);
				$nome = $info['nome'];

				$guardar = Painel::guardarChave($chave, $info['id'], $email, $info['cargo']);
				if ($guardar == true) {
					$data = (array("chave" => $chave, "nome" => $nome));
				} else {
					$data = 'Tnovamente';
				}
			} else {
				$data = 'noConfirm';
			}
            
		} else {
				$data = 'noExiste';
			}
		
		return $data;
	}

	public static function checkChave($chave, $senha, $email)
	{


		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin_users` WHERE `email` = ?");
		$sql->execute(array($email));
		if ($sql->rowCount() == 1) {
			$info = $sql->fetch();
			$chave1 = sha1($info['id'] . $info['pass']);
			if ($chave1 == $chave) {

				$sql = MySql::conectar()->prepare("DELETE FROM `tb_site.recuperar` WHERE  token = ? ");
				if ($sql->execute(array($chave))) {
					$senha = sha1($senha);
					$sql = MySql::conectar()->prepare("UPDATE `tb_admin_users` SET `pass` = ? WHERE id = ? ");
					if ($sql->execute(array($senha, $info['id']))) {
						$data = 'Scerto';
					}
				} else {
					$data = 'errorDelChave';
				}
			} else {
				$data = 'noChave';
			}
		} 
		return $data;
	}



    public static function guardarChave($chave, $id, $email, $cargo)
	{
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.recuperar` WHERE email = ? AND id_user = ? ");
		$sql->execute(array($email, $id));
		if ($sql->rowCount() < 1) {
			$hoje = date('Y-m-d');
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.recuperar` VALUES (null,?,?,?,?,?) ");
			if ($sql->execute(array($email, $chave, $hoje, $id, $cargo))) {
				return true;
			}
		} else if ($sql->rowCount() == 1) {
			$hoje = date('Y-m-d');
			$sql = MySql::conectar()->prepare("UPDATE `tb_site.recuperar` SET `email` = ?, `token` = ?, `data_solicitar` = ?, `id_user` = ?, `cargo_user` = ? WHERE email = ? AND token = ? ");
			if ($sql->execute(array($email, $chave, $hoje, $id, $cargo, $email, $chave))) {
				return true;
			}
		}
	}

    public static function verifyEmailNew($emailAge, $emailNew, $token, $pass)
	{
		$select = \MySql::conectar()->prepare("SELECT * FROM tb_admin_users WHERE email = ?");
		$select->execute(array($emailAge));
		if ($select->rowCount() == 1) {
			$dado = $select->fetch();
			if ($dado['pass'] == $pass) {

				$tokenEmail = sha1($emailAge . $dado['pass']);
				if ($tokenEmail == $token) {

					$select = \MySql::conectar()->prepare("SELECT * FROM `tb_site.newemail` WHERE (`id_user` = ? AND `token` = ?) AND (`email` = ?) ORDER BY id DESC");
					$select->execute(array($dado['id'], $token, $emailNew));
					if ($select->rowCount() > 0) {
						$dado2 = $select->fetch();
						$id = $dado2['id_user'];

						$insert = \MySql::conectar()->prepare("UPDATE `tb_admin_users` SET email = ? WHERE id = ?");
						if ($insert->execute(array($emailNew, $id))) {

							$delete = \MySql::conectar()->prepare("DELETE FROM `tb_site.newemail`  WHERE `id_user` = ?");
							$delete->execute(array($id));
							$return = 'sucesso';
						} else {
							$return = 'tentedps';
						}
					} else {
						$return = 'invalidtoken';
					}
				} else {
					$return = 'invalidtoken';
				}
			} else {
				$return = 'invalidpass';
			}
		}  else {
				// email
				$return = 'invalidEmail';
			}
		
		return $return;
	}

	public static function convertMoney($valor,$type = "R$")
	{
		if($type == "R$"){
			return 'R$'.number_format($valor, 2, ',', '.');
		}else{
			$tirar = ["R$","."," "];
			$valor = str_replace($tirar,"",$valor);
			$valor = str_replace(",",".",$valor);

			return $valor;
		}
		
	}


	public static function ConverterData($data)
	{
		$dataCovert = implode('/', array_reverse(explode('-', $data)));
		return $dataCovert;
	}

	
	public static function geratorTokenEmailNew($emailNew, $emailAge)
	{
		
			$ssq = \MySql::conectar()->prepare("SELECT * FROM tb_admin_users WHERE email = ?");
			$ssq->execute(array($emailNew));
			if ($ssq->rowCount() == 1) {
				$return = 'existEmailNew';
			} else {


				$select = \MySql::conectar()->prepare("SELECT * FROM tb_admin_users WHERE email = ?");
				$select->execute(array($emailAge));
				if ($select->rowCount() == 1) {
					$dado = $select->fetch();
					$tokenEmail = sha1($emailAge . $dado['pass']);
					$hoje = date('Y-m-d');

					$sql = \MySql::conectar()->prepare("INSERT `tb_site.newemail` Value (null,?,?,?,?,?,?)");
					$sql->execute(array($emailNew, $tokenEmail, $dado['id'], $hoje, $dado['cargo'], $emailAge));

					$return = $tokenEmail.'&l=2';
				} 
			
		}

		return $return;
	}

	public static function checkSlugFrame($slug)
	{
		$res=\Painel::select('tb_admin.frames','slug = ? AND status = ?',array($slug,'on'));
		if($res['slug'] != null) {
			return true;
		}else{
			return false;
		}
	}

	public static function titleCard($titleCard,$caracter = 35)
	{
		if(strlen($titleCard) > $caracter)
		{
			return substr($titleCard, 0, $caracter)."...";
		 }else{
			return $titleCard;
		 }
	}


	public static function getAmountReal($status,$valuePromo,$valueOld)
	{

		if($status == 'off'){
			$valor = $valueOld;
		}else{
			$valor = $valuePromo;

		}
		return $valor;

	}


	public static function valueCard($status,$valuePromo,$valueOld)
	{

		if($status == 'off'){
			$valueOld = number_format($valueOld, 2);
			$value = explode('.',$valueOld);

			$valueReal = str_replace(",",".",$value[0]);
			if(isset($value[1]) AND $value[1] != null AND $value[1] != "0"){
				$valueCent = $value[1];
			}else{
				$valueCent = "";
			}
		}else{
			$valuePromo = number_format($valuePromo, 2);
			$value = explode('.',$valuePromo);

			$valueReal = str_replace(",",".",$value[0]);
			if(isset($value[1]) AND $value[1] != null AND $value[1] != "0"){
				$valueCent = $value[1];
			}else{
				$valueCent = "";
			}
		}


		//PEGANDO VALOR DE COMPARAÇÃO DO VALOR ANTIGO PARA NOVO
		$valueComparation = explode('.',$valueOld);

			$valueRealvalueComparation = str_replace(",",".",$valueComparation[0]);
			if(isset($valueComparation[1]) AND $valueComparation[1] != null AND $valueComparation[1] != "0"){
				$valueCentComparation = $valueComparation[1];
			}else{
				$valueCentComparation = "";
			}

			if($status == 'on'){
				$valueRealOLD = 'R$'.$valueRealvalueComparation;
				$valueCentOLD = $valueCentComparation;
			} else{
				$valueRealOLD = NULL;
				$valueCentOLD = NULL;
			}
		

		// O $valueRealOLD E $valueCentOLD VERIFICA SE HÁ PROMOÇÃO NO PRODUTO, CASO TENHA ELE RETONA O VALOR NORMAL, CASO NAO TENHA
		// ELE RETORNA VAZIO. ISSO AJUDA A FAZER CONDIÇÕES PARA LEVAR OU NAO LALORES DE COMPARAÇÃO ATÉ A PAGINA DO PRODUTO

		return array($valueReal,$valueCent,$valueRealOLD,$valueCentOLD);
	}

	public static function calculateDesconto($status,$valuePro,$valueOri)
	{
		if($status == 'on'){
			$valuePro = floatval($valuePro); 
			$valueOri = floatval($valueOri); 

			$valueDesc = $valueOri-$valuePro;
			//$valueDesc = number_format($valueDesc, 2);

			$PromoPorcent=$valueDesc*100;
			$PorcentDesc = $PromoPorcent/$valueOri;
			$DescPorcent = floor($PorcentDesc).'% OFF';

			$res = $DescPorcent;

		}else{
			$res = "";
		}

		return $res;

	}

	public static function newproduct($nomeproduto,$preco,$precopromotion,$description,$type,$categorias,$estoque,$slug,$foto)
	{
		// VERIFICANDO SE O STATUS DA PROMOÇÃO SERÁ ATIVADA OU NÃO 
		// COM BASE SE O VALOR PROMOTION É 0 OU NÃO
		if($precopromotion == "0" or $precopromotion == ""){
			$statuspromotion = 'off';
			$precopromotion = 0;
		}else{
		 	$statuspromotion = 'on';
			$precopromotion = $precopromotion;
		}

		// VERIFICANDO SE O ESTOQUE SERÁ ATIVADO OU DESATIVADO COM BASE EM 
		// SE A QUANTIDADE DE ESTOQUE FOI DEFINIDA 
		if($estoque == "0" or $estoque == ""){
			$statusestoque = "off";
			$estoque = 0;
		}else{
			$statusestoque = "on";
			$estoque = $estoque;
		}

		// VERIFICANDO SE EXISTE ALGUN SLUG, SE FOR VAZIO O SISTEMA GERA UM SLUG
		if($slug == ""){
			$slug = $nomeproduto;
		}else{
			$slug = $slug;
		}

		// GERANDO UM SLUG NO FORMATO CORRETO
		$newslug = \Painel::removeCaracterEspecial($slug);


		// VALIDANDO PREÇOS NO FORMATO AMARICANO
		$preco = \Painel::convertMoney($preco,"$");
		$precopromotion = \Painel::convertMoney($precopromotion,"$");


		$statusproduct = "on";

			
			$newslug = \Painel::newSlugOfNewProduct($newslug);
			  

		
			// $idProduct = \Painel::select('tb_admin.store_products','slug = ?',array($newslug))['id'];

			// VALIDANDO QUANTIDADE DE IMG VALIDA
			// $qtdimg = 0;
			// $imgValida = 0;
			// $imgRecusada = 0;
			// foreach ($foto as $key => $img) {
			// 	$qtdimg++;

			// 	$validandoimg = \Painel::imagemValida($img);
			// 	if($validandoimg){

			// 		$imgValida++;
			// 	}else{

			// 		$imgRecusada++;
			// 	}
				
			// }
		
			// if($imgValida < 1){
			// 	//SE NAO HOUVER NENHUMA IMAGEM VALIDA O PRODUTO NAO CADASTRA

			// }else{

				// INSERINDO PRODUTO NO BANCO DE DADOS
				$arr = array(
					"nome_tabela" => "tb_admin.store_products",
					"title" => $nomeproduto,
					"description"=> $description,
					"value" => $preco,
					"value_promotion" => $precopromotion,
					"status_promotion" => $statuspromotion,
					"category" => $categorias,
					"views_total" => null,
					"slug" => $newslug,
					"frame" => null,
					"type" => $type,
					"status_estoque" => $statusestoque,
					"qtdestoque" => $estoque,
					"status" => $statusproduct
		
				);
				$inserir  =\Painel::insert($arr);

				if($inserir){
					
					$idProduct = \Painel::select('tb_admin.store_products','slug = ?',array($newslug))['id'];
				

					// DEIXANDO O ARRAY DE FOTOS EM UMA ESTRUTURA CORRETA
					$fotos = [];
					foreach ($foto as $attrName => $valuesArray) {
						foreach ($valuesArray as $key => $value) {
							$fotos[$key][$attrName] = $value;
						}
					}
							
						
				foreach ($fotos as $key => $img) {
				//  echo ($value['name']);
	
					$validandoimg = \Painel::imagemValida($img);
					if($validandoimg){
					
						$nameImg = \Painel::uploadImgProduct($img);
						$arr = array(
							"nome_tabela" => "tb_admin.imgproducts",
							"id_produto" => $idProduct,
							"img_produto"=> $nameImg
				
						);
						$inserir  =\Painel::insert($arr);
					}
	
					
					
				}
			}

			// }
		



		return true;



	}


	public static function newSlugOfNewProduct($newslug)
	{
			$verifyslug = \Painel::selectCount('tb_admin.store_products','slug = ?',array($newslug),"slug");
			if($verifyslug['qtd'] > 0){
				$newslug = $newslug.($verifyslug['qtd']+1);

				$verifyslug = \Painel::selectCount('tb_admin.store_products','slug = ?',array($newslug),"slug");
				if($verifyslug['qtd'] > 0){
					$newslug = \Painel::newSlugOfNewProduct($newslug);
				}
				

			
			}else{
				$newslug = $newslug;
			}
			return $newslug;

	}

	public static function removeCaracterEspecial($string)
	{
		$string = preg_replace('/[áàãâä]/ui', 'a', $string);
		$string = preg_replace('/[éèêë]/ui', 'e', $string);
		$string = preg_replace('/[íìîï]/ui', 'i', $string);
		$string = preg_replace('/[óòõôö]/ui', 'o', $string);
		$string = preg_replace('/[úùûü]/ui', 'u', $string);
		$string = preg_replace('/[ç]/ui', 'c', $string);
		$string = preg_replace('/[^a-z0-9]/', '_', $string);
		$string = preg_replace('/_+/', '-', $string); // ideia do Bacco :)
		$string = rtrim($string, "-");
		

		return $string;

	}

	public static function selectCount($table, $query = '', $arr = '',$count)
	{
		if ($query != false) {
			$sql = MySql::conectar()->prepare("SELECT COUNT($count) qtd FROM `$table` WHERE $query");
			$sql->execute($arr);
		} else {
			$sql = MySql::conectar()->prepare("SELECT COUNT($count) qtd FROM `$table`");
			$sql->execute();
		}
		return $sql->fetch();
	}

	public static function uploadImgProduct($file)
	{
		$formatoArquivo = explode('.', $file['name']);
		$imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
		if (move_uploaded_file($file['tmp_name'], BASE_DIR_IMG . '/imgsproducts/' . $imagemNome))
			return $imagemNome;
		else
			return false;
	}

	public static function deleteImgProduct($file)
	{
		@unlink(BASE_DIR_IMG . '/imgsproducts/' . $file);
	}

	public static function getCalculateDesconto($status,$valuePro,$valueOri)
	{
		if($status == 'on'){

			$valueDesc = $valueOri-$valuePro;

			$PromoPorcent = $valueDesc*100;
			$PorcentDesc = $PromoPorcent/$valueOri;
			$DescPorcent = floor($PorcentDesc).'% OFF';

			$res = array($DescPorcent,$valueDesc);

		}else{
			$res = array("",0);
		}

		return $res;

	}


}