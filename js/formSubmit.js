function submitForm(e, formid, callback) {
  loader("show");
  var url = e.currentTarget.action;
  var data = $(formid).serialize();
  $.ajax({
    type: "POST",
    url: url,
    data: data,
    dataType: "json",
    cache: false,
    processData: false,
    success: function (response) {
      loader();
      if (response.status != 3) {
        toastr[response.type](response.message);
      }
      callback(response);
    },
    error: function (error) {
      console.log(error);
    },
  });
}

toastr.options = {
  closeButton: true,
  debug: false,
  newestOnTop: false,
  progressBar: true,
  positionClass: "toast-top-right",
  preventDuplicates: true,
  onclick: null,
  showDuration: "300",
  hideDuration: "1000",
  timeOut: "4000",
  extendedTimeOut: "1000",
  showEasing: "swing",
  hideEasing: "linear",
  showMethod: "fadeIn",
  hideMethod: "fadeOut",
};

function fethcItem(key, action) {
  $.post(
    "./com/fetchItem.php",
    {
      key: key,
      action: action,
    },
    function (data, textStatus, jqXHR) {
      $("#items").html(data);
    },
    "html"
  );
}
