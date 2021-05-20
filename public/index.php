<?php


use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FirestoreClient;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Firebase\Auth\Token\Exception\InvalidToken;
use App\Models\User;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
  require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);




$factory = (new Factory)
->withServiceAccount("C:\devweb\my-project\immigrant-6dd30-firebase-adminsdk-hxxfq-1951aaa94f.json");
$guzzleClient = new Client(['verify' => false]);
$firestore = new FirestoreClient([
    'authHttpHandler' => function (RequestInterface $request, array $options = []) use ($guzzleClient) {
        return $guzzleClient->send($request, $options);
    },
    'projectId' => 'immigrant-6dd30',
]);
$firestore = $factory->createFirestore();
$database = $firestore->database();
$collectionReference = $database->collection('blog');
$documentReference = $collectionReference->document('coyIfcOE7j64fE0XTbmE');
$snapshot = $documentReference->snapshot();
//echo "The name of blog is " . $snapshot['name'];
$auth = $factory->createAuth();


