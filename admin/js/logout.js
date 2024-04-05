$(document).ready(function(){
    $('body').on("click", "#log-out-btn" , function(e){  
        e.preventDefault();
         Swal.fire({
            title: "Are you sure to Logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../log-out.php",
                    type: "POST",
                    data: {
                        action: "logout"
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                      
                        if(data.status === 200 && data.isLogout === true) 
                        {
                           
                            window.location.href = "../";
                        } 
                    }
                });
            }
          });
       }); 


});