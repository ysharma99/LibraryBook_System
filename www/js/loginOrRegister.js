var LoginOrRegister = (function () {
    "use strict"
    let pub = {};

    pub.setup = function () {
        let form_a_login = document.getElementById("a_login");
        let form_c_login = document.getElementById("c_login");
        let form_c_register = document.getElementById("c_register");

        

        form_c_register.addEventListener("submit", function (event) {
            event.preventDefault();
            alert("Account Registered (NOT! GOTCHAAA!)");
        });

    };

    return pub;

}());

if (document.getElementById) {
    if (window.addEventListener) {
        window.addEventListener('load', LoginOrRegister.setup);
    } else if (window.attachEvent) {
        window.attachEvent('onload', LoginOrRegister.setup);
    } else {
        /* jshint -W117 */
        alert("Could not attach 'LoginOrRegister.setup' to the 'window.onload' event");
        /* jshint +W117 */
    }
}