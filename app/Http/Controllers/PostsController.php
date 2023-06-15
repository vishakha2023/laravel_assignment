<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Posts::paginate(10);
        return view('user.posts.index', ['posts' => $posts]);
    }
    public function create()
    {
        return view('user.posts.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'desc'     => 'required',
            'postpic'     => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            if($request->hasFile('postpic'))
            {
                $file= $request->file('postpic');
                $fileName = $request->postpic->getClientOriginalName();
                $request->postpic->move(public_path('posts/image'), $fileName);
                Posts::create([
                    'name'    => $request->title,
                    'desc'     => $request->desc,
                    'img'     => $fileName,

                ]);
                DB::commit();

            }
            return redirect()->route('posts.index')->with('success','Post Created Successfully.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function edit(Posts $post)
    {dd($post->id);
        return view('user.posts.edit')->with([
            'post'  => $post
        ]);
    }
    public function update(Request $request, Posts $post)
    {
        // Validations
        $request->validate([
            'title'    => 'required',
            'desc'     => 'required',
            // 'postpic'     => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            if($files = $request->file('postpic')) {
                $fileName = $request->postpic->getClientOriginalName();
                $request->postpic->move(public_path('posts/image'), $fileName);
                $post_updated = Posts::whereId($post->id)->update([
                    'name'    => $request->title,
                    'desc'     => $request->desc,
                    'img'     => $fileName,
                ]);
            }
            else{
                $post_updated = Posts::whereId($post->id)->update([
                    'name'    => $request->title,
                    'desc'     => $request->desc,
                ]);
            }
            DB::commit();
            return redirect()->route('posts.index')->with('success','Post Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function delete(Posts $post)
    {
        DB::beginTransaction();
        try {
dd($post->id);
            $post = Posts::where('id',$post->id)->delete();
            DB::commit();
            return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
