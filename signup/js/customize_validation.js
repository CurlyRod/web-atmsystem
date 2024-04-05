//this customization is for validation and sanitation in fields  
//ref: https://just-validate.dev/docs/rules/required
//date: modify 03-15-24 11:40 pm author: Rod Mark

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
        document.getElementById("signupForm").submit();
    }); 


  