window.onload = function(){
  var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
                 navigator.userAgent && !navigator.userAgent.match('CriOS');

  if(isSafari) {
    document.body.classList.add("safari");
  }

  var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;


  if(isIE11) {
    //console.log('ie11');
    document.body.classList.add("ie11");
  }
}
