$('.add_line').bind('click', function(){
  url = $(this).attr('href');
  $('#ajax_add').load(url, function(){
    $('#ajax_add').dialog({ 
      closeOnEscape: true, 
      draggable: true,
      modal: true, 
      title: 'Add an line', 
      closeText: 'X', 
      buttons: [{
        text: "Cancel", 
        click: function() { $(this).dialog("close"); }
      }]
    });
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
      closeText: 'X', 
      buttons: [{
        text: "Cancel", 
        click: function() { $(this).dialog("close"); }
      }]
    });
  });
  return false;
});

