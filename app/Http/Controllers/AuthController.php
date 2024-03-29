<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
//use App\Models\Subregions;



class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email Or Password Does\'t exist'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function signup(SignupRequest $request){

        User::create($request->all());
        return $this->login($request);

    }

    public function show($id)
    {
       Users::findOrFail($id);
		return response()->json($users);
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
        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL() * 60,
        //     'user' => auth()->user()->name
            return response()->json([
            'access_token' => $token,
            // 'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            'designation' => auth()->user()->designation,
            'user_id' => auth()->user()->user_id

        ]);
    }
	
	// public function dependent(Request $request)
    // {

    //     /** dependency dropdown code start**/

    //     $region_id = $request->region_id;
    //     $subregionsModel = new Subregions();
    //     $data = $subregionsModel->getSubregion($region_id);
    //     return response()->json($data);
 
    //     /** dependency dropdown code end**/
        
    // }

}