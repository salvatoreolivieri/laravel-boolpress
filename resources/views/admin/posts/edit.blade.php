@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="mt-3 mb-4">Modifica Post Esistente</h1>
        <h3>Stai modificando: "{{$post->title}}"</h3>
        <p style="font-size: 18px">Modifica i dati e fai click su <span style="color: blue; text-decoration: underline">invia</span> per aggiornare i dati del post presente nel database.</p>

        @if ($errors->any())
        <div class="w-50 alert alert-danger">
                <ul>
                    {{-- $errors->all() reistituisce l'array ceon tutti gli errori --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
        @endif


        <div class="w-50">
            <form action="{{ route('admin.posts.update', $post)}}" method="POST">
                {{-- @csrf deve essere inserito in tutti i form altrimenti il form non è valido --}}
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label sc-label">Titolo Post</label>
                    {{-- il name dell'input deve corrispondere al nome della colonna della tabella di riferimento --}}
                    <input type="text" id="name" name="title"
                    value="{{old('title', $post->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Titolo Post">

                    @error('title')

                        <p class="error-msg text-danger"> {{$message}} </p>

                    @enderror
                </div>

                <div class="mb-3">

                    <span style="display: inline-block" class="mb-2">Seleziona la categoria</span>

                    <select type="text"
                                id="category_id"
                                name="category_id"
                                class="form-control"
                                uncliccable>

                                <option value="null" selected>Nessuna categoria</option>

                                @foreach ($categories as $category )
                                    <option
                                    @if ($category->id == $post->category_id) selected @endif
                                    value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea
                    class="form-control @error('content') is-invalid @enderror"
                    name="content" id="content" cols="30" rows="10">{{old('content', $post->content) }}</textarea>

                    @error('content')

                        <p class="error-msg text-danger"> {{$message}} </p>

                    @enderror
                </div>

                <div class="mb-3">

                    @foreach ($tags as $tag)

                        <input type="checkbox"
                        name="tags[]"
                        id="tag{{$loop->iteration}}"

                        @if(!$errors->any() && $post->tags->contains($tag->id))

                            checked

                        @elseif ($errors->any() && in_array($tag->id, old('tags', []) ))

                            checked

                        @endif

                        value="{{ $tag->id }}">

                        <label class="mr-3" for="tag{{$loop->iteration}}">{{$tag->name}}</label>

                    @endforeach

                </div>

                <button type="submit" class="btn btn-primary">Invia</button>
            </form>
        </div>




    </div>

@endsection
