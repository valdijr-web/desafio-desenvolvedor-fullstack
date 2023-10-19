<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Solicitation;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //retora a listagem de usuários
    public function index(Request $request)
    {
        
    }
    //registra um usuário no banco de dados
    public function store(Request $request)
    {
        
    }

    //retorna um usuário 
    public function show(Solicitation $solicitation){
       
    }

    //atualiza dados do usuário no banco de dados
    public function update(Request $request, Solicitation $solicitation)
    {
       
    }

    public function destroy(Solicitation $solicitation)
    {
       
    }
}
