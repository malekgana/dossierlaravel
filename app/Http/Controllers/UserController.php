<?php
//namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;

class UserController extends Controller{
    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }

    /*public function index(){

        try {
            $docRef=  app('firebase.firestore')->database()->collection('Association')->documents();
          //  $blog = $docRef;
            foreach ($docRef as $Association) {

               // printf('titre: %s' . PHP_EOL, $blog['titre']);
               // printf('date: %s' . PHP_EOL, $blog['date']);
               // printf('description: %s' . PHP_EOL, $blog['description']);
            }

         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

      //  return view ('user.index', compact('user'));
    }*/

  /*  public function create(){

        return view('user.create');
    }*/

    public function store(Request $request ,$id){
        try {
            'validate' == false;
            $docRef = app('firebase.firestore')->database()->collection('User');
             $docRef->add([
            'id'=>$id,           // 'titre' => $request->titre,
           // 'date' => $request->date,
            //'description' => $request->description,

        ]);
     return redirect('/User');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

    }

 /*  public function edit($id){


        try {
            $docRef = app('firebase.firestore')->database()->collection('blog')->getDocument($id);
            printf('First: %s' . PHP_EOL, $docRef['name']);
     $docRef->update([
            'name' => "waad",
            'age' => "21",
        ]);
     return redirect('/blogs');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }
*/
    public function update($idUser, Request $request){


        try {
            $docRef = app('firebase.firestore')->database()->collection('User')->document($idUser);
          //  printf('First: %s' . PHP_EOL, $docRef['name']);
            $docRef->get([
             'idUser' => $request->idUser,

              ]);
     return redirect('/User');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }
    public function valide ($id,$blog){

        try {
         $User=   app('firebase.firestore')->database()->collection('User')->document($id);
         $snapshot = $User->snapshot();

            $blog->set([
              // 'raisonSocial'=>$snapshot['raisonSocial'],

               'validate'=>true,
                 ]);

     return redirect('/User');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }

    public function destroy($idUser){
        $docRef = app('firebase.firestore')->database()->collection('User')->document($idUser);
        $docRef->delete();

        return redirect('/User');

}

}
