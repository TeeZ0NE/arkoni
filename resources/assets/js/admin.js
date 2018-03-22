$(function () {
var markitupOptions = {
    nameSpace:       "html", // Useful to prevent multi-instances CSS conflict
    onShiftEnter:    {keepDefault:false, replaceWith:'<br />\n'},
    onCtrlEnter:     {keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},
    onTab:           {keepDefault:false, openWith:'     '},
    markupSet:  [
        {name:'Heading 1', key:'1', openWith:'<h1(!( class="[![Class]!]")!)>', closeWith:'</h1>', placeHolder:'Your title here...' },
        {name:'Heading 2', key:'2', openWith:'<h2(!( class="[![Class]!]")!)>', closeWith:'</h2>', placeHolder:'Your title here...' },
        {name:'Heading 3', key:'3', openWith:'<h3(!( class="[![Class]!]")!)>', closeWith:'</h3>', placeHolder:'Your title here...' },
        {name:'Heading 4', key:'4', openWith:'<h4(!( class="[![Class]!]")!)>', closeWith:'</h4>', placeHolder:'Your title here...' },
        {name:'Heading 5', key:'5', openWith:'<h5(!( class="[![Class]!]")!)>', closeWith:'</h5>', placeHolder:'Your title here...' },
        {name:'Heading 6', key:'6', openWith:'<h6(!( class="[![Class]!]")!)>', closeWith:'</h6>', placeHolder:'Your title here...' },
        {name:'Paragraph', openWith:'<p(!( class="[![Class]!]")!)>', closeWith:'</p>'  },
        {separator:'---------------' },
        {name:'Bold', key:'B', openWith:'<strong>', closeWith:'</strong>' },
        {name:'Italic', key:'I', openWith:'<em>', closeWith:'</em>'  },
        {name:'Stroke through', key:'S', openWith:'<del>', closeWith:'</del>' },
        {separator:'---------------' },
        {name:'Ul', openWith:'<ul>\n', closeWith:'</ul>\n' },
        {name:'Ol', openWith:'<ol>\n', closeWith:'</ol>\n' },
        {name:'Li', openWith:'<li>', closeWith:'</li>' },
        {separator:'---------------' },
        {name:'Picture', key:'P', replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />' },
        {name:'Link', key:'L', openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith:'</a>', placeHolder:'Your text to link...' },
        {separator:'---------------' },
        {name:'Clean', replaceWith:function(h) { return h.selection.replace(/<(.*?)>/g, "") } },
        {name:'Preview', call:'preview', className:'preview' }
    ]
};

 $('.editor').markItUp(markitupOptions);
    // Brands. Change name
    $(".change-brand-name").on("click", function (event) {
        var old_name = $(this).attr('data-name');
        var brand_id = $(this).attr("id");
         $('.edit-brand').removeClass('d-none');
        $("#brand-name-ed").val(old_name);
        $("#id-edited").val(brand_id);
    });
    // var old_id=null;
    /* Cstegory rename. Old method
  $(".change-category").on("click", function(event){
        // event.preventDefault();
        var old_name = $(this).attr('data-name');
        var sub_id = $(this).attr('data-sub-id');
        var id = $(this).attr("id");
        $("#edit-form").removeClass('d-none');
        $("#new-cat-name").val(old_name);
        $("#id-edited").val(id);
         //enable or disable category
        //  if(old_id!=id){
        //   $("#parent-select option[value=" + id + "]").prop('disabled',true);
        //   $("#parent-select option[value=" + old_id + "]").prop('disabled',false);
        // }
        // else{
        //   $("#parent-select option[value=" + id + "]").prop('disabled',true);
        // }
        // old_id=id;
        $("#parent-select").val(sub_id).change();
      })*/
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
    // add category checkbox if multiple
    // not using
    // $('.add_cat').on('click',function(event){
    //   event.preventDefault();
    //   var id = $('#cats').val();
    //   if (id=='') return;
    //   var opt_text = $('#cats :selected').text();
    //   $('#cat_block').append('<input type="checkbox" name="categories[]" value="'+id+'" checked class="ml-1">'+opt_text);
    // })

    // add input field for adding attributes and own values
    $('.add_attr').on('click', function (event) {
        event.preventDefault();
        var id = $('#attrs').val();
        if (id == '') return;
        var opt_text = $('#attrs :selected').text();
        $('#attr_block').append('<div class="input-group mb-1"><div class="input-group-prepend"><span class="input-group-text">' + opt_text + '</span></div><input type="text" class="form-control" placeholder="Параметри" name="values[]" aria-label="' + opt_text + '" aria-describedby="item-name" required><input type="hidden" name="attrs[]" value="' + id + '"><a href="#" class="btn btn-danger remove_attr" onclick="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div>');
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
