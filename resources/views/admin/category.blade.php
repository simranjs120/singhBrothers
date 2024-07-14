<x-Admin-header :profile="$profile" />
<style>
    .badge:hover{
        cursor:pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                <h4 class="card-title card-title-dash m-4">Here's the list of all your categories</h4>
                <button type="button" class="btn btn-success m-3 mt-0 text-light" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">+ New Category</button>
                <button type="button" class="btn btn-primary m-3 mt-0 text-light">+ New Sub-Category</button>
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
                <table class="table" id="datatable" style="overflow-x:scroll;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryData as $key=>$row)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->category}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>
                                @if($row->status==0)
                                    <a href="{{url('admin/categories/change-status/'.$row->id.'/1')}}">
                                        <span class="badge badge-danger" onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                    </a>
                                @endif
                                @if($row->status==1)
                                    <a href="{{url('admin/categories/change-status/'.$row->id.'/0')}}">
                                        <span class="badge badge-success" onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-success text-light">View</button>
                                <button type="button" class="btn btn-danger text-light">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new category to the system from here.</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add.category')}}" method="POST">
                    @csrf
                    <label>Enter Your New Category: </label>
                    <input type="text" name="category" class="form-control mt-1 border border-dark" required
                        maxlength="100" placeholder="Start Typing...." />
            </div>
            <div class="modal-footer">
                <button type="suubmit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<x-admin-footer />