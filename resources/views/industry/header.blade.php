<div class="row">
  <div class="col-lg-12 page-header">
    {!! Form::open(['class'=>'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
          {{Form::label('sector', 'Sector :',['class'=>'col-md-2 control-label'])}}
          <div class="col-md-3">
            <select id="sector_id" class="form-control" onchange="window.location.href = this.value" name="select">
              @foreach($sectors as $s)
                <option value="{{$s->id}}">{{$s->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
  {!! Form::close() !!}
</div>
</div>
