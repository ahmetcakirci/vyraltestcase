<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create(Request $request){
        //Post::factory()->count(20)->create();

        $data = $request->only('user_id');
        $validator = Validator::make($data, [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false,'error' => $validator->messages()], 200);
        }
        $userId=$request->user_id;

        $jsonData = Http::get(sprintf('%s/posts',env('FAKE_API_URL')))->body();
        $_data=json_decode($jsonData,true);

        $filterArr=array_filter($_data,function($array)use ($userId) {
            return $array['userId']==$userId;
        });
        foreach ($filterArr as $item){
            $post = Post::create([
                'user_id' => $request->user_id,
                'context' => $item['body'],
                'status' => 0,
                'create_date' => now(),
            ]);
        }

        return response()->json(['success'=>true,'message' => 'Success create post'], 200);
    }

    public function read(Request $request){
        $data = $request->only('user_id');
        $validator = Validator::make($data, [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false,'error' => $validator->messages()], 200);
        }
        $userId=$request->user_id;

        $jsonData = Http::get(sprintf('%s/posts',env('FAKE_API_URL')))->body();
        $_data=json_decode($jsonData,true);

        $filterArr=array_filter($_data,function($array)use ($userId) {
            return $array['userId']==$userId;
        });

        return response()->json(['success'=>true,'return' => $filterArr], 200);
    }

    public function readAll(){
        $data = Http::get(sprintf('%s/posts',env('FAKE_API_URL')))->body();
        return response()->json(['success'=>true,'return' => json_decode($data,true)], 200);
    }
}
