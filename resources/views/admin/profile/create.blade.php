@extends('layouts.profile')

@section('title', 'プロフィール')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>プロフィール新規登録</h2>
        <form action="{{ action('Admin\ProfileController@create') }}" method="post">
            @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
            <!--名前-->
            <div class="form-group">
                <label class="control-label">氏名(name)</label>
                <input type="text" class="form-control btn-info" name="name" value="{{ old('name') }}">
            </div>
            <!--性別-->
            <div class="form-group">
                <label class="control-label" style="width: 100%">性別(gender)</label>
                <div class="btn-group" data-toggle="buttons" style="width: 100%">
                    <label class="btn btn-primary">
                        <input type="radio" autocomplete="off" checked name="gender" value="男性">　男性
                    </label>
                    <label class="btn btn-danger">
                        <input type="radio" autocomplete="off" checked name="gender" value="女性">　女性
                    </label>
                    <label class="btn btn-success">
                        <input type="radio" autocomplete="off" checked name="gender" value="その他">　その他
                    </label>
                </div>
            </div>
            <!--趣味-->
            <div class="form-group">
                <label class="control-label">趣味(hobby)</label>
                <textarea class="form-control btn-info" name="hobby" value="{{ old('hobby') }}" style="height: 100px;"></textarea>
            </div>
            <!--自己紹介-->
            <div class="form-group">
                <label class="control-label">自己紹介欄(introduction)</label>
                <textarea class="form-control btn-info" name="introduction" value="{{ old('introduction') }}" style="height: 300px;"></textarea>
            </div>
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary p-30px" value="更新">
        </form>
        </div>
    </div>
</div>
@endsection