<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <h2 class="panel-headings">Add New User</h2>
    <p class="panel-breadcrumbs">Dashboard/Add New User</p>
</div>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab mb-4"><br/>
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
                <form action="{{route('add.newUser')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="mb-2">Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name of the user..." required maxlength="200" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="mb-2">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email of the user..." required maxlength="200" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="mb-2">Password:</label>
                            <input type="password" name="password" class="form-control" required
                                placeholder="Set a password here..." maxlength="200" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success text-light mt-5">Add New User</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="card">
    <h4 class="card-title card-title-dash m-4">Here are other people who share this application with you</h4>
        <div class="col-12">
            <div class="table-box">
            <table class="table" id="datatable" style="overflow-x:scroll !important;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created Date/Time</th>
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
<x-admin-footer />