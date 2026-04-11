@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="container py-5 d-flex flex-column align-items-center favorite-page">
    
    <h1 class="page-title mb-5">
        <i class="fas fa-cog me-2"></i>Payment Setting
    </h1>

    <div class="col-md-8">
        <div class="payment-section-box mb-5">
            <h4 class="section-subtitle">Manage Payment Methods</h4>
            <div class="payment-list-inner">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle m-0">
                        <tbody class="text-center">
                            @forelse($methods as $method)
                            <tr class="border-bottom">
                                <td><i class="fab fa-cc-{{ strtolower($method->brand) }} fa-2x"></i></td>
                                <td class="fw-bold">{{ $method->brand }} ****{{ $method->last4 }}</td>
                                <td>
                                    @if($method->is_default)
                                        <span class="badge rounded-pill bg-success">Default</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('user.payment_method.destroy', $method->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn text-muted"><i class="fas fa-trash"></i></button>
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
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="payment-section-box">
            <h4 class="section-subtitle">Register / Edit</h4>
            <form id="payment-form" action="{{ route('user.payment_method.store') }}" method="POST" class="px-3">
                @csrf
                <div class="mb-4">
                    <label class="small fw-bold text-uppercase mb-2 d-block">Card Number</label>
                    <input type="text" name="card_number" class="form-control form-custom-input" placeholder="0000 0000 0000 0000" maxlength="16">
                </div>
                
                <div class="row mb-4">
                    <div class="col-6">
                        <label class="small fw-bold text-uppercase mb-2 d-block">Month</label>
                        <select name="exp_month" class="form-select form-custom-input" required>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ sprintf('%02d', $m) }}">{{ sprintf('%02d', $m) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="small fw-bold text-uppercase mb-2 d-block">Year</label>
                        <select name="exp_year" class="form-select form-custom-input" required>
                            @for ($y = date('y'); $y <= date('y') + 10; $y++)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="small fw-bold text-uppercase mb-2 d-block">Holder Name</label>
                    <input type="text" name="holder_name" class="form-control form-custom-input" placeholder="TARO KREDO">
                </div>
                
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-add-card">Add Card</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5 pb-5">
        <a href="{{ route('dashboard') }}" class="btn-back-custom">
            <i class="fa-solid fa-house me-2"></i>Back to Dashboard
        </a>
    </div>
</div>
@endsection