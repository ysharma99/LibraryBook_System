var LoginOrRegister= (function () {
    "use strict"

    PublicKeyCredential.setup = function () {
        let btn_a_login = document.getElementById("a_login");
        let btn_c_login = document.getElementById("c_login");
        let btn_c_register = document.getElementById("c_register");

        
    };

}());

if (document.getElementById) {
    if (window.addEventListener) {
        window.addEventListener('load', LoginOrRegister.setup);
    } else if (window.attachEvent) {
        window.attachEvent('onload', LoginOrRegister.setup);
    } else {
        /* jshint -W117 */
        alert("Could not attach 'MakeCard.setup' to the 'window.onload' event");
        /* jshint +W117 */
    }
}