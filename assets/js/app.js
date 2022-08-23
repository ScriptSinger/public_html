window.onload = function (e) {
    var btn = document.querySelector('.menu__btn')
    if (btn)
        btn.onclick = function () {
            document.querySelector('.sidebar__inner').classList.toggle('active');
        }

    /* Accordion */
    let parents = document.querySelectorAll('.accordion__item');
    let childs = document.querySelectorAll('.accordion__header');
    function showAccordion() {
        const parent = this.parentNode;
        if (parent.classList.contains('active')) {
            parent.classList.remove('active');
        } else {
            for (let i = 0; i < parents.length; i++) {
                parents[i].classList.remove('active');
            }
            parent.classList.add('active');
        }
    }
    for (let i = 0; i < childs.length; i++) {
        childs[i].onclick = showAccordion;
    }

    /* Confirm */
    var linkItems = document.querySelectorAll('#confirm');
    for (let i = 0; i < linkItems.length; i++) {
        linkItems[i].addEventListener("click", getConfirm);
    }
    function getConfirm(e) {
        if (!confirm()) {
            e.preventDefault();
        }
    }
}

