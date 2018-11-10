@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'Media'])
    All
  @endpage_header

  <div class="row">
    <div class="col-12">
      <table class="file-manager file-manager-list d-none is-datatable table-responsive" data-ajax="{{ route('admin.datatables.medias') }}" data-columns='[{"name" : "id", "orderable" : false, "searchable" : false}, {"name" : "title"}, {"name" : "size"}, {"name" : "type"}]'>
        <thead>
          <tr>
            <th colspan="5" class="text-left bg-white">
              {!! Form::open([
                'route'     => 'admin.medias.store',
                'files'     => TRUE,
                'class'     => 'dropzone'
              ]) !!}
                
              {!! Form::close() !!}
            </th>
          </tr>
          <tr>
            <th width="50" class="hide-sort-icons px-3">
              <div class="custom-control custom-checkbox w-auto">
                <input type="checkbox\" class="custom-control-input" id="all__checkbox" value="0">
                <label class="custom-control-label" for="all__checkbox"></label>
              </div>
            </th>
            <th class="text-left">Name</th>
            <th>Size</th>
            <th>Type</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection