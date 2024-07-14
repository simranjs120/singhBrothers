<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab mb-4">
                <h4 class="card-title card-title-dash m-4">You can update your profile from here {{$profile->name}}</h4>
                @if (Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('success')}}</h5>
                    </div>
                @endif
                @if (Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('error')}}</h5>
                    </div>
                @endif
                <form action="{{route('update.profile')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="mb-2">My Name:</label>
                            <input type="text" class="form-control" name="name" value="{{$profile->name}}" required
                                maxlength="200" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="mb-2">My Email:</label>
                            <input type="email" name="email" class="form-control" value="{{$profile->email}}" required
                                maxlength="200" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="mb-2">My Password:</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Set your new password here..." maxlength="200" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success text-light mt-5">Update My Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<x-admin-footer />