 function thumbs_up_or_down(like, model, id) {

    var data = {
         like: like,
         model: model,
         id: id
     };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    console.log(data);
     $.ajax({
         url: "/api/like/",
         type: "POST",
         data: data,
         success: function (json) {
             $('#like_alert').removeClass('alert-success').removeClass('alert-warning');
             $('#like_alert').show().addClass(json.class);
             $('#like_message').text(json.message);
         },
         dataType: "json"
     });
};
