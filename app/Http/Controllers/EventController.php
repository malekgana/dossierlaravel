<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;

class EventController extends Controller{
    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }

    public function index(){

        try {
            $docRef=  app('firebase.firestore')->database()->collection('Event')->documents();

      foreach ($docRef as $key => $Event) {
        $data[$key] = [
            'titre' => $Event['titre'],
            'date' => $Event['date'],
            'description' => $Event['description'],

        ];

            }


            return response()->json($data);
      /*      foreach ($docRef as $Event) {

                printf('titre %s' . PHP_EOL, $Event['titre']);
                printf('date %s' . PHP_EOL, $Event['date']);
                printf('description %s' . PHP_EOL, $Event['description']);
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
            $docRef = app('firebase.firestore')->database()->collection('Event');
             $docRef->add([
            'titre' => $request->titre,
            'date' => $request->date,
            'description' => $request->description,
            'idAssociation'=>$idAsso,

        ]);
     return redirect('/Event');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

    }

 public function edit($id){


        try {
            $Event = app('firebase.firestore')->database()->collection('Event')->document($id);
             $snapshot = $Event->snapshot();

             printf('titre %s' . PHP_EOL, $snapshot['titre']);
             printf('date %s' . PHP_EOL, $snapshot['date']);
             printf('description %s' . PHP_EOL, $snapshot['description']);
       // return redirect('/Event');
         // echo $user->uid;
             } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }

    public function update($id, Request $request){

        try {
            $Event = app('firebase.firestore')->database()->collection('Event')->document($id);
          //  $snapshot = $Event->snapshot();

          //  printf('First: %s' . PHP_EOL, $docRef['name']);
            $Event->set([
             'titre' => $request->titre,
             'date' => $request->date,
             'description' => $request->description,
              ]);
     return redirect('/Event');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }

    public function destroy($id){
        $docRef = app('firebase.firestore')->database()->collection('Event')->document($id);
        $docRef->delete();

        return redirect('/Event');

}

}
