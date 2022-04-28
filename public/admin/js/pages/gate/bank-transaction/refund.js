
function buildAmoutInput()
{
    $("#amount").select2({
        placeholder: "Nhập số tiền",
        allowClear: true,
        width: '100%',
        ajax: {
            url: "source/ajax/get-list-source-amount",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatAmount, // omitted for brevity, see the source of this page
        templateSelection: formatAmountSelection // omitted for brevity, see the source of this page
    });

    function formatAmount(repo) {
        if (repo.loading) return repo.text;
        var markup = "<div wire:ignore class='select2-result-repository clearfix'>" +
            "<div wire:ignore class='select2-result-repository__meta'>" +
            "<div wire:ignore class='select2-result-repository__title'>" + repo.text  + "</div>";
        return markup;
    }

    function formatAmountSelection(repo) {
        if(typeof repo.text !== 'undefined'){
            return repo.text;
        }
        return repo.text;
    }

}

function refundTransaction()
{
    $('#btn_refund').click(function(){
        if(confirm('Bạn muốn refund giao dịch này ?')){
            refundAction();
        }
    })
}

function refundAction()
{
    $.ajax({
        type: "POST",
        url: "/gate-bank-transaction/refund",
        data: {
            transaction_id: $('#transaction_id').text(),
            amount: $('#amount').val(),
            reason: $('#reason').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {

            if(response.success == false){
                console.log(response.success);
                swal.fire({
                    title: "",
                    text: response.message,
                    type: 'error',
                    confirmButtonClass: "btn btn-secondary"
                });
                return;
            }


            swal.fire({
                title: "",
                text: response.message,
                type: 'success',
                confirmButtonClass: "btn btn-secondary"
            });
        },
        error: function(response) {
            var errors = response.responseJSON.error;
            if (errors.code === 1){
                showErrorMessage(errors.errors)
            } else {
                var message = !errors ? 'Có lỗi xảy ra, vui lòng thử lại sau' : errors.message;
                swal.fire({
                    title: "",
                    text: message,
                    type: 'error',
                    confirmButtonClass: "btn btn-secondary"
                });
            }
        }
    });
}

refundTransaction();
buildAmoutInput();



