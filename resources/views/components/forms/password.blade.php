{!! Form::label($name, NULL, ['class' => 'control-label']) !!}
{!! Form::password($name, array_merge(['class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control'], $attr)) !!}
@if( $errors->has($name) )
  @foreach( $errors->get($name) as $error )
  <div class="invalid-feedback">{{ $error }}</div>
  @endforeach
@endif