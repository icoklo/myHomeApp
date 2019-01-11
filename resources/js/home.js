var city = $('div#vrijeme').data('city');
var interval = $('div#vrijeme').data('interval');
var intervalCurrency = $('div#tecajna_lista').data('interval');
var intervalDate = $('div#datum').data('interval');
var base_url = 'http://my-home-app.loc';

function weather() {

    $.ajax({
        method: "GET",
        url: base_url + "/weather",
        cache: false,
        dataType: "json",
        crossDomain: true,
        data: { q:city },
        error: function(){
            console.log("Greska 1001");
        },
        success: function(response){
            //alert("Radi");
            var text = response.name + ', ' + response.weather[0].description + ', ';
            text += response.main.temp + ' °C';
            $('div#vrijeme').html(text);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(weather, interval * 1000);
}

function currencyList() {

    $.ajax({
        method: "GET",
        url: base_url + "/currency-list",
        cache: false,
        dataType: "json",
        crossDomain: true,
        error: function(){
            console.log("Greska 1002");
        },
        success: function(response){
            //alert("Radi");
            $('div#tecajna_lista').html(response.rates.HRK);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(currencyList, intervalCurrency * 1000);
}

function date() {

    $.ajax({
        method: "GET",
        url: base_url + "/date",
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
