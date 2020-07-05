  $(function () {
    var _formId = '';
  // -----get orm id -----------
  $('.reqsub').click(function(e){
    e.preventDefault();
    window._formId = $(this).closest("form").attr('id');;
    if($('#'+window._formId).valid()){
      $('#'+window._formId).submit();
    }
  });

  //----------------validation logic form register patient ----------------

//------------------register patient form validation closed
}); //document ready closed
