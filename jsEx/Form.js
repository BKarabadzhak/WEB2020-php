function validate() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirm-password").value;

  let isValidUser = isValidUsername(username);
  let isValidPass = isValidPassword(password);
  let isValidConfirmPass = isValidConfirmPassword(confirmPassword, password);

  if (isValidUser) {
    hideErrorMessag("invalidUsername");
  }
  if (isValidPass) {
    hideErrorMessag("invalidPassword");
  }
  if (isValidConfirmPass) {
    hideErrorMessag("invalidConfirmPassword");
  }

  return (isValidUser && isValidPass && isValidConfirmPass) ? request() : false;
}

function ajax(dataRequest) {
  var xhr = new XMLHttpRequest();

  xhr.open(dataRequest.method, dataRequest.url, true);

  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      dataRequest.success(xhr.response);
    } else {
      console.error(xhr.response);
    }
  };
  
  xhr.send(dataRequest.data);
}

var callback = function(jsonText) {
  console.log(JSON.parse(jsonText)); 
};

function request() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirm-password").value;

  let data = {
    "Username": username,
    "Password": password,
    "ConfirmPassword": confirmPassword
  };

  var dataJSON = JSON.stringify(data);
  var dataRequest = {
    data: dataJSON,
    url: "http://localhost/WEB2020-php/jsEx/register.php",
    method: "POST",
    success: callback
  }
  
  ajax(dataRequest);
}

function hideErrorMessag(elementName) {
  let invalidMessage = document.getElementById(elementName);

  if (invalidMessage.textContent !== "") {
    invalidMessage.textContent = "";
  }
}

function isValidUsername(username) {
  let usernameRegex = /^[a-zA-z0-9_]{3,10}$/;
  if (!username.match(usernameRegex)) {
    showErrorMessage("The username is invalid!", "invalidUsername");
    return false;
  }
  return true;
}

function isValidPassword(password) {
  let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,}$/;
  if (!password.match(passwordRegex)) {
    showErrorMessage("The password is invalid!", "invalidPassword");
    return false;
  }
  return true;
}

function isValidConfirmPassword(confirmPassword, password) {
  if (confirmPassword !== password) {
    showErrorMessage(
      "The passwords should be the same!",
      "invalidConfirmPassword"
    );
    return false;
  }
  return true;
}

function showErrorMessage(message, elementName) {
  let invalidInput = document.getElementById(elementName);
  invalidInput.textContent = message;
  invalidInput.style.color = "red";
}