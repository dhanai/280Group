$(document).ready(function(){
  
  var lastScrollTop = 0;
  var delta = 5;
  
  var hideHello = localStorage.getItem("hide-hello");
  var ts = new Date().getTime();
  var hours = 24;
  
  if (hideHello === null || (parseInt(hideHello) + (3600000*hours) < ts)) {
    localStorage.removeItem("hide-hello");
    $("#hello-bar").toggleClass('closed'); 
  }
  
  $("#hello-bar .hello-close").on('click',function() {
    $("#hello-bar").toggleClass('closed'); 
    localStorage.setItem("hide-hello", ts);
  })

  $('.sidenav').sidenav({draggable: false});
  
  $(".hover_icons .icon-wrapper").on("click", function() {
    $(".hover_icons .copy").removeClass('open');    
    $(".hover_icons .icon-wrapper").removeClass('active');    
    $(this).addClass('active');
    $(this).parent().find(".copy").addClass("open");
  })
  
  $("#team-member-list .team-member img").on("click", function() {
    $("#team-member-list .team-member .hover-content").removeClass('open');  
    $(this).parent().parent().find('.hover-content').toggleClass("open");
  })
  
  $(".close-hover").on('click', function() {
    $(".hover_icons .icon-wrapper").removeClass('active');    
    $(this).parent().toggleClass("open");
  })
  
  $('.close-menu').on("click", function() {
    $('.sidenav').sidenav('close');
    $('body').removeClass('open');
    $('.sub-menu').removeClass('active');
  })
  
  $('.course-detail #masthead .online-price').mouseover(function() {
    $(this).next('.mh-whats-included').addClass('open');
  })
  $('.course-detail #masthead .online-price').mouseout(function() {
    $(this).next('.mh-whats-included').removeClass('open');
  })
  
  $('.mobile-nav-icon-wrapper').on("click", function() {
    $('.sidenav').sidenav('open');
    $('body').addClass('open');
  })
  
  $('.back-menu').on("click", function() {
    $('.sub-menu').removeClass('active');
    $('.sidenav').removeClass('sub-open');
  })
  
  $(".mobile-nav > li.menu-item-has-children > a").on('click', function(e) {
    e.preventDefault();
    $(this).next('.sub-menu').toggleClass('active');    
    $('.sidenav').addClass('sub-open');
  });
  
  $('.tooltip').tooltipster({
    theme: 'tooltipster-shadow',
    maxWidth: 500,
    contentAsHTML: true,
    side: ['right','left']
  });
  
  $('.scroller-full').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    prevArrow: $('.prev-arrow'),
    nextArrow: $('.next-arrow')
  });      
  
  $('.scroller-cards').slick({
    slidesToShow:3,
    slidesToScroll: 3,
    infinite: true,
    arrows: false,
    dots: true,
    responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });     
  
  $('.scroller-products').slick({
    slidesToShow:4,
    slidesToScroll: 4,
    infinite: true,
    arrows: true,
    dots: true,
    prevArrow: $('.prev-arrow'),
    nextArrow: $('.next-arrow')

  });     
  
  $('.tabs').tabs({duration: 100});

  $('.modal').modal({
      startingTop: '15%',
      endingTop	: '15%',
  });
  
  $('.next-modal').on('click',function() {
    $(this).parent().parent().modal('close');
    var mId = $(this).attr('data-target-id');
    setTimeout(function() {$(mId).modal('open');} , 300);
  })  

  $('.nav-modal-trigger').on('click',function() {
    $("#start-here-modal").modal('open');
  })  
  
  $('.modal-link-minimal').on('click',function() {
    $("#start-here-modal-minimal").modal('open');
  })  
  
  $('#header-search').click (function() {
    $(".search-container").toggleClass('open');
  })
  
  $(".search-container .close-search").on('click', function() {
    $(".search-container").toggleClass('open');
  });

  // Handles sticky header on scroll with a debounce method
  var didScroll = false;
  window.onscroll = scrollAction;
  
  
  function scrollAction() {
      didScroll = true;
  }
  setInterval(function() {
    if(didScroll) {
        didScroll = false;
        stickyHeader();
    }
  }, 50);
  
  function stickyHeader(){	
  	var fromTop = $(document).scrollTop();

    $('header').toggleClass("fixed", (fromTop > 300));
  	$('header').toggleClass("sticky", (fromTop > 450));
  	
      // Make sure they scroll more than delta
      if(Math.abs(lastScrollTop - fromTop) <= delta)
          return;
      
      // If they scrolled down and are past the navbar, add class .nav-up.
      // This is necessary so you never see what is "behind" the navbar.
      if (fromTop > lastScrollTop){
          // Scroll Down
          $('header.mobile').removeClass('nav-down').addClass('nav-up');
      } else {
          // Scroll Up
          if(fromTop + $(window).height() < $(document).height()) {
              $('header.mobile').removeClass('nav-up').addClass('nav-down');
          }
      }
      
      lastScrollTop = fromTop;
  } 
  
  
  
}) 



function initVideos() {
var vidDefer = document.getElementsByTagName('iframe');
for (var i=0; i<vidDefer.length; i++) {
if(vidDefer[i].getAttribute('data-src')) {
vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
} } }
window.onload = initVideos;