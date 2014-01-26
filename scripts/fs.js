$(document).ready(function(){
  $('#host').click(function() {
    $(this).prop('disabled', true);
    $('#join').prop('disabled', false);
    $('#join-form').fadeOut();
    $('#host-form').fadeIn();
  });

  $('#join').click(function() {
    $(this).prop('disabled', true);
    $('#host').prop('disabled', false);
    $('#host-form').fadeOut();
    $('#join-form').fadeIn();
  });
});
