<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Auth;
use App\Models\User;
class LoginController extends Controller {
   //use AuthenticatesUsers;
   protected $auth;
  // protected $redirectTo = RouteServiceProvider::HOME;
   public function __construct(FirebaseAuth $auth) {
      $this->middleware('guest')->except('logout');
      $this->auth = $auth;
   }
protected function login(Request $request) {
   try {  
      $email = $request->email;  
      $password = $request->password;  
      $user = app('firebase.auth')->signInWithEmailAndPassword($email,$password);  
   // echo $user->uid; 
  } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {  
      echo 'Invalid password';  
  }  
   }
   public function username() {
      return 'email';
   }

}