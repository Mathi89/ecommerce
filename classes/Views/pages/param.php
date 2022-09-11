<?php
if(!file_exists('classes/config.php')){

    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/");
    die();
    
}

?>
<div class="container" data-domain="<?= DOMAIN?>">
   <h1>oi</h1>
</div>
