!function(t){var e={};function a(n){if(e[n])return e[n].exports;var l=e[n]={i:n,l:!1,exports:{}};return t[n].call(l.exports,l,l.exports,a),l.l=!0,l.exports}a.m=t,a.c=e,a.d=function(t,e,n){a.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a.t=function(t,e){if(1&e&&(t=a(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var l in t)a.d(n,l,function(e){return t[e]}.bind(null,l));return n},a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,"a",e),e},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.p="",a(a.s=707)}({707:function(t,e,a){"use strict";var n={init:function(){var t,e;t={data:{type:"remote",source:{read:{url:"https://keenthemes.com/metronic/tools/preview/api/datatables/demos/default.php"}},pageSize:20,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{scroll:!0,height:550,footer:!1},sortable:!0,pagination:!0,search:{input:$("#generalSearch")},columns:[{field:"RecordID",title:"#",sortable:!1,width:30,type:"number",selector:{class:"kt-checkbox--solid"},textAlign:"center"},{field:"ID",title:"ID",width:30,type:"number",template:function(t){return t.RecordID}},{field:"OrderID",title:"Order ID"},{field:"Country",title:"Country",template:function(t){return t.Country+" "+t.ShipCountry}},{field:"ShipDate",title:"Ship Date",type:"date",format:"MM/DD/YYYY"},{field:"CompanyName",title:"Company Name"},{field:"Status",title:"Status",template:function(t){var e={1:{title:"Pending",class:"kt-badge--brand"},2:{title:"Delivered",class:" kt-badge--danger"},3:{title:"Canceled",class:" kt-badge--primary"},4:{title:"Success",class:" kt-badge--success"},5:{title:"Info",class:" kt-badge--info"},6:{title:"Danger",class:" kt-badge--danger"},7:{title:"Warning",class:" kt-badge--warning"}};return'<span class="kt-badge '+e[t.Status].class+' kt-badge--inline kt-badge--pill">'+e[t.Status].title+"</span>"}},{field:"Type",title:"Type",autoHide:!1,template:function(t){var e={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"success"}};return'<span class="kt-badge kt-badge--'+e[t.Type].state+' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-'+e[t.Type].state+'">'+e[t.Type].title+"</span>"}},{field:"Actions",title:"Actions",sortable:!1,width:110,overflow:"visible",autoHide:!1,template:function(){return'\t\t\t\t\t\t<div class="dropdown">\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'}}]},e=$(".kt-datatable").KTDatatable(t),$("#kt_datatable_destroy").on("click",(function(){$(".kt-datatable").KTDatatable("destroy")})),$("#kt_datatable_init").on("click",(function(){e=$(".kt-datatable").KTDatatable(t)})),$("#kt_datatable_reload").on("click",(function(){$(".kt-datatable").KTDatatable("reload")})),$("#kt_datatable_sort_asc").on("click",(function(){e.sort("Status","asc")})),$("#kt_datatable_sort_desc").on("click",(function(){e.sort("Status","desc")})),$("#kt_datatable_get").on("click",(function(){if(e.rows(".kt-datatable__row--active"),e.nodes().length>0){var t=e.columns("CompanyName").nodes().text();console.log(t)}})),$("#kt_datatable_check").on("click",(function(){var t=$("#kt_datatable_check_input").val();e.setActive(t)})),$("#kt_datatable_check_all").on("click",(function(){$(".kt-datatable").KTDatatable("setActiveAll",!0)})),$("#kt_datatable_uncheck_all").on("click",(function(){$(".kt-datatable").KTDatatable("setActiveAll",!1)})),$("#kt_datatable_hide_column").on("click",(function(){e.columns("ShipDate").visible(!1)})),$("#kt_datatable_show_column").on("click",(function(){e.columns("ShipDate").visible(!0)})),$("#kt_datatable_remove_row").on("click",(function(){e.rows(".kt-datatable__row--active").remove()})),$("#kt_form_status,#kt_form_type").selectpicker()}};jQuery(document).ready((function(){n.init()}))}});