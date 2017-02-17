@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Channel Setting</div>

                    <div class="panel-body">
                        <form action="/channel/{{$channel->slug}}/edit" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{old('name')?old('name'):$channel->name}}">
                                @if($errors->has('name'))
                                    <div class="help-block">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <div class="input-group">
                                    <div class="input-group-addon">{{config('app.url')}}</div>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                           value="{{old('slug')?old('slug'):$channel->slug}}">
                                </div>
                                @if($errors->has('slug'))
                                    <div class="help-block">
                                        {{$errors->first('slug')}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="slug">Description</label>
                                <textarea name="description" id="description" class="form-control">
                                    {{old('description')?old('description'):$channel->description}}
                                </textarea>
                                @if($errors->has('description'))
                                    <div class="help-block">
                                        {{$errors->first('description')}}
                                    </div>
                                @endif
                            </div>

                            <button class="btn btn-default" type="submit">提交</button>

                            {{csrf_field()}}
                            {{method_field('PUT')}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
