let elements = document.querySelectorAll('#item');
let txtLength,
    txtLimit
elements.forEach(el => {
    el.addEventListener('keyup', function () {
        txtLength = this.value.length; //количество символов 
        txtLimit = this.getAttribute('data-limit');
        this.previousSibling.textContent = txtLength + " из " + txtLimit + " рекомендуемых символов";
    });
});
