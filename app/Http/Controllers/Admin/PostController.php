<?php

namespace App\Http\Controllers\admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view ('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {

        $request->validate( $this->validateRules(), $this->validateMessages() );

        $data = $request->all();

        $new_post = new Post();
        $data['slug'] = Post::slugGenerator($data['title']);

        $new_post->fill($data);
        $new_post->save();

        if(array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);
        if ($post) {
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate( $this->validateRules(), $this->validateMessages() );

        $data = $request->all();

        if ($data['title'] != $post->title) {
            $data['slug'] = Post::slugGenerator($data['title']);
        }

        $post->update($data);

        if (array_key_exists( 'tags', $data)) {

            // se esiste l'array tags lo uso per sincronizzara i dati della tabella ponte

            $post->tags()->sync($data['tags']);
        } else{
            // se non esiste vuol dire che devo cancellare tutte le relazioni eventualmente presenti
            // posso usare sync passando un array vuoto
            //Spost-atags()-›sync((]);
            // oppure detach non passando nulla
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('prodotto_cancellato', "Il post '$post->title' è stato eliminato correttamente");
    }

    private function validateRules(){
        return [
            'title' => 'required|max:50|min:3',
            'content' => 'required|max:50|min:3',
        ];
    }

    private function validateMessages(){
        return [

            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo deve avere al massimo :max caratteri',
            'title.min' => 'Il titolo deve avere minimo :min caratteri',

            'content.required' => 'Il testo del post è obbligatorio',
            'content.max' => 'Il testo del post deve avere al massimo :max caratteri',
            'content.min' => 'Il testo del post deve avere minimo :min caratteri',

        ];

    }
}
