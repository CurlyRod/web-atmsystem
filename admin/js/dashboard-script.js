

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
                    $("#total-section").html(data.total_section);
                }
            });
        } 

    });
