@extends('layouts.app')

@section('title','Review')

@section('content')
<div class="container mx-auto my-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-3">Reviews</h1>
            {{-- Review Card : reply form --}}
            <div class="card border rounded-0 mb-4">
                <div class="card-body p-4">

                    <h4 class="mb-4">To Restaurant</h4>

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fa-solid fa-circle-user fs-1 text-dark"></i>
                            </div>

                            <div>
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <span>Delicious Restaurant</span>
                                    <div class="text-warning small">★★★★★</div>
                                    <span class="small">4.0</span>
                                </div>
                                <div>Yuki</div>
                            </div>
                        </div>

                        <div class="text-muted small">Apr 12, 2025</div>
                    </div>

                    <div class="ps-1 pe-1 mb-4" style="font-size: 1.1rem; line-height: 1.5;">
                        The sushi was incredibly fresh and beautifully presented.<br>
                        The atmosphere was warm and inviting, and the staff<br>
                        made us feel very welcome.<br>
                        Definitely one of the best Japanese restaurants in the area.
                    </div>

                    <form action="" method="POST">
                        @csrf
                        <div class="d-flex gap-2">
                            <input type="text"
                                name="reply"
                                class="form-control"
                                placeholder="Reply to this review">
                            <button type="submit" class="btn btn-navy px-4">Send</button>
                        </div>
                    </form>

                </div>
            </div>


            {{-- Review Card : replied --}}
            <div class="card border rounded-0">
                <div class="card-body p-4">

                    <h4 class="mb-4">To Meal kit</h4>

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fa-solid fa-circle-user fs-1 text-dark"></i>
                            </div>

                            <div>
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <span>Delicious Restaurant</span>
                                    <div class="text-warning small">★★★★★</div>
                                    <span class="small">4.0</span>
                                </div>
                                <div>Ray</div>
                            </div>
                        </div>

                        <div class="text-muted small">Nov 30, 2025</div>
                    </div>

                    <div class="ps-3 pe-1 mb-3" style="font-size: 1.1rem; line-height: 1.5;">
                        The sushi was incredibly fresh and beautifully presented.<br>
                        The atmosphere was warm and inviting, and the staff<br>
                        made us feel very welcome.<br>
                        Definitely one of the best Japanese restaurants in the area.
                    </div>

                    <div class="ps-2">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-reply mt-1"></i>
                            <div>
                                <div class="mb-1">Restaurant replay:</div>
                                <div style="font-size: 1.1rem; line-height: 1.5;">
                                    Thank you for your kind review.<br>
                                    We’re very happy to hear that you enjoyed your experience.<br>
                                    We look forward to welcoming you again!
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection