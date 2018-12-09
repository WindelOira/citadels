<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CategoriesRequests;
use App\Media;
use App\MediaMeta;
use App\Category;

class AdminProductCategoriesController extends Controller
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
                ->where('type', 'product')
                ->get()
                ->pluck('title', 'id')
                ->prepend('Select Parent Category');

      return view('admin.products.categories.index', compact('parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.products.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequests $request)
    {
      $category = Category::create($request
                          ->merge(['type' => 'product'])
                          ->all());

      if( ! empty($request->_media) ) : 
        $media = Media::findOrFail($request->_media);

        $category->medias()->save($media);
      endif;

      session()->flash('success', 'Product category has been added successfully.');

      return redirect()->route('admin.products.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Category::findOrFail($id)->media;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $parent = Category::whereNull('parent')
                ->where('type', 'product')
                ->get()
                ->pluck('title', 'id')
                ->prepend('Select Parent Category');

      $category = Category::findOrFail($id);

      return view('admin.products.categories.index', compact('parent', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequests $request, $id)
    {
      $data = $request->all();
      $data['type'] = 'product';

      Category::findOrFail($id)->update($data);

      session()->flash('success', 'Product category has been updated successfully.');

      return redirect()->route('admin.products.categories.index');
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
