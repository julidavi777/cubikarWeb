<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccountNotificationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use SplFileInfo;
use Symfony\Component\HttpFoundation\File\File;
use SebastianBergmann\FileIterator\Factory;


class AuthController extends Controller
{

    public function showLogin(){
        return view('auth.login');
    }

     /**
      * Create a new AuthController instance.
      *
      * @return void
      */
     public function __construct()
     {
        //  $this->middleware('auth:api', ['except' => ['login', 'register', 'test', 'verifyAccount']]);
     }


     public function login(Request $request)
     {
         $credentials = request(['email', 'password']);

         $token = auth()->attempt($credentials);
         if (! $token) {
             return response()->json(['error' => 'Unauthorized login'], 401);
         }

         $user = User::where('email', $request->post('email'))->first();

         if(is_null($user->email_verified_at)){
             return response()->json(['message' => 'You need verify your email'], 401);
         }

         DB::table('users')->where('email', $request->post('email'))->update(['token_session' => $token]);

         $user = User::where('email', $request->post('email'))->first();

         $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
         $userRole = $user->getRoleNames();
         return 'yes';
        }

     public function getUserByRawToken($token){
         $user = User::where('token_session', $token)->first();

         return $user;
     }

     /**
      * Get the authenticated User.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function me()
     {
         return response()->json(auth()->user());
     }

      /**
      * Log the user out (Invalidate the token).
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function logout()
     {
         auth()->logout();

         return response()->json(['message' => 'Successfully logged out']);
     }

     /**
      * Refresh a token.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function refresh()
     {
         return $this->respondWithToken(auth()->refresh());
     }

     /**
      * Get the token array structure.
      *
      * @param  string $token
      *
      * @return \Illuminate\Http\JsonResponse
      */
     protected function respondWithToken($token)
     {
         return response()->json([
             'access_token' => $token,
             'token_type' => 'bearer',
             'expires_in' => auth('web')->factory()->getTTL() * 60
         ]);
     }

     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'surname' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
             'role_id' => 'required|exists:roles,id',
         ]);

         if ($validator->fails()) {
             return response()->json([
                 'is_error' => true,
                 'message' => $validator->errors()], 422);
         }




         return DB::transaction(function() use ($request) {
             try{
                 $user = User::create([
                     'name' => $request->name,
                     'surname' => $request->surname,
                     'email' => $request->email,
                     'password' => Hash::make($request->password),
                 ])->assignRole($request->role_id/* Role::where('id', $request->role_id)->first()['name'] */);

                 $token = Auth::login($user);


                 try {
                     $myEmail = $user->email;
                     Mail::to($myEmail)->send(new VerifyAccountNotificationMail($token));

                     return response()->json([
                         'is_error' => false,
                         'message' => 'User created successfully',
                         'user' => $user,
                         'Auth' => [
                             'token' => $token,
                             'type' => 'bearer',
                         ]
                     ]);
                 } catch (\Throwable $ex) {
                     DB::rollback();
                     return response()->json(['status' => false, 'message' => 'something went wrong send email'.$ex], 400);
                 }

             }catch (\Exception $ex) {
                 DB::rollback();
                  throw $ex;
                 return response()->json(['status' => false, 'message' => 'something went wrong registro dog o usuario'.$ex], 400);
             }


         });
     }

     public function verifyAccount(Request $request){
         $user = auth()->user();

         if(is_null($user)){
             return response()->json(['message' => 'User not found, token expired'], 422);
         }

         $updated = User::where('id', $user->id)->update([
             'email_verified_at' => Carbon::now()
         ]);

         if($updated){
             return response()->json(['message' => 'Account verified']);
         }
         return response()->json(['message' => 'Error account not verified']);
     }

     public function test(Request $request){

	     $password = 'iVBORw0KGgo';

	     $hashedPassword = Hash::make($password);
        return "hh"; 
         $path = storage_path() . "\app\capitulacion.json"; 
         $json = json_decode(file_get_contents($path), true); 
         return $this->printArray($json);
        
       
         /* Permission::create([
             'name' => 'admin.commercialOffers.update',
             'description' => 'Actualizar ofertas'
         ])->syncRoles([1]);

         return "hellow"; */
         /* $user = User::where('id', 1)->first();

         dd($user->getAllPermissions()->pluck('name')->toArray()) ; */
       //  USERS perms
         /* Permission::create([
             'name' => 'admin.users.index',
             'description' => 'Registrar usuarios'
         ])->syncRoles([1]);
         Permission::create([
             'name' => 'admin.users.store',
             'description' => 'Actualizar usuarios'
         ])->syncRoles([1]);
         Permission::create([
             'name' => 'admin.users.update',
             'description' => 'Actualizar usuarios'
         ])->syncRoles([1]);

         Roles perms
         Permission::create([
             'name' => 'admin.roles.index',
             'description' => 'Registrar roles'
         ])->syncRoles([1]);
         Permission::create([
             'name' => 'admin.roles.store',
             'description' => 'Actualizar roles'
         ])->syncRoles([1]);
         Permission::create([
             'name' => 'admin.roles.update',
             'description' => 'Actualizar roles'
         ])->syncRoles([1]); */

     }

     function printArray($arr, $pad = 0, $padStr = "\t") {
         $outerPad = $pad;
         $innerPad = $pad + 1;
         $out = '[' . PHP_EOL;
         foreach ($arr as $k => $v) {
             if (is_array($v)) {
                         $out .= str_repeat($padStr, $innerPad)  . $this->printArray($v, $innerPad) .", \n";
             } else {
                 $out .= str_repeat($padStr, $innerPad) .'"'. $k .'"'. ' => ' . (is_int($v) ? $v:'"'.$v.'"') ;
                 $out .= PHP_EOL;
             }
         }
         $out .= str_repeat($padStr, $outerPad) . ']';
         return $out;
     }
}
 //hacer api y ruta de login pendiente
