/* Phone Mask */
$(document).ready(function () {
    $('#phone').mask('+7(999)999-99-99');
});
document.ondragstart = noselect;
document.onselectstart = noselect;
document.oncontextmenu = noselect;
function noselect() { return false; }