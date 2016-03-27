/*!
* custom.js by @livelyworks
*/

/*!
  Bootstrap - File Input
  ======================

  This is meant to convert all file input tags into a set of elements that displays consistently in all browsers.

  Converts all
  <input type="file">
  into Bootstrap buttons
  <a class="btn">Browse</a>

*/
$(function(){$("input[type=file]").not(".useDefault").each(function(c,e){if(typeof $(this).attr("data-bfi-disabled")!="undefined"){return}var d="Browse";if(typeof $(this).attr("title")!="undefined"){d=$(this).attr("title")}var b=$("<div>").append($(e).eq(0).clone()).html();$(e).replaceWith('<a class="file-input-wrapper btn">'+d+b+"</a>")}).promise().done(function(){$(".file-input-wrapper").mousemove(function(j){var g,b,i,h,f,c,e,d;b=$(this);g=b.find("input");i=b.offset().left;h=b.offset().top;f=g.width();c=g.height();e=j.pageX;d=j.pageY;moveInputX=e-i-f+20;moveInputY=d-h-(c/2);g.css({left:moveInputX,top:moveInputY})});$(".file-input-wrapper input[type=file]").change(function(){$(this).parent().next(".file-input-name").remove();if($(this).prop("files").length>1){$(this).parent().after('<span class="file-input-name">'+$(this)[0].files.length+" files</span>")}else{$(this).parent().after('<span class="file-input-name">'+$(this).val().replace("C:\\fakepath\\","")+"</span>")}})});var a="<style>.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }.file-input-name { margin-left: 8px; }</style>";$("link[rel=stylesheet]").eq(0).before(a)});