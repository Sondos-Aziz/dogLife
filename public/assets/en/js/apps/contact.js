$(document).ready(function() {

  checkall('contact-check-all', 'contact-chkbox');

  $('#input-search').on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
      $('.searchable-items .items:not(.items-header-section)').hide();
      $('.searchable-items .items:not(.items-header-section)').filter(function() {
          return rex.test($(this).text());
      }).show();
  });

  $('.view-grid').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */

    $(this).parents('.switch').find('.view-list').removeClass('active-view');
    $(this).addClass('active-view');

    $(this).parents('.searchable-container').removeClass('list');
    $(this).parents('.searchable-container').addClass('grid');

    $(this).parents('.searchable-container').find('.searchable-items').removeClass('list');
    $(this).parents('.searchable-container').find('.searchable-items').addClass('grid');

  });

  $('.view-list').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    $(this).parents('.switch').find('.view-grid').removeClass('active-view');
    $(this).addClass('active-view');

    $(this).parents('.searchable-container').removeClass('grid');
    $(this).parents('.searchable-container').addClass('list');

    $(this).parents('.searchable-container').find('.searchable-items').removeClass('grid');
    $(this).parents('.searchable-container').find('.searchable-items').addClass('list');
  });

  $('#btn-add-contact').on('click', function(event) {
    $('#addContactModal #btn-add').show();
    $('#addContactModal #btn-edit').hide();
    $('#addContactModal').modal('show');
  })

function deleteContact() {
  $(".delete").on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    $(this).parents('.items').remove();
  });
}

function addContact() {
  $("#btn-add").click(function() {

    var getParent = $(this).parents('.modal-content');

    var $_name = getParent.find('#c-name-ar');
    var $_name_en = getParent.find('#c-name-en');
   

    var $_getValidationField = document.getElementsByClassName('validation-text');
    // var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
    // var phoneReg = /^\d*\.?\d*$/;

    var $_nameValue = $_name.val();
    var $_name_enValue = $_name_en.val();
   

    if ($_nameValue == "") {
      $_getValidationField[0].innerHTML = 'Name must be filled out';
      $_getValidationField[0].style.display = 'block';
    } else {
      $_getValidationField[0].style.display = 'none';
    }

      if ($_name_enValue == "") {
        $_getValidationField[0].innerHTML = 'Name must be filled out';
        $_getValidationField[0].style.display = 'block';
      } else {
        $_getValidationField[0].style.display = 'none';
      }

   

    if ($_nameValue == "" || $_name_enValue == "" || (reg.test($_name_enValue) == false) ) {
      return false;
    }

    $html = '<div class="items">' +
              '<div class="item-content">' +
                  '<div class="user-profile">' +

                      '<div class="n-chk align-self-center text-center">' +
                          '<label class="new-control new-checkbox checkbox-primary">' +
                            '<input type="checkbox" class="new-control-input contact-chkbox">' +
                            '<span class="new-control-indicator"></span>' +
                          '</label>' +
                      '</div>' +

                      '<img src="assets/img/90x90.jpg">' +
                      '<div class="user-meta-info">' +
                          '<p class="user-name_ar" data-name='+ $_nameValue +'>'+ $_nameValue +'</p>' 
                      '</div>' +
                  '</div>' +
                  '<div class="user-meta-info">' +
                      // '<p class="info-title">Email: </p>' 
                      '<p class="user-name_en" data-name-en='+ $_name_enValue +'>'+ $_name_enValue +'</p>' +
                  '</div>' +
               
                  '<div class="action-btn">' +
                      '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>'+
                      '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus delete"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>'
                  '</div>' +
              '</div>' +
          '</div>';

      $(".searchable-items > .items-header-section").after($html);
      $('#addContactModal').modal('hide');

      var $_setNameValueEmpty = $_name.val('');
      var $_setName_enValueEmpty = $_name_en.val('');
    
    deleteContact();
    editContact();
    checkall('contact-check-all', 'contact-chkbox');
  });  
}

$('#addContactModal').on('hidden.bs.modal', function (e) {
    var $_name = document.getElementById('c-name-ar');
    var $_name_en = document.getElementById('c-name-en');
 
    var $_getValidationField = document.getElementsByClassName('validation-text');

    var $_setNameValueEmpty = $_name.value = '';
    var $_setName_enValueEmpty = $_name_en.value = '';
  
    for (var i = 0; i < $_getValidationField.length; i++) {
      e.preventDefault();
      $_getValidationField[i].style.display = 'none';
    }
})



function editContact() {
  $('.edit').on('click', function(event) {

    $('#addContactModal #btn-add').hide();
    $('#addContactModal #btn-edit').show();

    // Get Parents
    var getParentItem = $(this).parents('.items');
    var getModal = $('#addContactModal');

    // Get List Item Fields
    var $_name = getParentItem.find('.user-name_ar');
    var $_name_en = getParentItem.find('.user-name_en');
  

    // Get Attributes
    var $_nameAttrValue = $_name.attr('data-name');
    var $_name_enAttrValue = $_name_en.attr('data-name-en');
  

    // Get Modal Attributes
    var $_getModalNameInput = getModal.find('#c-name-ar');
    var $_getModalEmailInput = getModal.find('#c-name-en');
    
    // Set Modal Field's Value
    var $_setModalNameValue = $_getModalNameInput.val($_nameAttrValue);
    var $_setModalEmailValue = $_getModalEmailInput.val($_name_enAttrValue);
    
    $('#addContactModal').modal('show');

    $("#btn-edit").off('click').click(function(){

      var getParent = $(this).parents('.modal-content');

      var $_getInputName = getParent.find('#c-name-ar');
      var $_getInputName_en = getParent.find('#c-name-en');
     

      var $_nameValue = $_getInputName.val();
      var $_name_enValue = $_getInputName_en.val();
      
      var  setUpdatedNameValue = $_name.text($_nameValue);
      var  setUpdatedEmailValue = $_name_en.text($_name_enValue);
     
      var  setUpdatedAttrNameValue = $_name.attr('data-name', $_nameValue);
      var  setUpdatedAttrEmailValue = $_name_en.attr('data-name-en', $_name_enValue);
       $('#addContactModal').modal('hide');
    });
  })
}






$(".delete-multiple").on("click", function() {
    var inboxCheckboxParents = $(".contact-chkbox:checked").parents('.items');   
      inboxCheckboxParents.remove();
});

deleteContact();
addContact();
editContact();

})


// Validation Process

var $_getValidationField = document.getElementsByClassName('validation-text');
var reg = /^.+@[^\.].*\.[a-z]{2,}$/;
var phoneReg = /^\d{10}$/;

getNameInput = document.getElementById('c-name-ar');

getNameInput.addEventListener('input', function() {

  getNameInputValue = this.value;

  if (getNameInputValue == "") {
    $_getValidationField[0].innerHTML = 'Name Required';
    $_getValidationField[0].style.display = 'block';
  } else {
    $_getValidationField[0].style.display = 'none';
  }

})


getEmailInput = document.getElementById('c-name-en');

getNameInput.addEventListener('input', function() {

  getNameInputValue = this.value;

  if (getNameInputValue == "") {
    $_getValidationField[0].innerHTML = 'Name Required';
    $_getValidationField[0].style.display = 'block';
  } else {
    $_getValidationField[0].style.display = 'none';
  }

})


