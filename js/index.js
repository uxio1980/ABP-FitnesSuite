var text_logo = document.querySelector("#text-logo"),
    input_search = document.querySelector("#input-search");

// Funcion llamada desde el evento window.resize
function getDimensions() {
  if (window.innerWidth < 767){
		text_logo.innerHTML = "F";
        input_search.placeholder='';
	}else {
		text_logo.innerHTML = "FitnesSuite";
        input_search.placeholder=ji18n('Search');
	}
}

// Evento window.resize
window.addEventListener('resize', getDimensions);

// Llamada al inicializar la página
getDimensions();

//*************** Input search ******************
// Al quitar el foco del input-search
/*function Blur() {
    // Focus = cambia placeholder si el tamaño de página es pequeño ("mobile")
    (window.innerWidth < 767 ) ?document.getElementById("input-search").placeholder = '': document.getElementById("input-search").placeholder = 'Buscar producto';
}*/
//*************** Language button ***************
// Modificar funcionamiento del evento click del botón Language
$(document).ready(function() {
  $('#language-button').click(
    function(event) {
      $('#dropdown-language-content').css('display', 'flex');
      $('#dropdown-notification-content').css('display', 'none');
      $('#dropdown-content').css('display', 'none');
      event.stopPropagation();
    }
  );

  $('#dropdown-language-content').click(
    function(event) {
      event.stopPropagation();
    }
  );
  $('body').click(
      function() {
        $('#dropdown-language-content').css('display', 'none');

      }
  );
});

//*************** Notification button ***************
// Modificar funcionamiento del evento click del botón Notification
$(document).ready(function() {
  $('#alert-button').click(
    function(event) {
      $('#dropdown-notification-content').css('display', 'flex');
      $('#dropdown-language-content').css('display', 'none');
      $('#dropdown-content').css('display', 'none');
      event.stopPropagation();
    }
  );

  $('#dropdown-notification-content').click(
    function(event) {
      event.stopPropagation();
    }
  );
  $('body').click(
      function() {
        $('#dropdown-notification-content').css('display', 'none');

      }
  );
});
//*************** Login button ***************
// Trsansición entre formularios login y register
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

// Modificar funcionamiento del evento click del botón Login
$(document).ready(function() {
  $('#login-button').click(
    function(event) {
      $('#dropdown-content').css('display', 'flex');
        $('#dropdown-notification-content').css('display', 'none');
      $('#dropdown-language-content').css('display', 'none');
      event.stopPropagation();
    }
  );

  $('#dropdown-content').click(
    function(event) {
      event.stopPropagation();
    }
  );
  $('body').click(
      function() {
        $('#dropdown-content').css('display', 'none');

      }
  );
});


/***************CHAT FUNCTIONS****************/

function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
	var myDiv = document.getElementById("chat-container");
 	myDiv.scrollTop = myDiv.scrollHeight;
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function openLogin() {
	$('#dropdown-content').css('display', 'flex');
      event.stopPropagation();
}

//****************** Slide show gallery ********************
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("slide");
  var dots = document.getElementsByClassName("article-gallery-picture");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" active", "");
  }
  x[slideIndex-1].style.display = "flex";
  dots[slideIndex-1].className += " active";
}
