$(document).ready(function(){
 if ($(".slider-for")[0]){
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
}
if ($(".slider-nav")[0]){
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        centerMode: true,
        focusOnSelect: true,
        dots: false,
    });
}
if ($(".home-slider")[0]){
    $('.home-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        fade: true,
    });
}

  if ($(".form-contacto")[0]){
    $('#contact').validate({
    rules: {
   
    // simple rule, converted to {required:true}
    name_: "required",
    phone_: "required",
     message_: "required", 
    // compound rule
    email_: {
      required: true,
      email: true
    }
  },
  submitHandler: function(form) {
    // do other things for a valid form
    form.submit();
    
  }
});
  }



});