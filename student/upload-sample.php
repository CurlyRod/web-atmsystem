<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body> 
    <label for="" id="errorMsg"></label>
    <form action="uploads.php" method="POST" enctype="multipart/form-data"> 
        <input type="file" id="imageUpload"> 
        <input type="submit" value="Upload" id="submitBtn"> 
        <img src="../assets/uploads/default.png" alt="" id="studentImg" style="max-height:200px;">
    </form>  
    <input type="text" id="inputField"> 
    <input type="text" id="inputStudentNumber">
    <script>
        $(document).ready(function()
        {
            $("#submitBtn").click(function(e){
                e.preventDefault();
              
                let form_data = new FormData(); 
                let img = $("#imageUpload")[0].files;
             

                if (img.length >  0 )
                {
                    form_data.append('imageFile', img[0]); 
                    $.ajax({
                        url: 'uploads.php', 
                        type: 'POST', 
                        data: form_data, 
                        contentType: false, 
                        processData: false, 
                        success:function(response){ 
                            var dataFilter = JSON.parse(response);
                            if(dataFilter.status === 200)
                            {
                                let imagePath = dataFilter.src; 
                                console.log(dataFilter); 
                                $("#studentImg").attr("src", imagePath); 
                                $("#studentImg").fadeOut(1).fadeIn(1000); 
                                $("#imageUpload").val('');
                            }else{
                                $("#errorMsg").text(dataFilter.errorMessage);
                            }
                        }
                    });
                }
                else{
                    $("#errorMsg").text("Please Select Image");
                }
            }); 


            // Assuming your input field has an id of 'inputField'
            const inputField = document.getElementById('inputField');
            const inputStudentNumber = document.getElementById('inputStudentNumber');

            inputField.addEventListener('change', function() {
                const enteredValue = this.value.trim(); // Trim any whitespace
                if (enteredValue.length === 10 && /^\d+$/.test(enteredValue)) { // Check if exactly 12 digits
                let recentRfid = inputField.value; 
                console.log("recent", recentRfid);
                 
                    $.ajax({
                        url: './controller/ActionClasses.php',
                        method: 'POST',
                        data: { rfid: recentRfid, action: "check-user" },
                        success: function(response) {
                            var res = JSON.parse(response);   
                            
                            if (res.status === 200)
                            {       console.log("Else", res); 
                                //do some stuff like display name, section, student id
                              $("#studentImg").attr("src", res['image']); 
                              $("#errorMsg").text(res.message);
                            }
                            else{
                                console.log("Else", res); 
                                    $("#errorMsg").text(res.message);
                                
                            }

                            // if(res.exist ==  true)
                            // { 
                            //     if (res.status == 200)  {   
                            //     console.log(res[0]['data']['image']);  
                            //     $("#studentImg").attr("src", res[0]['data']['image']);  // do some stuff like display name, section, student id
                            //     }
                            // }
                            // // if (res.status == 200)
                            // // {
                            // //    console.log(res[0]['data']['image']);  
                            // //   // $("#studentImg").attr("src", res[0]['data']['image']);  // do some stuff like display name, section, student id
                            
                            // // }else
                            // // {   
                            // //    if(res.status == 308 && res.remarks == 2)
                            // //    {
                            // //     $("#errorMsg").text("Already Time out"); 
                            // //     Swal.fire({position: "center",icon: "info",title: "Already Time out",showConfirmButton: false, timer: 1000})
                            // //    } 
                            // //    else 
                            // //    {
                            // //     $("#errorMsg").text(res.message);
                            // //    }
                            // // }   
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                        }
                    });
                  console.log("Student", inputField.value);
                  $("#inputStudentNumber").val(enteredValue);  
                  $('#inputField').val('');
      
                }
            });

        });
    </script>
</body>
</html>