$(document).ready(function() {
    $('#contactForm').submit(function(e) {
        let sommeInput = parseInt($('#captcha').val());
        let sommeResult = parseInt($('#num1').html()) + parseInt($('#num2').html());
        if (sommeInput !== sommeResult) {
            $('#captchaError').html('La somme des 2 chiffres n\'est pas bonne');
            e.preventDefault();
        }
    });
});