var city = $('div#vrijeme').data('city');
var interval = $('div#vrijeme').data('interval');
var intervalCurrency = $('div#tecajna_lista').data('interval');

function weather() {

    $.ajax({
        method: "GET",
        url: "http://my-home-app.loc/weather",
        cache: false,
        dataType: "json",
        crossDomain: true,
        data: { q:city },
        error: function(){
            alert("Greska");
        },
        success: function(response){
            alert("Radi");
            $('div#vrijeme').html(response.weather[0].description);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(weather, interval * 1000);
}

function currencyList() {

    $.ajax({
        method: "GET",
        url: "http://my-home-app.loc/currency-list",
        cache: false,
        dataType: "json",
        crossDomain: true,
        error: function(){
            alert("Greska");
        },
        success: function(response){
            alert("Radi");
            $('div#tecajna_lista').html(response.rates.HRK);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(currencyList, intervalCurrency * 1000);
}

$(document).ready(function(){

    console.log("home.js");

    if(typeof intervalCurrency !== 'undefined')
    {
        currencyList();
    }
    if(typeof city !== 'undefined' && typeof interval !== 'undefined')
    {
        weather();
    }

});
