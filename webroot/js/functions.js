function readFile($id, $img){
    $input = ($('#' + $id))[0];
    if ($input.files && $input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + $img).attr('src', e.target.result);
        }
        reader.readAsDataURL($input.files[0]);
    }
}

/*function bearout($url, $id) {
    var res = prompt("What's your keyword?", "");
    $.ajax({
        type: 'POST',
        url: $url,
        data: {note_id: $id, word: res},
        async: false,
        success: function(data){
            data = jQuery.parseJSON(data);
            console.log(data);
            if (data['res']) {
		    	window.open(data['url'], "_self");
		    } else {
		    	alert ("I can not visualize");
		    }
        },
        error: function (xhr, textStatus, error) {
            console.log(error);
        }
    });
}*/

$(document).ready(function(){
   
    $('.openBearOut').click(function() {
	    $("#note-id").val( $(this).data('id') );
	    $("#note-slug").val( $(this).data('slug') );
	    $("#note-page").val( window.location.href );
	});
    
    $('#bearout').on("shown.bs.modal", function() {
        $('#note-keyword').focus();
    });

    $('.openSetRating').click(function() {
        $("#not-id").val( $(this).data('id') );
        $("#not-page").val( window.location.href );
        $("#not-rating").val( $(this).data('rating') );
        var stars = '';
        for (var i = 0; i < 5; i++) {
            if (i < $(this).data('rating')) {
                stars += '<i class="fa fa-star modal-star" id="modal-start-' + (i + 1) + '"></i>';
            } else {
                stars += '<i class="fa fa-star-o modal-star" id="modal-start-' + (i + 1) + '"></i>';
            }
        }
        $("#modal-rating").html(stars);
    });

    var e = $('.main_btm').attr("id").substr(-1);
    $('.qmenu:eq(' + e + ')').addClass("active");

});

$(document).on('click', '.modal-star', function () {
    var e = $(this).attr("id").substr(-1);
    var one = true;
    if (e == 1 && $('#modal-start-' + e).hasClass("fa-star")) {
        one = false;
        for (var i = 1; i < 5; i++) {
            if ($('#modal-start-' + (i + 1)).hasClass("fa-star")) {
                one = true;
                break;
            }
        }
    }
    if (one) {
        for (var i = 0; i < 5; i++) {
            if (i < e) {
                if (!$('#modal-start-' + (i + 1)).hasClass("fa-star")) {
                    $('#modal-start-' + (i + 1)).removeClass("fa-star-o");
                    $('#modal-start-' + (i + 1)).addClass("fa-star");
                }
            } else {
                if ($('#modal-start-' + (i + 1)).hasClass("fa-star")) {
                    $('#modal-start-' + (i + 1)).removeClass("fa-star");
                    $('#modal-start-' + (i + 1)).addClass("fa-star-o");
                }
            }
        }
        $('#not-rating').val(e);
    } else {
        $('#modal-start-' + e).removeClass("fa-star");
        $('#modal-start-' + e).addClass("fa-star-o");
        $('#not-rating').val(0);
    }
});

/*$(document).on('keypress', '#t-keyword', function (e) {
    if (e.which == 44) {
        var words = $('#keyword').val().split(',');
        var swords = '';
        for (var i = 0; i < words.length; i++) {
            swords += '<span class="label label-custom">' + words[i] + '</span>'
            console.log(words[i]);
        }
        $(this).val(swords);
        $('#keyword').val($('#keyword').val() + e.key);
        console.log(",");        
    } else if (e.which == 8) {
        console.log("DEL");
    } else {
        //$('#t-word').val($('#t-word').val() + e.key);
        $('#keyword').val($('#keyword').val() + e.key);
        console.log($('#keyword').val());
    }
});*/