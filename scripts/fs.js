$(document).ready(function(){
  $('#host').click(function() {
    $(this).prop('disabled', true);
    $('#join').prop('disabled', false);
    $('#join-form').fadeOut(function() {
      $('#host-form').fadeIn();
    });
  });

  $('#join').click(function() {
    $(this).prop('disabled', true);
    $('#host').prop('disabled', false);
    $('#host-form').fadeOut(function() {
      $('#join-form').fadeIn();
    });
  });

  $('#host-form').submit(function() {
    $.ajax({
      type: 'post',
      url: './utils/create_group.php',
      data: $('#host-form').serialize(),
      success: function(data) {
        window.location = './app/?gid=' + data;
      }
    });
    return false;
  });

  $('#join-form').submit(function() {
    $.ajax({
      type: 'post',
      url: './utils/join_group.php',
      data: $('#join-form').serialize(),
      success: function(data) {
        window.location = './app/?gid=' + data;
       }
    });
    return false;
  });
});
