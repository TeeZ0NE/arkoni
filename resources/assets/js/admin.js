$(function () {
    // editor 4 text-area
    /**
     * Author https://alex-d.github.io/Trumbowyg/documentation/
     */
    $.trumbowyg.svgPath = "/images/vendor/trumbowyg/icons.svg";
    $('.editor').trumbowyg({
        lang: 'ua',
        btns: [['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em'],
            ['link'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        removeformatPasted: true
    });
    // settings 4 blog with image
$('.blog-editor').trumbowyg({
        lang: 'ua',
        btns: [['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em'],
            ['link'],
            ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        removeformatPasted: true
    });

    // Brands. Change name
    $(".change-brand-name").on("click", function (event) {
        var old_name = $(this).attr('data-name');
        var brand_id = $(this).attr("id");
        $('.edit-brand').removeClass('d-none');
        $("#brand-name-ed").val(old_name);
        $("#id-edited").val(brand_id);
    });

    // update attributes
    $(".change-attr-name").on('click', function () {
        // event.preventDefault();
        $('.edit-attrs').removeClass('d-none');
        var old_ru = $(this).attr("data-lang-ru");
        var old_uk = $(this).attr("data-lang-uk");
        var id = $(this).attr("id");
        $("#uk-attr-name-ed").val(old_uk);
        $("#ru-attr-name-ed").val(old_ru);
        $("#id-edited").val(id);
    });

    // add input field for adding attributes and own values
    $('.add_attr').on('click', function (event) {
        event.preventDefault();
        var id = $('#attrs').val();
        if (id == '') return;
        var opt_text = $('#attrs :selected').text();
        $('#attr_block').append('<div class="input-group mb-1"><div class="input-group-prepend"><span class="input-group-text">' + opt_text + '</span></div><input type="text" class="form-control" placeholder="Параметри" name="values[]" aria-label="' + opt_text + '" aria-describedby="item-name" required><input type="hidden" name="attrs[]" value="' + id + '"><a href="#" class="btn btn-secondary remove_attr" onclick="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div>');
    });

    // remove input field from attributes
    $(document).on('click', 'a.remove_attr', function (event) {
        event.preventDefault();
        $(this).parent().remove();
    })

    // change label on getting file in admin
    $('#img_upload').on('change', function () {
        var file_name = $(this).val().split('\\').slice(-1)[0];
        $(this).next('.custom-file-label').html(file_name);
    })

});
