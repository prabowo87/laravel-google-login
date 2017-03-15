<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    public function googlelogin(Request $req)
    {
        $gClient = new \Google_Client();
        $gClient->setApplicationName('laravel-login');
        $gClient->setClientId('673882844731-9cunr377elhqa2ea2vbsggr74ttq0le4.apps.googleusercontent.com');
        $gClient->setClientSecret('YRzemKIyQujT1kxHKSPyCdGd');
        $gClient->setRedirectUri(route('glogin'));
        $gClient->setDeveloperKey('AIzaSyDy4laC627pcIJbspvPa-LtDbIKta5qj74');
        $gClient->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ));
        $google_oauthV2 = new \Google_Service_Oauth2($gClient);
        if ($req->get('code')){
            $gClient->authenticate($req->get('code'));
            $req->session()->put('token', $gClient->getAccessToken());
        }
        if ($req->session()->get('token'))
        {
            $gClient->setAccessToken($req->session()->get('token'));
        }
        if ($gClient->getAccessToken())
        {
            //For logged in user, get details from google using access token
            $guser = $google_oauthV2->userinfo->get();  

            $req->session()->put('name', $guser['name']);
            if ($user = User::where('email',$guser['email'])->first())
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
            $authUrl = $gClient->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }
//    public function listGoogleUser(Request $request){
//        $users = User::orderBy('id','DESC')->paginate(5);
//        return view('users.list',compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);
//    }
}
