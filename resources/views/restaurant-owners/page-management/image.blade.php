@extends('layouts.app')

@section('title','Page Management')

@section('content')
<div class="container my-5 mx-auto">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Hero Image --}}
                <div class="mb-5">

                    <h3 class="mb-1">Hero Image</h3>
                    <p class="text-muted small">Cover Photo</p>

                    <div class="mb-3 text-center">
                    
                        <img
                        src=""
                        class="img-fluid rounded"
                        style="max-height:350px; width:100%; object-fit:cover;">

                    </div>

                    <div class="d-flex gap-2">
                        <input type="file" name="hero_image" class="form-control">
                        <button class="btn btn-navy px-4">Upload</button>
                    </div>

                </div>


                {{-- Gallery Images --}}
                <div class="mb-4">

                    <h3 class="mb-1">Gallery Images</h3>
                    <p class="text-muted small">
                        Upload up to 2 gallery images to showcase your restaurant.
                    </p>

                    <div class="row">

                        {{-- Gallery 1 --}}
                        <div class="col-md-6 mb-4">

                            <div class="position-relative">

                                {{-- {{ $restaurant->gallery_image1
                                    ? asset('storage/'.$restaurant->gallery_image1)
                                    : asset('images/no-image.png') }} --}}
                                <img
                                src=""
                                class="img-fluid rounded"
                                style="height:220px;width:100%;object-fit:cover;">

                                {{-- @if($restaurant->gallery_image1) --}}
                                <button type="button"
                                    class="btn-close position-absolute top-0 end-0 m-2">
                                </button>
                                {{-- @endif --}}

                            </div>

                            <div class="mt-2 d-flex gap-2">
                                <input type="file" name="gallery_image1" class="form-control">
                                <button class="btn btn-navy px-3">Upload</button>
                            </div>

                        </div>


                        {{-- Gallery 2 --}}
                        <div class="col-md-6 mb-4">

                            <div class="position-relative">

                                {{-- {{ $restaurant->gallery_image2
                                    ? asset('storage/'.$restaurant->gallery_image2)
                                    : asset('images/no-image.png') }} --}}
                                <img
                                src=""
                                class="img-fluid rounded"
                                style="height:220px;width:100%;object-fit:cover;">

                                {{-- @if($restaurant->gallery_image2) --}}
                                <button type="button"
                                    class="btn-close position-absolute top-0 end-0 m-2">
                                </button>
                                {{-- @endif --}}

                            </div>

                            <div class="mt-2 d-flex gap-2">
                                <input type="file" name="gallery_image2" class="form-control">
                                <button class="btn btn-navy px-3">Upload</button>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="d-flex justify-content-center gap-3 mt-4">

                    <button type="submit" name="action" value="draft"
                        class="btn btn-outline-orange px-5">
                        Save Draft
                    </button>

                    <button type="submit" name="action" value="publish"
                        class="btn btn-orange px-5">
                        Publish
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>    
@endsection