jQuery(document).ready((function () {
    function showInput()
    {
        $('.btn-show').click(function(){
            var vendor = $(this).data('vendor');
            $(this).hide();
            $('.hide-vendor-'+ vendor).show();
            $('.row-vendor-'+ vendor).show();
            console.log(vendor)
        })
    }

    function hideInput()
    {
        $('.btn-hide').click(function(){
            var vendor = $(this).data('vendor');
            $(this).hide();
            $('.show-vendor-'+ vendor).show();
            $('.row-vendor-'+ vendor).hide();
            console.log(vendor)
        })
    }

    showInput();
    hideInput();
}))