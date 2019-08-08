@extends('layouts.app')

@section('title', 'Manage Images')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Images</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Image</th>
                                <th>Caption</th>
                                <th>Size</th>
                                <th>Uploaded</th>
                            </tr>
                            @foreach ($images as $image)
                                <tr>
                                    <th><img width="100px" src="{{$image->url}}"></th>
                                    <td>{{$image->title}}</td>
                                    <td>{{$image->size_in_kb}} KB</td>
                                    <td>{{date_format($image->created_at,"H:i:s d/m/Y")}}</td>
                                    <td>
                                        <form action="{{ route('deleteImage', $image->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </form></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
