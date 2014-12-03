$(function($) {
  //$('#edit_score').hide();

  $('.add_score').click(function() {
    console.log($(this).html());
    $('#edit_score').show(400);
  });

  $('button.add_btn').click(function() {
    var inning = $('input[name="data[inning]"]').val() + $('input[name="data[side]"]').val();
    var score = $('input.score').val();
    if (score == '') return;
    $.post(
      'add_score',
      {'inning':inning, 'score':score},
      function() {
      },
      'json'
    );
  });
});
