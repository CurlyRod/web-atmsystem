    $(document).ready(function() { 
        RenderAllRecord(); 
        TotalSection();
        function RenderAllRecord() {
            $.ajax({
                url: "../controller/MaintenanceController.php",
                type: "POST",
                data: {
                    action: "view"
                },
                success: function(response) {

                    $("#showUser").html(response);
                    $('#user_datatable').DataTable({
                        order: [8, "desc"],
                        responsive: true
                    }); 
                }
            });
        } 
        function TotalSection() {
            $.ajax({
                url: "../controller/MaintenanceController.php",
                type: "POST",
                data: {
                    action: "countsection"
                },
                success: function(response) {
                    var data = JSON.parse(response); 
                   console.log(data);
                }
            });
        } 

$('body').on("click", ".editBtn" , function(e){  
    e.preventDefault();
     var userId = $(this).attr('id'); 
    $.ajax({ 
        url:"../controller/MaintenanceController.php", 
        type:"POST", 
        data:{edit_id: userId },
        success:function(response){ 
       
        var data = JSON.parse(response);  
        console.log(data); 
        $("#edit_user_Id").val(data[0].id); 
        $("#edit_student_number").val(data[0].student_number);  
        $("#edit_section").val(data[0].section); 
        $("#edit_fname").val(data[0].first_name); 
        $("#edit_mname").val(data[0].middle_name); 
        $("#edit_lname").val(data[0].last_name); 
        $("#edit_email").val(data[0].email); 
        }
    });
});  
 // update 
$("#editUser").click(function(e){ 
    e.preventDefault();
    $.ajax({
        url: "../controller/MaintenanceController.php",
        type: "POST",
        data: $("#editUserForm").serialize() + "&action=update",
        success:function(response){ 
            var response = JSON.parse(response); 
            if (response.statuscode === 400)
            {   
                Swal.fire({ title: response.message, icon: response.status });   
                return;
            } 
            else 
            {
                $("#edit-user-modal").modal('hide');
                $("#editUserForm")[0].reset(); 
                Swal.fire({ title: response.message, icon: response.status });     
                RenderAllRecord();  
            }
        },  error: function (error) {
         
            alert(" Can't do because: " + error);
        }
    }); 
});
//delete
$('body').on("click", ".deleteBtn" , function(e){  
     e.preventDefault();
     var userId = $(this).attr('id');
     var tr =  $(this).closest('tr'); 

     Swal.fire({
        title: "Confirm deletion data!",
        text: "All data associated to this item will be deleted.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete"
      }).then((result) => {
        if (result.isConfirmed) { 
            $.ajax({
               url:"../controller/MaintenanceController.php",
               type:"POST",  
               data:{delete_user: userId, action:"delete"},
               success:function(response){ 
                var response= JSON.parse(response)
                tr.css('background-color', "#F79696"); 

                Swal.fire({ title: response.message, icon: response.status});     
                RenderAllRecord();  
               }                                 
            });
        }
      });
    });

// view 
const validationforUpdate = new JustValidate("#editUserForm"); 
validationforUpdate
    .addField("#edit_student_number",[ 
        {    
            rule:"required",

        },{
            rule: 'minLength',
            value: 11,
        },
        {
            rule: 'maxLength',
            value: 11,
        },
        {
            validator: (value) => () => 
            {
                return fetch("validate-credential.php?student_number="+ encodeURIComponent(value)) 
                        .then(function(response)
                        {
                            return response.json();
                        })
                        .then(function(json) {
                            return json.available;
                        });
            }, 
            errorMessage: "Student Number already taken"
        }
    ])  

    .addField("#edit_fname", [
        {   
            rule:"required"   
        }
    ])  
    .addField("#edit_lname", [
        {   
            rule:"required"   
        }
    ]) 
    .addField("#edit_email", [
        {
            rule:"required"
        },
        {
            rule:"email"
        },
        {
            validator: (value) => () => 
            {
                return fetch("validate-credential.php?email="+ encodeURIComponent(value)) 
                        .then(function(response)
                        {
                            return response.json();
                        })
                        .then(function(json) {
                            return json.available;
                        });
            }, 
            errorMessage: "Email already taken"
        }
    ]) 
   
    .onSuccess((event) => { 
        if ($("#editForm")[0].checkValidity()) { 
            event.preventDefault();
            $.ajax({
                url: "../controller/ActionController.php",
                type: "POST",
                data: $("#editUserForm").serialize() + "&action=update",
                success:function(response){ 
                    var response = JSON.parse(response); 
                    if (response.statuscode === 200)
                    {   
                        $("#edit-user-modal").modal('hide');
                        $("#editUserForm")[0].reset(); 
                        Swal.fire({ title: response.message, icon: response.status });     
                        RenderAllRecord();
                    }
                }
            });
            }
    }); 


//view
    $('body').on("click", ".viewBtn" , function(e){   

        e.preventDefault();
         var userId = $(this).attr('id');  
        $.ajax({ 
            url:"../controller/MaintenanceController.php", 
            type:"POST", 
            data:{view_id: userId ,action: "viewinfo"},
            success:function(response){
            var data = JSON.parse(response);   
            console.log(data);
            $("#view_user_Id").val(data[0].id); 
            $("#view_student_number").val(data[0].student_number);  
            $("#view_rfid").val(data[0].verify_tag); 
            $("#view_section").val(data[0].id); 
            $("#view_fname").val(data[0].first_name); 
            $("#view_mname").val(data[0].middle_name); 
            $("#view_lname").val(data[0].last_name); 
            $("#view_email").val(data[0].email); 
            }
        });
    }); 
    
    
 const validation = new JustValidate("#signupForm"); 
validation 
    .addField("#student_number",[ 
        {    
            rule:"required",
            // errorMessage: 'Student number Mandatory'
        },{
            rule: 'minLength',
            value: 11,
        },
        {
            rule: 'maxLength',
            value: 11,
        },
        {
            validator: (value) => () => 
            {
                return fetch("validate-credential.php?student_number="+ encodeURIComponent(value)) 
                        .then(function(response)
                        {
                            return response.json();
                        })
                        .then(function(json) {
                            return json.available;
                        });
            }, 
            errorMessage: "Student Number already taken"
        }
    ])  

    .addField("#fname", [
        {   
            rule:"required"   
        }
    ])  
    .addField("#lname", [
        {   
            rule:"required"   
        }
    ]) 
    .addField("#email", [
        {
            rule:"required"
        },
        {
            rule:"email"
        },
        {
            validator: (value) => () => 
            {
                return fetch("validate-credential.php?email="+ encodeURIComponent(value)) 
                        .then(function(response)
                        {
                            return response.json();
                        })
                        .then(function(json) {
                            return json.available;
                        });
            }, 
            errorMessage: "Email already taken"
        }
    ]) 
    .addField("#password" ,[
        {   
            rule:"required"
        },
        {
            rule:"password"
        } 
    ]) 
    .addField("#password_confirmation",[
        {
            validator: (value, fields) =>{
              return value === fields["#password"].elem.value;
            },
                errorMessage: "Password should match"
        }
    ]) 
    .onSuccess((event) => { 
        if ($("#signupForm")[0].checkValidity()) { 
            event.preventDefault(); 
                var isValid = false;
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
                    isValid = true; 

                    if(isValid)
                    {
                        $.ajax({
                            url: "../controller/ActionController.php",
                            type: "POST",
                            data: $("#signupForm").serialize() + "&action=insert",
                            success:function(response){ 
                                var response = JSON.parse(response);   
                                if (response.statuscode === 200)
                                {   
                                    $("#add-user-modal").modal('hide');
                                    $("#signupForm")[0].reset(); 
                                    RenderAllRecord();  
                                    console.log(response);
                                    Swal.fire({ title: response.message, icon: response.status });     
                                }
                            }
                        });
                    }
                } 
            }
    });   

    // verify script  


    const validationforUpdateRfid = new JustValidate("#verify-rfid-form"); 
    validationforUpdateRfid
    .addField("#verify_code",[ 
        {    
            rule:"required",

        },{
            rule: 'minLength',
            value: 8,
        },
        {
            rule: 'maxLength',
            value: 8,
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
                        RenderAllRecord();
                    }
                }
            });
            }

    }); 

}); 

 
