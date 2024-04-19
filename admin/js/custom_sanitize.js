
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
 