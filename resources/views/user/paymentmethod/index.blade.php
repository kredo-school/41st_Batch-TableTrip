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
                                    <td>{{ $method->brand }} ****{{ $method->last4 }}</td>
                                    <td>
                                        <form action="{{ route('user.payment_method.update', $method->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="exp_month" class="form-select-sm">
                                                @for ($m = 1; $m <= 12; $m++)
                                                    <option value="{{ sprintf('%02d', $m) }}" {{ $method->exp_month == $m ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                                @endfor
                                            </select>
                                            <select name="exp_year" class="form-select-sm">
                                                @for ($y = date('y'); $y <= date('y') + 10; $y++)
                                                    <option value="{{ $y }}" {{ $method->exp_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                                @endfor
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                    </td>
                                    {{-- delete --}}
                                    <td>
                                        <form action="{{ route('user.payment_method.destroy', $method->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger"><i class="fas fa-trash"></i></button>
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
                    <h4 class="fw-bold mb-4">Register / Edit</h4>
                    <form id="payment-form" action="{{ route('user.payment_method.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold">Card Number</label>
                            <input type="text" name="card_number" class="form-control" maxlength="19" inputmode="numeric" autocomplete="cc-number">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="small fw-bold">Month</label>
                                <select name="exp_month" class="form-select form-custom-input" required>
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ sprintf('%02d', $m) }}">{{ sprintf('%02d', $m) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold">Year</label>
                                <select name="exp_year" class="form-select form-custom-input" required>
                                    @for ($y = date('y'); $y <= date('y') + 10; $y++)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="small fw-bold">Holder Name</label>
                            <input type="text" name="holder_name" class="form-control form-custom-input" placeholder="TARO KREDO">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit">Add Card</button>
                            <button type="submit" class="btn btn-primary btn-rounded mx-1">Update</button>
                            <button type="reset" class="btn btn-outline-secondary btn-rounded mx-1">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-5 pb-5">
            <a href="{{ route('dashboard') }}" class="btn-back-custom">
                <i class="fa-solid fa-house me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection