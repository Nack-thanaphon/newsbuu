// JavaScript Document
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('show_time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);

}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function toTimeZone() {
  var time=new Date().toLocaleString('th-TH', { timeZone: 'Asia/Bangkok' })
}
 toTimeZone();
