/*MENU*/
( function( $ ) {
$( document ).ready(function() {
	$('#cssmenu > ul > li > a').click(function() {
	  $('#cssmenu li').removeClass('active');
	  $(this).closest('li').addClass('active');	
	  var checkElement = $(this).next();
	  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
	    $(this).closest('li').removeClass('active');
	    checkElement.slideUp('normal');
	  }
	  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
	    $('#cssmenu ul ul:visible').slideUp('normal');
	    checkElement.slideDown('normal');
	  }
	  if($(this).closest('li').find('ul').children().length == 0) {
	    return true;
	  } else {
	    return false;	
	  }		
	});
});
} )( jQuery );


/*Formularios de edição*/
function PreencheCampos(id,nome){
	document.getElementById("id-cat").value=id;
	document.getElementById("span-cat").innerHTML=nome;
	document.getElementById("form-editar").style.visibility = "visible";
}
window.onload = function(){
	var closeBtn = document.getElementById('close-form');
	closeBtn.onclick = function() {
		closeForm();
	}

	function closeForm() {
		document.getElementById("form-editar").style.visibility = "hidden";
	}
}
