<?php

namespace App\Http\Controllers\Apis\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuthLoginRequest;
use App\Http\Requests\Api\V1\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Log;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request){
        try{
            $data = $request->dto;

            $user = User::create([
                'name'=>$data->name , 
                'email'=>$data->email , 
                'password'=>Hash::make($data->password),
            ]);

            $tokenResult = $user->createToken('auth_token');
            $token = $tokenResult->plainTextToken;
            
            $tokenResult->accessToken->update([
                'expires_at'=>now()->addHour(),
            ]);

            return response()->json([
                'user'=> new UserResource($user),
                'token'=>$token , 
                'message'=>'User succeffully created',
                'token_type'=>'Bearer',
                'success'=>true 
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'message'=>'Error occured while registerd',
                'error'=>env('APP_DEBUG') ? $e->getMessage() : null , 
                'success'=>false 
            ],500);
        }
        
    }

    public function login(AuthLoginRequest $request){
        try{

            $request->authenticate();
            $user = Auth::user();
            
            $tokenResult = $user->createToken('auth_token');
            
            $token = $tokenResult->plainTextToken;
            $tokenResult->accessToken->update([
                'expires_at'=>now()->addHour(),
            ]);
            
            return response()->json(data: [
                'message'=>'logged succeffuly',
                'user'=>new UserResource($user),
                'token'=>$token,
                'token_type'=>'Bearer',
            ]);
        }catch(Exception $e){
            Log::error('Login Error: '.$e->getMessage(), [
                // 'trace' => $e->getTraceAsString(),   
                'error'=>$e->getMessage(),
            ]);
            
            return response()->json([
                'message'=>'Invalid creadiantions',
                'error'=>env('APP_DEBUG') ? $e->getMessage():null , 
                'success'=>false
            ],500);
        }
        
    }

    public function me(Request $request){
        try{
            return new UserResource($request->user());
        }catch(Exception $e){
            return response()->json(['message'=>'Error occured during profile','error'=>env('APP_DEBUG')?$e->getMessage():null,'success'=>false],401);
        }
    }
    
    public function logout(Request $request){
        try{
            $user = $request->user() ; 
            if($request->has('allTokens')){
                $user->tokens()->delete();
            }
            $user->currentAccessToken()->delete();
            return response()->json([
                'message'=>'Logout succeffully',
                'success'=>true , 
            ],200);

        }catch(Exception $e){
            return response()->json([
                'message'=>'Server error',
                'e'=>env('APP_DEBUG')?$e->getMessage():null,
            ],500);
        }
    }


}
