!function(e){var t={};function n(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(i,r,function(t){return e[t]}.bind(null,r));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=616)}({616:function(e,t,n){"use strict";var i={init:function(){var e=document.getElementById("kt_calendar");new FullCalendar.Calendar(e,{plugins:["interaction","dayGrid","timeGrid","list","googleCalendar"],isRTL:KTUtil.isRTL(),header:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay"},displayEventTime:!1,height:800,contentHeight:780,aspectRatio:3,views:{dayGridMonth:{buttonText:"month"},timeGridWeek:{buttonText:"week"},timeGridDay:{buttonText:"day"}},defaultView:"dayGridMonth",editable:!0,eventLimit:!0,navLinks:!0,googleCalendarApiKey:"AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE",events:"en.usa#holiday@group.v.calendar.google.com",eventClick:function(e){return window.open(e.url,"gcalevent","width=700,height=600"),!1},loading:function(e){},eventRender:function(e){var t=$(e.el);e.event.extendedProps&&e.event.extendedProps.description&&(t.hasClass("fc-day-grid-event")?(t.data("content",e.event.extendedProps.description),t.data("placement","top"),KTApp.initPopover(t)):t.hasClass("fc-time-grid-event")?t.find(".fc-title").append('<div class="fc-description">'+e.event.extendedProps.description+"</div>"):0!==t.find(".fc-list-item-title").lenght&&t.find(".fc-list-item-title").append('<div class="fc-description">'+e.event.extendedProps.description+"</div>"))}}).render()}};jQuery(document).ready((function(){i.init()}))}});