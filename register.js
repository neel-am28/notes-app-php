const regForm = document.getElementById('regForm');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const cpassword = document.getElementById('cpassword');
const error_msg = document.getElementById('error_msg');


regForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    validateCredentials();   
});

const validateCredentials = () => {
    const usernameVal = username.value.trim();
    const emailVal = email.value.trim();
    const passwordVal = password.value.trim();
    const cpasswordVal = cpassword.value.trim();


    //Validate username
    if(usernameVal === ""){
        setErrorMsg(username, "Username cannot be blank");
    } else if(usernameVal.length <=3 ){
        setErrorMsg(username, "Username should contain atleast 3 characters");
    } else {
        setSuccessMsg(username);
    }

    //Validate email
    let mailformat = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    if(emailVal === ""){
        setErrorMsg(email, "Email cannot be blank");
    } else if(!emailVal.match(mailformat)){
        setErrorMsg(email, "Please enter a valid email address");
    } else{
        setSuccessMsg(email);
    }

    //Validate password
    if (passwordVal === "") {
        setErrorMsg(password, "Password cannot be blank");
    } else if (passwordVal.length < 5) {
        setErrorMsg(password, "Password should contain atleast 5 characters");
    } else {
        setSuccessMsg(password);
    }

    // Validate confirm password
    if (cpasswordVal === "") {
        setErrorMsg(cpassword, "Password cannot be blank");
    } else if (passwordVal !== cpasswordVal) {
        setErrorMsg(cpassword, "Passwords do not match");
    } else {
        setSuccessMsg(cpassword);
    }

    //to check if all values are valid or not and then send to insert-users.php
    finalValidate();
}

function finalValidate(){
    let formElements = document.getElementsByClassName('form-control');
    let count = formElements.length;  
    // to check if all form fields have the class SUCCESS applied to them
    let successRate = 0;  
    for(let i = 0; i < formElements.length; i++){
        if(formElements[i].className === "form-control success"){
            successRate++;        
            sendData(successRate, count);
        } else{
            return false; // stop the function from running altogether
        }
    }
}

function sendData(successRate, count){
    if(successRate === count){
        let data = {
            username: username.value,
            email: email.value,
            password: password.value,
            cpassword: cpassword.value
        }
        // convert the object into a query string
        var queryString = Object.keys(data).map(function (key) {
            return key + '=' + data[key]
        }).join('&');

        fetch("http://localhost:8081/php-notes-app/insert-users.php", 
      {
        method: "POST",
        body: queryString,
    }).then(response => response.json())
      .then( (data) => {
          if(data.error == true){
            error_msg.innerText = data.msg;
            error_msg.parentElement.classList.remove("success");
          }
          if(data.error == false){
              swal("Good job!", data.msg , "success");
              setTimeout(() => {
                  window.location.href = "login.php";
                }, 2500);
          }
      })
      .catch((error) =>{     
          console.log('error: ', error);
            setTimeout(() => {
                window.location.reload();
            }, 1000);      
      });       
    }
}

function setSuccessMsg(input){
    const formControl = input.parentElement;
    formControl.className = "form-control success";
}

function setErrorMsg(input, msg){
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");
    formControl.className = "form-control error";
    small.innerText = msg;
}