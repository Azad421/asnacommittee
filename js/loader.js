function loader($cond = null) {
  var loader = $(".loader");
  if ($cond == "show") {
    loader.css("diplay", "flex");
    loader.show();
    setTimeout(() => {
      loader.hide();
    }, 5000);
  } else {
    loader.hide();
  }
}
