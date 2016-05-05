@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-offset-2 col-lg-8 col-lg-offset-2 
                    col-md-offset-1 col-md-10 col-md-offset-1
                    col-sm-12">

            <div class="col-sm-12 col-xs-12 beerslist">

                @if (Session::has('flash_message'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }}
                </div>
                @endif
                @if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

                <!-- Current lists -->

                        <div class="panel panel-primary">
                            <div class="panel-heading" style="height:55px;">

                                <form action="/edit/{{$list->id}}" method="POST" class="form-horizontal">
                                    {{ csrf_field() }}

                                    <!-- List Name -->
                                    <div class="col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <input type="text" name="name" id="list-name" class="form-control" value="{{ $list->name }}">
                                        </div>
                                    </div>
                                    <!-- Add list Button -->
                                    <div class="col-sm-offset-1 col-xs-offset-1 col-sm-2 col-xs-2 new-list-button">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-btn fa-edit button expand"></i>Edit name
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                                <div class="panel-body">
                                    <!-- New Beer Form -->
                                    <form action="/beer" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}

                                        <!-- Beer Name -->
                                        <div class="form-group">

                                            <div class="col-sm-8 col-xs-8">
                                                <input type="text" name="name" id="beer-name" class="beer-name-{{ $list->id }} form-control" value="{{ old('beer') }}" placeholder="ex. Chouffe">
                                                <input type="hidden" name="beerid" id="beerid">
                                                <input type="hidden" name="beerslistid" id="beerslistid" value="{{ $list->id }}">
                                            </div>
                                            <div class="col-sm-2 col-xs-2">
                                                <button type="submit" name="add" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-plus button expand"></i>Add Beer
                                                </button>
                                            </div>
                                            <div class="col-sm-2 col-xs-2">
                                                <button type="submit" name="search" class="btn btn-default">
                                                    <i class="fa fa-btn fa-search button expand"></i>Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    @if(count($list->beers) > 0)
                                    <ul class="listing-beers">
                                    @foreach ($list->beers as $beer)
                                    <li><a href="/brewery/{{$beer->brewery->id}}">{{ $beer->brewery->name }}</a> <a href="/beer/{{$beer->id}}">"<strong>{{ $beer->name }}</strong>"</a>
                                        <div class="btn-group">
                                                <form action="/beer/{{ $list->id }}/{{ $beer->id }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="borderless-button btn-delete" onclick="return confirm('Are you sure you want to delete this item from your list?');">
                                                        <i class="fa fa-btn fa-trash"></i>
                                                    </button>
                                                </form>
                                    </div>
                                    </li>

                                    @endforeach
                                    </ul>
                                    @else
                                    <p><strong>Nothing here yet !</strong> <br>Add some items by typing the beer's (or the brewery's) first letters above.</p>
                                    @endif

                                </div>
                        </div>
                        <div class="btn-group">
                        <a class="btn btn-default" href="/lists">
                            <i class="fa fa-btn fa-chevron-left"></i>Back
                        </a>
                        </div>
                        <div class="btn-group">
                            <form action="/list/{{ $list->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-task-{{ $list->id }}" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Delete "{{ $list->name }}" ?
                            </button>
                            </form>
                        </div>

            </div>

    </div>
</div>
@endsection
