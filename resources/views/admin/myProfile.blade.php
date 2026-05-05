<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="container-fluid px-3">

  <!-- Header -->
  <div class="row mb-3">
    <div class="col-12">
      <h1 class="mb-1">My Profile</h1>
      <p class="text-muted small mb-0 mt-3">Admin / More Options / My Profile</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
                <p class="fs-4 mb-4">You can update your profile from here <b>{{$profile->name}}</b></p>
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
                    <button type="submit" class="btn btn-sm py-2 px-4 fw-bold rounded-3 background-secondary text-dark border border-dark text-decoration-none mt-4">Update My Profile</button>
                </form>
                <p class="mt-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Pro Tip:</u>
                    </b> If you don't want to update your password, You can leave it blank
                    & proceed.</p>
            </div>
        </div>
    </div>
</div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4 class="card-title card-title-dash">My Activity (New to Old)</h4>
                </div>
            <ul class="list-unstyled ps-3 mb-0 small sb-timeline">
            @foreach($tracking as $row)
              <li>
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-1 gap-lg-3">
                  <div>
                    <span class="text-dark fw-bold">{{$row->changer_name}}</span> {{$row->change_title}}
                    <p class="fw-bold mb-0">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}
                    </p>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
            </div>
        </div>
    </div>
</div>
</div>
<x-admin-footer />