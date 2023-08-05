<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\invoice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
            return redirect('/')->with('success', 'Vous avez été déconnecté(e) avec succès!');
        
    }

    public function ShowCorrectHomepage(){
        if (auth()->check()){
            $user = auth()->user();
            $invoices = Invoice::all();
            return view('homepage',  ['user' => $user, 'invoices' => $invoices]);
        }
        else{
            return view('logpage');
            }
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
                'loginUsername' => 'required',
                'loginPassword' => 'required'

            ]);
            if (auth()->attempt(['username' => $incomingFields['loginUsername'],'password' => $incomingFields['loginPassword'] ])){
                $request->session()->regenerate();
                return redirect('/')->with('success', 'Vous êtes connecté(e) avec succès !');

            }
            else{
                return redirect('/')->with('failure', "Nom d'utilisateur ou mot de passe invalide.");
            }

    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3','max:20', Rule::unique('users','username') ],
            'email' => ['required', 'email', Rule::unique('users','email')],            'password' => 'required',
            'password' => ['required', 'min:6', 'same:pass2'],
            'pass2' => ['required', ]
            
              
            

        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $incomingFields['pass2'] = bcrypt($incomingFields['pass2']);
        $user=User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account');
    }
}



