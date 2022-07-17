<?php

namespace App\Http\Controllers\Api;

use App\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        // Prendo l'elenco dei post:
        $posts = Post::with(['category', 'tags'])->paginate(5);

        // Restituisco il Json:
        return response()->json(compact('posts'));
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);

    }
}
