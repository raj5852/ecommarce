@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category
                        <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name') <small class="text-danger">{{$message}} </small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">
                                @error('slug') <small class="text-danger">{{$message}} </small> @enderror

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea name="description"value="{{ old('description') }}"  id="description" class="form-control" rows="3"></textarea>
                                @error('description') <small class="text-danger">{{$message}} </small> @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label><br>
                                <input type="checkbox" id="status" name="status">
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" value="{{ old('meta_title') }}" name="meta_title">
                                @error('meta_title') <small class="text-danger">{{$message}} </small> @enderror

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_keyword">Meta Keyword</label>
                                <textarea type="text" class="form-control" id="meta_keyword" name="meta_keyword">

                                </textarea>
                                @error('meta_keyword') <small class="text-danger">{{$message}} </small> @enderror

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea type="text" class="form-control" id="meta_description" name="meta_description"></textarea>
                                @error('meta_description') <small class="text-danger">{{$message}} </small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-primary float-end" type="submit">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
