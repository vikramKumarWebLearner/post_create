@extends('layouts.app')

@section('content')
       <div class="container">
            <div class="row">
                <div class="col-md-10 mt-5 m-auto">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="m-2 text-center">Category Edit</h4>
                                <form action="{{ route('category.update') }}" method="post" >
                                <input type="text" name="post_id" id="cateory_id" value="{{$categorie->id}}" hidden>
                                    @csrf
                                    @method('PUT')
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$categorie->name}}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                </div>
                        </div>
                </div>
            </div>
       </div>
@endsection