<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\TipoConta;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            "tipo_conta_id" => "exists:tipo_contas,id"
        ],
        [
            "tipo_conta_id.exists" => "O Tipo de conta informado não é válido",
            "password.min" => "Campo Senha deve conter pelo menos 4 caracteres!",
            "name.min" => "Campo Nome deve conter pelo menos 3 letras!",
            "password.confirmed" => "A confirmação do campo de senha não corresponde.",
            "email.unique" => "Já existe um usuário com esse email.",
            
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipo_conta_id' => $data['tipo_conta_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
