$(document).ready(function(){
    // $('#listTrans').DataTable({
    //     searching:false,
    //     pagingType: "numbers",
    //     "dom": '<"top">rt<"bottom_paging"iflp>'
    // });
    // $('.input-append.date').datepicker();
    
    // $('#reportList').DataTable({
    //     searching:false,
    //     pagingType: "numbers",
    //     "dom": '<"top">rt<"bottom_paging"iflp>'
    // });
 
    $('#listTrans select').on('change',function(){
        var selected_class = $(this).find('option:selected').data('text-class');
        $(this).removeClass('form-select-^').addClass(selected_class);
    });


    $('.icon-collapse').click(function(){
        if($(this).hasClass('collapsed')){
            $(this).removeClass('collapsed');
            $('sidebar').removeClass('collapsed');
        }else{
            $(this).addClass('collapsed');
            $('sidebar').addClass('collapsed');
        }
    });

    // $('#payment_link').DataTable({
    //     searching:false,
    //     pagingType: "numbers",
    //     "dom": '<"top">rt<"bottom_paging"iflp>'
    // });

    //set status
    $('[data-bs-toggle="cust_dropdown"]').each(function(){
        var id = $(this).data('bs-target');
        if($(id).hasClass('show')){
            $(id).find('input').change(function(){
                $(id).find('.dropdown-item').removeClass('active');
                if($(this).is(":checked")){
                    $(this).parent().addClass('active');
                }
            });
        }
        
    });

});

var loadFile = function(event,ele) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = $(ele).next();
        output.css({'background':'url('+reader.result+') no-repeat top left / cover'});
    };
    reader.readAsDataURL(event.target.files[0]);
};

var copyclipboard = function(){
    var temp = document.getElementById('va_code').value;
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = temp;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
};

var copy_payment_link = function(ele){
    var temp = ele.previousSibling.innerHTML;
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = temp;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
};


function show_advance_search(ele){
    if($(ele).hasClass('hide-as')){
        $(ele).removeClass('hide-as').find('span').text('Lọc cơ bản');
        $('.as').removeClass('d-none');
    }else{
        $(ele).addClass('hide-as').find('span').text('Lọc nâng cao');
        $('.as').addClass('d-none')
    }
 
}

function show_option_payment_link(ele){
    if($(ele).hasClass('up')){
        $('.more_info').addClass('d-none');
        $(ele).removeClass('up');
    }else{
        $('.more_info').removeClass('d-none');
        $(ele).addClass('up');
    }
}

function add_ticket_type(){
    var frm_ticket_name = $('#frm_ticket_name').val();
    var html = '<div class="row mb-3"> <label for="inputPassword3" class="col-sm-3 col-form-label">'+frm_ticket_name+'</label><div class="col-sm-9"> <input type="text" class="form-control" id="inputPassword3"></div></div>';
    $('#add_type_ticket').append(html);
}
