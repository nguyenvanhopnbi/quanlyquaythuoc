
<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Risk Management

                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                style="color: #48465b;"
                class="fs-6 nav-link @if($tab == 'whitelist') {{'active'}} @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#whitelist" type="button" role="tab" aria-controls="home" aria-selected="true">White List</button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                style="color: #48465b;"
                class="fs-6 nav-link @if($tab == 'blacklist') {{'active'}} @endif" id="profile-tab" data-bs-toggle="tab" data-bs-target="#blacklist" type="button" role="tab" aria-controls="profile" aria-selected="false">Black List</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <button
                style="color: #48465b;"
                class="fs-6 nav-link @if($tab == 'ccbypass') {{'active'}} @endif" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ccbypass" type="button" role="tab" aria-controls="profile" aria-selected="false">CC account by pass</button>
            </li> --}}
           {{--  <li class="nav-item" role="presentation">
                <button
                style="color: #48465b;"
                class="fs-6 nav-link @if($tab == 'rulerisk') {{'active'}} @endif" id="profile-tab" data-bs-toggle="tab" data-bs-target="#rulerisk" type="button" role="tab" aria-controls="profile" aria-selected="false">Rule risk</button>
            </li>
 --}}
        </ul>

        <div class="tab-content" id="myTabContent">
            {{-- @dd($listRuleRisk) --}}
            <div
            class="tab-pane fade @if($tab == 'rulerisk') {{'show active'}} @endif"
            id="rulerisk">

            {{-- begin search form rule risk --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Rule Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your code" type="text" class="form-control" name="search_cc_account_rule_risk" id="search_cc_account_rule_risk">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a
                                            wire:click.prevent="$emit('searchRuleRiskCodeScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewRuleRiskModal"> Add new </a>

                                        </div>
                                    </div>
                                </div>
                                @if(isset($messageBypassSearch))
                                <div style="width: 70%; margin-top: 10px" class="alert alert-warning">{{$messageBypassSearch}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end search form rule risk --}}

            {{-- begin modal add new Rule risk form modal --}}
            <div wire:ignore.self class="modal fade" id="addnewRuleRiskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new rule risk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(isset($messageRuleRisk))
                    <tr>
                        <td colspan="2"><span class="alert alert-info">{{$messageRuleRisk}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Code: </span></td>
                        <td><input type="text" class="form-control" id="ruleriskCode"></td>
                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Name: </span></td>
                        <td>
                            <input type="text" class="form-control" id="ruleriskName">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('addNewRuleRiskScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new rule risk form modal --}}


{{-- begin modal update Rule risk form modal --}}
<div wire:ignore.self class="modal fade" id="UpdateRuleRiskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update rule risk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <table class="table table-light">
        @if(isset($messageRuleRisk))
        <tr>
            <td colspan="2"><span class="alert alert-info">{{$messageRuleRisk}}</span></td>
        </tr>
        @endif
        <tr>
            <td><span class="d-flex justify-content-center">Code: </span></td>
            <td>
                <input id="IDupdateruleRisk" type="hidden"
                value="@if(isset($idRuleRisk)){{$idRuleRisk}} @endif">
                <input type="text" class="form-control" id="UpdateruleriskCode"></td>
            </tr>
            <tr>
                <td><span class="d-flex justify-content-center">Name: </span></td>
                <td>
                    <input type="text" class="form-control" id="UpdateruleriskName">
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button wire:click.prevent="$emit('UpdateRuleRiskScript')" type="button" class="btn btn-primary">Save</button>
    </div>
</div>
</div>
</div>
{{-- end modal update rule risk form modal --}}

<table class="table table-light table-ccAccountWhitelist">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Create at</th>
            <th>Update at</th>
            <th>Action</th>
        </tr>
    </thead>

    {{-- @dump($listRuleRisk) --}}
    @if(isset($listRuleRisk) and !empty($listRuleRisk))
    @foreach($listRuleRisk as $listRuleRiskTable)
    <tr>
        <td><input style="width:100px" id="IDruleRisk-{{$listRuleRiskTable->id}}" type="text" value="{{$listRuleRiskTable->id}}"></td>
        <td><input style="width:100px"  type="text" id="ruleriskcode-{{$listRuleRiskTable->id}}" value="{{$listRuleRiskTable->code}}"></td>
        <td><input type="text" id="ruleriskName-{{$listRuleRiskTable->id}}" value="{{$listRuleRiskTable->name}}"></td>
        <td> <input id="createTime-{{$listRuleRiskTable->id}}" type="text" value="{{date('Y-m-d H:i:s', $listRuleRiskTable->created_at)}}"></td>
        <td> <input id="UpdateTime-{{$listRuleRiskTable->id}}" type="text" value="{{date('Y-m-d H:i:s', $listRuleRiskTable->updated_at)}}"></td>
        <td><a data-placement="top" title="Update Rule Risk" wire:click.prevent="$emit('getDateTableRuleRisk', '{{$listRuleRiskTable->id}}')" data-toggle="modal" data-target="#UpdateRuleRiskModal">
            <i class="flaticon2-pen"></i> |
        </a>
        <a data-placement="top" title="Delete CC Account Whitelist Bypass" wire:click.prevent="$emit('deleteRuleRiskScript', '{{$listRuleRiskTable->id}}')">
            <i class="flaticon2-delete"></i>
        </a></td>
    </tr>
    @endforeach
    @endif
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item @if($currentPageRuleRisk <= 1) {{'disabled'}} @endif"
    wire:click.prevent="getPageCurrentRuleRisk({{$currentPageRuleRisk - 1}})">
    <a class="page-link" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
    </a>
</li>
@if(isset($totalPageRuleRisk))
@for($i = 1; $i <= $totalPageRuleRisk; $i++)
<li
wire:click.prevent="getPageCurrentRuleRisk({{$i}})"
class="page-item @if($currentPageRuleRisk == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
@endfor
@endif
<li class="page-item @if($currentPageRuleRisk >= $totalPageRuleRisk) {{'disabled'}} @endif" wire:click.prevent="getPageCurrentRuleRisk({{$currentPageRuleRisk + 1}})">
  <a class="page-link" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
    <span class="sr-only">Next</span>
</a>
</li>
</ul>
</nav>
</div>

<div
class="tab-pane fade @if($tab == 'ccbypass') {{'show active'}} @endif"
id="ccbypass">

{{-- begin search form cc acount by pass --}}

<div class="kt-portlet__body">
    <div class="row align-items-center">
        <div class="col-xl-12 order-2 order-xl-1">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <label>Rule Code:</label>
                            <div class="kt-input-icon kt-input-icon--left">
                                <input placeholder="enter your code" type="text" class="form-control" name="search_cc_account_rule_code" id="search_cc_account_rule_code">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>

                        </div>

                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>&nbsp;</label>
                                </div>
                                <a
                                wire:click.prevent="$emit('searchCCAccountBypassScript')"
                                class="btn btn-primary"
                                style="color:#FFF">Search</a>

                                <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewccAccountBypass"> Add new </a>

                            </div>
                        </div>
                    </div>
                    @if(isset($messageBypassSearch))
                    <div style="width: 70%; margin-top: 10px" class="alert alert-warning">{{$messageBypassSearch}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end search form cc account by pass --}}

{{-- begin modal add new cc account bypass --}}
<div wire:ignore.self class="modal fade" id="addnewccAccountBypass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <table class="table table-light">
        @if(isset($messageBypass))
        <tr>
            <td colspan="2"><span class="alert @if($warning) {{'alert-warning'}} @else {{'alert-info'}} @endif">{{$messageBypass}}</span></td>
        </tr>
        @endif
        <tr>
            <td><span class="d-flex justify-content-center">Whitelist ID: </span></td>
            <td><input type="text" class="form-control" id="cc_account_whitelistID"></td>
        </tr>
        <tr>
            <td><span class="d-flex justify-content-center">Rule Code: </span></td>
            <td>
                <input list="cc_account_listRuleRisk" type="text" class="form-control" id="cc_account_Rule_Code">

                <datalist id="cc_account_listRuleRisk">
                    @if(isset($listRuleRisk))
                    @foreach($listRuleRisk as $ruleRisk)
                    <option value="{{$ruleRisk->code}}">{{$ruleRisk->name}}</option>
                    @endforeach
                    @endif
                </datalist>

            </td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('addNewAccountBypassScript')" type="button" class="btn btn-primary">Save</button>
</div>
</div>
</div>
</div>
{{-- end modal add new cc account bybass --}}

{{-- begin update modal cc account bybass --}}

<div wire:ignore.self class="modal fade" id="UpdateccAccountBypass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <table class="table table-light">
        @if(isset($messageBypass))
        <tr>
            <td colspan="2"><span class="alert alert-info">{{$messageBypass}}</span></td>
        </tr>
        @endif
        <tr>
            <td><span class="d-flex justify-content-center">Whitelist ID: </span></td>
            <td>
                <input type="hidden" value="{{$idccBypas}}" id="update_cc_account_ID">
                <input type="text" class="form-control" id="update_cc_account_whitelistID"></td>
            </tr>
            <tr>
                <td><span class="d-flex justify-content-center">Rule Code: </span></td>
                <td>
                    <input list="update_cc_account_listRuleRisk" type="text" class="form-control" id="update_cc_account_Rule_Code">
                    <datalist id="update_cc_account_listRuleRisk">
                        @if(isset($listRuleRisk))
                        @foreach($listRuleRisk as $ruleRisk3)
                        <option value="{{$ruleRisk3->code}}">{{$ruleRisk3->name}}</option>
                        @endforeach
                        @endif
                    </datalist>

                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button wire:click.prevent="$emit('UpdateAccountBypassScript')" type="button" class="btn btn-primary">Save</button>
    </div>
</div>
</div>
</div>

{{-- end update modal cc account bypass --}}

<table class="table table-light table-ccAccountWhitelist">
    <tr>
        <th>ID</th>
        <th>Whitelist Card ID</th>
        <th>Rule</th>
        <th>Create at</th>
        <th>Update at</th>
        <th>Action</th>
    </tr>

    @if(isset($ccAcountBypassRuleList))
    @foreach($ccAcountBypassRuleList as $acountBypass)
    <tr>
        <td><input style="width: 100px" type="text" value="{{$acountBypass->id}}"></td>
        <td><input id="cc_accounts_whitelist_id-{{$acountBypass->id}}" style="width: 100px" type="text" value="{{$acountBypass->cc_accounts_whitelist_id}}"></td>
        <td><input id="rule_code-{{$acountBypass->id}}" type="text" value="{{$acountBypass->rule_code}}"></td>
        <td><input type="text" value="{{date('Y-m-d H:i:s', $acountBypass->created_at)}}"></td>
        <td><input type="text" value="{{date('Y-m-d H:i:s', $acountBypass->updated_at)}}"></td>
        <td>
            <a data-placement="top" title="Update CC Account Whitelist Bypass" wire:click.prevent="$emit('getDateTableccAccountList', '{{$acountBypass->id}}')" data-toggle="modal" data-target="#UpdateccAccountBypass">
                <i class="flaticon2-pen"></i> |
            </a>
            <a data-placement="top" title="Delete CC Account Whitelist Bypass" wire:click.prevent="$emit('deleteCCAccountBypassScript', '{{$acountBypass->id}}')">
                <i class="flaticon2-delete"></i>
            </a>

        </td>
    </tr>
    @endforeach
    @endif
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li wire:click.prevent="getPageCurrent({{$ccPageCurrent - 1}})"
    class="page-item @if($ccPageCurrent <= 1) {{'disabled'}} @endif">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
    </a>
</li>
{{-- @dd($ccTotal) --}}
@for($i = 1 ; $i <= $ccTotal; $i++)
<li class="page-item @if($ccPageCurrent == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
@endfor
<li wire:click.prevent="getPageCurrent({{$ccPageCurrent + 1}})"
class="page-item @if($ccPageCurrent >= $ccTotal) {{'disabled'}} @endif">
<a class="page-link" href="#" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
    <span class="sr-only">Next</span>
</a>
</li>
</ul>
</nav>

</div>

<div class="tab-pane fade @if($tab == 'whitelist') {{'show active'}} @endif"  id="whitelist" role="tabpanel" aria-labelledby="home-tab">
    {{-- begin table white list --}}

    <div class="kt-portlet__body">

        <!--begin: Search Form white list -->
        {{-- <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10"> --}}
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Card Number:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="card_number" id="card_number">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Card Name:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="card_name" id="card_name">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Start Time:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input
                                        autocomplete="off"
                                        placeholder="Y-m-d H:i:s"
                                        type="text" class="form-control" name="startTimeSearch_whitelist" id="startTimeSearch_whitelist">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>End Time:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input
                                        autocomplete="off"
                                        placeholder="Y-m-d H:i:s"
                                        type="text" class="form-control" name="endTimeSearch_whitelist" id="endTimeSearch_whitelist">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <a
                                        wire:click="$emit('searchWhiteListScript')"
                                        class="btn btn-primary"
                                        style="color:#FFF">Search</a>

                                        <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewWhiteList"> Add new </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </form> --}}
    </div>


    <!-- begin Modal add whitelist -->
    <div wire:ignore.self class="modal fade" id="addnewWhiteList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new whitelist card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body addnewWhiteListCardForm">
        @if(isset($messageWhiteList) && $messageWhiteList != '')
        <div class="@if($valid) {{'alert alert-warning'}} @else {{'alert alert-info'}} @endif ">{{$messageWhiteList}}


        </div>
        @endif
        <label>Card Number:</label>
        <div class="kt-input-icon kt-input-icon--left">

            <input placeholder="Enter full card number" type="text" class="form-control" name="addnewWhitelistCardNumber" id="addnewWhitelistCardNumber">

        </div>

        <label>Card Name:</label>
        <div class="kt-input-icon kt-input-icon--left">
            <input placeholder="Enter your card name" type="text" class="form-control" name="addnewWhitelistCardName" id="addnewWhitelistCardName">

        </div>

        <label>Country Card:</label>
        <div class="kt-input-icon kt-input-icon--left">
            <input list="CountrList" placeholder="Enter your country card" type="text" class="form-control" name="addnewWhitelistCountryCard" id="addnewWhitelistCountryCard">
            <datalist id="CountrList">
                @foreach($countrycode_list as $listCountry)
                <option value="{{$listCountry->name}}"></option>

                @endforeach
            </datalist>

        </div>

        <label>Bank Card:</label>
        <div class="kt-input-icon kt-input-icon--left">
            <input placeholder="Enter your bank card" type="text" class="form-control" name="addnewWhitelistBankCard" id="addnewWhitelistBankCard">

        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button wire:click.prevent="$emit('addnewWhiteListScript')" type="button" class="btn btn-primary">Add cards</button>
    </div>
</div>
</div>
</div>

{{-- end modal add white list --}}

{{-- begin modal update whitelist --}}
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateWhiteList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update WhiteList Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body addnewWhiteListCardForm">
    @if(isset($messageWhiteList) && $messageWhiteList != '')
    <div class="@if($valid) {{'alert alert-warning'}} @else {{'alert alert-info'}} @endif">{{$messageWhiteList}}</div>
    @endif
    <input value="{{$idCardUpdate}}" type="hidden" class="form-control" name="updateWhitelistID" id="updateWhitelistID">
    <label>Card Number:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input value="" type="text" class="form-control" name="updateWhitelistCardNumber" id="updateWhitelistCardNumber">

    </div>

    <label>Card Name:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input type="text" class="form-control" name="updateWhitelistCardName" id="updateWhitelistCardName">

    </div>

    <label>Country Card:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input type="text" class="form-control" name="updateWhitelistCountryCard" id="updateWhitelistCountryCard">

    </div>

    <label>Bank Card:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input type="text" class="form-control" name="updateWhitelistBankCard" id="updateWhitelistBankCard">

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('updateWhiteListScript')" type="button" class="btn btn-primary">Update cards</button>
</div>
</div>
</div>
</div>
{{-- end modal update whitelist --}}

{{-- begin detail whitelist modal --}}
<div wire:ignore.self class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Whitelist Card detail ID: <span>@if(isset($detailCardID)) {{$detailCardID}} @endif</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

    <table class="table table-light">
        @if(!isset($detailCardID))
        <tr>
            <td colspan="2">

                <div class="d-flex justify-content-center">
                    @livewire('loading.loading')
                </div>

            </td>
        </tr>
        @else
        <tr>
            <td><span> ID: </span></td>
            <td><span>@if(isset($detailCardID)) {{$detailCardID}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Card Number: </span></td>
            <td><span>@if(isset($detailCardNumber)) {{$detailCardNumber}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Card Hash: </span></td>
            <td><span>@if(isset($detailCardHash)) {{$detailCardHash}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Card Name: </span></td>
            <td><span>@if(isset($detailCardName)) {{$detailCardName}} @endif</span></td>
        </tr>

        <tr>
            <td><span>Country Card: </span></td>
            <td><span>@if(isset($detailCardCountry_card)) {{$detailCardCountry_card}} @endif</span></td>
        </tr>

        <tr>
            <td><span>Bank Card: </span></td>
            <td><span>@if(isset($detailCardBank_card)) {{$detailCardBank_card}} @endif</span></td>
        </tr>

        <tr>
            <td><span>Create Time: </span></td>
            <td><span>@if(isset($detailCardCreatat)) {{$detailCardCreatat}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Update Time: </span></td>
            <td><span>@if(isset($detailCardUpdateat)) {{$detailCardUpdateat}} @endif</span></td>
        </tr>


        @endif

    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
{{-- end detail whitelist modal --}}

{{-- begin modal add new cc account bypass Direct --}}
<div wire:ignore.self class="modal fade" id="addnewccAccountBypassDirect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new CC Account Bypass</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <table class="table table-light">
        @if(isset($messageBypass))
        <tr>
            <td colspan="2"><span class="alert @if($warning == 'exist') {{'alert-warning'}} @else {{'alert-info'}} @endif">{{$messageBypass}}</span></td>
        </tr>
        @endif
        <tr>
            <td><span class="d-flex justify-content-center">Whitelist ID: </span></td>
            <td><input type="text" class="form-control" id="direct_cc_account_whitelistID"></td>
        </tr>
        <tr>
            <td><span class="d-flex justify-content-center">Rule Code: </span></td>
            <td>
                <input list="direct_cc_account_listRuleRisk" type="text" class="form-control" id="direct_cc_account_Rule_Code">
                {{-- @dump($listRuleRisk) --}}
                <datalist id="direct_cc_account_listRuleRisk">
                    @foreach($listRuleRisk as $ruleRisk2)
                    <option value="{{$ruleRisk2->code}}">{{$ruleRisk2->name}}</option>
                    @endforeach
                </datalist>

            </td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('addNewAccountBypassDirectScript')" type="button" class="btn btn-primary">Save</button>
</div>
</div>
</div>
</div>
{{-- end modal add new cc account bybass Direct --}}

<div style="width: 100%">
    <div>
        <table class="table table-light" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Card Number</th>
                    <th>Card Name</th>
                    <th>Country Card</th>
                    <th>Bank Card</th>
                    <th>Create Time</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

{{--                 @if(isset($messageBlacklist) && $messageBlacklist != '')
                <tr>
                    <td colspan="5">
                        <div class="alert alert-info">{{$messageBlacklist}}</div>
                    </td>
                </tr>
                @endif --}}

                @if(isset($whitelist))
                @foreach($whitelist as $list)
                <tr>
                    <td>
                     <input id="whitelist-{{$list->id}}" style="width: 50px;" type="text" class="cardRist"
                     value="{{$list->id}}">
                 </td>
                 <td>
                    <input id="WhiteListcardNumber-{{$list->id}}" type="hidden" class="cardRist" value="{{$list->card_number}}">{{$list->card_number}}
                </td>

                <td>
                    <input id="WhiteListcardName-{{$list->id}}" type="hidden" class="cardRist" value="{{$list->card_name}}">{{$list->card_name}}

                </td>

                <td>
                    <input id="WhiteListCountryCard-{{$list->id}}" type="hidden" class="cardRist" value="{{$list->country_card}}">{{$list->country_card}}

                </td>

                <td>
                    <input id="WhiteListBankCard-{{$list->id}}" type="hidden" class="cardRist" value="{{$list->bank_card}}">{{$list->bank_card}}

                </td>

                <td>
                    <input type="hidden" class="cardRist" value="{{date("Y-m-d H:i:s", $list->updated_at)}}">{{date("Y-m-d H:i:s", $list->updated_at)}}
                </td>
                <td>
                    <a data-placement="top" title="Update card" wire:click.prevent="$emit('getDateTableWhiteList', '{{$list->id}}')" data-toggle="modal" data-target="#updateWhiteList">
                        <i class="flaticon2-pen"></i> |
                    </a>
                    <a data-placement="top" title="Delete card" wire:click.prevent="$emit('deleteWhiteListScript', '{{$list->id}}')">
                        <i class="flaticon2-delete"></i>
                    </a> |
                    <a data-placement="top" title="Detail cards" data-toggle="modal" data-target="#detailModal" style="font-size: 1.15rem; color: #93a2dd; cursor: pointer;" wire:click.prevent="$emit('detailWhiteListScript', '{{$list->id}}')">
                        <i class="flaticon2-search"></i>
                    </a> |
                    <a data-toggle="tooltip" data-placement="top" title="Add to blacklist" style="font-size: 1.15rem; color: #00000; cursor: pointer;" wire:click.prevent="$emit('addDirectBlackListScript', '{{$list->id}}')">
                        <i class="flaticon2-paperplane"></i>
                    </a>
                    |
                    <a data-toggle="modal" data-target="#addnewccAccountBypassDirect" data-placement="top" title="Add to CC Account Bypass" style="font-size: 1.15rem; color: #93a2dd; cursor: pointer;" wire:click.prevent="$emit('addDirectCCAccountBypassScript', '{{$list->id}}')">
                        <i class="flaticon2-paperplane"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{-- @dump('total' . $totalPages) --}}
    {{-- {{$pageCurrent}} --}}
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item @if($pageCurrent <= 1) {{'disabled'}} @endif">
            <a class="page-link" wire:click = "goCurrentPages({{$pageCurrent - 1}})">Previous</a></li>

            @for($i = 1; $i <= $totalPages; $i++)
            <li wire:click.prevent="$emit('goCurrentPagesScript', '{{$i}}')"
            class="page-item @if($pageCurrent == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
            @endfor

            <li class="page-item @if($pageCurrent >= $totalPages) {{'disabled'}} @endif"><a class="page-link" wire:click = "goCurrentPages({{$pageCurrent + 1}})">Next</a></li>
        </ul>
    </nav>
</div>


</div>
<!--end: Datatable -->

</div>
<div class="tab-pane fade @if($tab == 'blacklist') {{'show active'}} @endif" id="blacklist" role="tabpanel" aria-labelledby="profile-tab">

 {{-- begin table black list --}}

 <div class="kt-portlet__body">

    <!--begin: Search Form blacklist -->
    {{-- <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10"> --}}
        <div class="row align-items-center">
            <div class="col-xl-12 order-2 order-xl-1">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <label>Card Number:</label>
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" name="card_number_blacklist" id="card_number_blacklist">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <label>Card Name:</label>
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" name="card_name_blacklist" id="card_name_blacklist">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <label>Start Time:</label>
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input
                                    placeholder="Y-m-d H:i:s"
                                    type="text" class="form-control" name="startTimeSearch_blacklist" id="startTimeSearch_blacklist">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <label>End Time:</label>
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input
                                    placeholder="Y-m-d H:i:s"
                                    type="text" class="form-control" name="endTimeSearch_blacklist" id="endTimeSearch_blacklist">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>&nbsp;</label>
                                    </div>
                                    <a
                                    wire:click="$emit('searchBlackListScript')"
                                    class="btn btn-primary"
                                    style="color:#FFF">Search</a>

                                    <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewBlackList"> Add new </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </form> --}}
</div>

{{-- modal and new black list --}}

<div wire:ignore.self class="modal fade" id="addnewBlackList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new blacklist card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body addnewWhiteListCardForm">
    @if(!isset($messageBlacklist) || $messageBlacklist == '')
    <div id="loading-addnewblacklist" class="d-flex justify-content-center" style="display: none !important;">@livewire('loading.loading')</div>
    @endif

    @if(isset($messageBlacklist) && $messageBlacklist != '')
    <div class="@if($valid) {{'alert alert-warning'}} @else {{'alert alert-info'}} @endif">{!! $messageBlacklist !!}</div>
    @endif




    <label>Card Number:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input placeholder="6 first number card" class="card_blacklist_number" style="width:30%" type="text" class="form-control" name="addBlackListSixFirstNumber" id="addBlackListSixFirstNumber">
        <input placeholder="4 last number card" class="card_blacklist_number" style="width: 30%" type="text" class="form-control" name="addnewBlackListFourLastNumber" id="addnewBlackListFourLastNumber">

    </div>

    <label>Card Name:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input placeholder="Put your card name" type="text" class="form-control" name="addnewBlackListCardName" id="addnewBlackListCardName">

    </div>

    <label>Reason:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <textarea placeholder="Put your reason" class="form-control" name="addnewBlackListReason" id="addnewBlackListReason"></textarea>

    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('addnewBlackListScript')" type="button" class="btn btn-primary">Add cards</button>
</div>
</div>
</div>
</div>



{{-- end modal and new black list --}}

{{-- begin modal update card --}}

<div wire:ignore.self class="modal fade" id="updateBlackList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Blacklist card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body addnewWhiteListCardForm">
    @if(isset($messageBlacklist) && $messageBlacklist != '')
    <div class="@if($valid) {{'alert alert-warning'}} @else {{'alert alert-info'}} @endif">{!! $messageBlacklist !!}</div>
    @endif
    <input type="hidden" value="{{$idBlack}}" id="idBlackUpdate">

    <label>Card Number:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input placeholder="6 first number card" class="card_blacklist_number" style="width:30%" type="text" class="form-control" name="updateBlackListSixFirstNumber" id="updateBlackListSixFirstNumber">
        <input placeholder="4 last number card" class="card_blacklist_number" style="width: 30%" type="text" class="form-control" name="updateBlackListFourLastNumber" id="updateBlackListFourLastNumber">

    </div>

    <label>Card Name:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <input placeholder="Put your card name" type="text" class="form-control" name="updateBlackListCardName" id="updateBlackListCardName">

    </div>
    <label>Reason:</label>
    <div class="kt-input-icon kt-input-icon--left">
        <textarea placeholder="Put your reason" type="text" class="form-control" name="updateBlackListReason" id="updateBlackListReason"> </textarea>

    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('updateBlackListScript')" type="button" class="btn btn-primary">Update card</button>
</div>
</div>
</div>
</div>


{{-- end modal update card --}}

{{-- begin detail blacklist  --}}

<div wire:ignore.self class="modal fade" id="detailModalBlacklist" tabindex="-1" role="dialog" aria-labelledby="detailModalBlacklist2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Blacklist Detail ID: <span>@if(isset($detailblackCardID)) {{$detailblackCardID}} @endif</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <table class="table table-light">
        @if(!isset($detailblackCardID))
        <tr>
            <td colspan="2">

                <div class="d-flex justify-content-center">
                    @livewire('loading.loading')
                </div>

            </td>
        </tr>
        @else
        <tr>
            <td><span> ID: </span></td>
            <td><span>@if(isset($detailblackCardID)) {{$detailblackCardID}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Card Number: </span></td>
            <td><span>@if(isset($detailblackCardNumber)) {{$detailblackCardNumber}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Card Hash: </span></td>
            <td><span>@if(isset($detailblackCardHash)) {{$detailblackCardHash}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Card Name: </span></td>
            <td><span>@if(isset($detailblackCardName)) {{$detailblackCardName}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Status: </span></td>
            <td><span class="badge badge-danger">@if(isset($detailblackStatus)) {{$detailblackStatus}} @endif</span></td>
        </tr>

        <tr>
            <td><span>Reason: </span></td>
            <td><span>@if(isset($detailblackCardReason)) {{$detailblackCardReason}} @endif</span></td>
        </tr>

        <tr>
            <td><span>Create Time: </span></td>
            <td><span>@if(isset($detailblackCardCreatat)) {{$detailblackCardCreatat}} @endif</span></td>
        </tr>
        <tr>
            <td><span>Update Time: </span></td>
            <td><span>@if(isset($detailblackCardUpdateat)) {{$detailblackCardUpdateat}} @endif</span></td>
        </tr>
        @endif
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
{{-- end detail blacklist --}}


<div class="kt-portlet__body kt-portlet__body--fit">
    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" id="ajax_data" style="">
        <table id="blacklistTable" class="table table-light" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Card Number</th>
                    <th>Card Name</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Create Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              {{--   @if(isset($messageBlacklist) && $messageBlacklist != '')
                <tr>
                    <td colspan="5">
                        <div
                        class="
                        @if($warming == 'delete' || $valid) {{' alert alert-warning'}}
                        @else{{'alert alert-info'}} @endif">
                    {{$messageBlacklist}}</div>
                </td>
            </tr>
            @endif --}}
            {{-- @dump($blackList) --}}
            @if(isset($blackList) and !empty($blackList))
            @foreach($blackList as $listblack)
            <tr>
                <td>
                 <input id="BlackList-{{$listblack->id}}" style="width: 50px;" type="hidden" class="cardRist"
                 value="{{$listblack->id}}">{{$listblack->id}}
             </td>
             <td>
                <input id="BlackListcardNumber-{{$listblack->id}}" type="hidden" class="cardRist" value="{{$listblack->card_number}}">{{$listblack->card_number}}
            </td>
            <td>
                <input id="BlackListcardName-{{$listblack->id}}" type="hidden" class="cardRist" value="{{$listblack->card_name}}">{{$listblack->card_name}}

            </td>
            <td>
                <input id="BlackListStatus-{{$listblack->id}}" type="hidden" class="cardRist" value="{{$listblack->card_status}}">
                <span class="badge badge-danger">{{$listblack->card_status}}</span>

            </td>

            <td>
                <input id="BlackListReason-{{$listblack->id}}" type="hidden" class="cardRist" value="{{$listblack->reason}}">
                {{$listblack->reason}}

            </td>

            <td>
                <input type="hidden" class="cardRist" value="{{date("Y-m-d H:i:s", $listblack->updated_at)}}">{{date("Y-m-d H:i:s", $listblack->updated_at)}}
            </td>
            <td>
                <a wire:click.prevent="$emit('getDataTableBlackList', '{{$listblack->id}}')" data-toggle="modal" data-target="#updateBlackList">
                    <i class="flaticon2-pen"></i> |
                </a>
                <a wire:click.prevent="$emit('deleteBlackListScript', '{{$listblack->id}}')">
                    <i class="flaticon2-delete"></i>
                </a> |
                <a data-toggle="modal" data-target="#detailModalBlacklist" style="font-size: 1.15rem; color: #93a2dd; cursor: pointer;" wire:click.prevent="$emit('detailBlackListScript', '{{$listblack->id}}')">
                    <i class="flaticon2-search"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{-- <div wire:loading.delay wire:target="detailBlackListScript">Loading</div> --}}
 @if(isset($blackList) and !empty($blackList))
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item @if($blacklistCurrentPage <= 1) {{'disabled'}} @endif">
        <a class="page-link" wire:click = "goCurrentPagesBlacklist({{$blacklistCurrentPage - 1}})">Previous</a></li>

        @for($i = 1; $i <= $blacklistTotalPage; $i++)
        <li wire:click.prevent="goCurrentPagesBlacklist({{$i}})"
        class="page-item @if($blacklistCurrentPage == $i) {{'active'}}  @endif"><a class="page-link">{{$i}}</a></li>
        @endfor

        <li class="page-item @if($blacklistCurrentPage >= $blacklistTotalPage) {{'disabled'}} @endif"><a class="page-link" wire:click = "goCurrentPagesBlacklist({{$blacklistCurrentPage + 1}})">Next</a></li>
    </ul>
</nav>
@endif
</div>


</div>
<!--end: Datatable -->

</div>

</div>


</div>


</div>
</div>

