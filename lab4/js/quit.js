$(".btn-outline-success").click(function(e) {
    document.cookie = "login=";
    document.cookie = "password=";
    document.location.href = "../login.php";
});