<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Image Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <style media="screen">
    .preview{
      display: block;
      width: 150px;
      height: 150px;
      border: 1px solid black;
      margin-top: 10px;
    }
  </style>
  <body>
    <form method = "post" action = "" enctype = "multipart/form-data">
      <input type="file" name="fileImg" id="fileImg">
      <button type="button" onclick = "submitData();">Submit</button>
      <div class = "preview">
        <img src="" id = "img" alt = "Preview" style = "width: 100%; height: 100%">
      </div>
    </form>

    <script type="text/javascript">
      // Preview
      fileImg.onchange = evt => {
        const [file] = fileImg.files
        if (file) {
          img.src = URL.createObjectURL(file)
        }
      }
      // Submit
      function submitData(){
        $(document).ready(function(){
          var formData = new FormData();
          var files = $('#fileImg')[0].files;
          formData.append('fileImg', files[0]);

          $.ajax({
            url: 'function.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success:function(response){
              if(response == "Success"){
                alert("Successfully Added");
              }
              else if(response == "Invalid Extension"){
                alert("Invalid Extension");
              }
              else{
                alert("Please Fill Out The Form");
              }
            }
          });
        });
      }
    </script>
  </body>
</html>
