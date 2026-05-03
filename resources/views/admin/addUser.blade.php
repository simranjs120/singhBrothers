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
      <h1 class="mb-1">System users</h1>
      <p class="text-muted small mb-0 mt-3">Admin / Add New User</p>
    </div>
  </div>

  <!-- Form Card -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <p class="fs-4">Add a new user</p>
          @if (Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
              <h6 class="text-light mb-0">{{Illuminate\Support\Facades\Session::pull('success')}}</h6>
            </div>
          @endif

          @if (Illuminate\Support\Facades\Session::has('error'))
            <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
              <h6 class="text-light mb-0">{{Illuminate\Support\Facades\Session::pull('error')}}</h6>
            </div>
          @endif

          <form action="{{route('add.newUser')}}" method="POST">
            @csrf

            <div class="row g-3">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <label class="mb-1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name of the user..." required
                  maxlength="200" />
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12">
                <label class="mb-1">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email of the user..." required
                  maxlength="200" />
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12">
                <label class="mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Set a password here..."
                  required maxlength="200" />
              </div>
            </div>

            <button type="submit" class="btn btn-sm py-2 background-secondary text-decoration-none text-dark border border-dark border-1 rounded-3 px-4 mt-4 fw-bold">
              Add New User
            </button>

          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Table Card -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">

        <div class="card-body">
          <p class="fs-4">List of all users</p>

          <div class="table-responsive">
            <table class="table" id="datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created Date/Time</th>
                </tr>
              </thead>

              <tbody>
                @foreach($fetchUsers as $key => $row)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                  </tr>
                @endforeach
              </tbody>

            </table>
          </div>

        </div>

      </div>
    </div>
  </div>

</div>

<x-admin-footer />