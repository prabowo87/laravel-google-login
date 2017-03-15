<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    public function loginWithGoogle(Request $req)
    {
        $klien = new \Google_Client();
        //apllication name
        $klien->setApplicationName('laravel-login');
        //client id
        $klien->setClientId('CLIENT_ID');
        //client secret
        $klien->setClientSecret('CLIENT_SECRET');
        //redirect url, setting mush be match with credential
        $klien->setRedirectUri(route('googlelogin'));
        //developer key
        $klien->setDeveloperKey('DEVELOPER_KEY');
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
                //do something when user with these email already registered in website
            }else{
                //register your user with response data
            }
            
            //create session
            session([
                //store session google user value, your name
                'googleuser'    => $userInfo['name']
            ]);
            return redirect()->route('index');
        }
        else
        {
            //For Guest user, get google login url
            $authUrl = $klien->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }
}
