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
                <h4 class="card-title card-title-dash" style="margin: 20px 0px 30px 0px;">You can update your profile from here {{$profile->name}}</h4>
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
                    <button type="submit" class="btn btn-success text-light mt-4">Update My Profile</button>
                </form>
                <p class="mt-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Pro Tip:
                        </u>
                    </b>Password is not pre-set here, If you don't want to update your password, You can leave it blank
                    & proceed.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card mt-4">
        <div class="col-lg-12">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4 class="card-title card-title-dash">My Activity (New to Old)</h4>
                    <p class="mb-0">Timestamps</p>
                </div>
                <ul class="bullet-line-list">
                    @foreach($tracking as $row)
                        <li>
                            <div class="d-flex justify-content-between">
                                <div><span class="text-primary">{{$row->changer_name}}</span>
                                    {{$row->change_title}}
                                    <p id="mobile-agent">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p>
                                </div>
                                <p id="pc-agent">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="list align-items-center pt-3">
                    <div class="wrapper w-100">
                        <p class="mb-0">
                            <a href="{{url('/admin/all-activity')}}" class="fw-bold text-primary">Show all activity<i
                                    class="mdi mdi-arrow-right ms-2"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin-footer />