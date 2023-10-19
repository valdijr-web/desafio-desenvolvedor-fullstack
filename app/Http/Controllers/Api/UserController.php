<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    //retora a listagem de usuários
    public function index(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchTerm = $request->input('search.value'); // Obtenha o termo de pesquisa
        
        // Realize a consulta para buscar os dados paginados
        $query = User::select();
        
        // Se houver um termo de pesquisa, aplique a cláusula WHERE
        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('document', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone_number', 'like', '%' . $searchTerm . '%')
                    ->orWhere('birth_date', 'like', '%' . $searchTerm . '%');
               
            });
        }
        $recordsTotal = $query->count();
        $users = $query->skip($start)->take($length)->get();
        
        $response = [
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $users,
        ];
        
        return response()->json($response);

    }
    //registra um usuário no banco de dados
    public function store(StoreUpdateUserRequest $request)
    {
        $user = New User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->document = $request->document;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->birth_date = $request->birth_date;
        $user->password = $request->password;

        $user->save();
        return new UserResource($user);
    }

    //retorna um usuário 
    public function show(User $user){
        return new UserResource($user);
    }

    //atualiza dados do usuário no banco de dados
    public function update(StoreUpdateUserRequest $request, User $user)
    {
       
       
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->document = $request->document;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->birth_date = $request->birth_date;
        if(!empty($user->password)){
            $user->password = $request->password;
        }
        

        $user->save();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado.'], Response::HTTP_NOT_FOUND);
        }
        $user->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
