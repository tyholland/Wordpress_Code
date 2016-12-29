$(document).ready(function () {

  $('.menuTrigger').on('click', function() {
    var mobileNav = $('.mobileMenu').css('display');

    mobileNav !== 'none' ? menuClose() : menuOpen();
  });

  $('#menClothing').on('change', function(e) {
    e.preventDefault();
    var clothes = $(this).val(),
        locate = '';

    if (clothes === 'mClothes') {
      locate = '/find-cool-clothes-for-men/';
    } else if (clothes === 'mHeadgear') {
      locate = '/find-cool-headgear-for-men/';
    } else if (clothes === 'mShoes') {
      locate = '/find-cool-shoes-for-men/';
    }  else {
      locate = '/find-cool-outfits-for-men/';
    } 

    location.href = locate;
  });

  $('#womenClothing').on('change', function(e) {
    e.preventDefault();
    var clothes = $(this).val(),
        locate = '';

    if (clothes === 'wClothes') {
      locate = '/find-cool-clothes-for-women/';
    } else if (clothes === 'wHeadgear') {
      locate = '/find-cool-headgear-for-women/';
    } else if (clothes === 'wShoes') {
      locate = '/find-cool-shoes-for-women/';
    }  else {
      locate = '/find-cool-outfits-for-women/';
    } 

    location.href = locate;
  });

  function menuOpen() {
    $('.mobileMenu').css('display', 'block');
    $('.menuTrigger').html('X');
    $('#main').hide();
  }

  function menuClose() {
    $('.mobileMenu').css('display', 'none');
    $('.menuTrigger').html('menu');
    $('#main').show();
  }

  $('#prices').on('change', function() {
    var price = $(this).val();
    $('input[name="pg"]').val('1');
    $('input[name="price"]').val(price);
    $('#pageForm').submit();
  });

  $('#mainCategory').on('change', function(e) {
    e.preventDefault();
    var cat = $(this).val();
    location.href = cat;
  });

  $('.firstPg').on('click', function(e) {
    e.preventDefault();    
    $('input[name="pg"]').val(1);
    $('#pageForm').submit();
  });

  $('.leftPg').on('click', function(e) {
    e.preventDefault();    
    var page = $('input[name="pg"]').val();
    $('input[name="pg"]').val(page-1);
    $('#pageForm').submit();
  });

  $('.rightPg').on('click', function(e) {
    e.preventDefault();    
    var page = $('input[name="pg"]').val();
    $('input[name="pg"]').val(parseInt(page)+1);
    $('#pageForm').submit();
  });

  $('button.details').on('click', function() {
    $this = $(this);

    if ($this.attr('count') != 0) {
      review = '<p><strong>Number of Reviews:</strong> ' + $this.attr('count') + '<br>' +
                '<strong>Rating (out of 5):</strong> ' + $this.attr('rating') + '</p>';
    } else {
      review = '';
    }

    if ($this.attr('code')) {
      coupon = '<p><strong>Coupon Code/Description:</strong> ' + $this.attr('code') + '</p>';
    } else {
      coupon = '';
    }

    $('body').append('<div id="modal">' +
      '<p><strong>Name:</strong> ' + $this.attr('name') + '</p>' +
      '<p><strong>Description:</strong> ' + $this.attr('descript') + '</p>' +
      '<p><strong>Manufacturer:</strong> ' + $this.attr('store') + '</p>' +
      review +
      coupon +
      '<p><a href="' + $this.attr('link') + '" target="_blank"><button>Buy Now</button></a></p>' +
      '</div>');

    $('#modal').dialog({
      title: 'Item Details',
      width: '600px',
      close: function() {
        $('#modal').remove();
      }
    });
  });

});
