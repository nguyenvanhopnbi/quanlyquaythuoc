!function(e){var t={};function a(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(n,o,function(t){return e[t]}.bind(null,o));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=698)}({698:function(e,t){var a,n=(a=["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"],{init:function(){var e,t,n,o,i,r;$("#kt_typeahead_1, #kt_typeahead_1_modal, #kt_typeahead_1_validate, #kt_typeahead_2_validate, #kt_typeahead_3_validate").typeahead({hint:!0,highlight:!0,minLength:1},{name:"states",source:(e=a,function(t,a){var n;n=[],substrRegex=new RegExp(t,"i"),$.each(e,(function(e,t){substrRegex.test(t)&&n.push(t)})),a(n)})}),t=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.whitespace,queryTokenizer:Bloodhound.tokenizers.whitespace,local:a}),$("#kt_typeahead_2, #kt_typeahead_2_modal").typeahead({hint:!0,highlight:!0,minLength:1},{name:"states",source:t}),n=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.whitespace,queryTokenizer:Bloodhound.tokenizers.whitespace,prefetch:"https://keenthemes.com/metronic/tools/preview/api/typeahead/countries.json"}),$("#kt_typeahead_3, #kt_typeahead_3_modal").typeahead(null,{name:"countries",source:n}),o=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.obj.whitespace("value"),queryTokenizer:Bloodhound.tokenizers.whitespace,prefetch:"https://keenthemes.com/metronic/tools/preview/api/typeahead/movies.json"}),$("#kt_typeahead_4").typeahead(null,{name:"best-pictures",display:"value",source:o,templates:{empty:['<div class="empty-message" style="padding: 10px 15px; text-align: center;">',"unable to find any Best Picture winners that match the current query","</div>"].join("\n"),suggestion:Handlebars.compile("<div><strong>{{value}}</strong> – {{year}}</div>")}}),i=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.obj.whitespace("team"),queryTokenizer:Bloodhound.tokenizers.whitespace,prefetch:"https://keenthemes.com/metronic/tools/preview/api/typeahead/nba.json"}),r=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.obj.whitespace("team"),queryTokenizer:Bloodhound.tokenizers.whitespace,prefetch:"https://keenthemes.com/metronic/tools/preview/api/typeahead/nhl.json"}),$("#kt_typeahead_5").typeahead({highlight:!0},{name:"nba-teams",display:"team",source:i,templates:{header:'<h3 class="league-name" style="padding: 5px 15px; font-size: 1.2rem; margin:0;">NBA Teams</h3>'}},{name:"nhl-teams",display:"team",source:r,templates:{header:'<h3 class="league-name" style="padding: 5px 15px; font-size: 1.2rem; margin:0;">NHL Teams</h3>'}})}});jQuery(document).ready((function(){n.init()}))}});