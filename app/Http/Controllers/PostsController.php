<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use Auth;
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
        $posts = Post::orderBy('created_at','desc')->paginate(6);//adds pagination after 15 entries
        return view('posts.index')->with('posts',$posts );
        // $posts = Post::all();

        // return view('posts.index')->with('posts',$posts);

         // $posts = DB::select('SELECT * FROM posts');
        // return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);
        // create post
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();
        return redirect('/posts')->with('success','Post created');
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
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);    
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);
        // create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);
       $post->delete();
       if(Auth::check()){
        return redirect('/dashboard')->with('success','Post deleted');
       }
       else{
        return redirect('/posts')->with('success','Post deleted');
       }
    }
}
