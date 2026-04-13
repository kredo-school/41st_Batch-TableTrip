@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="mt-5 mb-3">This page is not available</h1>
    <p class="text-muted mb-4">This restaurant page is not published yet.</p>
    <a href="{{ url('/') }}" class="btn btn-orange">Back to Home</a>
</div>
@endsection