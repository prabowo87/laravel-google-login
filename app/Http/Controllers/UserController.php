<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    public function googlelogin(Request $req)
    {
        $klien = new \Google_Client();
        $klien->setApplicationName('laravel-login');
        $klien->setClientId('673882844731-9cunr377elhqa2ea2vbsggr74ttq0le4.apps.googleusercontent.com');
        $klien->setClientSecret('YRzemKIyQujT1kxHKSPyCdGd');
        $klien->setRedirectUri(route('glogin'));
        $klien->setDeveloperKey('AIzaSyDy4laC627pcIJbspvPa-LtDbIKta5qj74');
        $klien->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ));
        $googleOauthv2 = new \Google_Service_Oauth2($klien);
        if ($req->get('code')){
            $klien->authenticate($req->get('code'));
            $req->session()->put('token', $klien->getAccessToken());
        }
        if ($req->session()->get('token'))
        {
            $klien->setAccessToken($req->session()->get('token'));
        }
        if ($klien->getAccessToken())
        {
            //get details from google using access token
            $userInfo = $googleOauthv2->userinfo->get();  

            $req->session()->put('name', $userInfo['name']);
            if ($user = User::where('email',$userInfo['email'])->first())
            {
                //logged your user via auth login
                return redirect()->route('welcome');
            }else{
                //register your user with response data
            }
            return redirect()->route('welcome');     
        }
        else
        {
            //For Guest user, get google login url
            $authUrl = $klien->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }
}
