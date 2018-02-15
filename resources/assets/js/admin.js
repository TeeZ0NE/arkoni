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
  var old_id=null;
  $(".change-category").on("click", function(event){
        // event.preventDefault();
        var old_name = $(this).attr('data-name');
        var sub_id = $(this).attr('data-sub-id');
        var id = $(this).attr("id");
         $("#edit-form").removeClass('d-none');
         $("#new-cat-name").val(old_name);
         $("#id-edited").val(id);
         //enable or disable category
         if(old_id!=id){
          $("#parent-select option[value=" + id + "]").prop('disabled',true);
          $("#parent-select option[value=" + old_id + "]").prop('disabled',false);
        }
        else{
          $("#parent-select option[value=" + id + "]").prop('disabled',true);
        }
        old_id=id;
        $("#parent-select").val(sub_id).change();
      })
});