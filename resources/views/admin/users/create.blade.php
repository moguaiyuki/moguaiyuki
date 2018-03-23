@extends('layouts.admin')

@section('content')

    <h1>ユーザー登録</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'Admin\UsersController@store', 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('image_id', 'アイコン:') !!}
        {!! Form::file('image_id', null, ['class'=>'form-control']) !!}
    </div>
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

    @include('includes.form_error')

@stop