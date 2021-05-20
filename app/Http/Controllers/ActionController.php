<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;

class ActionController extends Controller{
    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }

    public function index(){

        try {
            $docRef=  app('firebase.firestore')->database()->collection('Action')->documents();

      foreach ($docRef as $key => $Action) {
        $data[$key] = [
            'titre' => $Action['titre'],
            'date' => $Action['date'],
            'description' => $Action['description'],

        ];

            }
            return response()->json($data);

       /* try {
            $docRef=  app('firebase.firestore')->database()->collection('Action')->documents();
          //  $blog = $docRef;
            foreach ($docRef as $Action) {

                printf('titre %s' . PHP_EOL, $Action['titre']);
                printf('date %s' . PHP_EOL, $Action['date']);
                printf('description %s' . PHP_EOL, $Action['description']);
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

    public function store(Request $request,$idAsso){
        try {
            $docRef = app('firebase.firestore')->database()->collection('Action');
             $docRef->add([
            'titre' => $request->titre,
            'date' => $request->date,
            'description' => $request->description,
            'idAssociation'=>$idAsso,

        ]);
     return redirect('/Action');
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
            $docRef = app('firebase.firestore')->database()->collection('Action')->document($id);
          //  printf('First: %s' . PHP_EOL, $docRef['name']);
            $docRef->set([
             'titre' => $request->titre,
            'date' => $request->date,
            'description' => $request->description,
              ]);
     return redirect('/Action');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }

    public function destroy($id){
        $docRef = app('firebase.firestore')->database()->collection('Action')->document($id);
        $docRef->delete();

        return redirect('/Action');

}

}
