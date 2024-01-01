@extends('admin.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin Change Password</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row justify-content-center">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" action="{{ route('admin.update.password') }}">
                                    @csrf

                                    @if (session('status'))
                                        <div
                                            class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-success"><i class="bx bxs-check-circle"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-success"> {{ session('status') }}</h6>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @elseif(session('error'))
                                        <div
                                            class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-danger"><i class="bx bxs-message-square-x"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-danger">{{ session('error') }}</h6>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="row mb-3">
                                        <div class="col-sm-5">
                                            <h6 class="mb-0">Old Password</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid @enderror"
                                                id="current_password" placeholder="Old Password" />

                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-5">
                                            <h6 class="mb-0">New Password</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="password" name="new_password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="new_password" placeholder="New Password" />

                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-5">
                                            <h6 class="mb-0">Confirm New Password</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                id="new_password_confirmation" placeholder="Confirm New Password" />
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4 w-100" value="Save Changes" />
                                        </div>
                                    </div>
                            </div>

                            </form>



                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
