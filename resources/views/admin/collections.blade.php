<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-6 breadcrumbs">
                <h5 class="m-4">
                    <a href="{{url('admin/categories')}}">Category</a> / <a href="{{url('admin/categories')}}">Manage Category</a> /  
                    <span class="breadcrumbs-active">Collections</span>
                </h5>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                    <div class="tab-pane fade show active" id="categories" role="tabpanel">
                        <h4 class="card-title card-title-dash p-3">Here's the list of all your collections</h4>
                        <div class="table-box" style="overflow-x:scroll !important;">
                            <table class="table" id="datatable" style="overflow-x:scroll;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Collection</th>
                                        <th scope="col">Created On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($collectionData as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$row->collection}}</td>
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
<script>
    $('.nav-category-sidebar').addClass('active');
</script>
<x-admin-footer />