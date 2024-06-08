<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RecommenderSystemWithMLController extends Controller
{
    public function index(){
        $client = new Client();

        $response = $client->get('http://127.0.0.1:5000/predict');
        $movie = json_decode($response->getBody()->getContents(), true);

        $movie_lists = [];
        if (isset($movie['movie_list'])) {
            $movieTitles = $movie['movie_list'];

            foreach ($movieTitles as $title) {
                $movie_lists[] = [
                    'name' => $title, 
                ];
            }
        }

        $data['movie_lists'] = $movie_lists;


        return view('recommender_with_ml.index', $data);
    }
    public function getPrediction(Request $request){
        $client = new Client();

        $get = $client->get('http://127.0.0.1:5000/predict');
        $movie = json_decode($get->getBody()->getContents(), true);

        $movie_lists = [];
        if (isset($movie['movie_list'])) {
            $movieTitles = $movie['movie_list'];

            foreach ($movieTitles as $title) {
                $movie_lists[] = [
                    'name' => $title, 
                ];
            }
        } 

        $response = $client->post('http://127.0.0.1:5000/predict', [
            'json' => [
                'movie' => $request->input('movie')
            ]
        ]);

        $prediction = json_decode($response->getBody()->getContents(), true);

        $recommendedMovies = [];
        if (isset($prediction['recommended_movies_name']) && isset($prediction['recommended_movies_poster'])) {
            $names = $prediction['recommended_movies_name'];
            $posters = $prediction['recommended_movies_poster'];

            for ($i = 0; $i < count($names); $i++) {
                $recommendedMovies[] = [
                    'name' => $names[$i],
                    'poster' => $posters[$i] ?? null,
                ];
            }
        }
 
        $data['recommendedMovies'] = $recommendedMovies; 
        $data['selected_movie'] = $request->input('movie');
        $data['movie_lists'] = $movie_lists;

        return view('recommender_with_ml.index', $data);
    }
}
