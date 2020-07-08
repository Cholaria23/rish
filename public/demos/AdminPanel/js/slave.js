/*
 * EXTEND JQUERY SERIALIZE TO OBJECT
 */
$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/*
 * INIT FILEUPLOAD
 */
function initUpload() {
    var error = false;

    $('.fileupload').each(function () {
        let formData = {};
            error = false;
        $.each($(this).data(), function (key, value) {
            formData[key] = value;
        });
        $(this).fileupload({
            dataType: 'json',
            formData: formData,
            start: function (e) {
                var butnLoad = $(e.target).closest(".butn__load");
                butnLoad.addClass("is_load");
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10),
                    butnLoad = $(e.target).closest(".butn__load"),
                    butnProgressBar = butnLoad.find('.butn__progressbar');
                butnProgressBar.css('width', progress + '%');
            },
            done: function (e, data) {
                if (data.result.status == "ok") {
                    if (typeof window[formData.on_after_upload] === "function") {
                        window[formData.on_after_upload](formData, data);
                    }
                }
                initUpload();
            },
            fail: function(e, data){
                error = data.jqXHR.responseText;
                alertify.error(error);
            },
            stop: function (e, data) {
                if(!error){
                    var butnLoad = $(e.target).closest(".butn__load"),
                        butnProgressBar = butnLoad.find('.butn__progressbar');
                    butnLoad.removeClass("is_load");
                    butnProgressBar.css('width', 0).removeAttr('style');
                    if (typeof window[formData.on_total_upload] === "function") {
                        window[formData.on_total_upload](formData);
                    }
                    initUpload();
                }
                error = false;
            },
        });
    });
}

let ck_toolbar = {
    toolbarGroups: [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        '/',
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'spoiler', groups: [ 'spoiler' ] },
        { name: 'about', groups: [ 'about' ] }
    ],

    removeButtons: 'NewPage,Preview,Print,Templates,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,BidiLtr,BidiRtl,Language,Flash,Smiley,SpecialChar,PageBreak',
};

function initCKEditor(toolbar, uiColor = "#cccccc", readOnly = false) {
    $(".for_ckeditor").each(function (index, el) {
        if (!$(this).hasClass('loaded')) {

            let formData = {};
            $.each($(this).data(), function (key, value) {
                formData[key] = value;
            });

            var editor = CKEDITOR.replace($(this).attr('id'), {
                uiColor: uiColor,                
                extraPlugins: 'autogrow,save,spoiler',
                autoGrow_onStartup: true,
                autoGrow_minHeight: 250,
                autoGrow_maxHeight: 600,
                readOnly: readOnly,
                toolbarGroups: eval(toolbar).toolbarGroups,
                removeButtons: eval(toolbar).removeButtons,
                extraAllowedContent: 'iframe svg g polygon style circle line path animateTransform a p span div img button [*]{*}(*)',
                filebrowserUploadUrl: '/admin/ckfinder/connector?command=QuickUpload&type=Files&_token=' + $('meta[name=csrf-token]').attr("content"),
                filebrowserImageUploadUrl: '/admin/ckfinder/connector?command=QuickUpload&type=Images&_token=' + $('meta[name=csrf-token]').attr("content"),
            });

            editor.on('save', function (evt) {
                evt.cancel();
                if (typeof window[formData.on_save] === "function") {
                    formData['ck_data'] = evt.editor.getData();
                    window[formData.on_save](formData);
                }
                //console.log( 'Total bytes: ' + evt.editor.getData().length );
            });

            CKFinder.setupCKEditor(editor);
            $(this).addClass('loaded');
        }
    });
}

function fixHelper(e, ui) {
    ui.children().each(function () {
        $(this).width($(this).width());
    });
    return ui;
}

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 7000,
});

const ToastSuccess = Swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 5000,
    type: 'success',
    background: '#cee6cd'
});

const ToastError = Swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 7000,
    type: 'error',
    background: '#f5d1c8'
});

$(document).ready(function () {
    $(document).on('keypress', '#search_input', function (e) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            let search = $(this).val()
            window.location.href="admin/search?search="+search;
        }
    });
});
