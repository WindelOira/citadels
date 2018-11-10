<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Media;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.medias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.medias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if( $request->hasFile('file') ) :
        $file = $request->file;

        $media = Media::create([
          'title'       => chop($file->getClientOriginalName(), '.'. $file->getClientOriginalExtension()),
          'ext'         => $file->getClientOriginalExtension()
        ]);

        $media->addMeta([
          'mime_type'   => $file->getMimeType(),
          'size'        => $file->getClientSize()
        ]);

        $request->file('file')->storeAs($media->generateUploadLocation(), $media->media_file);

        return response()->json('success', 200);
      endif;
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
      $media = Media::findOrFail($id);

      return view('admin.medias.edit', compact('media'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $media = Media::findOrFail($id);

      $media->delete();

      session()->flash('deleted', 'Media item has been deleted.');

      return response()->json('success', 200);
      //return redirect()->route('admin.medias.index');
    }
}
