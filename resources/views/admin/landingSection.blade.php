<x-Admin-header :profile="$profile" />
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-6 breadcrumbs">
                <h4 class="card-title card-title-dash m-4">Update landing section from here</h4>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="m-4">Update Navigation Links</h5>
                @if (Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('success')}}</h5>
                    </div><br/>
                @endif
                @if (Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('error')}}</h5>
                    </div><br/>
                @endif
                <div class="table-box" style="overflow-x:scroll !important;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tab Name</th>
                                <th scope="col">Tab Link</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>@if($navTabs->nav_tab_1!="") {{$navTabs->nav_tab_1}} @else - @endif</td>
                                <td>@if($navTabs->nav_tab_1_link!="") {{$navTabs->nav_tab_1_link}} @else - @endif</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="configurationModal('1')">Configure</button></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>@if($navTabs->nav_tab_2!="") {{$navTabs->nav_tab_2}} @else - @endif</td>
                                <td>@if($navTabs->nav_tab_2_link!="") {{$navTabs->nav_tab_2_link}} @else - @endif</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="configurationModal('2')">Configure</button></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>@if($navTabs->nav_tab_3!="") {{$navTabs->nav_tab_3}} @else - @endif</td>
                                <td>@if($navTabs->nav_tab_3_link!="") {{$navTabs->nav_tab_3_link}} @else - @endif</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="configurationModal('3')">Configure</button></td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>@if($navTabs->nav_tab_4!="") {{$navTabs->nav_tab_4}} @else - @endif</td>
                                <td>@if($navTabs->nav_tab_4_link!="") {{$navTabs->nav_tab_4_link}} @else - @endif</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="configurationModal('4')">Configure</button></td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>@if($navTabs->nav_tab_5!="") {{$navTabs->nav_tab_5}} @else - @endif</td>
                                <td>@if($navTabs->nav_tab_5_link!="") {{$navTabs->nav_tab_5_link}} @else - @endif</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="configurationModal('5')">Configure</button></td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>@if($navTabs->nav_tab_6!="") {{$navTabs->nav_tab_6}} @else - @endif</td>
                                <td>@if($navTabs->nav_tab_6_link!="") {{$navTabs->nav_tab_6_link}} @else - @endif</td>
                                <td><button type="button" class="btn btn-primary btn-sm" onclick="configurationModal('6')">Configure</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="m-4">Update Headings</h5>
                <form action="{{route('configure.headings')}}" method="POST">
                    @csrf
                    <label>Enter Title: </label>
                        <input type="text" name="title" class="form-control mt-1 border border-dark"
                        maxlength="70" placeholder="Enter title" value="{{$headings->title}}"/><br/>
                        <label>Enter Title Colored Words: </label>
                        <input type="text" name="titleColor" class="form-control mt-1 border border-dark"
                        maxlength="45" placeholder="Enter title colored words" value="{{$headings->title_color}}"/><br/>
                    <label>Enter Tagline: </label>
                        <input type="text" name="tagline" class="form-control mt-1 border border-dark"
                        maxlength="70" placeholder="Enter tagline" value="{{$headings->tagline}}"/><br/>
                    <label>Enter line above search bar: </label>
                        <input type="text" name="search_line" class="form-control mt-1 border border-dark mb-3"
                        maxlength="70" placeholder="Enter line above search bar" value="{{$headings->search_line}}"/>
                    <button type="submit" class="btn btn-success w-100 mb-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Configure Navigation Item -->
<div class="modal fade" id="configurationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Configure new navigation tab.</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('configure.tab')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="setNavId" name="tabNumber"/>
                    <label>Enter Tab Name: </label>
                    <input type="text" name="tabName" class="form-control mt-1 border border-dark"
                        maxlength="45" placeholder="Enter Tab Name" />
                        <br/>
                        <label>Enter Tab Link: </label>
                        <input type="text" name="tabLink" class="form-control mt-1 border border-dark"
                        maxlength="100" placeholder="Enter Tab Name" />
            </div>
            <p class="mt-1 p-1"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Pro Tip: </u></b>If you want to remove this tab, Submit this blank.</p>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
            
        </div>
    </div>
</div>
<!-- Footer -->
<x-admin-footer />
<script>
function configurationModal(id){
    $('#configurationModal').modal('show');
    $('#setNavId').val(id);
}
</script>