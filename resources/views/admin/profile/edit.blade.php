@extends('layouts.profile')
@section('title', 'プロフィールの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <!--名前-->
                    <div class="form-group">
                        <label class="control-label" for="name">氏名(name)</label>
                        <input type="text" class="form-control btn-info" name="name" value="{{ $profile_form->name }}">
                    </div>
                    <!--性別-->
                    <div class="form-group">
                        <label class="control-label" style="width: 100%">性別(gender)</label>
                        <div class="btn-group" data-toggle="buttons" style="width: 100%">
                            <label class="btn btn-primary">
                                <input type="radio" autocomplete="off" checked name="gender" value="{{ $profile_form->gender }}">　男性
                            </label>
                            <label class="btn btn-danger">
                                <input type="radio" autocomplete="off" checked name="gender" value="{{ $profile_form->gender }}">　女性
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" autocomplete="off" checked name="gender" value="{{ $profile_form->gender }}">　その他
                            </label>
                        </div>
                    </div>
                    <!--趣味-->
                    <div class="form-group">
                        <label class="control-label">趣味(hobby)</label>
                        <textarea class="form-control btn-info" name="hobby" value="{{ old('hobby') }}" style="height: 100px;">{{ $profile_form->hobby }}</textarea>
                    </div>
                    <!--自己紹介-->
                    <div class="form-group">
                        <label class="control-label">自己紹介欄(introduction)</label>
                        <textarea class="form-control btn-info" name="introduction" value="{ $profile_form->introduction }}" style="height: 300px;">{{ $profile_form->introduction }}</textarea>
                    </div>
            
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->changelogs != NULL)
                                @foreach ($profile_form->changelogs as $changelog)
                                    <li class="list-group-item">{{ $changelog->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection