<?php

namespace App\Http\Controllers\APIs;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\PostResource;
use Exception;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api')
            ->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::included()->filter()->sort()->getOrPaginate();
        // return $categories;
        return PostResource::collection($posts); //Para una o varias respuestas
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'slug'=>'required|unique:posts|max:255',
            'extract'=>'required|string',
            'body'=>'required|string',
            'categoria_id'=>'required|exists:categorias,id', # Que exista en tabla categirias, columna id
            // 'user_id'=>'required|exists:users,id', # Que exista en tabla users, columna id
        ]);

        if(!$validator->fails()) {
            $request->user_id = $user_id;
            Post::create($request->all());
            return response()->json(['success'=>1,'message'=>''],201);
        }

        return response()->json(['success'=>0,'message'=>$validator->errors()],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PostResource::make(Post::included()->sort()->findOrFail($id)); //Para una sola respuesta
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        auth()->user();
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'slug'=>'required|unique:posts,slug,'.$id,
            'extract'=>'required|string',
            'body'=>'required|string',
            'categoria_id'=>'required|exists:categorias,id', # Que exista en tabla categirias, columna id
            // 'user_id'=>'required|exists:users,id', # Que exista en tabla users, columna id
        ]);

        // $request->id = $user_id;

        if(!$validator->fails())
        {
            $register = Post::findOrFail($id);
            $register->update($request->all());

            return response()->json(['success'=>1,'message'=>''],200);
        }

        return response()->json(['success'=>0,'message'=>$validator->errors()],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user();
        $post = Post::find($id);
        if(empty($post))
            return response()->json(['success'=>0,'message'=>'Id no hallado'],200);
        else {
            try {
                $post->delete();
                return response()->json(['success'=>1,'message'=>''],200);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>$e->getMessage()],200);
            }

        }
    }
}
