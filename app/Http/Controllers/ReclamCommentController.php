<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use SebastianBergmann\Environment\Console;


class ReclamCommentController extends Controller{
    protected $auth;
    // protected $redirectTo = RouteServiceProvider::HOME;
     public function __construct(FirebaseAuth $auth) {
        $this->middleware('guest');
        $this->auth = $auth;
     }


     public function create( $idblog,$id ,Request $request){
        try {
            $blog = app('firebase.firestore')->database()->collection('blog')->document($idblog);
            $comments = $blog->collection('comment')->document($id);
            $reclam = $comments->collection('reclam');

             $reclam->add([

            'message' => $request->message,

        ]);
     return redirect('/blogs');
         // echo $user->uid;
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
            echo $ex;
        }

    }
    public function index($idBlog,$id){
        try {

        $blog=  app('firebase.firestore')->database()->collection('blog')->document($idBlog);
        $comments = $blog->collection('comment')->document($id);
        $reclam = $comments->collection('reclam')->documents();

      //  $blog = $docRef;
        foreach ($reclam as $rec) {

            printf('First: %s' . PHP_EOL, $rec ['message']);
        }

     // echo $user->uid;
    } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
        echo $ex;
    }

    //return view ('user.index', compact('user'));
}








}
