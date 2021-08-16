<?php

namespace App\Http\Controllers\APIs;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\CategoriaResource;
use Exception;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categoria::included()->filter()->sort()->getOrPaginate();
        // return $categories;
        return CategoriaResource::collection($categories); //Para una o varias respuestas
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
            'name'=>'required|max:255',
            'slug'=>'required|unique:categorias|max:255'
        ]);

        Categoria::create($request->all());

        return response()->json(['success'=>1,'error'=>''],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $category, $id)
    {
        /* ----------------------------- formas posibles ---------------------------- */
        /* return $category->with(['posts.users'])->findOrFail($id); //Con ello trae categorias, con sus post y a la vez, con sus usuarios.
        return $category->findOrFail($id); */

        //Uso de query scope included
        return CategoriaResource::make($category->included()->sort()->findOrFail($id)); //Para una sola respuesta

        /* ------------------------------ forma fracaso ----------------------------- */
        // return $category; //NO me resulta de esta manera, en desuso
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria ,$id)
    {
        $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|unique:categorias,slug,'.$id,
        ]);
        $register = Categoria::findOrFail($id);
        $register->update($request->all());

        return response()->json(['success'=>1,'error'=>''],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria, $id)
    {
        try {
            $categoria->destroy($id);
            /* ------------------------------- Otra forma ------------------------------- */
            /*
            $categoria->findOrFail($id)->delete();
            */
            /* --------------------------------- retorno -------------------------------- */
            return response()->json(['success'=>1,'error'=>''],200);

        } catch (Exception $e) {
            return response()->json(['success'=>1,'error'=>$e->getMessage()],200);
        }
    }
}
