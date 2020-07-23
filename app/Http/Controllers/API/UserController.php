<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    /**
     * @var \App\Models\User
     */
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        try {
            $users = $user->all();
            $usersCollection = new UserCollection($users);

            return response()->json($usersCollection, 200);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno no servidor'
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = \Correios::cep($request->zipcode);
        try {
          $user = new User();
          $user->fill($request->all());
          $user->password = Hash::make($user->password);
          if(!empty($address)) {
              $user->address      = $address['logradouro'];
              $user->neighborhood = $address['bairro'];
              $user->city         = $address['cidade'];
              $user->state        = $address['uf'];
            }
          $user->save();
          $userResource = new UserResource($user);

          return response()->json($userResource, 200);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
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
            $user = $this->model->findOrFail($id);
            $userResource = new UserResource($user);
            return response()->json($userResource);

        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Usuário não encontrado!'
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
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $address = \Correios::cep($request->zipcode);
        try {

          $user->fill($request->all());
          $user->password = Hash::make($user->password);
          if(!empty($address)) {
              $user->address      = $address['logradouro'];
              $user->neighborhood = $address['bairro'];
              $user->city         = $address['cidade'];
              $user->state        = $address['uf'];
            }
          $user->save();
          $userResource = new UserResource($user);

          return response()->json($userResource, 200);
        } catch (\Exception $erro) {
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
            $user = $this->model->find($id);
            if($user != null) {
                $user->delete();

                return response()->json([
                    'msg' => 'Usuário deletado com sucesso!'
                ], 200);
            } else {
                return response()->json([
                    'msg' => 'Usuário não encontrado!'
                ], 404);
            }
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
        }
    }
}
