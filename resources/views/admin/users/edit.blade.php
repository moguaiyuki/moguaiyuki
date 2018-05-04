@extends('layouts.admin')

@section('content')

    <h1>ユーザー編集</h1>

    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['Admin\UsersController@update', $user->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <!-- laravel file manager -->
    <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> 画像選択
            </a>
        </span>
        <input id="thumbnail" class="form-control" type="text" name="filepath">
    </div>
    <img id="holder" style="margin-top:15px;max-height:100px;">
    <!-- /laravel file manager -->
    <div class="form-group">
        {!! Form::label('email', 'メール:') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', '権限:') !!}
        {!! Form::select('role_id', [''=>'選択してください'] + $roles , null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'パスワード:') !!}
        {!! Form::password('password', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@stop