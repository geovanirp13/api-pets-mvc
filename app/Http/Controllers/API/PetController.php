<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Http\Requests\PetRequest;
use Exception;
use App\Http\Resources\Pet as PetResource;
use App\Http\Resources\PetCollection;

class PetController extends Controller
{
    /**
     * @var \App\Models\Pet
     */
    protected $model;

    public function __construct(Pet $pet)
    {
        $this->model = $pet;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pet $pet)
    {
        try {
            $pets = $pet->all();
            $petsCollection = new PetCollection($pets);
            return response()->json($petsCollection, 200);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno no servidor'
            ], 500);
        }
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
     * @param  \App\Http\Requests\PetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        try {
            $pet = new Pet();
            $pet->fill($request->all());
            $pet->save();
            $petResource = new PetResource($pet);

            return response()->json($petResource, 201);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $pet = $this->model->findOrFail($id);
            $petResource = new PetResource($pet);
            return response()->json($petResource);

        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Pet não encontrado!'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetRequest $request, $id)
    {
        try {
            $pet = $this->model->find($id);
            $pet->fill($request->all());
            $pet->save();
            $petResource = new PetResource($pet);

            return response()->json($petResource, 200);
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $pet = $this->model->find($id);
            if($pet != null) {
                $pet->delete();
                return response()->json([
                'msg' => 'Pet deletado com sucesso!'
            ], 200);
            } else {
                return response()->json([
                    'msg' => 'Pet não encontrado!'
                 ], 404);
            }
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
