@extends('layouts.owner')

@section('title','Page Management')

@section('content')
<div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-4">Page Management</h1>
            @include('restaurant-owners.page-management.tabs')

            <form action="{{ route('owner.page-management.updateImage') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                {{-- Hero Image --}}
                @if (session('success_image'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success_image') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-5">

                    <h3 class="mb-1">Hero Image</h3>
                    <p class="text-muted small">Cover Photo</p>

                    <div class="mb-3 text-center">
                    
                        @if ($restaurant->heroImage)
                           <img src="{{ asset('storage/'.$restaurant->heroImage->image_url) }}" alt="hero_image" class="img-fluid rounded hero-image">
                        @else
                           <div class="bg-light border rounded d-flex align-items-center justify-content-center hero-image" >
                               <span class="text-muted">No Hero Image Uploaded</span>
                           </div>
                        @endif

                    </div>

                    <div class="d-flex gap-2">
                        <input type="file" name="hero_image" class="form-control @error('hero_image') is-invalid @enderror">
                        @error('hero_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
                                @if ($restaurant->galleryImage1)
                                    <img src="{{ asset('storage/'.$restaurant->galleryImage1->image_url) }}" alt="gallery_image1" class="img-fluid rounded" style="height:220px;width:100%;object-fit:cover;">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height:220px;width:100%;">
                                        <span class="text-muted">No Gallery Image 1 Uploaded</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-2 d-flex gap-2">
                                <input type="file" name="gallery_image1" class="form-control @error('gallery_image1') is-invalid @enderror">
                                @error('gallery_image1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button class="btn btn-navy px-3">Upload</button>
                            </div>

                        </div>


                        {{-- Gallery 2 --}}
                        <div class="col-md-6 mb-4">

                            <div class="position-relative">
                                @if ($restaurant->galleryImage2)
                                    <img src="{{ asset('storage/'.$restaurant->galleryImage2->image_url) }}" alt="gallery_image2" class="img-fluid rounded" style="height:220px;width:100%;object-fit:cover;">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height:220px;width:100%;">
                                        <span class="text-muted">No Gallery Image 2 Uploaded</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-2 d-flex gap-2">
                                <input type="file" name="gallery_image2" class="form-control @error('gallery_image2') is-invalid @enderror">
                                @error('gallery_image2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button class="btn btn-navy px-3">Upload</button>
                            </div>

                        </div>

                    </div>

                </div>
                </div>
            </form>
        </div>
    </div>
</div>    
@endsection