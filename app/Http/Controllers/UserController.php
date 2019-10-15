<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        // if(request()->has('empty')){
        //     $users = [];
        // } else{

        //     $users = [
        //         'Reinaldo',
        //         'Alejandro',
        //         'Ynes',
        //         'Naldo'
        //     ];
        // }

        $users = User::all();

        $titulo = 'Lista de usuarios';

        return view('users.index', compact('users', 'titulo'));
    }

    public function show(User $user){
        
        //lo mas facil es usar el metodo User y cabiar la variable id en la ruta por el user. Manteniedo siempre los cambios realizados en el metodo usado antes que este.

        // $user = User::find($id);

        // if($user == null){
        //     return response()->view('users.error-404',[], 404);
        // }

        // $user = User::findOrFail($id);
        //para lograr que este metodo funcione debo seguir los parametros para la convencion: primero debo crear en la carpeta views una subcarpeta llamada errors a la altura de users. Dentro de dicha carpeta debo crear un archivo blade.php con el numero del error 404.
        
        return view('users.show', compact('user'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(){
        
        $data = request()->all();

        factory(User::class)->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])

            // 'name' => 'Reinaldo',
            // 'email' => 'reinaldo2@reinaldo.com',
            // 'password' => bcrypt('12345')
        ]);

        return redirect()->route('user');
    }
}
