<?php

    namespace App\Base;

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    abstract class Controller {
        private Environment $twig;
        public function __construct(){
            $this->twig = new Environment(new FilesystemLoader(__DIR__."/../View"));
        }

        public function render($template, $data = []){
            try{
                return $this->twig->render($template, $data);
            }catch(\Exception $e){
                return "<h1 style='color: red'>".$e->getMessage()."</h1>";
            }
        }

    }