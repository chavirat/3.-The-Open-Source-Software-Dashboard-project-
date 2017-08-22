@extends('layouts.master')
@section('content')
@foreach($user as $user)
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{$user->name}}</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
    {!! Form::open(['action' => ['ProfileController@update', $user->id], 'class'=>'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name',['class'=>'col-md-4 control-label'])}}
                <div class="col-md-6">
                  {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'name'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('password', 'Password',['class'=>'col-md-4 control-label'])}}
                <div class="col-md-6">
                  {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'password'])}}
              </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email',['class'=>'col-md-4 control-label'])}}
                <div class="col-md-6">
                {{Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'email','disabled'])}}
              </div>
            </div>
              @endforeach
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
              {{Form::hidden('_method','PUT')}}
              </div>
              <div class="col-md-6">
              {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
              </div>
            </div>
        {!! Form::close() !!}
      </div>
  </div>
@endsection
<script type="text/javascript">
$('select').on('change',function(){
  var role_id =  $( "select option:selected" ).val();
  });
</script>
