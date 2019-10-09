<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function registro(Request $request){
        $user = new \App\User();
        $user -> username = $request ->username;
        $user -> email = $request ->email;
        $user -> password = bcrypt($request ->password);
        if($user ->save())
        return response()->json($user,201);
        return response()->json($user,204);
    }

    public function login (Request $request){
        $credenciales = ["email"=>$request->email,"password"=>$request->password];
        if(Auth::once($credenciales)){
            $token=Str::random(60);
            $request->user()->forcefill([
                'api_token'=> hash('sha256',$token),
            ])->save();

            return response()->json(["token"=>$token],201);
        }
        \Abort(401);
    }

    public function logout(Request $request){
        $request -> user()->forcefill(['api_token'=>null])->save();
        return response()->json("sesión cerrada",201);
        \Abort(204);
    }

    public function comics(Request $request){
        $tokenmarvel = '595a727740be5712eb2f1b8919a9e6eb';
        $hash = '02e51458a2a328bbf58a87d961b28916';
        $comics= $request->idcomics;

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://gateway.marvel.com:443']);
        $res = $client->request('GET',"/v1/public/comics/$comics?ts=1&apikey=$tokenmarvel&hash=$hash");
         return $res -> getBody();
    }

    public function personaje(Request $request){
        $tokenmarvel = '595a727740be5712eb2f1b8919a9e6eb';
        $hash = '02e51458a2a328bbf58a87d961b28916';
        $personaje= $request->idpersonaje;

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://gateway.marvel.com:443']);
        $res = $client->request('GET',"/v1/public/characters/$personaje?ts=1&apikey=$tokenmarvel&hash=$hash");
         return $res -> getBody();
    }

    public function series(Request $request){
        $tokenmarvel = '595a727740be5712eb2f1b8919a9e6eb';
        $hash = '02e51458a2a328bbf58a87d961b28916';
        $series= $request->idserie;

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://gateway.marvel.com:443']);
        $res = $client->request('GET',"/v1/public/series/$series?ts=1&apikey=$tokenmarvel&hash=$hash");
         return $res -> getBody();
    }

    public function stories(Request $request){
        $tokenmarvel = '595a727740be5712eb2f1b8919a9e6eb';
        $hash = '02e51458a2a328bbf58a87d961b28916';
        $stories= $request->idstories;

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://gateway.marvel.com:443']);
        $res = $client->request('GET',"/v1/public/stories/$stories?ts=1&apikey=$tokenmarvel&hash=$hash");
         return $res -> getBody();
    }
}
