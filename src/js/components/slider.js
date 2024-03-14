import $ from 'jquery';

/* Slidenumber start */
  let slideIndex = [1, 1, 1, 1];
  let stdSliderTime = 7000;
  let slotTimer = {
        'slot-0-slide': stdSliderTime,
        'slot-1-slide': stdSliderTime,
        'slot-2-slide': stdSliderTime,
        'slot-3-slide': stdSliderTime
  };

  /* Class the members of each slideshow group with different CSS classes */
  let slideId = ["slot-0-slide", "slot-1-slide", 'slot-2-slide', 'slot-3-slide']

  showSlides(1, 0);
  showSlides(1, 1);
  showSlides(1, 2);
  showSlides(1, 3);

  function plusSlides(n, no) {
    showSlides(slideIndex[no] += n, no);
  }

  function showSlides(n, no) {
    let i;
    let x = document.getElementsByClassName(slideId[no]);

    if(x.length > 0){
      if (n > x.length) {slideIndex[no] = 1}
      if (n < 1) {slideIndex[no] = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      if(typeof $(x[slideIndex[no]-1]).children('video')[0] != 'undefined'){
        slotTimer[slideId[no]] = $(x[slideIndex[no]-1]).children('video')[0].getAttribute('data-duration');
      } 
      if(!$(x[slideIndex[no]-1]).hasClass('video')){
        slotTimer[slideId[no]] = stdSliderTime;
      }
      x[slideIndex[no]-1].style.display = "block";
    }
  }

  /* Define autoplay */
  // Slider 0 autoplay
  let slot0;
  function startSlot0(){
    if(slot0){
      slot0 = window.clearInterval(slot0);
    }
    slot0 = window.setInterval(function(){
      plusSlides(1, 0);
      startSlot0();
    }, slotTimer['slot-0-slide']);
  }
  startSlot0();

  // Slider 1 autoplay
  let slot1;
  function startSlot1(){
    if(slot1){
      slot1 = window.clearInterval(slot1);
    }
    slot1 = window.setInterval(function(){
      plusSlides(1, 1);
      startSlot1();
    }, slotTimer['slot-1-slide']);
  }
  startSlot1();

  // Slider 2 autoplay
  let slot2;
  function startSlot2(){
    if(slot2){
      slot2 = window.clearInterval(slot2);
    }
    slot2 = window.setInterval(function(){
      plusSlides(1, 2);
      startSlot2();
    }, slotTimer['slot-2-slide']);
  }
  startSlot2();

  // Slider 3 autoplay
  let slot3;
  function startSlot3(){
    if(slot3){
      slot3 = window.clearInterval(slot3);
    }
    slot3 = window.setInterval(function(){
      plusSlides(1, 3);
      startSlot3();
    }, slotTimer['slot-3-slide']);
  }
  startSlot3();

