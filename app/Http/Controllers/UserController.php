<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at','desc')->paginate(20);
        return view('users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('description', 'id_role');
        return view('users.register', ["roles" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'secret_question' => 'required|max:255',
            'secret_answer' => 'required|max:255',
            'id_role' => 'required'
        ]);
        $data = $request->all();
        
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'secret_question' => $data['secret_question'],
            'secret_answer' => $data['secret_answer'],
            'tries' => 0,
            'active' => true,
            'id_role' => $data['id_role'],
        ]);
        
        return Redirect::to('admin/user/register')->with('successMessage','O usuário foi cadastrado com sucesso no banco de dados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.account',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.editAccount', ['user' => $user]);
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'secret_question' => 'required|max:255',
            'secret_answer' => 'required|max:255'
        ]);

        $input = $request->all();
        $user->fill($input)->save();

        return Redirect::to('admin/user/'.$user->id_user)->with('successMessage','O usuário foi alterado com sucesso no banco de dados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(Auth::user()->role->description != 'Administrador' && Auth::user() != $user){
            return Redirect::to('admin/user')->withErrors('Você não tem permissão para deletar este usuário!');
        }else if($user->delete()){
            return Redirect::to('admin/user')->with('successMessage','O usuário foi excluido com sucesso do banco de dados.');
        }else{
            return Redirect::to('admin/user')->withErrors('Houve um erro ao deletar o usuário');
        }
    }
}
