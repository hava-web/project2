@extends('layouts/admin')
@section('content')

@if ($errors->any())
<div class="">
    @foreach ($errors as $error)
        <div class="">{{ $error }}</div>
    @endforeach
</div>
@endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4 card-header shadow p-3 mb-5 bg-white rounded">
        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
        <a href="{{ url('admin/products') }}" class="d-none d-sm-inline-block btn btn btn-primary shadow-sm">Back</a>
    </div> 

        <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="seotag-tab" data-toggle="tab" data-target="#seotag" type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO Tags</button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="detail-tab" data-toggle="tab" data-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="false">Detail</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="image-tab" data-toggle="tab" data-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="color-tab" data-toggle="tab" data-target="#color" type="button" role="tab" aria-controls="color" aria-selected="false">Color</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Product Slug</label>
                        <input type="text" name="slug" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Select Brand</label>
                        <select name="brand" class="form-control" id=""> 
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Small Description</label>
                        <textarea name="small_description" id="" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade border p-3" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                    <div class="mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="">Meta Keyword</label>
                        <input type="text" name="meta_keyword" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" id=""  rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade border p-3" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Original Price</label>
                                <input type="number" name="original_price" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Selling Price</label>
                                <input type="number" name="selling_price" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Trending</label>
                                <input type="checkbox" name="trending" id="" style="width: 20px; height: 20px";>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" id="" style="width: 20px; height: 20px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                    <div class="mb-3">
                        <label for="">Upload Product Image</label>
                        <input type="file" name="image[]" multiple class="form-control" id=""/>
                    </div>
                </div>
                <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                    <div class="mb-3">
                        <label for="">Select Color</label>
                        <div class="row">
                            @forelse($colors as $color)
                            <div class="col-md-3">
                                <div class="p-2 border mb-3">
                                    Color: <input type="checkbox" name="colors[{{ $color->id }}]" value="{{ $color->id }}" id=""/>{{ $color->name }}
                                    <br>
                                    Quantity: <input type="number" name="colorquantity[{{ $color->id }}]" style="width: 70px; border: 1px solid " id="">
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <h1>No Color Not Found</h1>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection