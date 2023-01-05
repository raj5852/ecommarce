@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Products
                        <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }} </div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('admin/products/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag"
                                    type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO
                                    Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                    type="button" role="tab" aria-controls="details"
                                    aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                    type="button" role="tab" aria-controls="image" aria-selected="false">Product
                                    Image</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border  p-3 show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control" id="">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Select Brand</label>
                                    <select name="brand" class="form-control" id="">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Small Description(500 words)</label>
                                    <textarea name="small_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Small Description(500 words)</label>
                                    <textarea name="small_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border  p-3" id="seotag" role="tabpanel"
                                aria-labelledby="seotag-tab">
                                <div class="mb-3">
                                    <label for="">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border  p-3" id="details" role="tabpanel"
                                aria-labelledby="details-tab">
                                <div class="mb-3">
                                    <label for="">Original Price</label>
                                    <input type="number" name="original_price" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Selling Price</label>
                                    <input type="number" name="selling_price" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Quantity</label>
                                    <input type="number" name="quantity" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Trending</label>
                                    <input type="checkbox" name="trending" style="width: 20px;height:20px">
                                </div>
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <input type="checkbox" name="status" style="width: 20px;height:20px">
                                </div>
                            </div>
                            <div class="tab-pane fade border  p-3" id="image" role="tabpanel"
                                aria-labelledby="image-tab">
                                <div class="mb-3">
                                    <label for="">Upload Product Images</label>
                                    <input type="file" multiple name="image[]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
