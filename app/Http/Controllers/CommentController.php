<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;


class CommentController extends Controller{

    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }

    public function index($idBlog){
            try {
            $blog=  app('firebase.firestore')->database()->collection('blog')->document($idBlog);
            $comments = $blog->collection('comment')->documents();
          //  $blog = $docRef;
            foreach ($comments as $comment) {

                printf('First: %s' . PHP_EOL, $comment ['contenu']);
            }

         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

        //return view ('user.index', compact('user'));
    }


  /*  public function create(){

        return view('user.create');
    }*/

    public function store($idBlog, Request $request){
        try {
            $blog=  app('firebase.firestore')->database()->collection('blog')->document($idBlog);

            $comments = $blog->collection('comment');
             $comments->add([
            'contenu' => $request->contenu,

        ]);
     return redirect('/blogs');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

    }


    public function update($idBlog,$id, Request $request){
        try {
            $docRef = app('firebase.firestore')->database()->collection('blog')->document($idBlog);

            $comment = $docRef->collection('comment')->document($id);
            foreach ($comment as $com) {

                printf('First: %s' . PHP_EOL, $com ['contenu']);
            }
                     $comment->set([

            'contenu' => $request->contenu,
              ]);
    // return redirect('/blogs');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }
    }


   public function destroy($idBlog,$id){
        $docRef = app('firebase.firestore')->database()->collection('blog')->document($idBlog);
        $comment = $docRef->collection('comment')->document($id);

        $comment->delete();

        return redirect('/blogs');

}

}

