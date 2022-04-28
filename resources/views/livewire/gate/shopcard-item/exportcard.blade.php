<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                    Xuất CSV card item</h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="container" style="background: #FFFFFF">
                @if(isset($message))
                <div class="row">
                    <div class="col"><span class="alert alert-warning">{{$message}}</span></div>
                </div>
                @endif
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="nhamang">Nhà mạng</label>
                        <select
                        wire:change.prevent="$emit('getValueScript')"
                        style="margin-top:6px" class="form-control" id="nhamang">
                        <option selected="selected" value="viettel">Viettel</option>
                        <option value="appota">Appota</option>
                        <option value="mobifone">Mobifone
                        </option>
                        <option value="vinaphone">Vinaphone
                        </option>
                        <option value="vnmobile">VNMobile
                        </option>
                        <option value="beeline">Beeline</option>
                        <option value="zing">Zing</option>
                        <option value="vcoin">VCoin</option>
                        <option value="gate">Gate</option>
                        <option value="garena">Garena</option>
                        <option value="megacard">MegaCard
                        </option>
                        <option value="scoin">SCoin</option>
                        <option value="oncash">OnCash</option>
                        <option value="soha">Soha</option>
                        <option value="funtap">Funtap</option>
                        <option value="viettel_data">Viettel Data
                        </option>
                        <option value="mobifone_data">Mobifone Data
                        </option>
                        <option value="vinaphone_data">Vinaphone Data
                        </option>
                    </select>
                </div>



            </div>
            <div class="col">

                <div class="form-group">
                    <label for="value">Mệnh giá</label>
                    <select style="margin-top: 6px" class="form-control" id="value">
                        <option value="10000">10000</option>
                        <option value="20000">20000</option>
                        <option value="30000">30000</option>
                        <option value="50000">50000</option>
                        <option value="100000">100000</option>
                        <option value="200000">200000</option>
                        <option value="300000">300000</option>
                        <option value="500000">500000</option>
                        <option value="1000000">1000000</option>
                        <option value="2000000">2000000</option>
                        <option value="3000000">3000000</option>
                        <option value="5000000">5000000</option>
                    </select>
                </div>




            </div>
            <div class="col">
              <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="text" class="form-control" id="quantity" placeholder="Nhập số lượng">
            </div>

        </div>
        <div class="col">
            <div class="form-group">
                <button wire:click.prevent="$emit('exportcardItemScript')" style="margin-top: 33px" class="btn btn-primary">Xuất thẻ</button>
            </div>

        </div>
    </div>
<hr>

    {{-- begin search form --}}
    <div class="row">
      <div class="col-3">
        <div class="form-group">
            <label for="nhamangSearch">Nhà mạng</label>
            <select
            style="margin-top:6px" class="form-control" id="nhamangSearch">
            <option selected="selected" value="">All</option>
            <option value="viettel">Viettel</option>
            <option value="appota">Appota</option>
            <option value="mobifone">Mobifone
            </option>
            <option value="vinaphone">Vinaphone
            </option>
            <option value="vnmobile">VNMobile
            </option>
            <option value="beeline">Beeline</option>
            <option value="zing">Zing</option>
            <option value="vcoin">VCoin</option>
            <option value="gate">Gate</option>
            <option value="garena">Garena</option>
            <option value="megacard">MegaCard
            </option>
            <option value="scoin">SCoin</option>
            <option value="oncash">OnCash</option>
            <option value="soha">Soha</option>
            <option value="funtap">Funtap</option>
            <option value="viettel_data">Viettel Data
            </option>
            <option value="mobifone_data">Mobifone Data
            </option>
            <option value="vinaphone_data">Vinaphone Data
            </option>
        </select>
    </div>
</div>
<div class="col-3">

    <div class="form-group">
        <label for="valueSearch">Mệnh giá</label>
        <select style="margin-top: 6px" class="form-control" id="valueSearch">
            <option value="">All</option>
            <option value="10000">10000</option>
            <option value="20000">20000</option>
            <option value="30000">30000</option>
            <option value="50000">50000</option>
            <option value="100000">100000</option>
            <option value="200000">20000</option>
            <option value="300000">300000</option>
            <option value="5000000">500000</option>
            <option value="1000000">1000000</option>
            <option value="2000000">2000000</option>
            <option value="3000000">3000000</option>
            <option value="5000000">5000000</option>
        </select>
    </div>




</div>
<div class="col-3">
  <div class="form-group">
    <label for="quantitySearch">Số lượng</label>
    <input type="text" class="form-control" id="quantitySearch" placeholder="Nhập số lượng">
</div>

</div>

<div class="col-3">
  <div class="form-group">
    <label for="emailAdminSearch">Email</label>
    <input type="email" class="form-control" id="emailAdminSearch" placeholder="Nhập email">
</div>

</div>

</div>
<div class="row">
    <div class="col-3">
         <div class="form-group">
            <label for="startTimeSearch">Start Time</label>
            <input
            autocomplete="off"
            type="text" class="form-control" id="startTimeSearch" placeholder="Y-m-d H:i:s">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="endTimeSearch">End Time</label>
            <input
            autocomplete="off"
            type="text" class="form-control" id="endTimeSearch" placeholder="Y-m-d H:i:s">
        </div>
    </div>
    <div class="col-3">
    <div class="form-group">
        <button wire:click.prevent="$emit('searchExportItemScript')" style="margin-top: 33px" class="btn btn-primary">Search</button>
    </div>

</div>
</div>

{{-- end search form --}}


{{-- details modal --}}
<div
    wire:ignore.self
    id="modal-data-card"
    class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details card items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- @dump($listCardItemDetail) --}}
        @if(!isset($loading))
        <span class="d-flex justify-content-center">
            @livewire('loading.loading')
        </span>
        @endif
        <span>We have <strong style="color: red">{{$count}}</strong> card items</span>
        <span style="margin-left: 20px; font-size: 14px; color: red">{{$codeCard}}</span>
        {{-- @dump($listCardItemDetail) --}}
        <table class="table table-light table-detail-card-item">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Serial</th>
                    <th>vendor</th>
                    <th>value</th>
                    <th>Provider Code</th>
                    <th>Expire</th>
                    <th>Sole</th>
                    <th>Public</th>
                    <th>Update at</th>
                </tr>
            </thead>
            <tbody id="data-card">
                {{-- @dump($listCardItemDetail) --}}
                @if(isset($listCardItemDetail) and !empty($listCardItemDetail))
                @foreach($listCardItemDetail as $listDetails)
                {{-- @dump(date('Y-m-d H:i:s', $listDetails->expiry)) --}}
                <tr>
                    <td>
                        {{(isset($listDetails->id))?$listDetails->id:''}}</td>
                    <td>
                        @can('shopcard-card-item-code-card')
                             <span
                        id="codecard-{{(isset($listDetails->id))?$listDetails->id:''}}">{{(isset($listDetails->codecard))?$listDetails->codecard:''}}</span>
                        @endcan

                        {{-- <button
                        id="btn-{{(isset($listDetails->id))?$listDetails->id:''}}"
                        wire:click.prevent="$emit('ShowCodeScript', '{{(isset($listDetails->id))?$listDetails->id:''}}')"
                        class="btn btn-primary" style="width: 43px; height: 19px; padding: 1px; font-size: 10px;">Show</button> --}}
                    </td>
                    <td>{{(isset($listDetails->serial))?$listDetails->serial:''}}</td>
                    <td>{{(isset($listDetails->vendor))?$listDetails->vendor:''}}</td>
                    <td>{{(isset($listDetails->value))?$listDetails->value:''}}</td>
                    <td>{{(isset($listDetails->provider_code))?$listDetails->provider_code:''}}</td>
                    <td>{{date('Y-m-d', strtotime((isset($listDetails->expiry))?$listDetails->expiry:'0'))}}</td>
                    <td>{{(isset($listDetails->sold))?$listDetails->sold:''}}</td>
                    <td>{{(isset($listDetails->public))?$listDetails->public:''}}</td>
                    <td>{{date('Y-m-d', (isset($listDetails->updatedAt))?$listDetails->updatedAt:'0')}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
{{-- end details modal --}}

<div class="row">
    <div class="col">
        <table class="table table-light">
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Nhà mạng</th>
                    <th>Mệnh giá</th>
                    <th>Số lượng</th>
                    <th>Email Admin</th>
                    <th>Card Items</th>
                    <th>Create at</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if(isset($listCardItemLog))
                    @foreach($listCardItemLog as $list)
                    <tr>
                        <td>{{$list->id}}
                        </td>
                        <td>{{$list->vendor}}</td>
                        <td>{{$list->amount}}</td>
                        <td>{{$list->quantity}}</td>
                        <td>{{$list->email_admin}}</td>
                        <td>{{$list->card_items}}</td>
                        <td>{{date('Y-m-d H:i:s', $list->created_at)}}</td>
                        <td><a
                            data-toggle="modal"
                            data-target=".bd-example-modal-xl"
                            wire:click.prevent="$emit('getDataTableScript', '{{$list->card_items}}', '{{$list->id}}')"><i class=" flaticon2-search-1"></i></a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </tr>
        </table>

        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @if(isset($totalPage))
        @for($i = $startPage; $i <= $endPage; $i++)
        <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
        @endfor
        @endif
        <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
        </a>
    </li>
</ul>
</nav>
</div>
</div>
</div>
</div>

<!-- end:: Content -->
</div>
</div>
