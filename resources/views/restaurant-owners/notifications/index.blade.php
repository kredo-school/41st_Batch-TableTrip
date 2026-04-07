@extends('layouts.owner')

@section('title','Notifications')

@section('content')
   <div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-3">Notifications</h1>
            <div class="container my-4">

                {{-- notification item --}}
                <a href="#" class="notification-card text-decoration-none text-dark"
                data-bs-toggle="modal"
                data-bs-target="#notificationModal">

                    <div class="d-flex align-items-start">

                        {{-- unread / read indicator --}}
                        <span class="notification-dot unread"></span>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <div class="notification-title">
                                    <i class="fa-regular fa-calendar me-2"></i>
                                    [Reservation] New Booking recived
                                </div>

                                <small class="text-muted">3 hours ago</small>

                            </div>

                            <p class="notification-text mb-0">
                                You have a new reservation for tonight at 19:00.<br>
                                Customer: Yuki Tanaka (2 guests)<br>
                                Please review and confirm the reservation details.
                            </p>

                        </div>

                        <div class="ms-3">
                            <i class="fa-solid fa-angle-right text-muted"></i>
                        </div>

                    </div>

                </a>


                {{-- read notification --}}
                <a href="#" class="notification-card text-decoration-none text-dark">

                    <div class="d-flex align-items-start">

                        <span class="notification-dot read"></span>

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <div class="notification-title">
                                    <i class="fa-solid fa-box me-2"></i>
                                    [Order] New meal kit order #45782
                                </div>

                                <small class="text-muted">1 day ago</small>

                            </div>

                            <p class="notification-text mb-0">
                                A new order has been placed.<br>
                                Total: $43.20<br>
                                Please prepare the items and update the shipping status.
                            </p>

                        </div>

                        <div class="ms-3">
                            <i class="fa-solid fa-angle-right text-muted"></i>
                        </div>

                    </div>

                </a>
            
             {{-- @foreach($notifications as $notification)
                <a href="#"
                class="notification-card text-decoration-none text-dark"
                data-bs-toggle="modal"
                data-bs-target="#notificationModal{{ $notification->id }}">

                    <div class="d-flex align-items-start">
                        <span class="notification-dot {{ $notification->is_read ? 'read' : 'unread' }}"></span>

                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    [{{ $notification->type }}] {{ $notification->title }}
                                </div>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="mb-0">{{ $notification->message }}</p>
                        </div>
                    </div>
                </a>
            @endforeach --}}
             </div>

        </div>
    </div>
    @include('restaurant-owners.notifications.notification-modal')
   </div>

    
@endsection