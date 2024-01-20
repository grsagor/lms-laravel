@extends('front.partials.app')
@section('title', 'Profile')
@section('css')
    <style>
        .nav-tabs .nav-link {
            color: #444444;
            width: 100%;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background: var(--primary-color);
            color: white;
            width: 100%;
        }

        .dp-container:hover .plus-icon-container {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            display: flex !important;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.426);
            color: #fff;
            font-weight: 700;
            font-size: 24px;
        }
    </style>
@endsection
@section('content')
    <div class="row container mx-auto">
        <div class="col-3 px-3 text-primary">
            <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane"
                        type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false">Change
                        Password</button>
                </li>
            </ul>
        </div>
        <div class="col-9">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <form action="{{ route('profile.info.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 d-flex justify-content-center">
                            <label for="dp" class="form-label cursor-pointer position-relative dp-container">
                                <img width="100" height="100"
                                    src="{{ $user->dp ? asset($user->dp) : asset('assets/img/fixed/dp.jpg') }}"
                                    alt="" id="dp_preview">
                                <div class="plus-icon-container d-none">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </label>
                            <input type="file" onchange="previewImage(this, '#dp_preview')" class="form-control d-none"
                                id="dp" name="dp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" readonly value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab"
                    tabindex="0">
                    <form action="{{ route('change.password') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewImage(input, previewContainerClass) {
            var preview = document.querySelector(previewContainerClass);
            console.log(previewContainerClass)
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
