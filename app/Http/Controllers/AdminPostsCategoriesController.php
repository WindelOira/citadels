<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Category;
use App\Media;

class AdminPostsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $parent = Category::whereNull('parent')
                ->orWhere('parent', 0)
                ->where('type', 'post')
                ->get()
                ->pluck('title', 'id')
                ->prepend('Select Parent Category');

      return view('admin.posts.categories', compact('parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $parent = Category::whereNull('parent')
                ->orWhere('parent', 0)
                ->where('type', 'post')
                ->get()
                ->pluck('title', 'id')
                ->prepend('Select Parent Category');

      return view('admin.posts.categories', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();
      $data['type'] = 'post';

      $category = Category::create($data);

      if( ! empty($request->_media) ) :
        $media = Media::findOrFail($request->_media);

        $media->categories()->save($category);
      endif;

      session()->flash('success', 'Product category has been added successfully.');

      return redirect()->route('admin.posts.categories.index');
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
      $category = Category::findOrFail($id);

      $parent = Category::whereNull('parent')
                ->orWhere('parent', 0)
                ->where('type', 'post')
                ->get()
                ->pluck('title', 'id')
                ->prepend('Select Parent Category');

      return view('admin.posts.categories', compact('category', 'parent'));
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
      $category = Category::findOrFail($id);

      $data = $request->all();
      $data['type'] = 'post';

      $category->update($data);

      if( ! empty($request->_media) ) :
        $media = Media::findOrFail($request->_media);
        
        DB::table('mediaables')
          ->whereMediaableId($category->id)
          ->update([
            'media_id'  => $request->_media
          ]);
      endif;

      session()->flash('success', 'Post category has been updated successfully.');

      return redirect()->route('admin.posts.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Category::findOrFail($id)->delete();

      session()->flash('deleted', 'Product category has been deleted.');

      return response()->json('success', 200);
    }
}
