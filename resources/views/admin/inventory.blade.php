<x-Admin-header :profile="$profile" />

<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab" style="overflow-x:scroll !important;">
                <h4 class="card-title card-title-dash m-4">All Your Inventory</h4>
                <a href="{{url('admin/addInventory')}}">
                    <button type="button" class="btn btn-success m-3 mt-0 text-light">+ New Inventory</button>
                </a>
                <table class="table" id="datatable" style="overflow-x:scroll !important;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Striker Price</th>
                            <th scope="col">Actual Price</th>
                            <th scope="col">Offer Badge</th>
                            <th scope="col">Dimensions</th>
                            <th scope="col">Size</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Collection</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventory as $key => $row)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}"
                                        class="img-fluid" />
                                </td>
                                <td>{{$row->itemName}}</td>
                                <td>{{$row->strikerPrice}}</td>
                                <td>{{$row->actualPrice}}</td>
                                <td>{{$row->offerBadge}}</td>
                                <td>{{$row->dimensions}}</td>
                                <td>{{$row->size}}</td>
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->collection_name}}</td>
                                <td>
                                    @if($row->status == 0)
                                        <a href="{{url('')}}">
                                            <span class="badge badge-danger"
                                                onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                        </a>
                                    @endif
                                    @if($row->status == 1)
                                        <a href="{{url('')}}">
                                            <span class="badge badge-success"
                                                onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success text-light">View</button>
                                    <button type="button" class="btn btn-danger text-light">Del</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-admin-footer />