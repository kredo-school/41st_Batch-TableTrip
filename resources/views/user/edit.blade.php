@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class="edit-wrapper">
        <div class="edit-card">
            <h2 class="edit-title">
                Edit User Account
            </h2>
            <form action="{{ route('mypage.edit') }}" class="edit-form" method="POST">
                @csrf
                @method('POST')
                <label for="profile_picture" class="profile-upload-label">
                    @if($user->profile_picture)
                        {{-- already registerd --}}
                        <img id="profile_picture_preview" 
                            src="{{ asset('storage/' . $user->profile_picture) }}" 
                            style="display: block; width: 60px; height: 60px; border-radius: 50%;">
                        <svg id="default_svg" style="display: none;">...</svg>
                    @else
                        {{-- not registered yet --}}
                        <img id="profile_picture_preview" src="" style="display: none;">
                        <svg id="default_svg">...</svg>
                    @endif
                </label>
                <div class="form-grid">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="first name" class="form-control required">

                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="last name" class="form-control required">
                    
                    <label>User Name</label>
                    <input type="text" name="user_name" id="user_name" placeholder="user name" class="form-control required">
                    
                    <label>Tel</label>
                    <input type="number" name="tel" id="tel" placeholder="xx-xxxx-xxxx" class="form-control required">
                    
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" placeholder="xx-xxxx-xxxx" class="form-control required">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" class="form-control required">

                    <label>Address</label>
                    <div class="address-row">
                        <input type="text" name="address" class="form-control required">
                            <select name="country" class="form-select text-muted" required>
                                <option value="" class="text-muted">country</option>
                                <option value="Japan" {{ old('country')=='Japan'?'selected':'' }}>Japan</option>
                                <option value="USA" {{ old('country')=='USA'?'selected':'' }}>USA</option>
                                <option value="South Korea" {{ old('country')=='South Korea'?'selected':'' }}>South Korea</option>
                                <option value="China" {{ old('country')=='China'?'selected':'' }}>China</option>
                                <option value="Taiwan" {{ old('country')=='Taiwan'?'selected':'' }}>Taiwan</option>
                                <option value="Singapore" {{ old('country')=='Singapore'?'selected':'' }}>Singapore</option>
                                <option value="Thailand" {{ old('country')=='Thailand'?'selected':'' }}>Thailand</option>
                                <option value="Malaysia" {{ old('country')=='Malaysia'?'selected':'' }}>Malaysia</option>
                                <option value="Indonesia" {{ old('country')=='Indonesia'?'selected':'' }}>Indonesia</option>
                                <option value="France" {{ old('country')=='France'?'selected':'' }}>France</option>
                                <option value="Germany" {{ old('country')=='Germany'?'selected':'' }}>Germany</option>
                                <option value="Netherlands" {{ old('country')=='Netherlands'?'selected':'' }}>Netherlands</option>
                                <option value="Spain" {{ old('country')=='Spain'?'selected':'' }}>Spain</option>
                                <option value="Hungary" {{ old('country')=='Hungary'?'selected':'' }}>Hungary</option>
                                <option value="Iran" {{ old('country')=='Iran'?'selected':'' }}>Iran</option>
                                <option value="India" {{ old('country')=='India'?'selected':'' }}>India</option>
                                <option value="Norway" {{ old('country')=='Norway'?'selected':'' }}>Norway</option>
                                <option value="Mexico" {{ old('country')=='Mexico'?'selected':'' }}>Mexico</option>
                                <option value="Switzerland" {{ old('country')=='Switzerland'?'selected':'' }}>Switzerland</option>
                                <option value="Australia" {{ old('country')=='Australia'?'selected':'' }}>Australia</option>
                                <option value="UK" {{ old('country')=='UK'?'selected':'' }}>UK</option>
                                <option value="Brazil" {{ old('country')=='Brazil'?'selected':'' }}>Brazil</option>
                                <option value="Argentina" {{ old('country')=='Argentina'?'selected':'' }}>Argentina</option>
                                <option value="Uruguay" {{ old('country')=='Uruguay'?'selected':'' }}>Uruguay</option>
                                <option value="Morocco" {{ old('country')=='Morocco'?'selected':'' }}>Morocco</option>
                                <option value="Italy" {{ old('country')=='Italy'?'selected':'' }}>Italy</option>
                                <option value="Ireland" {{ old('country')=='Ireland'?'selected':'' }}>Ireland</option>
                            </select>
                    </div>

                    <label>Password</label>
                    <input type="password" name="password" class="form-control required">

                </div>
            {{-- update --}}
                <div class="button-area">
                    <button type="submit" class="btn-update">Update</button>
                </div>
            </form>
            {{-- delete --}}
            <form action="{{ route('mypage.destroy') }}" method="POST"class="button-area" onsubmit="return confirm('Are you sure you want to delete your account?');">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="btn-delete">Delete Account</button>
            </form>

        </div>
    </div>
@endsection