/**
 * This file contains functions which helps make manipulating
 * users simplier
 */

/**
 * Process the login form
 */
function login(form) {
     // Check each field has a value
    if (form.username.value == ''  ||
        form.password.value == '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(form.password.value);

    // Make sure the plaintext password doesn't get sent.
    form.password.value = "";
    form.submit();
}

/**
 * This function validates the registration form
 */
function regformhash(form) {
    console.log(form.typelist.options[form.typelist.selectedIndex].value);
     // Check each field has a value
    if (form.username.value == ''  ||
        form.password.value == ''  ||
        form.confirmpwd.value == '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (form.password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least six characters

    // var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    // if (!re.test(form.password.value)) {
    //     alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
    //     return false;
    // }

    // Check password and confirmation are the same
    if (form.password.value != form.confirmpwd.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(form.password.value);

    // Make sure the plaintext password doesn't get sent.
    form.password.value = "";
    form.confirmpwd.value = "";

    // Create an input field to enter the employee type
    var e = document.createElement("input");
    form.appendChild(e);
    e.name = "type";
    e.type = "hidden";
    e.value = form.typelist.options[form.typelist.selectedIndex].value;

    // Finally submit the form.
    form.submit();
    return true;
}
