<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ErrorException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    //

    public function changePassword() {
        try {
            $validation = request()->validate([
                'old_password'  =>  'required|string',
                'password'  =>  'required|string',
                'password_confirmation'  =>  'required|string'
            ],[
                'required'  =>  '`:attribute` requi(s) !'
            ]);

            // VERIFIER LA VALIDITE DE L'ANCIEN MOT DE PASSE 

            if(!Hash::check(request()->old_password,request()->user()->password)) {
                throw new ErrorException("Ancien mot de passe invalide !");
            }

            // VERIFIER SI LES DEUX MOT DE PASSE SONT CONFORME

            if(request()->password != request()->password_confirmation) {
                throw new ErrorException(" Les mots de passe ne correspondent pas ! ");
            }

            $user = request()->user();
            $user->password = bcrypt(request()->password);
            $user->update();

            return response()
                ->json('done');
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }
}
