var city = $('div#vrijeme').data('city');
var interval = $('div#vrijeme').data('interval');
var intervalCurrency = $('div#tecajna_lista').data('interval');
var intervalDate = $('div#datum').data('interval');

function weather() {

    $.ajax({
        method: "GET",
        url: baseUrl + "/weather",
        cache: false,
        dataType: "json",
        crossDomain: true,
        data: { q:city },
        error: function(){
            console.log("Greska 1001");
        },
        success: function(response){
            //alert("Radi");
            if(response.cod == 400)
            {
                $('div#vrijeme').html("Niste izabrali grad/mjesto!!!");
            }
            else
            {
                var text = response.name + ', ' + response.weather[0].description + ', ';
                text += response.main.temp + ' °C';
                $('div#vrijeme').html(text);
            }
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(weather, interval * 1000);
}

function currencyList() {

    $.ajax({
        method: "GET",
        url: baseUrl + "/currency-list",
        cache: false,
        dataType: "json",
        crossDomain: true,
        error: function(){
            console.log("Greska 1002");
        },
        success: function(response){
            //alert("Radi");
            $('div#tecajna_lista').html(response.rates.HRK + ' HRK');
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(currencyList, intervalCurrency * 1000);
}

function date() {

    $.ajax({
        method: "GET",
        url: baseUrl + "/date",
        cache: false,
        dataType: "json",
        crossDomain: true,
        error: function(){
            console.log("Greska 1003");
        },
        success: function(response){
            //alert("Radi");
            $('div#datum').html(response.date);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(date, intervalDate * 1000);
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
    if(typeof intervalDate !== 'undefined')
    {
        date();
    }

});
