<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;

class MsgController extends Controller{
    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }

    public function index(){

        try {
            $docRef=  app('firebase.firestore')->database()->collection('Msg')->documents();

      foreach ($docRef as $key => $Msg) {
        $data[$key] = [
            'date' => $Msg['date'],

            'contenu' => $Msg['contenu'],

        ];

            }
            return response()->json($data);


        /*try {
            $docRef=  app('firebase.firestore')->database()->collection('Msg')->documents();
          //  $blog = $docRef;
            foreach ($docRef as $Msg) {

                //printf('titre %s' . PHP_EOL, $Msg['titre']);
                printf('contenu %s' . PHP_EOL, $Msg['contenu']);

               printf('date %s' . PHP_EOL, $Msg['date']);
            }*/

         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

      //  return view ('user.index', compact('user'));
    }

  /*  public function create(){

        return view('user.create');
    }*/

    public function store(Request $request,$idUser){
        try {
            $docRef = app('firebase.firestore')->database()->collection('Msg');
             $docRef->add([
            //'titre' => $request->titre,
            'date' => $request->date,
            'contenu' => $request->contenu,
           // 'idAssociation'=>$idAsso,

        ]);
     return redirect('/Msg');
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
  /*  public function update($id, Request $request){


        try {
            $docRef = app('firebase.firestore')->database()->collection('Event')->document($id);
          //  printf('First: %s' . PHP_EOL, $docRef['name']);
            $docRef->set([
             'titre' => $request->titre,
            'date' => $request->date,
            'description' => $request->description,
              ]);
     return redirect('/Event');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }*/

   public function destroy($idUser,$idMsg){
        $docRef = app('firebase.firestore')->database()->collection('Msg')->document($idMsg);
        $docRef->delete();

        return redirect('/Msg');

}

}
