(function ($) {
  "use strict";

  $('.popup-youtube, .popup-vimeo').magnificPopup({
    // disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });

  if ($(window).width() < 991) {
    // menu fixed js code
    $(window).scroll(function () {
      var window_top = $(window).scrollTop() + 1;
      if (window_top > 50) {
        $('.main_menu').addClass('menu_fixed animated fadeInDown');
      } else {
        $('.main_menu').removeClass('menu_fixed animated fadeInDown');
      }
    });
  } else {
    window.onscroll = function () {
      myFunction()
    };

    var sticky_menu = document.getElementById("sticky_menu");
    var sticky = sticky_menu.offsetTop;

    function myFunction() {
      if (window.pageYOffset >= sticky) {
        sticky_menu.classList.add("sticky")
      } else {
        sticky_menu.classList.remove("sticky");
      }
    }
  }


  // easying js
  $('.page-scroll').bind('click', function (event) {
    var $anchor = $(this);
    var headerH = '80';
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
  });

}(jQuery));