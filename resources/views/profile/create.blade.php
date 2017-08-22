@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">create a new account</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
    {!! Form::open(['action' => ['ProfileController@store'], 'class'=>'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('role', 'Role',['class'=>'col-md-4 control-label'])}}
                <div class="col-md-6">
                  <select class="form-control" name="role_id" id="role_id">
                    @foreach($roles as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4 control-label">
              </div>
              <div class="col-md-6">
              {{Form::submit('Create', ['class'=>'btn btn-success'])}}
              </div>
            </div>
        {!! Form::close() !!}
      </div>
  </div>

  @endsection
  <!-- javascripts -->
  {!!Html::script('js/jquery.js')!!}
<script type="text/javascript">
  $('select').on('change',function(){
    var role_id =  $( "select option:selected" ).val();
    });
  </script>
