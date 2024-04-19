$(document).ready(function(){
    const validationforUpdate = new JustValidate("#verify-rfid-form"); 
    validationforUpdate
        .addField("#verify_code",[ 
            {    
                rule:"required",
    
            },
            {
                validator: (value) => () => 
                {
                    return fetch("validate-code.php?verify_code="+ encodeURIComponent(value)) 
                            .then(function(response)
                            {
                                return response.json();
                            })
                            .then(function(json) {
                                return json.available;
                            });
                }, 
                errorMessage: "Already use this Code"
            }
        ]) 
        .addField("#verify_tag", [
            {
                rule:"required"
            },
            {
                validator: (value) => () => 
                {
                    return fetch("validate-code.php?verify_tag="+ encodeURIComponent(value)) 
                            .then(function(response)
                            {
                                return response.json();
                            })
                            .then(function(json) {
                                return json.available;
                            });
                }, 
                errorMessage: "RFID Tag already taken"
            }
        ]) 
       
        .onSuccess((event) => { 
            if ($("#verify-rfid-form")[0].checkValidity()) { 
                event.preventDefault();
                $.ajax({
                    url: "../controller/MaintenanceController.php",
                    type: "POST",
                    data: $("#verify-rfid-form").serialize() + "&action=verify",
                    success:function(response){ 
                        var response = JSON.parse(response); 
                        if (response.statuscode === 200)
                        {   
                            $("#verify-rfid-modal").modal('hide');
                            $("#verify-rfid-form")[0].reset(); 
                            Swal.fire({ title: response.message, type: response.status ,icon: response.status });     
                         
                        }
                    }
                });
                }
    
        }); 
});