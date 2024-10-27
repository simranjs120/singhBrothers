<x-header :web="$web" />
<style>
    .badge-spotlight {
        margin-bottom: 12px;
    }
</style>
<main>
<section id="spotlight" class="spotlight" height="auto">
    <div class="container">
      <div class="text-center">
      <h2 class="spotlight-heading mt-5"><br/>{{$LabelName}}</h2>
      <div class='container'>
        <div class="spotlight-render-here">
        </div>
      </div>
      </div>
    </div>
    </section>
    <section id="" class="mt-5">
        <div class="container">
            <div class="row">
                @foreach($inventory as $row)
                    <div class="col-lg-4 mt-4">
                        <a
                            href="{{env('APP_URL')}}/listing/{{base64_encode($row['id'])}}/{{base64_encode($row['category_id'])}}/{{base64_encode($row['sub_category_id'])}}">
                            <div class="card">
                                <img src="{{Helper::props('admin/inventoryImages') . '/' . $row['thumbnailimg']}}"
                                    class="img-fluid p-2" />
                                @if($row['offerBadge'] !== "")
                                    <p style="text-align:left; margin-left:10px;">
                                        <span class="badge badge-spotlight">{{$row['offerBadge']}}</span>
                                    </p>
                                @endif
                                <h4 class="spotlight-itemName">{{$row['itemName']}}</h4>
                                @if($row['importantNote'] !== "")
                                    <p class="text-dark text-start" style="margin:0px 0px 0px 10px;">{{$row['importantNote']}}</p>
                                @endif
                                <h4 class="spotlight-pricetag">
                                    @if($row['strikerPrice'] != "")<s>₹{{$row['strikerPrice']}}</s>&nbsp;@endif₹{{$row['actualPrice']}}
                                </h4>
                                @if($row['salePitch'] != "")
                                    <h6 class="text-danger" style="font-weight:bold;text-align:left; padding-left:10px;">
                                        {{$row['salePitch']}}</h6><br/>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
</main>
<x-footer />