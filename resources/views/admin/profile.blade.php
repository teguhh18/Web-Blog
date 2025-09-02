@extends('admin.layouts.admin')

@section('main')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div>
                    @if (session()->has('success'))
                        <div class="alert alert-primary bg-primary alert-dismissible fade show text-white" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div>
                    @if (session()->has('error'))
                        <div class="alert alert-warning bg-warning alert-dismissible fade show text-white" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form action="{{ route('admin.profile.update', encrypt($user->id)) }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            @if ($user->foto)
                                                <img src="{{ asset('storage/' . $user->foto) }}" alt="Profile">
                                            @else
                                                <img src="{{ asset('admin/img/profile-img.jpg') }}" alt="Profile">
                                            @endif
                                            <div class="pt-2">
                                                <a id="btnUpload" class="btn btn-primary btn-sm"
                                                    title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                <a id="btnRemove" class="btn btn-danger btn-sm"
                                                    title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <form action="{{ route('admin.password.update', encrypt($user->id)) }}" method="POST">
                                    @method('put')
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="newpassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newpassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="renewpassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewpassword">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>

                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="tempat-modal"></div>
@endsection
@push('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", "#btnUpload", function(e) {
                e.preventDefault();
                var url = "{{ route('admin.profile.image') }}";
                $.ajax({
                        method: "GET",
                        url: url,
                    })
                    .done(function(data) {
                        $('#tempat-modal').html(data.html);
                        $('#modal_show').modal('show');
                    })
            })
        })
    </script>
@endpush
