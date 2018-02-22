$(function(){
  $(".change_name").on("click", function(event){
    event.preventDefault();
    var old_name = $(this).attr('data-name');
    var name = prompt('Введіть нову назву', old_name);
    if(name != null && name !=='' && name != old_name) 
    {
      var id = $(this).attr("id");
      var orig_href = $(this).attr('href');
      window.location = orig_href
      +"?id="+id
      +"&name="+name;
    }
    else return false;
  });
  // var old_id=null;
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
      })
  // add category checkbox
    $('.add_cat').on('click',function(event){
        event.preventDefault();
        var id = $('#cats').val();
        if (id=='') return;
        var opt_text = $('#cats :selected').text();
        $('#cat_block').append('<input type="checkbox" name="categories[]" value="'+id+'" checked class="ml-1">'+opt_text);
    })

    // add input field for adding attributes and own values
    $('.add_attr').on('click',function(event){
        event.preventDefault();
        var id = $('#attrs').val();
        if (id=='') return;
        var opt_text = $('#attrs :selected').text();
        $('#attr_block').append('<div class="input-group mb-1"><div class="input-group-prepend"><span class="input-group-text">'+opt_text+'</span></div><input type="text" class="form-control" placeholder="Параметри" name="values[]" aria-label="'+opt_text+'" aria-describedby="item-name"><input type="hidden" name="attrs[]" value="'+id+'"><a href="#" class="btn btn-danger remove_attr" onclick="javascript:void(0);"><i class="fas fa-trash-alt"></a></div>');
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