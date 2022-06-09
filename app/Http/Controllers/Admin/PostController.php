<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
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
        return view('admin.posts.create', compact('categories', 'tags'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|max:250',
            'content'=> 'required|min:20',
            'category_id'=>'required|exists:categories,id',
            'tags'=>'exists:tags,id',
            'image'=>'nullable|image'
        ], [
            'title.required' => 'Il titolo deve essere valorizzato!',
            'title.max' => 'Titolo troppo lungo, usa il dono della sintesi!',
            'tags'=>'Tag non esiste',
            'image'=>'Il file non è un immagine'

        ]);

        $postData = $request->all();

        if(array_key_exists('image', $postData)) {
            $img_path = Storage::put('uploads', $postData['image']);
            $postData['cover'] = $img_path;
        }

        $newPost = new Post();

        $newPost->fill($postData);

        $newPost->slug = Post::convertToSlug($newPost->title);

        $newPost->save();

        if(array_key_exists('tags', $postData)) {
            $newPost->tags()->sync($postData['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $category = Category::find($post -> category_id);

        return view('admin.posts.show', compact('post', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('categories', 'post', 'tags'));
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

        $request->validate([
            'title'=> 'required|max:250',
            'content'=> 'required',
            'category_id'=>'required|exists:categories,id',
            'tags'=>'exists:tags,id',
            'image'=>'nullable|image'
        ], [
            'title.required' => 'Il titolo deve essere valorizzato!',
            'title.max' => 'Titolo troppo lungo, usa il dono della sintesi!',
            'tags'=>'Tag non esistente',
            'image'=>'Il file non è un immagine'



        ]);

        $postData = $request->all();

        if(array_key_exists('image', $postData)) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $img_path = Storage::put('uploads', $postData['image']);
            $postData['cover'] = $img_path;
        }

        $post->fill($postData);


        $post->slug = Post::convertToSlug($post->title);

        if(array_key_exists('tags', $postData)) {
            $post->tags()->sync($postData['tags']);
        }

        $post->update();


        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if($post) {
            $post->tags()->sync([]);
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $post->delete();
        }

        return redirect()->route('admin.posts.index');

    }
}
