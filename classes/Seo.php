<?php 
use \CoffeeCode\Optimizer\Optimizer;

class Seo {
    protected $optimizer;

    public function __construct(string $schema = "article")
    {

        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
            NOME_EMPRESA,
            "pt-BR",
            $schema
        );
        
    }

    public function render(string $title, string $descrption, string $url, string $img, bool $follow = true): string
    {
        $seo = $this->optimizer->optimize(
            $title,
            $descrption,
            $url,
            $img,
            $follow

        );

        return $seo->render();

    }

}

?>