$(".btn-plus, .btn-minus").on("click", function (e) {
  const isNegative = $(e.target).closest(".btn-minus").is(".btn-minus");
  const input = $(e.target).closest(".input-group").find("input");
  if (input.is("input")) {
    input[0][isNegative ? "stepDown" : "stepUp"]();
  }
});

$("#checkout").on("click", function (e) {
  $("#loader").toggleClass("d-none");
  form = $("#formCheckout");
  setTimeout(function () {
    form.submit();
  }, 5000);
  e.preventDefault();
});
