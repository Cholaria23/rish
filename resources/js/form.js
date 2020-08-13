$(document).ready( function() {
    // Inputmask
    Inputmask({
        mask: '+38 (999) 999-99-99',
        clearMaskOnLostFocus: true,
        clearIncomplete: true,
        showMaskOnHover: false,
    }).mask('input[type=tel]');

});
