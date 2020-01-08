function controlNavbar() {
    var x = document.getElementById("main-nav");
    if (x.classList.contains("responsive")) {
        x.classList.remove("responsive");
    } else {
        x.classList.add("responsive");
    }
}

$(document).ready(function () {
   $('#main-nav').css('display', 'flex');
});