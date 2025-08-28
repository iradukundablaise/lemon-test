<?php

namespace App\Service;

use GuzzleHttp\Client;

class TMDbService
{
    private Client $httpClient;
    private SearchLoggerService $searchLoggerService;

    public function __construct(){
        $this->httpClient = new Client();
        $this->searchLoggerService = new SearchLoggerService();
    }

    public function getMovieById(int $id): array {
        $req = $this->httpClient->get($_ENV["TMDB_API_URL"] . "movie/" . $id . "?language=fr-FR", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $_ENV["TMDB_API_TOKEN"],
            ],
        ]);

        return json_decode($req->getBody()->getContents(), true);
    }

    public function getCurrentTopMovies(): array {
        $req = $this->httpClient->get($_ENV["TMDB_API_URL"] . "movie/now_playing?language=fr-FR&page=1", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $_ENV["TMDB_API_TOKEN"],
            ],
        ]);

        return json_decode($req->getBody()->getContents(), true);
    }

    public function searchMovie(string $query, int $page = 1): array {
        if(trim($query) !== ""){
            $this->searchLoggerService->log($query);
            $req = $this->httpClient->get($_ENV["TMDB_API_URL"]."search/movie?language=fr-FR&query=".$query."&page=".$page, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$_ENV["TMDB_API_TOKEN"],
                ],

            ]);
            return json_decode($req->getBody()->getContents(), true);
        }
        return [];
    }
}