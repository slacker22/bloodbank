<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [

            'username' => 'required|string',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 401);
        }else  if(Auth::attempt(['user_name' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['user_type']= $user->type->name;
            $success['user_type_id']= $user->type->id;
            if($user->type->id == 5 )
            {
                $success['id']= $user->donor->id;
            }
            else{
                $success['id']= $user->staff->id;
            }


            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Invalid Credentials'], 401);
        }
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $success=[];
        $validator = $this->validateUserData($request->all());
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 401);
        }
        $this->createUser($request->all());
        return response()->json(['success'=>$success], $this-> successStatus);
    }

    public function validateUserData($data)
    {
        $rules=[
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
        return Validator::make($data,$rules);
    }



    public function createUser($data)
    {
//lowercase all the characters
        //remove any space
        // elbahr combine firstname + space + lastname
        $data['password'] = bcrypt($data['password']);
        return User::create([
            'full_name'=>$data['full_name'],
            'email'=>$data['email'],
            'password'=>$data['password']
        ]);
    }

    public function index()
    {

   }

    public function show(User $user)
    {

}

    public function successAction($user)
    {
        $success['token'] =  $user->createToken('auth_token')-> accessToken;
        $success['full_name'] =  $user->full_name;
        return $success;
    }
}
