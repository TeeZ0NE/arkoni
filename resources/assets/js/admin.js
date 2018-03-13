$(function(){
// var mySettings={onShiftEnter:{keepDefault:!1,replaceWith:"<br />\n"},onCtrlEnter:{keepDefault:!1,openWith:"\n<p>",closeWith:"</p>"},onTab:{keepDefault:!1,replaceWith:"    "},markupSet:[{name:"Bold",key:"B",openWith:"(!(<strong>|!|<b>)!)",closeWith:"(!(</strong>|!|</b>)!)"},{name:"Italic",key:"I",openWith:"(!(<em>|!|<i>)!)",closeWith:"(!(</em>|!|</i>)!)"},{name:"Stroke through",key:"S",openWith:"<del>",closeWith:"</del>"},{separator:"---------------"},{name:"Bulleted List",openWith:"    <li>",closeWith:"</li>",multiline:!0,openBlockWith:"<ul>\n",closeBlockWith:"\n</ul>"},{name:"Numeric List",openWith:"    <li>",closeWith:"</li>",multiline:!0,openBlockWith:"<ol>\n",closeBlockWith:"\n</ol>"},{separator:"---------------"},{name:"Picture",key:"P",replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />'},{name:"Link",key:"L",openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>',closeWith:"</a>",placeHolder:"Your text to link..."},{separator:"---------------"},{name:"Clean",className:"clean",replaceWith:function(e){return e.selection.replace(/<(.*?)>/g,"")}},{name:"Preview",className:"preview",call:"preview"}]};

    // $(".markItUp").MarkItUp(mySettings);
  // Brands. Change name
  $(".change-brand-name").on("click", function(event){
    event.preventDefault();
    var old_name = $(this).attr('data-name');
    var name = prompt('Введіть нову назву', old_name);
    if(name != null && name !=='' && name != old_name)
    {
      var brand_id = $(this).attr("id");
      var orig_href = $(this).attr('href');
      window.location = orig_href
      +"?id="+brand_id
      +"&name="+name;
    }
    else return false;
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
    $(".change-attr-name").on('click',function () {
        // event.preventDefault();
        $('.edit-attrs').removeClass('d-none');
        var old_ru = $(this).attr("data-lang-ru");
        var old_uk = $(this).attr("data-lang-uk");
        var id = $(this).attr("id");
        $("#uk-attr-name-ed").val(old_uk);
        $("#ru-attr-name-ed").val(old_ru);
        $("#id-edited").val(id);
    });
  // add category checkbo
    // not using
  // $('.add_cat').on('click',function(event){
  //   event.preventDefault();
  //   var id = $('#cats').val();
  //   if (id=='') return;
  //   var opt_text = $('#cats :selected').text();
  //   $('#cat_block').append('<input type="checkbox" name="categories[]" value="'+id+'" checked class="ml-1">'+opt_text);
  // })

    // add input field for adding attributes and own values
    $('.add_attr').on('click',function(event){
      event.preventDefault();
      var id = $('#attrs').val();
      if (id=='') return;
      var opt_text = $('#attrs :selected').text();
      $('#attr_block').append('<div class="input-group mb-1"><div class="input-group-prepend"><span class="input-group-text">'+opt_text+'</span></div><input type="text" class="form-control" placeholder="Параметри" name="values[]" aria-label="'+opt_text+'" aria-describedby="item-name" required><input type="hidden" name="attrs[]" value="'+id+'"><a href="#" class="btn btn-danger remove_attr" onclick="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div>');
    });

    // remove input field from attributes
    $(document).on('click','a.remove_attr',function(event){
      event.preventDefault();
      $(this).parent().remove();
    })

    // change label on getting file in admin
    $('#img_upload').on('change',function(){
      var file_name = $(this).val().split('\\').slice(-1)[0];
      $(this).next('.custom-file-label').html(file_name);
    })

  });
