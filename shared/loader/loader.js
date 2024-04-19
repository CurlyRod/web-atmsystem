var form = document.getElementById('card-container');
var loadercontainer = document.getElementById("loader-container"); 

// Function to hide form and display loader on DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
   form.style.display = "none"; 
   showLoader();
});

// Function to show loader and then remove it when fully loaded
$(window).on('load', function() {
   setTimeout(removeLoader, 1200);
});
 
// Function to show loader
function showLoader() {
   $("#loader").fadeIn(500);
}

// Function to remove loader and show form
function removeLoader() {
    $("#loader").fadeOut(500, function() {
       $("#loader").remove();  
       $(form).fadeIn(100);
       form.style.display = "block"; 
       $("#loader-container").remove();
   });
} 
