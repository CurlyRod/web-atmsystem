const fullName = document.getElementById('fullName').textContent;
const [firstName, , lastName] = fullName.split(' '); // Using array destructuring to skip the middle name
const initials = firstName[0] + lastName[0];
document.getElementById('profileImage').innerHTML = initials.toUpperCase();

    $(document).ready(function() {
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
                    // var data = JSON.parse(response);
                    //console.log(data);  
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
                    //console.log(data.total_user);
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
                    console.log(data.total_section);
                    $("#total-section").html(data.total_section);
                }
            });
        } 

    });
