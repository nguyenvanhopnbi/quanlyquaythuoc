<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}


    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Rule Risk
                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">
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
                                        <label>Rule Name:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your rule name" type="text" class="form-control" name="search_rule_name" id="search_rule_name">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Start Time:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="Y-m-d H:i:s" type="text" class="form-control" name="startTimeSearch" id="startTimeSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>End Time:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="Y-m-d H:i:s" type="text" class="form-control" name="endTimeSearch" id="endTimeSearch">
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
            <div class="modal-content" style="width: 750px;">
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

                    <tr>
                        <td><span class="d-flex justify-content-center">Details: </span></td>
                        <td wire:ignore>
                            <div id="toolbar-container"></div>
                            <div id="editor">

                            </div>
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
    <div class="modal-content" style="width: 750px">
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
            <tr wire:ignore>
                <td><span class="d-flex justify-content-center">Detail: </span></td>
                <td>
                    <div id="toolbar-container-update"></div>
                    <div id="editor-update"></div>

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
            <th>Detail</th>
            <th>Create at</th>
            <th>Update at</th>
            <th>Action</th>
        </tr>
    </thead>

    {{-- @dump($listRuleRisk) --}}
    @if(isset($listRuleRisk) and !empty($listRuleRisk))
    @foreach($listRuleRisk as $listRuleRiskTable)
    <tr>
        <td><input style="width:100px" id="IDruleRisk-{{$listRuleRiskTable->id}}" type="hidden" value="{{$listRuleRiskTable->id}}">{{$listRuleRiskTable->id}}</td>

        <td><input style="width:100px"  type="hidden" id="ruleriskcode-{{$listRuleRiskTable->id}}" value="{{$listRuleRiskTable->code}}">{{$listRuleRiskTable->code}}</td>

        <td><input type="hidden" id="ruleriskName-{{$listRuleRiskTable->id}}" value="{{$listRuleRiskTable->name}}">{{$listRuleRiskTable->name}}</td>

        <td><input type="hidden" id="Detail-{{$listRuleRiskTable->id}}" value="{{$listRuleRiskTable->detail}}">{!! $listRuleRiskTable->detail !!}</td>

        <td> <input id="createTime-{{$listRuleRiskTable->id}}" type="hidden" value="{{date('Y-m-d H:i:s', $listRuleRiskTable->created_at)}}">{{date('Y-m-d H:i:s', $listRuleRiskTable->created_at)}}</td>

        <td> <input id="UpdateTime-{{$listRuleRiskTable->id}}" type="hidden" value="{{date('Y-m-d H:i:s', $listRuleRiskTable->updated_at)}}">{{date('Y-m-d H:i:s', $listRuleRiskTable->updated_at)}}</td>

        <td style="width: 100px;"><a data-placement="top" title="Update Rule Risk" wire:click.prevent="$emit('getDateTableRuleRisk', '{{$listRuleRiskTable->id}}')" data-toggle="modal" data-target="#UpdateRuleRiskModal">
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
</div>


</div>
