<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="container-fluid px-3">
    <!-- Header -->
    <div class="row mb-0">
        <div class="col-12">
            <h1 class="mb-1">View Collections</h1>
            <p class="text-muted small mb-0 mt-3">Admin / Categories & Collections / View Collections</p>
            <p class="text-muted mb-0 mt-3">
                Collections are the final paths created from your category tree. Assign one of these collections to an
                inventory item so the item appears under the correct main category and child category.
            </p>
        </div>
    </div>

    <br />
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="tab-pane fade show active" id="categories" role="tabpanel">
                    <a href="javascript:history.back()" class="mb-4 text-decoration-none text-dark d-inline-flex align-items-center gap-2 fw-semibold">
                        <i class="bi bi-arrow-left"></i>Back
                    </a>
                        <p class="fs-4 mb-1">Available collection paths</p>
                        <p class="text-muted">
                            Example: Frames / Italian / 3mm. When adding inventory, select the most specific collection.
                        </p>
                        <div class="table-box" style="overflow-x:scroll !important;">
                            <table class="table" id="datatable" style="overflow-x:scroll;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Collection Path</th>
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
</div>
<script>
    $('.nav-category-sidebar').addClass('active');
</script>
<x-admin-footer />
