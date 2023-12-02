<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
class UsersController extends Controller
{
    //
    public function index(Request $request){
        $where = [];
        if($request->name){
            $where[] = ['name', 'like', '%' . $request->name.'%'];
        }
        $users = User::orderBy('id', 'desc');
        if(!empty($where)){
            $users = $users->where($where);
        }
        $users = $users->paginate(1);
        if($users->count()){
            $status = 'success';
        }else{
            $status = 'no_data';
        }
//        $users = UserResource::collection($users);
        $users = UserCollection::collection($users, $status);

        $responses = [
            'status' =>$status,
            'data' => $users
        ];
        return $responses;
    }
    function detail($id){
        $user = User::find($id);
        $user = UserResource::collection($user);
        if(!$user){
            $status = 'no_data';
        } else{
            $status = 'success';
        }
        $responses = [
            'status' =>$status,
            'data' => $user
        ];
        return  $responses;
    }
    function create(Request $request, User $user){
        $request->validate([
            'name' => 'required|min:5',
            'email'  => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if($user->id){
            $responses = [
                'status' =>'success',
                'data' => $user
            ];
        } else{
            $responses = [
                'status' =>'error',
            ];
        }

        return $responses;
    }
    function update(Request $request,$id){
        $user = User::find($id);
        if(!$user){
            $responses = [
                'status' =>'no_data',
            ];
        }else{
            $method = $request->method();
            if($method == 'PUT'){
                $user->name = $request->name;
                $user->email = $request->email;
                if ( $user->password){
                    $user->password = Hash::make($request->password);
                } else {
                    $user->password = null;
                }
                $user->save();
                $response =  [
                    'status' => 'success',
                    'data' => $user
                ];
            }
        }
        return $response;
    }
    function delete(User $user) {
        $status = User::destroy($user->id);
        if ($status){
            $response = [
                'status' => 'success',
            ];
        }else{
            $response = [
                'status' => 'error',
            ];
        }
        return $response;
    }
}
