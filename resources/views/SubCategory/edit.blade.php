@extends('layouts.app')

@section('content')
       <div class="container">
            <div class="row">
                <div class="col-md-10 mt-5 m-auto">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="m-2 text-center">SubCategory Edit</h4>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                <form action="{{ route('subcategory.update') }}" method="post" >
                                <input type="text" name="post_id" id="subcategorie_id" value="{{$subcategorie->id}}" hidden>
                                    @csrf
                                    @method('PUT')
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$categorie->name}}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                                 <label for="category" class="form-label">Ceategory</label>
                                                <select class="form-select" id="ceategory" name="category_id">
                                                <option selected>Select Ceategory</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $subcategorie->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
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