<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner Special Rule

                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            {{-- begin search form partner rule special --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Rule Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your code" type="text" class="form-control" name="search_partner_special_rule" id="search_partner_special_rule">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="search_partner_code_list" placeholder="enter your partner code" type="text" class="form-control" name="search_partner_code" id="search_partner_code">
                                            <datalist id="search_partner_code_list">
                                                {{-- @dd($partnerCodelist) --}}
                                                @if(isset($partnerCodelist))
                                                @foreach($partnerCodelist as $listCodeSearch)
                                                <option value="{{$listCodeSearch}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>

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
                                            placeholder="Y-m-d H:i:s"  type="text" class="form-control" name="endTimeSearch" id="endTimeSearch">
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
                                            wire:click.prevent="$emit('searchPartnerSpecialCodeScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewRulePartnerSpecialModal"> Add new </a>

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

            {{-- end search form partner rule special --}}

            {{-- begin modal add new partner Rule risk form modal --}}
            <div wire:ignore.self class="modal fade" id="addnewRulePartnerSpecialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add partner rule special</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(isset($message))
                    <tr>
                        <td colspan="2"><span class="alert alert-info">{{$message}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Partner Code: </span></td>
                        <td>
                            <input placeholder="Enter your partner code" class="form-control" type="text" id="PartnerCode" list="PartnerCodeList">
                            <datalist id="PartnerCodeList">
                                @if(isset($partnerCodelist))
                                @foreach($partnerCodelist as $listCode)
                                <option value="{{$listCode}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Code: </span></td>
                        <td>
                            <input
                            autocomplete="off"
                            wire:change.prevent="$emit('getParamSpecialScript')" list="codeSpecial" placeholder="Enter your code" type="text" class="form-control" id="rulePartnerSpecialCode">
                            <datalist id="codeSpecial">
                                @if(isset($listRuleSpecial))
                                @foreach($listRuleSpecial as $listCodeSpecial)
                                <option value="{{$listCodeSpecial->code}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </td>
                    </tr>

                    <tr>
                        <td><span class="d-flex justify-content-center">Param: <i
                style = "margin-left: 5px; font-weight: bold; cursor: pointer;" class="flaticon-questions-circular-button" wire:click.prevent="$emit('DetailScript')"></i> </span> </td>
                        <td>

                            <input type="hidden" value="{{$countNum}}" class="form-control" id="countPartnerSpecialSSS">
                            {!! $paramInput !!}
                            {{-- <button wire:click.prevent="$emit('addMoreParamsPartnerSpecialHTML')" class="badge badge-success btn-param">more params</button> --}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><span class="text-primary">{!! $DetailInstruction !!}</span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('addNewPartnerRuleSpecialScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new partner rule risk form modal --}}

{{-- begin modal update partner Rule risk form modal --}}
<div wire:ignore.self class="modal fade" id="UpdateRulePartnerSpecialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update partner rule special</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <table class="table table-light">
        @if(isset($message))
        <tr>
            <td colspan="2"><span class="alert alert-info">{{$message}}</span></td>
        </tr>
        @endif
        <tr>
            <td><span class="d-flex justify-content-center">Partner Code: </span></td>
            <td>
                <input type="hidden" count="{{$countUpdate}}" value="{{$idUpdatePartnerSpecial}}" id="idUpdatePartnerSpecial">
                <input placeholder="Enter your partner code" class="form-control" type="text" id="PartnerCodeUpdate" list="PartnerCodeListUpdate">
                <datalist id="PartnerCodeListUpdate">
                    @if(isset($partnerCodelist))
                    @foreach($partnerCodelist as $listCodeUpdate)
                    <option value="{{$listCodeUpdate}}"></option>
                    @endforeach
                    @endif
                </datalist>
            </td>
        </tr>
        <tr>
            <td><span class="d-flex justify-content-center">Code: </span></td>
            <td>
                <input wire:change.prevent="$emit('getParamSpecialUpdateScript')" list="codeSpecial" placeholder="Enter your code" type="text" class="form-control" id="rulePartnerSpecialCodeUpdate">
                <datalist id="codeSpecial">
                    @if(isset($listRuleSpecial))
                    @foreach($listRuleSpecial as $listCodeSpecialupdate)
                    <option value="{{$listCodeSpecialupdate->code}}"></option>
                    @endforeach
                    @endif
                </datalist>
            </td>
        </tr>

        <tr>
            <td><span class="d-flex justify-content-center">Param:  <i
                style = "margin-left: 5px; font-weight: bold; cursor: pointer;" class="flaticon-questions-circular-button" wire:click.prevent = "$emit('DetailUpdateScript')"></i></span></td>
            <td>

                <input type="hidden" value="{{$countNum}}" class="form-control" id="countPartnerSpecialSSS">
                {!! $paramInputUpdate !!}

            </td>
        </tr>

        <tr>
            <td colspan="2"> <span class="text-primary">{!! $DetailInstructionUpdate !!}</span></td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('UpdatePartnerRuleSpecialScript')" type="button" class="btn btn-primary">Save</button>
</div>
</div>
</div>
</div>
{{-- end modal update partner rule risk form modal --}}


<table class="table table-light">
    <thead>
        <tr>
            <th>ID</th>
            <th>Partner Code</th>
            <th>Rule Code</th>
            <th>Rule Param</th>
            <th>Update at</th>
            <th>Action</th>
        </tr>
    </thead>

    {{-- @dump($partnerSpecialRuleList) --}}
    @if(isset($partnerSpecialRuleList))
    @foreach($partnerSpecialRuleList as $list)
    <tr>
        <td><input id="specialID-{{$list->id}}" type="hidden" value="{{$list->id}}">{{$list->id}}</td>
        <td><input id="PartnerCode-{{$list->id}}" type="hidden" value="{{$list->partner_code}}">{{$list->partner_code}}</td>
        <td><input id="RuleCode-{{$list->id}}" type="hidden" value="{{$list->rule_code}}">{{$list->rule_code}}</td>
        <td><input id="RuleParam-{{$list->id}}" type="hidden" value="{{$list->rule_param}}">{{$list->rule_param}}</td>
        <td>{{isset($list->updated_at)? date('Y-m-d H:i:s', $list->updated_at) : 'no value'}}</td>
        <td>
            <a data-placement="top" title="Update Partner Rule Special" wire:click.prevent="$emit('getDateTablePartnerRuleSpecialScript', '{{$list->id}}')" data-toggle="modal" data-target="#UpdateRulePartnerSpecialModal">
                <i class="flaticon2-pen"></i> |
            </a>
            <a data-placement="top" title="Delete Rule Special" wire:click.prevent="$emit('deletePartnerRuleSpecialScript', '{{$list->id}}')">
                <i class="flaticon2-delete"></i>
            </a>
        </td>

    </tr>
    @endforeach
    @endif
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li wire:click.prevent="getCurrentPage({{$pageCurrent - 1}})"
    class="page-item @if($pageCurrent <= 1) {{'disabled'}} @endif">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
    </a>
</li>
@if(isset($total))
@for($i = 1; $i <= $total; $i++)
<li wire:click.prevent="getCurrentPage({{$i}})" class="page-item @if($pageCurrent == $i) {{'active'}}  @endif"><a class="page-link">{{$i}}</a></li>
@endfor
@endif
<li wire:click.prevent="getCurrentPage({{$pageCurrent + 1}})"
class="page-item @if($pageCurrent >= $total) {{'disabled'}} @endif">
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
