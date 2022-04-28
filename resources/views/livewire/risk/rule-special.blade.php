<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Rule Special

                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            {{-- begin search form rule special --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Rule Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your code" type="text" class="form-control" name="search_cc_special_rule" id="search_cc_special_rule">
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
                                            placeholder="enter your code" type="text" class="form-control" name="endTimeSearch" id="endTimeSearch">
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
                                            wire:click.prevent="$emit('searchRuleSpecialCodeScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewRuleSpecialModal"> Add new </a>

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

            {{-- end search form rule special --}}

            {{-- begin modal add new Rule risk form modal --}}
            <div wire:ignore.self class="modal fade" id="addnewRuleSpecialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 750px;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new rule special</h5>
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
                        <td><span class="d-flex justify-content-center">Code <span style="color:red">*</span>: </span></td>
                        <td>
                            <input autocomplete="off" list="listRuleRisk" placeholder="Enter your code" type="text" class="form-control" id="ruleSpecialCode">
                            <datalist id="listRuleRisk">
                                @if(isset($ruleRiskList))
                                @foreach($ruleRiskList as $listRule)
                                <option value="{{$listRule->code}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Name<span style="color:red">*</span>: </span></td>
                        <td>

                            <input placeholder="Enter your name" type="text" class="form-control" id="ruleSpecialName">
                        </td>
                        <tr>
                        <td><span class="d-flex justify-content-center">Param<span style="color:red">*</span>: </span></td>
                        <td>
                            <input type="hidden" value="{{$count}}" class="form-control" id="ruleSpecialParam">
                            {!! $paramInput !!}
                            <button wire:click.prevent="$emit('addMoreParamsHTML')" class="badge badge-success btn-param">more params</button>
                        </td>

                        </tr>
                    </tr>
                    <tr>
                        <td>
                            <span class="d-flex justify-content-center">
                                Details
                            </span>
                        </td>
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
                <button wire:click.prevent="$emit('addNewRuleSpecialScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new rule risk form modal --}}

 {{-- begin modal update Rule risk form modal --}}
            <div wire:ignore.self class="modal fade" id="UpdateRuleSpecialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 750px">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update rule special</h5>
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
                        <td><span class="d-flex justify-content-center">Code: </span></td>
                        <td>
                            <input type="hidden" value="{{$inum}}" id="inum">
                            <input type="hidden" value="{{$idSpecialRule}}" id="idSpecialRuleInput">
                            <input
                            autocomplete="off"
                            list="listRuleRiskUpdate" value="{{$codeSpecialRule}}" placeholder="Enter your code" type="text" class="form-control" id="ruleSpecialCodeUpdate">
                            <datalist id="listRuleRiskUpdate">
                                @if(isset($ruleRiskList))
                                @foreach($ruleRiskList as $listRuleUpdate)
                                <option value="{{$listRuleUpdate->code}}"></option>
                                @endforeach
                                @endif
                            </datalist>

                        </td>
                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Name: </span></td>
                        <td>
                            <input
                            autocomplete="off"
                            value="{{$nameSpecialRule}}" placeholder="Enter your name" type="text" class="form-control" id="ruleSpecialNameUpdate">
                        </td>
                        <tr>
                        <td><span class="d-flex justify-content-center">Param: </span></td>
                        <td>

                            {!! $paramInputUpdate !!}
                            <button wire:click.prevent="$emit('addMoreParamsHTMLUpdateScript')" class="badge badge-success btn-param">more params</button>
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td>
                            <span class="d-flex justify-content-center">
                                Details
                            </span>
                        </td>
                        <td wire:ignore>
                            <div id="toolbar-container-update"></div>
                            <div id="editor-update">

                            </div>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('updateRuleSpecialScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal update rule risk form modal --}}



            <table class="table table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Param</th>
                    <th>Detail</th>
                    <th>Update at</th>
                    <th>Action</th>
                </tr>
                {{-- @dump($specialList) --}}
                @if(isset($specialList))
                @foreach($specialList as $listSpecial)
                <tr>
                    <td><input id="idSpecial-{{$listSpecial->id}}" type="hidden" value="{{$listSpecial->id}}">{{$listSpecial->id}}</td>

                    <td><input id="nameSpecial-{{$listSpecial->id}}" type="hidden" value="{{$listSpecial->name}}">{{$listSpecial->name}}</td>

                    <td><input id="codeSpecial-{{$listSpecial->id}}" type="hidden" value="{{$listSpecial->code}}">{{$listSpecial->code}}</td>

                    <td><input id="paramSpecial-{{$listSpecial->id}}" type="hidden" value="{{$listSpecial->param}}">{{$listSpecial->param}}</td>
                    <td>
                        <input id="detail-{{$listSpecial->id}}" type="hidden" value="{{$listSpecial->detail}}">{!! $listSpecial->detail !!}
                    </td>

                    <td>
                        {{isset($listSpecial->updated_at) ? date('Y-m-d H:i:s', $listSpecial->updated_at) : 'no value'}}
                    </td>
                    <td style="width: 100px;">
                        <a data-placement="top" title="Update Rule Special" wire:click.prevent="$emit('getDateTableRuleSpecialDataScript', '{{$listSpecial->id}}')" data-toggle="modal" data-target="#UpdateRuleSpecialModal">
                            <i class="flaticon2-pen"></i> |
                        </a>
                        <a data-placement="top" title="Delete Rule Special" wire:click.prevent="$emit('deleteRuleSpecialScript', '{{$listSpecial->id}}')">
                            <i class="flaticon2-delete"></i>
                        </a>

                    </td>
                </tr>
                @endforeach
                @endif
            </table>

            @if(isset($totalPage))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif" wire:click.prevent="getCurrentPage({{$currentPage - 1}})">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @for($i = 1; $i <= $totalPage; $i++)
            <li wire:click.prevent="getCurrentPage({{$currentPage}})" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
            @endfor
            <li wire:click.prevent="getCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
              <a class="page-link" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
@endif
</div>
</div>
</div>
