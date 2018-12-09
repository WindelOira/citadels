<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Media;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.products.index');
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
                      ['type', 'product']
                    ])
                    ->orWhereNull('parent')
                    ->get();

      return view('admin.products.create', compact('categories'));
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
      $data['content'] = base64_encode($data['content']);
      $data['status'] = $data['save'];

      $product = Product::create($data);

      if( isset($data['categories']) && is_array($data['categories']) ) :
        foreach( $data['categories'] as $key => $value ) :
          $category = Category::findOrFail($value);

          $category->products()->save($product);
        endforeach;
      endif;

      if( ! empty($request->_media) ) : 
        $media = Media::findOrFail($request->_media);

        $product->medias()->save($media);
      endif;

      session()->flash('success', $data['save'] == 'publish' ? 'Product saved successfully.' : 'Product saved as draft.');

      return redirect()->route('admin.products.edit', $product);
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
      $product = Product::findOrFail($id);
      $categories = Category::where([
                      ['parent', 0],
                      ['type', 'product']
                    ])
                    ->orWhereNull('parent')
                    ->get();

      return view('admin.products.edit', compact('product', 'categories'));
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
      $product = Product::findOrFail($id);

      return view('admin.products.edit', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Product::findOrFail($id)->delete();

      session()->flash('danger', 'Product deleted successfully.');

      return response()->json('success', 200);
    }
}
