/**
 * File portfolio.js.
 *
 * Portfolio sort & display 
 */

(function($){
	'use strict';
 
    var selectedClass = "";
	$(".filter-btn").click(function(){ 
	selectedClass = $(this).attr("data-filter"); 
    $("#portfolio").fadeTo(100, 0.1);
	$("#portfolio .portfolio-item").not("."+selectedClass).fadeOut().removeClass('scale-anm');
    setTimeout(function() {
    	$("."+selectedClass).fadeIn().addClass('scale-anm');
    	$("#portfolio").fadeTo(300, 1);
    }, 300); 
		
	});
 
} ) ( jQuery );
