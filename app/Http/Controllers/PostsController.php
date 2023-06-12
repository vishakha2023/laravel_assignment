<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
Use DB;

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
            // 'postpic'     => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // DB::beginTransaction();
        try {

            // $destinationPath = 'posts/images';
            // // $myimage = $request->postpic->getClientOriginalName();
            // $request->postpic->move(public_path($destinationPath));

    //         $imageName = time() . '.' . $request->postpic->extension();
    // $request->postpic->move(public_path('posts/images'));
    // if($file = $request->hasFile('postpic')) {
        $file = $request->file('postpic') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/posts/images' ;
            $file->move($destinationPath,$fileName);
    // $request->postpic->storeAs('public/posts/images', $imageName);

            Posts::create([
                    'name'    => $request->title,
                    'desc'     => $request->desc,
                    'img'     => $request->postpic,

                ]);
                // DB::commit();
    // }

            return redirect()->route('posts.index')->with('success','Post Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function edit(Posts $post)
    {
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
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $post_updated = Posts::whereId($post->id)->update([
                'name'    => $request->title,
                'desc'     => $request->desc,
            ]);

            DB::commit();
            return redirect()->route('posts.index')->with('success','Post Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
