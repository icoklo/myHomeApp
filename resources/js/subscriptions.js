$(document).ready(function(){

    console.log("subscriptions.js");

    var selectedVal = $('select[name="information"]').val();
    switchCase(selectedVal);

    $('select[name="information"]').on('change',function(){
        var selectedVal = $(this).val();
        switchCase(selectedVal)
    });

    function switchCase(selectedVal)
    {
        switch(selectedVal) {
            case "1":
                $('.weather').hide();
                $('.currency-list').hide();
                break;
            case "2":
                $('.weather').show();
                $('.currency-list').hide();
                // setInterval(function () {
                //
                //     $(".weather").show().html(Math.random())
                // }, 1000);
                break;
            case "3":
                $('.weather').hide();
                $('.currency-list').show();
                break;
            default:
                //change this according to your need
                break;

        }
    }

});
