<x-guest-layout>
    {{-- Google Fonts の読み込み --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Sen:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f7f5f0 !important;
            color: #000000 !important;
            font-family: 'Sen', sans-serif;
        }

       h2.custom-header {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: #000000 !important; 
            border-bottom: 2px solid #FF6F61; 
            padding-bottom: 8px;
            display: inline-block;
            letter-spacing: 0.05em;

        }

        .custom-card {
            background-color: #f7f5f0 !important;
            border: 1px solid #e0ddd5 !important;
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .form-control, .form-select {
            background-color: transparent !important;
            border: 1px solid #000000 !important;
            border-radius: 0 !important;
            padding: 10px;
            font-family: 'Sen', sans-serif;
        }

        .btn-custom {
            font-family: 'Sen', sans-serif;
            border-radius: 0 !important;
            padding: 12px 30px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: 0.3s;
        }

        .btn-register {
            background-color: #FF6F61 !important;
            border: none !important;
            color: #ffffff !important;
        }

        .btn-back {
            background-color: transparent !important;
            border: 1px solid #000000 !important;
            color: #000000 !important;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-custom:hover {
            opacity: 0.7;
        }
        .profile-upload-label {
    cursor: pointer;
    position: relative;
    display: inline-block;
    transition: transform 0.2s ease;
}

.profile-upload-label:hover {
    transform: scale(1.05); 
}

.profile-upload-label:hover .profile-icon-overlay {
    background: rgba(0, 0, 0, 0.1); 
}

.profile-icon-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* 実際のファイル選択ボタンは隠す */
#profile_picture {
    display: none;
}
    </style>

   <div class="container d-flex justify-content-center align-items-center vh-100 p-3">
        <div class="card custom-card p-5 shadow-sm" style="max-width: 500px; width: 100%;">
            
            <div class="text-center mb-5">
                <h2 class="custom-header h4 text-uppercase">
                    Create New Account
                </h2>
            </div>

            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Profile Picture Section --}}
                <div class="row mb-4 align-items-center">
                    <div class="col-sm-4">
                        <label class="form-label text-nowrap">Profile Picture</label>
                    </div>
                    <div class="col-sm-8 text-center text-sm-start">
                        <label for="profile_picture" class="profile-upload-label">

                            {{-- default icon--}}
                            <svg id="default_svg" width="60" height="60" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="border rounded-circle p-2 bg-white" style="border-color: #D1CFC0 !important;">
                                <path d="M32 32C37.5228 32 42 27.5228 42 22C42 16.4772 37.5228 12 32 12C26.4772 12 22 16.4772 22 22C22 27.5228 26.4772 32 32 32Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M52 52C52 46.4772 47.5228 42 42 42H22C16.4772 42 12 46.4772 12 52" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="32" cy="32" r="31" stroke="#4A4A4A" stroke-width="2"/>
                            </svg>
                        </label>
                        {{-- hidden file input--}}
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                        <div id="file-name" class="small text-muted mt-1" style="font-size: 0.65rem;">Tap icon to upload</div>
                    </div>
                </div>

                {{-- error illustlate --}}
                @if($errors->any())
                    <div class="alert alert-danger p-2 small mb-4" style="border-radius: 0; border: 1px solid #dc3545;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="first_name" class="form-label">First Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="last_name" class="form-label">Last Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="user_name" class="form-label">User Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="user_name" id="user_name" class="form-control" value="{{ old('user_name') }}" placeholder="User name" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="tel" class="form-label">Tel</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="d-flex gap-1">
                            <input type="tel" style="width: 70px;" class="form-control text-center" placeholder="+00" readonly>
                            <input type="tel" name="tel" id="tel" class="form-control flex-grow-1" value="{{ old('tel') }}" placeholder="number" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="email" class="form-label">Email Address</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="xxxxx@.nl" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="postal_code" class="form-label">Postal Code</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}" placeholder="postal code">
                    </div>
                </div>

                <div class="row mb-3 align-items-start">
                    <div class="col-sm-4">
                        <label class="form-label mt-1">Address</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="d-flex flex-column gap-2">
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="address">
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
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" name="password" id="password" class="form-control" placeholder="**********" required>
                    </div>
                </div>

                <div class="row mb-5 align-items-center">
                    <div class="col-sm-4">
                        <label for="password_confirmation" class="form-label">Confirm</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="**********" required>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url()->previous() }}" class="btn btn-custom btn-back btn-outline-danger">Back</a>
                    <button type="submit" class="btn btn-custom btn-register btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>