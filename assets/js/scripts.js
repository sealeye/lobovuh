"use strict";function nextSlide(){goToSlide(currentSlide+1)}function previousSlide(){goToSlide(currentSlide-1)}function goToSlide(e){slides[currentSlide].className="slider__item",currentSlide=(e+slides.length)%slides.length,slides[currentSlide].className="slider__item showing"}$(function(){$(document).on("mouseover mouseout","a",function(e){var t=$(this).attr("href");t&&"#"!=t&&$("a").filter('[href="'+$(this).attr("href")+'"]').toggleClass("hover","mouseover"==e.type)}),$(".select select").on("change",function(){$('input[name="city"]').val($(this).find("option:selected").val())})});var slider=document.querySelector(".slider-container"),slides=document.querySelectorAll(".slider__item"),currentSlide=0,slideInterval=setInterval(nextSlide,2e4),next=document.getElementById("next"),previous=document.getElementById("prev");next.onclick=function(){nextSlide()},previous.onclick=function(){previousSlide()};