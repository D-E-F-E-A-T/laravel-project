<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
use Auth;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index',"show"]]);
    }
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
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        // handle file uploads
        if($request->hasFile('cover_image')){
            // get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename . '_' . time() . '.' .$extension;
            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore ='noimage.jpg';
        }
        // create post
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
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
        // check for user correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page.');
        }
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
        if($request->hasFile('cover_image')){
            // get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store
            $fileNameToStore = $filename . '_' . time() . '.' .$extension;
            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        // create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
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
       if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page.');
        }
        if($post->cover_image!== 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Remove');
    }
}
