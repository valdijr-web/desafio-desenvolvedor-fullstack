<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Solicitation;
use Illuminate\Http\Request;

class SolicitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('solicitations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('solicitations.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitation $solicitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitation $solicitation)
    {
        return view('solicitations.edit',[
            'solicitation' => $solicitation
        ]);
    }


   
}
