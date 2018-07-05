<?php
/**
 * Created by PhpStorm.
 * User: djkar
 * Date: 05/07/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Api\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait IssueTokenTrait
{
    public function issueToken(Request $request, $granType, $scope = "*")
    {
        $params = [
            'grant_type' => $granType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->username ?: $request->email,
            'scope' => $scope
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token', 'POST');
        return Route::dispatch($proxy);
    }
}