!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=642)}({642:function(e,t,n){"use strict";var r={init:function(){$("#kt_table_1").DataTable({responsive:!0,pageLength:5,lengthMenu:[[2,5,10,15,-1],[2,5,10,15,"All"]],footerCallback:function(e,t,n,r,o){var u=this.api(),i=function(e){return"string"==typeof e?1*e.replace(/[\$,]/g,""):"number"==typeof e?e:0},l=u.column(6).data().reduce((function(e,t){return i(e)+i(t)}),0),c=u.column(6,{page:"current"}).data().reduce((function(e,t){return i(e)+i(t)}),0);$(u.column(6).footer()).html("$"+KTUtil.numberString(c.toFixed(2))+"<br/> ( $"+KTUtil.numberString(l.toFixed(2))+" total)")}})}};jQuery(document).ready((function(){r.init()}))}});