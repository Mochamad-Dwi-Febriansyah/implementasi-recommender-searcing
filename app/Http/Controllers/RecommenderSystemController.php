<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecommenderModel;
use GuzzleHttp\Client;


class RecommenderSystemController extends Controller
{
    public function index(){
        $movie_list = RecommenderModel::getRecord();
        $client = new Client();
        $movie_new = [];
        foreach ($movie_list as $mv) {
            $movie_id = $mv->movie_id;
 
            $url = "https://api.themoviedb.org/3/movie/{$movie_id}?api_key=46c98e3677436841f374eecf471dcf85&language=en-US"; 
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true); 
            $poster_path = $data['poster_path']; 
            $full_path = "http://image.tmdb.org/t/p/w500" . $poster_path; 
            $movie_new[] = [
                'title' => $mv->title,
                'poster' => $full_path
            ];
        }
        // dd($data['movie_list']); 
        $data['movie_title'] = $movie_list;
        $data['movie_list'] = $movie_new;
        return view('recommender.index', $data);
    }
}
