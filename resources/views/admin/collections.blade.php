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
                    <div class="tab-pane fade show active" id="categories" role="tabpanel">
                        <h4 class="card-title card-title-dash p-3">Here's the list of all your collections</h4>
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
                                        <td>{{$row->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.nav-category-sidebar').addClass('active');
</script>
<x-admin-footer />