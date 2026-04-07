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
                <div class="mb-5">

                    <h3 class="mb-1">Hero Image</h3>
                    <p class="text-muted small">Cover Photo</p>

                    <div class="mb-3 text-center">

                        @php
                            $heroImage = $restaurant->images->firstWhere('display_order', 1);
                        @endphp

                        @if ($heroImage)
                            <img src="{{ asset('storage/' . $heroImage->image_url) }}" alt="Hero Image" class="img-fluid rounded hero-image">
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <input type="file" name="hero_image" class="form-control @error('hero_image') is-invalid @enderror">
                        <button type="submit" class="btn btn-navy px-4">Upload</button>
                        @error('hero_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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

                            @php
                                $gallery1 = $restaurant->images->firstWhere('display_order', 2);
                            @endphp

                            <div>
                                <img
                                    src="{{ $gallery1
                                        ? asset('storage/'.$gallery1->image_url)
                                        : asset('images/no-image.png') }}"
                                    class="img-fluid rounded sub-image">
                            </div>
                            <div class="mt-2 d-flex gap-2">
                                <input type="file" name="gallery_image1" class="form-control @error('gallery_image1') is-invalid @enderror">
                                <button type="submit" class="btn btn-navy px-3">Upload</button>
                                @error('gallery_image1')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        {{-- Gallery 2 --}}
                        <div class="col-md-6 mb-4">

                            @php
                                $gallery2 = $restaurant->images->firstWhere('display_order', 3);
                            @endphp

                            <div>
                                <img
                                    src="{{ $gallery2
                                        ? asset('storage/'.$gallery2->image_url)
                                        : asset('images/no-image.png') }}"
                                    class="img-fluid rounded sub-image">
                            </div>

                            <div class="mt-2 d-flex gap-2">
                                <input type="file" name="gallery_image2" class="form-control @error('gallery_image2') is-invalid @enderror">
                                <button type="submit" class="btn btn-navy px-3">Upload</button>
                                @error('gallery_image2')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="d-flex justify-content-center gap-3 mt-4">

                    <a href="{{ route('owner.page-management.preview') }}" 
                        class="btn btn-outline-orange px-5">
                        Check Preview
                    </a>

                    <button type="submit" 
                        class="btn btn-orange px-5">
                        Save
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>    
@endsection