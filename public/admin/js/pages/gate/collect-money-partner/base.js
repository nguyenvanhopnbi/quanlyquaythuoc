jQuery(document).ready((function () {
    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    
    function getApiKey()
    {
        $('.btn-create-api-key').click(function(e){
            var string = makeid(16);
            $('#apiKey').val(string.toUpperCase());
        })    
    }
    function getSecretKey()
    {
        $('.btn-create-secret-key').click(function(e){
            var string = makeid(16);
            $('#secretKey').val(string.toUpperCase());
        })    
    }
    getSecretKey();
    getApiKey();
}))