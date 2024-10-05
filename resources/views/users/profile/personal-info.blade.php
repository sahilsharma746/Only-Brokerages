@extends('users.layouts.app_user')
@section('styles')

@endsection
@section('content')
    <article class="tab-content trade-article">
        <section id="" class="tab-pane in personal-information common-section active">
            <div class="back-btn-area">
                <ul class="nav nav-tabs list-style-none">
                    <li class="nav-item d-flex align-items-center g-15">
                        <a class="btn-tab d-flex align-items-center g-15" href="{{ route('user.dashboard') }}">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span class="text">Account</span>
                        </a>
                        <p class="section-name d-flex g-15">
                            <span>/</span>
                            <span>Personal Information</span>
                        </p>
                    </li>
                </ul>
            </div>
            @php
                $country_code = $user_data->addresses->country;
                $country_name = config('countries.' . $country_code);
            @endphp
            <form action="{{ route('user.personal.info.update') }}" method="POST">
                @csrf
                <div class="personal-info-card-area">
                    <div class="area-title">personal information</div>
                    <div class="card common-card">
                        <div class="card-body d-grid">
                            <div class="input-group">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" name="first_name" value="{{ $user_data->first_name }}" placeholder="Enter First Name">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="{{ $user_data->last_name }}" placeholder="Enter Last Name">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Email address</label>
                                <input class="form-control" type="email" placeholder="Enter email address" readonly name="email" value="{{ $user_data->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Phone number</label>
                                <input class="form-control" type="text" placeholder="Enter Phone number" name="phone" value="{{ $user_data->phone }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Country</label>
                                <select class="form-control" id="userCountry" searchable="true" name="country">
                                    <option>Select Country</option>
                                   @foreach($countries as $code => $name)
                                        <option {{ $country_code == $code ? 'selected' : '' }} value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-update-profile w-max" type="submit">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
                <div class="profile-picture-card-area">
                    <div class="area-title">Profile picture</div>
                    <form action="{{ route('user.profile.avatarUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card common-card">
                            <div class="card-body d-grid">
                                <div class="upload-files-container w-100 overflowY-hidden">
                                    <div class="drag-file-area align-content-center">
                                        <img id="user-image" class="user-image d-none" src="https://picsum.photos/300/200?grayscale" alt="">
                                        <label for="upload-dp-input"
                                            class="upload-icon attach-icon mx-auto d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-link"></i>
                                        </label>
                                        <p class="attach-note dynamic-message">
                                            Drop a file here to upload <br> Photo must be 5MB or less
                                        </p>
                                        <label class="label d-none">
                                            <span class="browse-files">
                                                <input id="upload-dp-input" type="file" name="avatar" accept="image/*"
                                                    class="default-file-input" />
                                            </span>
                                        </label>
                                    </div>
                                    <p class="cannot-upload-message">
                                        <strong>Error : </strong> <span> Please select a file first</span>
                                        <span class="cancel-alert-button btn-close">❌</span>
                                    </p>

                                    <div class="file-block">
                                        <div class="file-info">
                                            <span class="file-name"
                                                style="max-width: 230px; padding-right: 5px; overflow: hidden;"> </span>
                                            | <span class="file-size"> </span>
                                        </div>
                                        <span class="material-icons remove-file-icon">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </span>
                                        <div class="progress-bar"> </div>
                                    </div>
                                    @error('avatar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <fieldset>
                                    <p>Prohibited Pictures:</p>
                                    <ul>
                                        <li>Photos explicit or inappropriate nature</li>
                                        <li>Photos involving people younger than 18 years old</li>
                                        <li>Third-party copyrighted protected photos</li>
                                        <li>AI generated photos</li>
                                        <li class="text-danger">Images not in JPG, PNG or GIF</li>
                                        <li>Photos larger than 5MB</li>
                                    </ul>
                                    <p>Your face must be shown clearly. All photos uploaded must abide by these
                                        guideline or the photo will be removed.</p>
                                </fieldset>
                                {{-- <a type="button" id="dp-upload-btn" class="btn upload-button w-max">Upload picture</a> --}}
                                <button id="dp-upload-btn" class="btn upload-button w-max" type="submit">Upload Picture</button>
                            </div>
                        </div>
                    </form>
                </div>
            </form>
        </section>
    </article>
@endsection
@section('scripts')
    <!-- upload file js add ======================= -->
<script src="{{ asset('assets') }}/upload-file/upload-file.js"></script>
@endsection
