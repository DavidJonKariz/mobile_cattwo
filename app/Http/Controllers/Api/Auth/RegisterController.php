<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    private $client;
    use IssueTokenTrait;

    public function __construct()
    {
        $this->client = Client::find(1);
    }

    public function register(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users|email',
                'password' => 'required|min:6',
            ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt('password')
        ]);

        return $this->issueToken($request, 'password');

//        $params = [
//                'grant_type' => 'password',
//                'client_id' => $this->client->id,
//                'client_secret' => $this->client->secret,
//                'username' => request('email'),
//                'password' => request('password'),
//                'scope' =>'*'
//        ];
//
//        $request->request->add($params);
//        $proxy = Request::create('oauth/token', 'POST');
//        return Route::dispatch($proxy);
    }
}
