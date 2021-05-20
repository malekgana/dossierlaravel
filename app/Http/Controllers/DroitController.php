<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;

class DroitController extends Controller{
    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }

    public function index(){

        try {
            $docRef=  app('firebase.firestore')->database()->collection('Droit')->documents();

      foreach ($docRef as $key => $Droit) {
        $data[$key] = [
            'titre' => $Droit['titre'],

            'description' => $Droit['description'],

        ];

            }
            return response()->json($data);


       /* try {
            $docRef=  app('firebase.firestore')->database()->collection('Droit')->documents();
          //  $blog = $docRef;
            foreach ($docRef as $Droit) {

                printf('titre %s' . PHP_EOL, $Droit['titre']);
                //printf('date %s' . PHP_EOL, $Dossier['date']);
                printf('description %s' . PHP_EOL, $Droit['description']);
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
            $docRef = app('firebase.firestore')->database()->collection('Droit');
             $docRef->add([
            'titre' => $request->titre,
           // 'date' => $request->date,
            'description' => $request->description,
            'idUser'=>$idUser,

        ]);
     return redirect('/Droit');
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
    public function update($id, Request $request){


        try {
            $docRef = app('firebase.firestore')->database()->collection('Droit')->document($id);
          //  printf('First: %s' . PHP_EOL, $docRef['name']);
            $docRef->set([
             'titre' => $request->titre,
            //'date' => $request->date,
            'description' => $request->description,
              ]);
     return redirect('/Droit');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }

    public function destroy($id){
        $docRef = app('firebase.firestore')->database()->collection('Droit')->document($id);
        $docRef->delete();

        return redirect('/Droit');

}

}
