<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    // cutom form register
    public function showRegistrationForm()
    {
        $titre = "Ajout utilisateur";
        $chemin = "utilisateurs / Ajout";

        return view('application.utilisateurs.create', compact('titre', 'chemin'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($user != NULL){
            return redirect()->route('utilisateur.index')->with('messageSuccess', 'Utilisateur ajouter avec succès');
        }else{
            return redirect()->route('register')->with('messageError', 'Le chef de service existe déjà');
        }
        
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('auth');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'prenom' => 'required',
            'tel' => 'required',
            'typeUtilisateur' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $chefService = NULL;
        
        if($data['typeUtilisateur'] == 'chefDeService'){
            $chefService = $this->findDuplicate([
                'typeUtilisateur' => $data['typeUtilisateur']
            ]);
        }

        if(is_null($chefService)){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'prenom' => $data['prenom'],
                'tel' => $data['tel'],
                'typeUtilisateur' => $data['typeUtilisateur']
            ]);
        }else{
            return NULL;
        }
    }

    private function findDuplicate($params = []){
        $user = User::where($params)->first();
        return $user;
    }
}
