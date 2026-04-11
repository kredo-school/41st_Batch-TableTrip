@extends('layouts.owner')

@section('title','Notifications')

@section('content')
   <div class="m-5">
    <div class="row">
        @include('restaurant-owners.sidebar')
        <div class="col-12 col-lg-9">
            <h1 class="text-underline-accent mb-3">Notifications</h1>
            <div class="container my-4">
            
             @foreach($notifications as $notification)
             
                <button type="button"
                class="notification-card text-decoration-none text-dark mb-3 w-100 text-start border-0 bg-white p-3 rounded shadow-sm"
                id="notification-card-{{ $notification->id }}"
                data-bs-toggle="modal"
                data-bs-target="#notificationModal{{ $notification->id }}"
                onclick="markAsRead({{ $notification->id }})">

                    <div class="d-flex align-items-start w-100">
                        <span class="notification-dot {{ $notification->is_completed ? 'read' : 'unread' }}" id="notification-dot-{{ $notification->id }}"></span>

                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    @if($notification->target_type === \App\Models\Reservation::class)
                                        <i class="fa-regular fa-calendar"></i>

                                    @elseif($notification->target_type === \App\Models\Order::class)
                                        <i class="fa-solid fa-box"></i>

                                    @elseif($notification->target_type === \App\Models\Review::class)
                                        <i class="fa-solid fa-star"></i>

                                    @else
                                        <i class="fa-solid fa-bell"></i>
                                    @endif
                                     {{ $notification->title }}
                                </div>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="notification-text mb-0">{{ $notification->message }}</p>
                        </div>
                         <div class="ms-3">
                            <i class="fa-solid fa-angle-right text-muted"></i>
                        </div>
                    </div>
                </button>
                
                    @include('restaurant-owners.notifications.notification-modal')
            @endforeach
             </div>

        </div>
    </div>
   </div>

    
@endsection