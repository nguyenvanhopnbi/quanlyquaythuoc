!function(e){var t={};function n(a){if(t[a])return t[a].exports;var o=t[a]={i:a,l:!1,exports:{}};return e[a].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(a,o,function(t){return e[t]}.bind(null,o));return a},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=632)}({632:function(e,t,n){"use strict";var a={init:function(){$("#kt_tree_1").jstree({core:{themes:{responsive:!1}},types:{default:{icon:"fa fa-folder"},file:{icon:"fa fa-file"}},plugins:["types"]}),$("#kt_tree_2").jstree({core:{themes:{responsive:!1}},types:{default:{icon:"fa fa-folder kt-font-warning"},file:{icon:"fa fa-file  kt-font-warning"}},plugins:["types"]}),$("#kt_tree_2").on("select_node.jstree",(function(e,t){var n=$("#"+t.selected).find("a");if("#"!=n.attr("href")&&"javascript:;"!=n.attr("href")&&""!=n.attr("href"))return"_blank"==n.attr("target")&&(n.attr("href").target="_blank"),document.location.href=n.attr("href"),!1})),$("#kt_tree_3").jstree({plugins:["wholerow","checkbox","types"],core:{themes:{responsive:!1},data:[{text:"Same but with checkboxes",children:[{text:"initially selected",state:{selected:!0}},{text:"custom icon",icon:"fa fa-warning kt-font-danger"},{text:"initially open",icon:"fa fa-folder kt-font-default",state:{opened:!0},children:["Another node"]},{text:"custom icon",icon:"fa fa-warning kt-font-waring"},{text:"disabled node",icon:"fa fa-check kt-font-success",state:{disabled:!0}}]},"And wholerow selection"]},types:{default:{icon:"fa fa-folder kt-font-warning"},file:{icon:"fa fa-file  kt-font-warning"}}}),$("#kt_tree_4").jstree({core:{themes:{responsive:!1},check_callback:!0,data:[{text:"Parent Node",children:[{text:"Initially selected",state:{selected:!0}},{text:"Custom Icon",icon:"fa fa-warning kt-font-danger"},{text:"Initially open",icon:"fa fa-folder kt-font-success",state:{opened:!0},children:[{text:"Another node",icon:"fa fa-file kt-font-waring"}]},{text:"Another Custom Icon",icon:"fa fa-warning kt-font-waring"},{text:"Disabled Node",icon:"fa fa-check kt-font-success",state:{disabled:!0}},{text:"Sub Nodes",icon:"fa fa-folder kt-font-danger",children:[{text:"Item 1",icon:"fa fa-file kt-font-waring"},{text:"Item 2",icon:"fa fa-file kt-font-success"},{text:"Item 3",icon:"fa fa-file kt-font-default"},{text:"Item 4",icon:"fa fa-file kt-font-danger"},{text:"Item 5",icon:"fa fa-file kt-font-info"}]}]},"Another Node"]},types:{default:{icon:"fa fa-folder kt-font-brand"},file:{icon:"fa fa-file  kt-font-brand"}},state:{key:"demo2"},plugins:["contextmenu","state","types"]}),$("#kt_tree_5").jstree({core:{themes:{responsive:!1},check_callback:!0,data:[{text:"Parent Node",children:[{text:"Initially selected",state:{selected:!0}},{text:"Custom Icon",icon:"fa fa-warning kt-font-danger"},{text:"Initially open",icon:"fa fa-folder kt-font-success",state:{opened:!0},children:[{text:"Another node",icon:"fa fa-file kt-font-waring"}]},{text:"Another Custom Icon",icon:"fa fa-warning kt-font-waring"},{text:"Disabled Node",icon:"fa fa-check kt-font-success",state:{disabled:!0}},{text:"Sub Nodes",icon:"fa fa-folder kt-font-danger",children:[{text:"Item 1",icon:"fa fa-file kt-font-waring"},{text:"Item 2",icon:"fa fa-file kt-font-success"},{text:"Item 3",icon:"fa fa-file kt-font-default"},{text:"Item 4",icon:"fa fa-file kt-font-danger"},{text:"Item 5",icon:"fa fa-file kt-font-info"}]}]},"Another Node"]},types:{default:{icon:"fa fa-folder kt-font-success"},file:{icon:"fa fa-file  kt-font-success"}},state:{key:"demo2"},plugins:["dnd","state","types"]}),$("#kt_tree_6").jstree({core:{themes:{responsive:!1},check_callback:!0,data:{url:function(e){return"https://keenthemes.com/metronic/tools/preview/api/jstree/ajax_data.php"},data:function(e){return{parent:e.id}}}},types:{default:{icon:"fa fa-folder kt-font-brand"},file:{icon:"fa fa-file  kt-font-brand"}},state:{key:"demo3"},plugins:["dnd","state","types"]})}};jQuery(document).ready((function(){a.init()}))}});