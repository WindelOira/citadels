@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'New Product'])
    Products
  @endpage_header

	<div class="row">
		<div class="col-lg-9 col-md-12">
      <!-- Add New Post Form -->
      <div class="card card-small mb-3">
        <div class="card-body">
          {!! Form::open([
            'route'    => 'admin.products.store'
          ]) !!}
            <div class="form-group">
              {{ Form::bsText('title', NULL, ['placeholder' => 'Product Title']) }}
            </div>
            
            <div id="editor-container" class="add-new-post__editor mb-1"></div>
          {!! Form::close() !!}
        </div>
      </div>
      <!-- / Add New Post Form -->
    </div>
    <div class="col-lg-3 col-md-12">
      <!-- Post Overview -->
      <div class='card card-small mb-3'>
        <div class="card-header border-bottom">
          <h6 class="m-0">Actions</h6>
        </div>
        <div class='card-body p-0'>
          <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">flag</i>
                <strong class="mr-1">Status:</strong> Draft
                <a class="ml-auto" href="#">Edit</a>
              </span>
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">visibility</i>
                <strong class="mr-1">Visibility:</strong>
                <strong class="text-success">Public</strong>
                <a class="ml-auto" href="#">Edit</a>
              </span>
              <span class="d-flex mb-2">
                <i class="material-icons mr-1">calendar_today</i>
                <strong class="mr-1">Schedule:</strong> Now
                <a class="ml-auto" href="#">Edit</a>
              </span>
              <span class="d-flex">
                <i class="material-icons mr-1">score</i>
                <strong class="mr-1">Readability:</strong>
                <strong class="text-warning">Ok</strong>
              </span>
            </li>
            <li class="list-group-item d-flex px-3">
              <button class="btn btn-sm btn-outline-accent">
                <i class="material-icons">save</i> Save Draft</button>
              <button class="btn btn-sm btn-accent ml-auto">
                <i class="material-icons">file_copy</i> Publish</button>
            </li>
          </ul>
        </div>
      </div>
      <!-- / Post Overview -->
      <!-- Post Overview -->
      <div class='card card-small mb-3'>
        <div class="card-header border-bottom">
          <h6 class="m-0">Categories</h6>
        </div>
        <div class='card-body p-0'>
          <ul class="list-group list-group-flush">
          @if( count($categories) > 0 )
            <li class="list-group-item px-3 pb-2">
              @foreach( $categories as $category )
              <div class="custom-control custom-checkbox mb-1">
                <input type="checkbox" class="custom-control-input" id="{{ str_slug($category->title) }}">
                <label class="custom-control-label" for="{{ str_slug($category->title) }}">{{ $category->title }}</label>
              </div>
              @if( $category->isParent() )
              <ul class="list-group list-group-flush">
                <li class="list-group-item px-3 pb-2">
                  @foreach( $category->getChildren() as $child )
                  <div class="custom-control custom-checkbox mb-1">
                    <input type="checkbox" class="custom-control-input" id="{{ str_slug($child->title) }}">
                    <label class="custom-control-label" for="{{ str_slug($child->title) }}">{{ $child->title }}</label>
                  </div>
                  @endforeach
                </li>
              </ul>
              @endif
              @endforeach
            </li>
          @endif
            <li class="list-group-item d-flex px-3">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-white px-2" type="button">
                    <i class="material-icons">add</i>
                  </button>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- / Post Overview -->
    </div>
	</div>
@endsection

@section('scripts')
<script>
  var quill = new Quill('#editor-container');
</script>
@endsection