@extends('layouts.admin')
@section('header')
    All Media
@endsection
@section('content')

    @if(Session::has('deleted_photo'))
        <p class="alert alert-danger">{{session('deleted_photo')}}</p>
    @endif

    <form action="delete/photos" method="post" class="form-inline">
        {{csrf_field()}}
        {{method_field('delete')}}
        <div class="form-group">
            <select name="checkBoxArray" class="form-control">
                <option  value="">Delete</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="" class="btn btn-primary ">
        </div>


    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col"><input type="checkbox" id="options"></th>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Belongs To</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Delete</th>


        </tr>
        </thead>
        <tbody>
        @if($records)

            @foreach($records as $record)
                <tr>
                    <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value={{$record->id}}></td>

                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img height="60px" width="40px" src="{{$record->path}}" alt=""></td>
                    <td>
                        @if($record->user) {{'User/ ' . $record->user->name }}
                        @elseif($record->post) {{'Post/ ' . $record->post->title }}
                        @else{{'none'}}
                        @endif

                    </td>
                    <td>{{$record->created_at->diffForHumans()}}</td>
                    <td>{{$record->updated_at->diffForHumans()}}</td>
                    <td><a href="/admin/photos/delete/confirm/{{$record->id}}" class="btn btn-danger">Delete</a></td>
                </tr>

            @endforeach
        @endif
        </tbody>
    </table>
    <a href="{{asset(route('admin.posts.create'))}}" class="btn btn-success">Create Posts</a>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$records->render()}}
        </div>
    </div>
    </form>
@endsection
@section('scripts')
    <script>
    $(document).ready(function(){

        $('#options').click(function(){

            if(this.checked){
                $('.checkBoxes').each(function(){
                   this.checked = true ;
                });
            }else{
                $('.checkBoxes').each(function(){
                    this.checked = false ;
                });
            }

    });

    });
    </script>
@endsection

