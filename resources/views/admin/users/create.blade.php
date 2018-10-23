@extends('layouts.admin')

@section('content')
  @page_header(['title' => 'New User'])
    Users
  @endpage_header

  {!! Form::open([
    'route'     => 'admin.users.store',
    'files'     => TRUE,
  ]) !!}
  <div class="row">
    <div class="col-lg-4">
      <div class="card card-small mb-4 pt-3">
        <div class="card-header border-bottom text-center">
          <div class="mb-3 mx-auto">
            <img class="rounded-circle" src="images/avatars/0.jpg" alt="User Avatar" width="110"> </div>
          <h4 class="mb-0">Sierra Brooks</h4>
          <span class="text-muted d-block mb-2">Project Manager</span>
          <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2">
            <i class="material-icons mr-1">person_add</i>Follow</button>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item px-4">
            {{ Form::bsSelect('role', array_pluck($roles, 'title', 'id')) }}
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Account Details</h6>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item p-3">
            <div class="row">
              <div class="col">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      {{ Form::bsText('first_name', NULL, ['placeholder' => 'First Name']) }}
                    </div>
                    <div class="form-group col-md-6">
                      {{ Form::bsText('last_name', NULL, ['placeholder' => 'Last Name']) }}
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      {{ Form::bsText('email', NULL, ['placeholder' => 'Email']) }}
                    </div>
                    <div class="form-group col-md-6">
                      {{ Form::bsPassword('password', ['placeholder' => 'Password']) }}
                    </div>
                  </div>
                  <div class="form-group">
                    {{ Form::bsText('address', NULL, ['placeholder' => '1234 Main St']) }}
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      {{ Form::bsText('city') }}
                    </div>
                    <div class="form-group col-md-4">
                      {{ Form::bsSelect('state', [], NULL, ['placeholder' => 'Choose...']) }}
                    </div>
                    <div class="form-group col-md-2">
                      {{ Form::bsText('zip') }}
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      {{ Form::bsTextarea('description', NULL, ['rows' => 5]) }}
                    </div>
                  </div>
                  {{ Form::bsButton('save', NULL, 'submit', ['title' => 'Save Account', 'class' => 'btn btn-accent']) }}
                </form>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
@endsection