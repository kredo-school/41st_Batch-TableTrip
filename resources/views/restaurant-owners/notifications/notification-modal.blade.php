<!-- Notification Detail Modal -->
<div class="modal fade"
     id="notificationModal{{ 
     $notification->id }}"
     tabindex="-1"
     aria-labelledby="notificationModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <!-- header -->
            <div class="modal-header border-bottom">
                <h5 class="modal-title d-flex align-items-center gap-2" id="notificationModalLabel">
                    <i class="fa-regular fa-calendar"></i>
                    {{ $notification->title }}
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            
            <div class="modal-body px-4 py-4" style="font-family: 'Sen','sans-serif'">

            @if ($notification->target_type === \App\Models\Reservation::class && $notification->target)    
                <p>Date: {{ \Carbon\Carbon::parse($notification->target->reservation_date)->format('M d') }}</p>
                <p>Time: {{ \Carbon\Carbon::parse($notification->target->reservation_time)->format('H:i') }}</p>
                <p> Customer Name: {{ $notification->target->full_name }}</p>
                <p> Number of Guests: {{ $notification->target->number_of_people }}</p>

                @if ($notification->target->special_requests)
                    <p>
                        Special Request: {{ $notification->target->special_requests }}
                    </p>
                @endif

                <p class="mt-3">Please review the reservation details and take any necessary action.</p>

                @elseif ($notification->target_type === \App\Models\Order::class && $notification->target)
                <p>Order ID: #{{ $notification->target->id }}</p>

                <p class="mb-3"> Total Price: ${{ number_format($notification->target->total_price, 2) }}</p>

                <p>Please review the order details and update the status if needed.</p>

            @elseif ($notification->target_type === \App\Models\Review::class && $notification->target)
                <p> 
                    <div class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $notification->target->rating)
                                <i class="fa-solid fa-star text-warning"></i>
                            @else
                                <i class="fa-regular fa-star text-warning"></i>
                            @endif
                        @endfor
                    </div>
                    Rating: {{ $notification->target->rating ?? '-' }}
                </p>

                <p>
                    Comment: {{ $notification->target->comment ?? 'No comment provided.' }}
                </p>

            @else
                <p>{{ $notification->message }}</p>
            @endif

            <div class="text-end text-muted small mt-3">
            {{ $notification->created_at->diffForHumans() }}
            </div>
            </div>


            <!-- footer -->
            <div class="modal-footer border-0 justify-content-center pb-4">
                @if ($notification->target_type === \App\Models\Reservation::class && $notification->target)  
                    <a href="{{ route('owner.reservations.show', $notification->target->id) }}" class="btn btn-orange px-4">
                        View Reservation
                    </a>
                @elseif ($notification->target_type === \App\Models\Order::class && $notification->target)  
                    <a href="{{ route('owner.orders.show', $notification->target->id) }}" class="btn btn-orange px-4">
                        View Order
                    </a>
                @elseif ($notification->target_type === \App\Models\Review::class && $notification->target)  
                    <a href="{{ route('owner.reviews') }}" class="btn btn-orange px-4">
                        View Review
                    </a>
                @endif

                <button type="button"class="btn btn-outline-orange px-4"data-bs-dismiss="modal">
                    Close
                </button>

            </div>

        </div>
    </div>
</div>