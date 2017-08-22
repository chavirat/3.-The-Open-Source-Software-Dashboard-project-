@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">profile</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-2">
    <a href="/profile/create" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Create</a>
  </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12">
     @if(count($users)>0)
       <table class="table table-striped">
         <tr>
           <th>Name</th>
           <th>Email</th>
           <th>Role</th>
           <th>Created at</th>
           <th>Updated at</th>
           <th></th>
         </tr>
          @foreach($users as $user)
          <tr>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->role_name}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td><a href="/profile/{{$user->id}}/edit" class="btn btn-primary">Edit</a>
                {!!Form::open(['action' => ['ProfileController@destroy', $user->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
              </td>
            </tr>
          @endforeach
        </table>
      @else
        <p>No user accounts found</p>
    @endif
  </div>
</div>
@endsection
