@extends('layouts.app')

@section('content')
       <div class="container">
            <div class="row">
                <div class="col-md-10 mt-5 m-auto">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="m-2 text-center">Category Create</h4>
                                    <a href="{{ route('subcategory.create') }}" class="btn btn-primary">SubCreate Category</a>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                <form action="{{ route('category.store') }}" method="post" >
                                   @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
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