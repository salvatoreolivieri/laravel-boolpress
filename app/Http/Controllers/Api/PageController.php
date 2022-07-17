<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Category;
use App\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        // Prendo l'elenco dei post:
        $posts = Post::with(['category', 'tags'])->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();

        // Restituisco il Json:
        return response()->json(compact('posts', 'categories', 'tags'));
    }

    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);

    }

    public function getPostByCategory($slug_category){

        $category = Category::where('slug', $slug_category)->with('posts')->first();

        return response()->json($category);

    }

    public function getPostByTag($slug_tag){

        $tag = Tag::where('slug', $slug_tag)->with('posts')->first();

        return response()->json($tag);

    }
}
