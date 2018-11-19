<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Order by title in ascending order

        // $posts = Post::orderBy('title','asc')->get();

        // in descending order
        // $posts = Post::orderBy('title','desc')->get();

        // find by any parameter using where method
        // $post = Post::where('title','Post One')->get();

        // to run regular SQL Query add DB class using use keyword and select as belot
        // $posts = DB::select('SELECT * FROM posts);

        // if you want to select the numer of entries thenn
        // $posts = Post::orderBy('title','desc')->take(3)->get();
        // the above method takes only first 3 entries

        // adding pagination 
        $posts = Post::orderBy('title','asc')->paginate(15);//adds pagination after 15 entries
        return view('posts.index')->with('posts',$posts );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('posts.show')->with('post',$post); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}