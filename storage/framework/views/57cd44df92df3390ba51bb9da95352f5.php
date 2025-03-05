<div class="g-recaptcha" data-sitekey="6Ld4pVcqAAAAAOfALLYov45c9oyQ-Ng7j24Imofq"></div>

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    if (grecaptcha.getResponse() === '') {
        event.preventDefault();
        alert('Please complete the CAPTCHA');
    }
});
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php /**PATH /home6/bloggerc/goaltract.com/resources/views/inc/captcha.blade.php ENDPATH**/ ?>