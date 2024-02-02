function toggleMenu() {
    var sidebar = document.querySelector('.side-bar');
    var logotext = document.querySelector('.logo-text');
    var logoimg = document.querySelector(".logo-img");

    // Select all elements with the class "menu-text"
    var menutextElements = document.querySelectorAll(".menu-text");

    if (sidebar.style.width === '250px') {
        sidebar.style.width = '100px';
        logotext.style.display = "none";

        // Loop through each .menu-text element and hide them
        menutextElements.forEach(function(element) {
            element.style.display = "none";
        });
    } else {
        sidebar.style.width = '250px';
        logotext.style.display = "block";

        // Loop through each .menu-text element and show them
        menutextElements.forEach(function(element) {
            element.style.display = "block";
        });
    }
}

