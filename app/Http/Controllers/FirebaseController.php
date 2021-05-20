<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 class FirebaseController extends Controller
 {
   protected $db;
   public function __construct() {
     $this->db = app('firebase.firestore')->database();

     //app('firebase.firestore')->database()->collection('blog')->document('c0gjI296bdH8j9AfXX0C')->delete();
   }
   public function index(Request $request)
   {
     $docRef = $this->db->collection('blog');
     $query = $docRef;
     if(isset($request->search))
       $query = $docRef->where('name', '=', 'malek');
     $documents = $query->documents();
     foreach ($documents as $document) {
       if ($document->exists()) {
         printf('Document data for document %s:' . PHP_EOL, $document->id());
         printf($document->data());
         printf(PHP_EOL);
       } else {
         printf('Document %s does not exist!' );
       }
     }

   try {
    $email = 'youremailaddress@gmail.com';
    $password = 'yourpassword';
    $authRef = app('firebase.auth')->createUser([
       'email' => $email,
      'password' => $password
    ]);
   $actionCodeSettings = [
        'continueUrl' => 'www.yoursite.com/homeeeee'
   ];
    app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);
    echo $authRef->uid; //This is unique id of inserted user.
}
catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
  echo 'email already exists';
}

   }



 }
