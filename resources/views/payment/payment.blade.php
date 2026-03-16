@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endpush
@section('content')

<div class="payment-body">
    <div class="payment-container">
        <h2 class="setting-title">
            Payment Setting
        </h2>
        <div class="payment-section">
            <p class="section-label">
                default
            </p>
                <table class="card-table">
                    @foreach ($cards as $card)
                    <tr>
                        <td style="width: 40px; text-align: center;">
                        <input type="radio" name="default" {{ $card->is_default ? 'checked' : '' }}>
                        </td>
                        <td>{{ $card->card_name }}</td>
                        <td style="width: 50px; text-align: center;">
                            <a href="{{ route('payment.edit', $card->id) }}" class="btn-icon">🖊️</a>
                        </td>
                        <td style="width: 50px; text-align: center;">
                            <form action="{{ route('payment.destroy', $card->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
        </div>
        <div class="payment-section">
            <h3 class="section-title">Register</h3>
            <form action="{{ route('payment.store') }}" method="POST" class="payment-form">
                @csrf
                <table>
                    <tr>
                        <td>Expire</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <input type="text" name="expiry_date" id="expiry_date" class="input-short" placeholder="MM/YY">
                                <span>Pin</span>
                                <input type="text" name="security_code" id="security_code" class="input-short">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Holder Name</td>
                        <td><input type="text" name="card_holder_name"></td>
                    </tr>
                    <tr>
                        <td>Original Name</td>
                        <td><input type="text" name="card_name"></td>
                    </tr>
                </table>
                <button type="submit" class="btn-register">Register</button>
            </form>
        </div>
    </div>
</div>