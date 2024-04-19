$(document).ready(function(){
    RenderAllRecord();
    TotalUser();
    TotalSection();

    function RenderAllRecord() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "view"
            },
            success: function(response) {
                
                $("#showUser").html(response);
                $('#user_datatable').DataTable({
                    order: [0, "desc"],
                    responsive: true
                }); 
                
            }
        });
    }

    function TotalUser() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "countuser"
            },
            success: function(response) {
                var data = JSON.parse(response);
                $("#total-user").html(data.total_user);
            }
        });
    }  
    function TotalSection() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "countsection"
            },
            success: function(response) {
                var data = JSON.parse(response); 
                console.log(data);
                $("#total-section").html(data.total_section);
            }
        });
    } 
 
// //  edit 
// $('body').on("click", ".editBtn" , function(e){  
//     e.preventDefault();
//      var userId = $(this).attr('id'); 
//     $.ajax({ 
//         url:"../controller/ActionController.php", 
//         type:"POST", 
//         data:{edit_id: userId },
//         success:function(response){ 
       
//         var data = JSON.parse(response);  
//         console.log(data); 
//         $("#edit_user_Id").val(data[0].id); 
//         $("#edit_student_number").val(data[0].student_number); 
//         $("#edit_section").val(data[0].section); 
//         $("#edit_fname").val(data[0].first_name); 
//         $("#edit_mname").val(data[0].middle_name); 
//         $("#edit_lname").val(data[0].last_name); 
//         $("#edit_email").val(data[0].email); 
//         }
//     });
// });  
 
 
// const validationforUpdate = new JustValidate("#editUserForm"); 
// validationforUpdate
//     .addField("#edit_student_number",[ 
//         {    
//             rule:"required",

//         },{
//             rule: 'minLength',
//             value: 11,
//         },
//         {
//             rule: 'maxLength',
//             value: 11,
//         },
//         {
//             validator: (value) => () => 
//             {
//                 return fetch("validate-credential.php?student_number="+ encodeURIComponent(value)) 
//                         .then(function(response)
//                         {
//                             return response.json();
//                         })
//                         .then(function(json) {
//                             return json.available;
//                         });
//             }, 
//             errorMessage: "Student Number already taken"
//         }
//     ])  

//     .addField("#edit_fname", [
//         {   
//             rule:"required"   
//         }
//     ])  
//     .addField("#edit_lname", [
//         {   
//             rule:"required"   
//         }
//     ]) 
//     .addField("#edit_email", [
//         {
//             rule:"required"
//         },
//         {
//             rule:"email"
//         },
//         {
//             validator: (value) => () => 
//             {
//                 return fetch("validate-credential.php?email="+ encodeURIComponent(value)) 
//                         .then(function(response)
//                         {
//                             return response.json();
//                         })
//                         .then(function(json) {
//                             return json.available;
//                         });
//             }, 
//             errorMessage: "Email already taken"
//         }
//     ]) 
   
//     .onSuccess((event) => { 
//         if ($("#editForm")[0].checkValidity()) { 
//             event.preventDefault();
//             $.ajax({
//                 url: "../controller/ActionController.php",
//                 type: "POST",
//                 data: $("#editUserForm").serialize() + "&action=update",
//                 success:function(response){ 
//                     var response = JSON.parse(response); 
//                     if (response.statuscode === 200)
//                     {   
//                         $("#edit-user-modal").modal('hide');
//                         $("#editUserForm")[0].reset(); 
//                         Swal.fire({ title: response.message, type: response.status ,icon: response.status });     
//                         RenderAllRecord();
//                     }
//                 }
//             });
//             }

//     }); 


//view
    $('body').on("click", ".viewBtn" , function(e){   

        e.preventDefault();
         var userId = $(this).attr('id');  
        $.ajax({ 
            url:"../controller/ActionController.php", 
            type:"POST", 
            data:{view_id: userId ,action: "viewinfo"},
            success:function(response){
            var data = JSON.parse(response);  
            $("#view_user_Id").val(data[0].id); 
            $("#view_student_number").val(data[0].student_number);  
            $("#view_rfid").val(data[0].rfid_tag); 
            $("#view_section").val(data[0].section); 
            $("#view_fname").val(data[0].first_name); 
            $("#view_mname").val(data[0].middle_name); 
            $("#view_lname").val(data[0].last_name); 
            $("#view_email").val(data[0].email); 
            }
        });
    }); 
}); 

