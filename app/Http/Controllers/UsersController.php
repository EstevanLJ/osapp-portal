<?php

namespace App\Http\Controllers;

use Gate;
use Storage;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'canViewUsers']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Novo Usuário';
        $user = new User;
        $types = User::TYPES;

        return view('users.form', compact('title', 'user', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $dados = $request->validated();
        $dados['enabled'] = isset($dados['enabled']);

        $user = User::create($dados);
        $request->session()->flash('success', 'Usuário criado com sucesso!');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = 'Editar Usuário';
        $types = User::TYPES;

        return view('users.form', compact('title', 'user', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $dados = $request->validated();

        if ($dados['password'] != null) {
            $dados['password'] = Hash::make($dados['password']);
        } else {
            unset($dados['password']);
        }

        $dados['enabled'] = isset($dados['enabled']);

        $user->update($dados);
        $request->session()->flash('success', 'Usuário editado com sucesso!');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
