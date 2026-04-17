@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="payment-container">
    <div class="container text-center">
        <h1 class="payment-title">
            <i class="fas fa-cog me-2 text-secondary"></i>Payment Setting
        </h1>

        <div class="row justify-content-center text-start">
            <div class="col-md-8">
                
                <div class="payment-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="m-0 fw-bold">Manage Payment Methods</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle" style="border: 1px solid #eee;">
                            <tbody class="text-center">
                                @forelse($methods as $method)
                                <tr>
                                    <td><i class="fab fa-cc-{{ strtolower($method->brand) }} fa-2x"></i></td>
                                    <td>
                                        {{ $method->brand }} ****{{ $method->last4 }}
                                        {{-- default --}}
                                        @if($method->is_default)
                                            <span class="badge bg-success ms-2" style="background-color: #78c2ad !important;">Default</span>
                                        @else
                                            <form action="{{ route('user.payment_method.default', $method->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-link p-0 ms-2 text-decoration-none text-muted small">
                                                    Set as Default
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Edit button --}}
                                            <button type="button" class="btn btn-sm btn-outline-primary edit-button m-0"
                                                data-id="{{ $method->id }}"
                                                data-month="{{ sprintf('%02d', $method->exp_month) }}"
                                                data-year="{{ $method->exp_year }}"
                                                data-holder="{{ $method->holder_name }}"
                                                data-last4="{{ $method->last4 }}">
                                                Edit
                                            </button>
                                            {{-- update --}}
                                            <form action="{{ route('user.payment_method.update', $method->id) }}" method="POST" class="d-flex align-items-center gap-1 m-0">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="from" value="{{ request('from') }}">
                                                
                                                <select name="exp_month" class="form-select form-select-sm" style="width: auto; min-width: 60px;">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ sprintf('%02d', $m) }}" {{ $method->exp_month == $m ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                                    @endfor
                                                </select>
                                                
                                                <select name="exp_year" class="form-select form-select-sm" style="width: auto; min-width: 70px;">
                                                    @for ($y = date('y'); $y <= date('y') + 10; $y++)
                                                        <option value="{{ $y }}" {{ $method->exp_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                                    @endfor
                                                </select>

                                                <button type="submit" class="btn btn-sm btn-update" style="padding: 5px 15px;">Update</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.payment_method.destroy', $method->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-trash btn-delete-card"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-5 text-muted">No payment methods found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="payment-card">
                    <h4 class="fw-bold mb-4" id="form-title">Register / Edit</h4>
                    <form id="payment-form" action="{{ route('user.payment_method.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="from" value="{{ request('from') }}">
                        <div id="method-field"></div>

                        {{-- card number --}}
                        <div class="mb-3" id="card-number-container">
                            <label class="small fw-bold">Card Number</label>
                            <input type="text" name="card_number" id="card_number" class="form-control" maxlength="16">
                            <small class="text-muted" id="edit-notice" style="display:none;">
                                ※ Editing mode: Enter a new number only if you wish to change it. (Current: **** <span id="display-last4"></span>)
                            </small>
                        </div>

                        {{-- expired information --}}
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="small fw-bold">Month</label>
                                <select name="exp_month" id="exp_month" class="form-select" required>
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ sprintf('%02d', $m) }}">{{ sprintf('%02d', $m) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold">Year</label>
                                <select name="exp_year" id="exp_year" class="form-select" required>
                                    @for ($y = date('y'); $y <= date('y') + 10; $y++)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="small fw-bold">Holder Name</label>
                            <input type="text" name="holder_name" id="holder_name" class="form-control" placeholder="TARO KREDO">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" id="submit-button" class="btn-add">Add Card</button>
                            <button type="button" id="cancel-edit" class="btn btn-outline-secondary mx-1" style="display:none;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-5 pb-5 d-flex gap-3 justify-content-center">
            <a href="{{ route('dashboard') }}" class="btn-back-custom">
                <i class="fa-solid fa-house me-2"></i>Back to Dashboard
            </a>
            @if(request('from') === 'confirm')
                <a href="{{ route('cart.confirm') }}" class="btn-back-custom">
                    <i class="bi bi-cart me-2"></i>Back to Cart
                </a>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/payment.js') }}"></script>
@endpush