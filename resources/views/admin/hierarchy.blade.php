<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
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
                <h4 class="card-title card-title-dash m-3">Category: {{$categoryName->category}}</h4>
                <button type="button" class="btn btn-success m-3 mt-0 text-light" data-bs-toggle="modal"
                                data-bs-target="#hierarchyModal">+ Initiate new Hierarchy</button>
                                <table class="table" id="datatable" style="overflow-x:scroll;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hierarchy</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hierachyData as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$row->breadcrumb}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <a href="{{url('/admin/change-hierarchy-status/' . $row->id . '/1')}}">
                                                    <span class="badge badge-danger"
                                                        onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                                </a>
                                            @endif
                                            @if($row->status == 1)
                                                <a href="{{url('/admin/change-hierarchy-status/' . $row->id . '/0')}}">
                                                    <span class="badge badge-success"
                                                        onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success text-light" onclick="editCategory('{{$row->id}}','{{$row->breadcrumb}}')">Edit Hierarchy</button>
                                            <a href="{{url('/admin/delete-hierarchy/' . $row->id)}}">
                                                <button type="button" class="btn btn-danger text-light"
                                                    onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>

<!-- Add first child Modal -->
<div class="modal fade" id="hierarchyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new hierarchy first child.</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add.hierarchy')}}" method="POST">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$parent_id}}">
                    <input type="hidden" name="category_name" value="{{$categoryName->category}}">
                    <label>Parent Category: <b>/{{$categoryName->category}}</b></label>
                    <br>    
                    <label class="mt-3">Select the first child: </label>
                    <select class="form-control" id="" name="subcategory_id"
                        style="color:black !important;" required>
                        <option selected disabled value="">--- Select First Child ---</option>
                        @foreach($subCategoryData as $data)
                            <option value="{{$data->id}}">{{$data->sub_category}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Hierarchy Modal -->
<div class="modal fade" id="editHierarchyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new hierarchy first child.</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('edit.hierarchy')}}" method="POST">
                    @csrf
                    <input type="hidden" class="id" name="id" value="">
                    <input type="hidden" class="prewritten" name="prewritten" value=""/>
                    <label class="label-for-breadbrumb"><b></b></label>
                    <br>    
                    <label class="mt-3">Create Hierarchy: </label>
                    <select class="form-control" id="" name="subcategory_id"
                        style="color:black !important;" required>
                        <option selected disabled value="">--- Select Steps ---</option>
                        @foreach($subCategoryData as $data)
                            <option value="{{$data->id}}">{{$data->sub_category}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<x-admin-footer />
<script>
    $(document).ready(function(){
        $('.nav-category-sidebar').addClass('active');
    });

    function editCategory(id,breadcrumb){
        $('#editHierarchyModal').modal('show');
        $('.label-for-breadbrumb').text(breadcrumb);
        $('.id').val(id);
        $('.prewritten').val(breadcrumb);
    }
</script>