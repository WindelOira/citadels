@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'All Products'])
    Products
  @endpage_header
  
  <table class="table table-sm is-datatable" data-ajax="{{ route('admin.datatables.products') }}" data-columns='[{"name" : "title"}, {"name" : "content"}]'>
    <thead>
      <tr>
        <th>Title</th>
        <th>Content</th>
      </tr>
    </thead>
  </table>
@endsection