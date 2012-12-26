cvgenerator = {};

cvgenerator.activateSortable = function(activate) {
  if (activate == true) {
    $('#categories').sortable(
      { 
        items: 'div.category', 
        update: function(event, ui) {
          cvgenerator.refreshOrder();
        }, 
      }
    ); 
    $('#categories').disableSelection();
    $('div.category').addClass('sortable');
  }
  else {
    $('div.category').removeClass('sortable');
    $('#categories').sortable("disable");
  }
}

cvgenerator.hideAdminButtons = function (activate) {
  if(activate == true) {
    $('#admin_items').show();
    $('.adminOn').hide();
    $('.adminOff').show();
    $('.admin').show();
  }
  else {
    $('#admin_items').hide();
    $('.adminOn').show();
    $('.adminOff').hide();
    $('.admin').hide();
    cvgenerator.activateSortable(false);
  }
}

cvgenerator.refreshOrder = function() {
  var cptr = 0;
  var id = 0; 
  var cat = '';

  // refresh hidden form
  $('div.category').each(function(index) {
    id = $(this).find('input[type=hidden]').val();
    cat = 'category_' + id;

    $('input#form_' + cat).val(cptr);
    cptr++;
  });

  // Send ajax request
  $.ajax({
    type: 'POST', 
    url: $('form#reorderForm').attr('action'),
    data: $('form#reorderForm').serialize(), 
    success: function(html) {}, 
  });

}

$(document).ready(function() {
  /* BINDINGS */
  // add element
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

  // Add Category
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

  // (des)activate admin
  $('.adminOn').bind('click', function(){
    cvgenerator.hideAdminButtons(true);
  });
  $('.adminOff').bind('click', function(){
    cvgenerator.hideAdminButtons(false);
  });

  // Reorder category
  $('.reorderCategories').bind('click', function() {
    cvgenerator.activateSortable(true);
  });

  cvgenerator.activateSortable(false);
  cvgenerator.hideAdminButtons();
})
