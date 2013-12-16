$(document).ready(function () {

    $(".inlineEdit").bind("click", updateText);

    var OrigText, NewText;
$( document ).on( "click", ".save", function() {
    

        $("#loading").fadeIn('slow');

        NewText = $(this).siblings("form").children(".edit").val();
        var id = $(this).parent().attr("id");
        var data = 'id=' + id + '&text=' + NewText;

        $.post("ajax_alertedit", data, function (response) {
            $("#response").html(response);
            $("#showalert").show();
            /*$("#response").slideDown('slow');
           slideout();
           $("#loading").fadeOut('slow');*/

        });

        $(this).parent().html(NewText).removeClass("selected").bind("click", updateText);

    });
$( document ).on( "click", ".revert", function() {
    
        $(this).parent().html(OrigText).removeClass("selected").bind("click", updateText);
    });



    function updateText() {

        $('#nev_test li ul li').removeClass("inlineEdit");
        OrigText = $(this).html();
        
        $(this).addClass("selected").html('<form ><textarea class="edit">'+OrigText+'</textarea> </form><a href="#" class="btn btn-lg btn-block btn-success save" style="width:62px;padding:2px;float:left;margin:5px;">Save</a> <a href="#" class="btn btn-lg btn-block btn-danger revert" style="width:62px;padding:2px;margin:5px;">Cancel</a><br /><div class="clear"></div>').unbind('click', updateText);

    }
});