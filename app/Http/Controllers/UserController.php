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
        if(Auth::user()->isAdmin()){
            $users = User::orderBy('created_at','desc')->paginate(20);
            return view('users.index',['users' => $users]);
        }else{
            return Redirect::back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin()){
            $roles = Role::lists('description', 'id_role');
            return view('users.register', ["roles" => $roles]);
        }else{
            return Redirect::back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isAdmin()){
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
        }else{
            return Redirect::back();
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
        $user = User::findOrFail($id);
        if(Auth::user()->isAdmin() || Auth::user()->id_user == $user->id_user){
            return view('users.account',['user' => $user]);
        }else{
            return Redirect::back();
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
        $user = User::findOrFail($id);
        if(Auth::user()->isAdmin() || Auth::user()->id_user == $user->id_user){
            $roles = Role::lists('description', 'id_role');
            return view('users.editAccount', ['user' => $user, 'roles' => $roles]);
        }else{
            return Redirect::back();
        }
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
        if(Auth::user()->isAdmin() || Auth::user()->id_user == $user->id_user){

            if(!Auth::user()->isAdmin()){
                $request['id_role'] = $user->id_role;
                $request['active'] = $user->active;
            }

            if(Auth::user()->id_user != $user->id_user){
                $request['secret_question'] = $user->secret_question;
                $request['secret_answer'] = $user->secret_answer;
            }

            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'secret_question' => 'required|max:255',
                'secret_answer' => 'required|max:255',
                'id_role' => 'required',
                'active' => 'required'
            ]);

            $input = $request->all();
            $user->fill($input)->save();
            return Redirect::to('admin/user/account/'.$user->id_user)->with('successMessage','O usuário foi alterado com sucesso no banco de dados.');
        }else{
            return Redirect::back();
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
        $user = User::findOrFail($id);
        if(Auth::user()->isAdmin() || Auth::user()->id_user == $user->id_user){
            if($user->delete()){
            return Redirect::to('admin/user')->with('successMessage','O usuário foi excluido com sucesso do banco de dados.');
            }else{
                return Redirect::to('admin/user')->withErrors('Houve um erro ao deletar o usuário');
            }    
        }else{
            return Redirect::back();
        }
    }
}
