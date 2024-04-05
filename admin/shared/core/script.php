
<script src="../shared/js/bootstrap.bundle.min.js"></script>  
<script src="../shared/js/sidebarmenu.js"></script>
<script src="../shared/js/app.min.js"></script>
<script src="../shared/js/just-validate.production.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script> 
const fullName = document.getElementById('fullName').textContent;
const [firstName, , lastName] = fullName.split(' '); // Using array destructuring to skip the middle name
const initials = firstName[0] + lastName[0];
document.getElementById('profileImage').innerHTML = initials.toUpperCase();
</script> 
<script>
    $(document).ready(function() {
        RenderAllRecord();
        TotalUser();

        function RenderAllRecord() {
            $.ajax({
                url: "../controller/admin/ActionController.php",
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
                url: "../controller/admin/ActionController.php",
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
    });
    </script>
