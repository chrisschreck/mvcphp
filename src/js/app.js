import $ from 'jquery';
import './components/slider.js';
import {Sortable, Plugins} from '@shopify/draggable';

$(".screen-col").css('height', window.outerHeight/2);
var children_col = $( ".full div" ).children();
console.log(children_col);
var noti_call_time = 1000;
var host = window.location.hostname;

//Resize Sidebar by Main-Height
function mainSize() {
    var height = window.innerHeight;
    document.getElementById("main").style.height = height + "px";
}
window.onload = mainSize();


$(".info-accordion-head").click(function() {
    if ($('.info-accordion-body').is(':visible')) {
        $(".info-accordion-body").slideUp(300);
        $(".plusminus").text('+');
    }
    if ($(this).next(".info-accordion-body").is(':visible')) {
        $(this).next(".info-accordion-body").slideUp(300);
        $(this).children(".plusminus").text('+');
    } else {
        $(this).next(".info-accordion-body").slideDown(300);
        $(this).children(".plusminus").text('-');
    }
});

// $(".selecttable tbody tr input[type=checkbox]").change(function(e) {
//     if (e.target.checked) {
//         $(this).closest("tr").addClass("info");
//         //$(".selecttable tbody tr").addClass("selectedrowtr");
//     } else {
//         //$(".selecttable tbody tr").removeClass("selectedrowtr");
//         $(this).closest("tr").removeClass("info");
//     }
// });
// $(document).ready(function(){
//     if(document.getElementsByClassName('selecttable tbody tr input[type=checkbox]').checked) {
//         console.log($(".selecttable tbody tr input[type=checkbox]").attr('checked'));
//         $(".selecttable tbody tr").addClass("selectedrowtr");
//     }
// });
  
$(".selecttable tbody tr").click(function(e){
    if (e.target.type != 'checkbox' && e.target.tagName != 'A'){
    var cb = $(this).find("input[type=checkbox]");
    cb.trigger('click');
    }
});

$("#save-screen").submit(function(e) {
    var children = $( ".div1" ).children();
    console.log(children);
    // $( "li" ).each(function( index ) {
    //     console.log( index + ": " + $( this ).text() );
    // });
});




$('.drag-element').dblclick(function(){

    $(this).attr('selected', 'false');
    $(this).appendTo('.available-packages');
    //Hidden input entfernen, wenn ein Package vom Screen entfernt wird
    var value = $(this).attr("value");
    $('#inputs :input[value='+value+']').remove();
});





// $('#file').on('dragstart', function(evt) {
//     drag(evt);
// });




// window.onload = function() {

//     var legends = document.getElementsByTagName("legend");

//     for (var i = 0; i < legends.length; i++) {
//         legends[i].onclick = function() {
//             var myDivs = this.parentNode.getElementsByTagName("div");
//             var myDiv;

//             if (myDivs.length > 0) {
//                 var myDiv = myDivs[0];

//                 if (myDiv.style.display == "block") {
//                     myDiv.style.display = "none"
//                 } else {
//                     myDiv.style.display = "block";
//                 }
//             }
//         }
//     }

// };


// $('.tablinks').click(function() {
//     var i, tabcontent;
//     tabcontent = document.getElementsByClassName("tabcontent");
//     for (i = 0; i < tabcontent.length; i++) {
//         tabcontent[i].style.display = "none";
//     }
//     var id = $(this).attr("id");
//     var box = document.getElementById(id + "_box");
//     if (box.style.display == "block")
//         box.style.display = "none";
//     else
//         box.style.display = "block";
// });




// function allowDrop(ev) {
//     ev.preventDefault();
// }

// function drag(ev) {
//     ev.dataTransfer.setData("text", ev.target.id);
// }

// function drop(ev) {
//     ev.preventDefault();
//     var data = ev.dataTransfer.getData("text");
//     ev.target.appendChild(document.getElementById(data));
// }