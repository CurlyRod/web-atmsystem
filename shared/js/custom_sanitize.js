function checkforblank() {
    
    var location = document.getElementById('section'); 
    var error = document.getElementById('error-msg');
    var invalid = location.value == "Choose Section";
  
    if (invalid) {
        location.className = 'form-select form-select'; 
        error.className = 'd-block';
    }
    else {
        location.className = 'form-select form-select'; 
        error.className = 'd-none';
    }
    
    return !invalid;
} 

function restrictToLetters(inputElement) {
    inputElement.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var sanitizedValue = inputValue.replace(/[^a-zA-Z\s]/g, "");
        event.target.value = sanitizedValue;
    }); 
}  

function restrictToNumbers(inputElement) {
    inputElement.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var sanitizedValue = inputValue.replace(/[^0-9]/g, "");
        event.target.value = sanitizedValue;
    }); 
}

restrictToLetters(document.getElementById("fname"));
restrictToLetters(document.getElementById("mname")); 
restrictToLetters(document.getElementById("lname")); 
restrictToNumbers(document.getElementById("student_number"));
