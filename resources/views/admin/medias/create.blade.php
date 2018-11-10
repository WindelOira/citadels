@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'New Media'])
    All
  @endpage_header

  <div class="row">
    <div class="col-12">
      {!! Form::open([
        'route'     => 'admin.medias.store',
        'files'     => TRUE,
        'class'     => 'dropzone'
      ]) !!}
        
      {!! Form::close() !!}
    </div>
  </div>
@endsection