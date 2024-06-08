<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class RecommenderModel extends Model
{
    use HasFactory;
    protected $table = 'tb_movie_list'; 
    static public function getRecord(){
        $return =  self::select('tb_movie_list.movie_id', 'tb_movie_list.title');
                        if(!empty(Request::get('movie'))){
                            $return = $return->where('tb_movie_list.title' , 'like' , '%'.Request::get('movie').'%');
                        }
        $return = $return->paginate(200);

        return $return;
    }
}
