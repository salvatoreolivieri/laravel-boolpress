<?php

namespace App\Http\Controllers\Api;

use App\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        // Prendo l'elenco dei post:
        $posts = Post::all();

        // Restituisco il Json:
        return response()->json(compact('posts'));
    }
}
