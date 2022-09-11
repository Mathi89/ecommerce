<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>
<link rel="stylesheet" href="<?= INCLUDE_CSS_T01?>geral.css">

  <div class="corpo_erro404">
      <div class="group_erro404">
            <img class="img_404" src="<?= INCLUDE_PATH_VIEWS?>imgsistem/404.jpg">
      </div>

      <div class="group_erro404">
          <h2>Oooops! Essa página não existe.</h2>
      </div>
 
</div>
