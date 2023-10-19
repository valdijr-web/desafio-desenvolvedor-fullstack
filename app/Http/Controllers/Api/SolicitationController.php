<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSolicitation;
use App\Http\Resources\SolicitationResource;
use App\Models\Solicitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SolicitationController extends Controller
{
    //retora a listagem de usuários
    public function index(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchTerm = $request->input('search.value'); // Obtenha o termo de pesquisa
        // Realize a consulta para buscar os dados paginados
        $query = Solicitation::selectRaw('solicitations.id AS id, users.first_name AS user_id, solicitations.description, solicitations.quantity, solicitations.price ')
        ->join('users', 'solicitations.user_id', '=', 'users.id');
        
        // Se houver um termo de pesquisa, aplique a cláusula WHERE
        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('quantity', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
               
            });
        }
        $recordsTotal = $query->count();
        $solicitations = $query->skip($start)->take($length)->get();
        
        $response = [
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $solicitations,
        ];
        
        return response()->json($response);
        
    }

    //retora a listagem de usuários
    public function getUserSolicitations(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchTerm = $request->input('search.value'); // Obtenha o termo de pesquisa
        // Realize a consulta para buscar os dados paginados
        $query = Solicitation::select()
            ->where('user_id', 1);
        
        // Se houver um termo de pesquisa, aplique a cláusula WHERE
        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('quantity', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%');
            });
        }
        $recordsTotal = $query->count();
        $solicitations = $query->skip($start)->take($length)->get();
        
        $response = [
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $solicitations,
        ];
        
        return response()->json($response);
        
    }

    //registra um usuário no banco de dados
    public function store(StoreUpdateSolicitation $request)
    {
        $solicitation = New Solicitation();
        $solicitation->description = $request->description;
        $solicitation->quantity = $request->quantity;
        $solicitation->price = $request->price;
        //não deu tempo construir o login então estou buscando o primeiro usuário que tiver na tabela.
        $solicitation->user_id = User::first()->id;
        $solicitation->save();
        return new SolicitationResource($solicitation);
    }

    //retorna um usuário 
    public function show(Solicitation $solicitation){
        return new SolicitationResource($solicitation);
    }

    //atualiza dados do usuário no banco de dados
    public function update(StoreUpdateSolicitation $request, Solicitation $solicitation)
    {
        $solicitation->description = $request->description;
        $solicitation->quantity = $request->quantity;
        $solicitation->price = $request->price;
        $solicitation->save();
        return new SolicitationResource($solicitation);
       
    }

    public function destroy(Solicitation $solicitation)
    {
        if (!$solicitation) {
            return response()->json(['error' => 'Pedido não encontrado.'], Response::HTTP_NOT_FOUND);
        }
        $solicitation->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
