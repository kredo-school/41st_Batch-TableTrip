@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@section('content')
<div class="payment-container">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold"><i class="fas fa-cog me-2 text-secondary"></i>Payment Setting</h2></h2>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card payment-card">
                        <div class="payment-card-header d-flex justify-content-between align-items-center">
                            <span>Manage Payment Methods</span>
                            <button class="btn btn-primary btn-sm btn-rounded">+ Add New</button>
                        </div>
                        <div class="card-body">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="text-muted small">
                                        <th>Brand</th>
                                        <th>Details</th>
                                        <th class="text-center">Default</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($methods as $method)
                                    <tr>
                                        <td><i class="fab fa-cc-{{ strtolower($method->brand) }} fa-2x"></i></td>
                                        <td>{{ $method->brand }} ****{{ $method->last4 }}</td>
                                        <td class="text-center">
                                            @if($method->is_default)
                                                <i class="fas fa-check text-success"></i>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <form action="{{ route('user.payment-methods.destroy', $method->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger btn-delete-card"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card payment-card">
                        <div class="payment-card-header text-center">
                            Register / Edit
                        </div>
                        <div class="card-body p-4">
                            <div class="brand-icons text-center mb-4">
                                <i class="fab fa-cc-visa fa-2x"></i>
                                <i class="fab fa-cc-mastercard fa-2x"></i>
                                <i class="fab fa-cc-jcb fa-2x"></i>
                                <i class="fab fa-cc-amex fa-2x"></i>
                            </div>

                            <form id="payment-form" action="{{ route('user.payment-methods.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="small fw-bold">Number</label>
                                    <input type="text" name="card_number" class="form-control form-custom-input" placeholder="0000 0000 0000 0000">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="small fw-bold">Expire</label>
                                        <input type="text" name="expire" class="form-control form-custom-input" placeholder="MM/YY">
                                    </div>
                                    <div class="col-6">
                                        <label class="small fw-bold">Pin</label>
                                        <input type="password" name="cvc" class="form-control form-custom-input" placeholder="***">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold">Holder Name</label>
                                    <input type="text" name="holder_name" class="form-control form-custom-input" placeholder="TARO KREDO">
                                </div>
                                
                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-primary btn-rounded mx-1">Update</button>
                                    <button type="reset" class="btn btn-warning btn-rounded mx-1">Cancel</button>
                                    <button type="button" class="btn btn-danger btn-rounded mx-1">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- back to dashboard --}}
    <div class="btn-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-house"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/payment.js') }}"></script>
@endpush