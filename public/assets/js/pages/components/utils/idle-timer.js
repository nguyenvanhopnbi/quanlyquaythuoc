!function(t){var e={};function l(r){if(e[r])return e[r].exports;var n=e[r]={i:r,l:!1,exports:{}};return t[r].call(n.exports,n,n.exports,l),n.l=!0,n.exports}l.m=t,l.c=e,l.d=function(t,e,r){l.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},l.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},l.t=function(t,e){if(1&e&&(t=l(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(l.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)l.d(r,n,function(e){return t[e]}.bind(null,n));return r},l.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return l.d(e,"a",e),e},l.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},l.p="",l(l.s=638)}({638:function(t,e,l){"use strict";var r={init:function(){$(document).on("idle.idleTimer",(function(t,e,l){$("#docStatus").val((function(t,e){return e+"Idle @ "+moment().format()+" \n"})).removeClass("alert-success").addClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight)})),$(document).on("active.idleTimer",(function(t,e,l,r){$("#docStatus").val((function(t,e){return e+"Active ["+r.type+"] ["+r.target.nodeName+"] @ "+moment().format()+" \n"})).addClass("alert-success").removeClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight)})),$("#btPause").click((function(){return $(document).idleTimer("pause"),$("#docStatus").val((function(t,e){return e+"Paused @ "+moment().format()+" \n"})).scrollTop($("#docStatus")[0].scrollHeight),$(this).blur(),!1})),$("#btResume").click((function(){return $(document).idleTimer("resume"),$("#docStatus").val((function(t,e){return e+"Resumed @ "+moment().format()+" \n"})).scrollTop($("#docStatus")[0].scrollHeight),$(this).blur(),!1})),$("#btElapsed").click((function(){return $("#docStatus").val((function(t,e){return e+"Elapsed (since becoming active): "+$(document).idleTimer("getElapsedTime")+" \n"})).scrollTop($("#docStatus")[0].scrollHeight),$(this).blur(),!1})),$("#btDestroy").click((function(){return $(document).idleTimer("destroy"),$("#docStatus").val((function(t,e){return e+"Destroyed: @ "+moment().format()+" \n"})).removeClass("alert-success").removeClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight),$(this).blur(),!1})),$("#btInit").click((function(){return $(document).idleTimer({timeout:5e3}),$("#docStatus").val((function(t,e){return e+"Init: @ "+moment().format()+" \n"})).scrollTop($("#docStatus")[0].scrollHeight),$(document).idleTimer("isIdle")?$("#docStatus").removeClass("alert-success").addClass("alert-warning"):$("#docStatus").addClass("alert-success").removeClass("alert-warning"),$(this).blur(),!1})),$("#docStatus").val(""),$(document).idleTimer(5e3),$(document).idleTimer("isIdle")?$("#docStatus").val((function(t,e){return e+"Initial Idle State @ "+moment().format()+" \n"})).removeClass("alert-success").addClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight):$("#docStatus").val((function(t,e){return e+"Initial Active State @ "+moment().format()+" \n"})).addClass("alert-success").removeClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight),$("#docTimeout").text(5),$("#elStatus").on("idle.idleTimer",(function(t,e,l){t.stopPropagation(),$("#elStatus").val((function(t,e){return e+"Idle @ "+moment().format()+" \n"})).removeClass("alert-success").addClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight)})),$("#elStatus").on("active.idleTimer",(function(t){t.stopPropagation(),$("#elStatus").val((function(t,e){return e+"Active @ "+moment().format()+" \n"})).addClass("alert-success").removeClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight)})),$("#btReset").click((function(){return $("#elStatus").idleTimer("reset").val((function(t,e){return e+"Reset @ "+moment().format()+" \n"})).scrollTop($("#elStatus")[0].scrollHeight),$("#elStatus").idleTimer("isIdle")?$("#elStatus").removeClass("alert-success").addClass("alert-warning"):$("#elStatus").addClass("alert-success").removeClass("alert-warning"),$(this).blur(),!1})),$("#btRemaining").click((function(){return $("#elStatus").val((function(t,e){return e+"Remaining: "+$("#elStatus").idleTimer("getRemainingTime")+" \n"})).scrollTop($("#elStatus")[0].scrollHeight),$(this).blur(),!1})),$("#btLastActive").click((function(){return $("#elStatus").val((function(t,e){return e+"LastActive: "+$("#elStatus").idleTimer("getLastActiveTime")+" \n"})).scrollTop($("#elStatus")[0].scrollHeight),$(this).blur(),!1})),$("#btState").click((function(){return $("#elStatus").val((function(t,e){return e+"State: "+($("#elStatus").idleTimer("isIdle")?"idle":"active")+" \n"})).scrollTop($("#elStatus")[0].scrollHeight),$(this).blur(),!1})),$("#elStatus").val("").idleTimer(3e3),$("#elStatus").idleTimer("isIdle")?$("#elStatus").val((function(t,e){return e+"Initial Idle @ "+moment().format()+" \n"})).removeClass("alert-success").addClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight):$("#elStatus").val((function(t,e){return e+"Initial Active @ "+moment().format()+" \n"})).addClass("alert-success").removeClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight),$("#elTimeout").text(3)}};jQuery(document).ready((function(){r.init()}))}});