<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    CC account Bypass

                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">
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
                                        <label>Card Number:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your card number" type="text" class="form-control" name="search_card_number" id="search_card_number">
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
                                            placeholder="Y-m-d H:i:s" type="text" class="form-control" name="startTimeSearch" id="startTimeSearch">
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
                                            placeholder="enter your card number" type="text" class="form-control" name="endTimeSearch" id="endTimeSearch">
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
                    <h5 class="modal-title" id="exampleModalLabel">Add new CC Account Bypass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(!isset($messageBypass))
                        <span id="statusCCAccountBypass" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($messageBypass))
                    <tr>
                        <td colspan="2"><span class="alert @if($warning) {{'alert-warning'}} @else {{'alert-info'}} @endif">{{$messageBypass}}</span></td>
                    </tr>
                    @endif


                    <tr>
                        <td><span class="d-flex justify-content-center">Card Number: </span></td>
                        <td><input type="text" class="form-control" id="cc_account_whitelistFullCard"></td>

                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Rule Code: </span></td>
                        <td>
                            <input list="cc_account_listRuleRisk" type="text" class="form-control" id="cc_account_Rule_Code">

                            <datalist id="cc_account_listRuleRisk">
                                @if(isset($listRuleRisk))
                                @foreach($listRuleRisk as $ruleRisk)
                                <option value="{{$ruleRisk}}">{{$ruleRisk}}</option>
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
        <h5 class="modal-title" id="exampleModalLabel">Update CC Account Bypass</h5>
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
            <td><span class="d-flex justify-content-center">Card Number: </span></td>
            <td>
                <input type="hidden" value="{{$idccBypas}}" id="update_cc_account_ID">

                <input type="text" value="{{$cardNumberUpdate}}" class="form-control" id="update_cc_account_whitelistCard"></td>
            </tr>
            <tr>
                <td><span class="d-flex justify-content-center">Rule Code: </span></td>
                <td>
                    <input list="update_cc_account_listRuleRisk" type="text" class="form-control" id="update_cc_account_Rule_Code">
                    <datalist id="update_cc_account_listRuleRisk">
                        @if(isset($listRuleRisk))
                        @foreach($listRuleRisk as $ruleRisk3)
                        <option value="{{$ruleRisk3}}"></option>
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
    <thead>
        <tr>
            <th>ID</th>
            <th>Whitelist Card ID</th>
            <th>Rule</th>
            <th>Create at</th>
            <th>Update at</th>
            <th>Action</th>
        </tr>
    </thead>
    @if(isset($ccAcountBypassRuleList))
    @foreach($ccAcountBypassRuleList as $acountBypass)
    <tr>
        <td><input style="width: 100px" type="hidden" value="{{$acountBypass->id}}">{{$acountBypass->id}}</td>
        <td><input id="cc_accounts_whitelist_id-{{$acountBypass->id}}" style="width: 100px" type="hidden" value="{{$acountBypass->cc_accounts_whitelist_id}}">{{$acountBypass->cc_accounts_whitelist_id}}</td>

        <td><input id="rule_code-{{$acountBypass->id}}" type="hidden" value="{{$acountBypass->rule_code}}">{{$acountBypass->rule_code}}</td>

        <td><input type="hidden" value="{{date('Y-m-d H:i:s', $acountBypass->created_at)}}">{{date('Y-m-d H:i:s', $acountBypass->created_at)}}</td>
        <td><input type="hidden" value="{{date('Y-m-d H:i:s', $acountBypass->updated_at)}}">{{date('Y-m-d H:i:s', $acountBypass->updated_at)}}</td>
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
</div>
</div>
