function getContent(e){$.ajax({type:"POST",url:"/core/fn/get_content.php",data:"path="+e,success:function(e){$("#page").animate({opacity:0},300,function(){$("#page").html(e),$(window).scrollTop(0)}),$("#page").animate({opacity:1},300)}})}function getPass(e){$.ajax({type:"POST",url:"/core/fn/get_pass.php",data:"name="+e,success:function(e){$("#page").animate({opacity:0},300,function(){$("#page").html(e),$(window).scrollTop(0)}),$("#page").animate({opacity:1},300)}})}function addGroup(e){$.ajax({type:"POST",url:"/core/fn/add_group.php",data:"name="+e,success:function(e){"error"==e?alert("Error!"):"exist"==e?alert("Folder exist!"):getContent(e)}})}function editGroup(e,t){var a={name:e,oldname:t};$.ajax({type:"POST",url:"/core/fn/edit_group.php",data:a,success:function(e){"error"==e?alert("Error!"):"exist"==e?alert("Folder exist!"):getContent(e)}})}function getAddPassPage(){$.ajax({type:"POST",url:"/core/fn/add_pass_page.php",success:function(e){$("#page").animate({opacity:0},300,function(){$("#page").html(e),$(window).scrollTop(0)}),$("#page").animate({opacity:1},300)}})}function saveNewPass(e,t){var a={name:e,arr:t};$.ajax({type:"POST",url:"/core/fn/add_new_pass.php",data:a,success:function(e){"error"==e?alert("Error!"):getContent(e)}})}function savePass(e,t){var a={name:e,arr:t};$.ajax({type:"POST",url:"/core/fn/resave_pass.php",data:a,success:function(e){"error"==e?alert("Error!"):getContent(e)}})}function delItem(e,t){var a={name:e,type:t};$.ajax({type:"POST",url:"/core/fn/del_item.php",data:a,success:function(e){"error"==e?alert("Error!"):getContent(e)}})}function fieldDecrypt(e,t){$.ajax({type:"POST",url:"/core/fn/get_key.php",success:function(a){var s=decoding(a,t);$(e).val(s)}})}function fieldCrypt(e,t){$.ajax({type:"POST",url:"/core/fn/get_key.php",success:function(a){var s=coding(a,t);$(e).val(s)}})}function allDecrypt(e,t){$.ajax({type:"POST",url:"/core/fn/get_key.php",success:function(a){$(".js-decrypt-all").css({opacity:"0"});var s=decoding(a,t);$(e).text(s),setTimeout(function(){$(".js-decrypt-all").hide(),$(".js-make-backup").css({display:"flex",opacity:"1"})},600)}})}function copyButton(e,t){$.ajax({type:"POST",url:"/core/fn/get_key.php",success:function(a){var s=decoding(a,t),n=$('<input style="position: absolute; left: -9999px">');$("body").append(n),$(n).val(s).select(),document.execCommand("copy"),$(n).remove(),$(e).addClass("copied"),setTimeout(function(){$(".js-pass-copy").removeClass("copied")},1e3)}})}function showAll(){$.ajax({type:"POST",url:"/core/fn/show_all.php",success:function(e){$("#page").animate({opacity:0},300,function(){$("#page").html(e),$(window).scrollTop(0)}),$("#page").animate({opacity:1},300)}})}function backUp(e){$.ajax({type:"POST",url:"/core/fn/backup.php",data:"inner="+e,success:function(e){alert(e)}})}function normalizeName(e){var t=e.replace(/[^а-яa-z0-9\_\-\@\.\,\s]/gi,"");return t}function checkAllCrypt(){$(".js-crypt.decrypted:not(.empty)").length>0?($(".js-pass-save").addClass("hide"),$(".js-newpass-save").addClass("hide")):$(".js-input-title.edit").length>0&&($(".js-pass-save").removeClass("hide"),$(".js-newpass-save").removeClass("hide"))}$(document).ready(function(){getContent("HOME"),$("body").on("click",".js-tree-path",function(){var e=$(this).attr("target");""!=e&&null!=e?getContent(e):alert("error")}),$("body").on("click",".js-pass-title",function(){var e=$(this).attr("target");""!=e&&null!=e?getPass(e):alert("error")}),$("body").on("click",".js-add-group",function(){var e=normalizeName(prompt("Enter folder name"));""!=e&&null!=e&&addGroup(e)}),$("body").on("click",".js-folder-edit",function(){var e=$(this).closest(".js-tree-item").find(".js-tree-name").attr("target"),t=normalizeName(prompt("Enter new name",e.substr(1)));""!=t&&null!=t&&editGroup("/"+t,e)}),$("body").on("click",".js-add-pass",function(){getAddPassPage()}),$("body").on("click",".js-newpass-save",function(){var e=$(".js-input-title").val(),t={login:$(".js-input-login").val(),pass:$(".js-input-pass").val(),link:$(".js-input-link").val(),note:$(".js-input-note").val()};t?saveNewPass(e,t):alert("Write name!")}),$("body").on("click",".js-pass-save",function(){var e=confirm("Resave?");if(e){var t=$(".js-input-title").val(),a={login:$(".js-input-login").val(),pass:$(".js-input-pass").val(),link:$(".js-input-link").val(),note:$(".js-input-note").val()};a?savePass(t,a):alert("Write name!")}}),$("body").on("click",".js-tree-del",function(){var e=confirm("Seriously?");if(e){var t=$(this).closest(".js-tree-item").find(".js-tree-name"),a=$(t).attr("target"),s=$(t).attr("type"),n=["groups","passwd"];""!=a&&null!=a&&$.inArray(s,n)>=0?delItem(a,s):alert("error")}}),$("body").on("click",".js-crypt-decrypt.crypted",function(){var e=$(this).closest(".js-field"),t=$(e).find(".js-crypt"),a=$(t).val();""!=a&&null!=a&&(fieldDecrypt(t,a),$(t).removeClass("crypted").addClass("decrypted").prop("disabled",!1),$(this).removeClass("crypted").addClass("decrypted").attr("src","/_assets/img/svg/key.svg"),$(this).next(".js-pass-copy").addClass("hide")),checkAllCrypt()}),$("body").on("click",".js-crypt-decrypt.decrypted",function(){var e=$(this).closest(".js-field"),t=$(e).find(".js-crypt"),a=$(t).val();""!=a&&null!=a&&(fieldCrypt(t,a),$(t).removeClass("decrypted").addClass("crypted").prop("disabled",!0),$(this).removeClass("decrypted").addClass("crypted").attr("src","/_assets/img/svg/eye.svg"),$(this).next(".js-pass-copy").removeClass("hide")),checkAllCrypt()}),$("body").on("click",".js-pass-copy",function(){var e=$(this).closest(".js-field").find(".js-crypt").val(),t=$(this);""!=e&&null!=e&&copyButton(t,e)}),$("body").on("input propertychange",".js-crypt",function(){var e=$(this),t=$(e).val(),a=$(e).closest(".js-field");""!=t&&null!=t?($(a).find(".js-crypt-decrypt").removeClass("hide").attr("src","/_assets/img/svg/key.svg"),$(e).removeClass("empty")):($(a).find(".js-pass-copy").addClass("hide"),$(a).find(".js-crypt-decrypt").addClass("hide"),$(e).addClass("empty")),$(".js-input-title").addClass("edit"),checkAllCrypt()}),$("body").on("input propertychange",".js-input-title",function(){$(this).addClass("edit"),checkAllCrypt()}),$("body").on("input",".js-input-title",function(){var e=$(this).val(),t=normalizeName(e);$(this).val(t)}),$("body").on("click",".js-show-all",function(){showAll()}),$("body").on("click",".js-decrypt-all",function(){$(".js-allpass-field").each(function(e,t){var a=$(t).text();""!=a&&null!=a&&allDecrypt($(t),a)})}),$("body").on("click",".js-make-backup",function(){var e=$(".js-allpass-body").html();backUp(e)}),history.pushState(null,null,location.href),window.onpopstate=function(e){history.go(1)}});