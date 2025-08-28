<?php

namespace App\Controller;

use App\Base\Controller;
use App\Service\TMDbService;

class IndexController extends Controller
{
    private TMDbService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new TMDbService();
    }

    public function index(): string{
        $currentMovies = $this->service->getCurrentTopMovies();
        return $this->render('movie/index.html.twig', [
            "movies" => $currentMovies["results"],
        ]);
    }

    public function search(): string{
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
        $movies = $this->service->searchMovie(
            $_GET['query'] ?? "",
                $page
        );

        return $this->render('movie/search.html.twig', [
            "query" => $_GET['query'],
            "movies"=>$movies["results"] ?? [],
            "page" => $movies["page"] ?? 1,
            "total_pages" => $movies["total_pages"] ?? 1
        ]);
    }

    public function show(): string
    {
        $movieId = $_GET["id"] ?? "";
        $movie = $this->service->getMovieById(intval($movieId));

        return $this->render('movie/show.html.twig', [
            "movie" => $movie,
        ]);
    }


}