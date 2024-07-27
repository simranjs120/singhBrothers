<x-Admin-header :profile="$profile"/>

<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                <h4 class="card-title card-title-dash m-4">All Your Inventory</h4>
                <button type="button" class="btn btn-success m-3 mt-0 text-light">+ New Inventory</button>
                <table class="table" id="datatable" style="overflow-x:scroll;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub-Categories</th>
                            <th scope="col">Item Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Stock Available</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <img src="https://www.ikea.com/in/en/images/products/himmelsby-frame-white__0945737_ph172196_s5.jpg?f=xxs"class="img-fluid"/>
                            </td>
                            <td>Italian Moulding</td>
                            <td>Frames</td>
                            <td>Frames/moulding</td>
                            <td>₹ 1800/-</td>
                            <td><span class="badge badge-danger">In-Active</span></td>
                            <td>100</td>
                            <td>
                                <button type="button" class="btn btn-success text-light">View</button>
                                <button type="button" class="btn btn-primary text-light">Edit</button>
                                <button type="button" class="btn btn-danger text-light">Del</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-admin-footer />