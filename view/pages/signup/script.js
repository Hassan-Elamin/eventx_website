
function wrongInputMsg(message) {
    return (`<div style="display:block" class="invalid-feedback">
        `+ message + `
        </div>`)
}

function signupCheck() {
    var password = document.getElementById('password-input').value;
    var confirm_password = document.getElementById('repassword-input').value;
    if (password != confirm_password) {
        $('#repassword-input').after(wrongInputMsg('password is not matched'))
        return false;
    }
    else {
        let checkboxVal = document.getElementById('termsCheck').value
        if (checkboxVal) {
            return true
        } else {
            alert("You must agree to the terms and conditions");
            return false;
        }
    }
}

document.getElementById('profile-img').addEventListener('input', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('profile-img-view').src = e.target.result;
    }
    reader.readAsDataURL(this.files[0]);
})