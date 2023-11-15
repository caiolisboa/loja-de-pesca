var buttons = document.getElementsByClassName("go_to_shop");

for(var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function() {
        window.location.href = "shop.php";
    });
}