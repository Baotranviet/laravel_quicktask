$(document).on('click','#logout', function (e) {
  e.preventDefault();
  $.ajax({
      url: 'logout',
      type: 'POST',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      dataType: 'json',
      data: {},
      success: function (e) {
          $("#app .navbar").html(e.nav);
      },
      error: function (e) {}
  });
});
