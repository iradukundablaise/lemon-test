<?php

    require_once __DIR__.'/../vendor/autoload.php';

    use Dotenv\Dotenv;
    use App\Base\Router;
    use App\Controller\IndexController;


    $dotenv = Dotenv::createImmutable(__DIR__."/../");
    $dotenv->load();

    $router = new Router();

    $router->get("/", [IndexController::class, "index"]);
    $router->get("/search", [IndexController::class, "search"]);
    $router->get("/movie", [IndexController::class, "show"]);

    try {
        $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }catch (\Exception $e){
        echo $e->getMessage();
    }
