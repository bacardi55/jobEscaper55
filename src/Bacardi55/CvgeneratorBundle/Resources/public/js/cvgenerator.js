$('.add_line').bind('click', function(){

  url = $(this).attr('href');
  $('#ajax_add').load(url, function(){
    $('#ajax_add').dialog({ 
      closeOnEscape: true, 
      draggable: true,
      modal: true, 
      title: 'Add an line', 
      closeText: 'X', 
      width: '550',
      close: function(event, ui){
        tinyMCE.execCommand('mceRemoveControl', false, 'Element_text');
      },
      buttons: [{
        text: "Cancel", 
        click: function() {
          $(this).dialog("close"); 
        }
      }]
    });
    tinyMCE.execCommand('mceAddControl', false, 'Element_text');
  });
  return false;
});

$('.add_category').bind('click', function(){
  url = $(this).attr('href');
  $('#ajax_add').load(url, function(){
    $('#ajax_add').dialog({ 
      closeOnEscape: true, 
      draggable: true,
      modal: true, 
      title: 'Add a category', 
      width: '550',
      closeText: 'X', 
      buttons: [{
        text: "Cancel", 
        click: function() { $(this).dialog("close"); }
      }]
    });
  });
  return false;
});
