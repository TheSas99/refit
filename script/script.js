function myFunction() {
    var greeting;
    var time = new Date().getHours();
    if (time < 12) {
        greeting = "Goedemorgen!";
    } else if (time < 18) {
        greeting = "Goedemiddag";
    } else {
        greeting = "Goedenavond";
    }
    document.getElementById("demo").innerHTML = greeting;
}
function changeType()
{
    document.register.txt.type=(document.register.option.value=(document.register.option.value==1)?'-1':'1')=='1'?'text':'password';
}
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 51.912624, lng: 4.483982},
        zoom: 11
    });
}
