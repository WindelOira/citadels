<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Media;
use App\Http\Requests\AdminPostRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::where([
                      ['parent', 0],
                      ['type', 'post']
                    ])
                    ->orWhereNull('parent')
                    ->get();

      return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPostRequest $request)
    {
      $data = $request->all();
      $data['content'] = base64_encode($data['content']);
      $data['status'] = $data['save'];

      $post = Post::create($data);

      if( isset($data['categories']) && is_array($data['categories']) ) :
        foreach( $data['categories'] as $key => $value ) :
          $category = Category::findOrFail($value);

          $category->posts()->save($post);
        endforeach;
      endif;

      if( ! empty($request->_media) ) : 
        $media = Media::findOrFail($request->_media);

        $post->medias()->save($media);
      endif;

      session()->flash('success', $data['save'] == 'publish' ? 'Post saved successfully.' : 'Post saved as draft.');

      return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);
      $categories = Category::where([
                      ['parent', 0],
                      ['type', 'post']
                    ])
                    ->orWhereNull('parent')
                    ->get();

      return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
