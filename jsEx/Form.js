const url = "./register.php"

function validate() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirm-password").value;

  let isValidUser = isValidUsername(username);
  let isValidPass = isValidPassword(password);
  let isValidConfirmPass = isValidConfirmPassword(confirmPassword, password);

  if (isValidUser) {
    hideNotification("invalidUsername");
  }
  if (isValidPass) {
    hideNotification("invalidPassword");
  }
  if (isValidConfirmPass) {
    hideNotification("invalidConfirmPassword");
  }

  return (isValidUser && isValidPass && isValidConfirmPass) ? request() : false;
}

function ajax(dataRequest) {
  var xhr = new XMLHttpRequest();

  xhr.open(dataRequest.method, dataRequest.url, true);

  xhr.onload = function() {
    if (xhr.status === 200) {
      dataRequest.success(xhr.response);
    } else {
      dataRequest.error("Problems with response, try again.");
    }
  };
  
  xhr.send(dataRequest.data);
}

var successfulCallback = function(jsonText) {
  hideNotification("notification");
  console.log(JSON.parse(jsonText)); 
};

var filedCallback = function(responseText) {
  showNotification(responseText, "notification");
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
    url: url,
    method: "POST",
    success: successfulCallback,
    error: filedCallback
  }
  
  ajax(dataRequest);
}

function hideNotification(elementName) {
  let invalidMessage = document.getElementById(elementName);

  if (invalidMessage.textContent !== "") {
    invalidMessage.textContent = "";
  }
}

function isValidUsername(username) {
  let usernameRegex = /^[a-zA-z0-9_]{3,10}$/;
  if (!username.match(usernameRegex)) {
    showNotification("The username is invalid!", "invalidUsername");
    return false;
  }
  return true;
}

function isValidPassword(password) {
  let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,}$/;
  if (!password.match(passwordRegex)) {
    showNotification("The password is invalid!", "invalidPassword");
    return false;
  }
  return true;
}

function isValidConfirmPassword(confirmPassword, password) {
  if (confirmPassword !== password) {
    showNotification(
      "The passwords should be the same!",
      "invalidConfirmPassword"
    );
    return false;
  }
  return true;
}

function showNotification(message, elementName) {
  let invalidInput = document.getElementById(elementName);
  invalidInput.textContent = message;
  invalidInput.style.color = "red";
}