var ModalDialog = {
    Show: function () {

        this.modalDialog = $('<div>', { id: Math.random(), 'class': 'ModalDialog' });
        var dialogOverlay = $('<div>', { 'class': 'DialogOverlay' });
        var dialogDetail = $('<div>', { 'class': 'Detail' });

        this.modalDialog.appendTo('body');
        dialogOverlay.appendTo(this.modalDialog);
        dialogDetail.insertAfter(dialogOverlay);
    },    
    DestroyModalDialog: function () {
        $(".ModalDialog").remove();
    },
    
    SetPotitionDialog: function (dialogHeight, dialogWidth) {
        var winH = $(window).height();
        var winW = $(window).width();

        $(".Detail").css('top', winH / 2 - dialogHeight / 2);
        $(".Detail").css('left', winW / 2 - dialogWidth / 2);
    }
    
};
