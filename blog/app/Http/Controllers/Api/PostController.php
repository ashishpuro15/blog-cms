<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        if(count($posts)>0){
            //post exists
            $response=[
                'message'=>count($posts).' posts found',
                'status'=>1,
                'data'=>$posts
            ];
            
        }else{
            //doesn't exist
            $response=[
                'message'=>count($posts).'posts found',
                'status'=>0,
            ];
        }
            return view('home')->with('posts',$posts);
            // return response()->json($response, 200);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>['required'],
            'content'=>['required'],
            'author'=>['required'],
            'publication_date'=>['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }else{
            $data=[
                'title'=>$request->title,
                'content'=>$request->content,
                'author'=>$request->author,
                'publication_date'=>$request->publication_date
            ];
            DB::beginTransaction();
            try{
                $post=Post::create($data);
                DB::commit();
                return redirect('home')->with('status','Post created successfully');
            } catch(\Exception $e){
                p($e->getMessage());
                $post=null;
            }
            if($post != null){
                return response()->json([
                    'message'=>'Post added successfully'
                ],200);
            }else{
                return response()->json([
                    'message'=>'Internal server error'
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::find($id);
        return view('blogs.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post=Post::find($id);
        if(is_null($post)){
            return response()->json(
                [
                    'status'=>0,
                    'message'=>'Post does not exist'
                ],
            );
        }else{
            DB::beginTransaction();
            try{
                    $post->title=$request['title'];
                    $post->content=$request['content'];
                    $post->author=$request['author'];
                    $post->publication_date=$request['publication_date'];
                    $post->save();
                    DB::commit();
                    return redirect('/home')->with('success','Post updated successfully');
                }
                catch(\Exception $err){
                    DB::rollBack();
                    $post=null;
                }
                if(is_null($post)){
                    return response()->json([
                        'status'=>0,
                        'message'=>'Internal server error',
                        'error_msg'=>$err->getMessage()
                    ],
                    500
                );
                } else{
                    return response()->json([
                        'status'=>0,
                        'message'=>'Post updated successfully'
                    ], 
                    200
                );
                }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);
        if(is_null($post)){
            $response=[
                'message'=>"Post doesn't exist",
                'status'=>0
            ];
            $respCode=404;
        }else{
                DB::beginTransaction();
                try{
                    $post->delete();
                    DB::commit();
                    $response=[
                        'message'=>"Post deleted successfully",
                        'status'=>1
                    ];
                    $respCode=200;
                } catch(\Exception $err){
                    DB::rollBack();
                    $response=[
                        'message'=>"Internal Server Error",
                        'status'=>0
                    ];
                    $respCode=500;
                }
        }
        return redirect('home')->with('status','Post deleted successfully');
        // return response()->json($response,$respCode);
    }
}
