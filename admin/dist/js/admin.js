function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#previewImg").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#gambar").change(function () {
  readURL(this);
});

// UPDATE STOK
$(".btn-plus, .btn-minus").on("click", function (e) {
  const isNegative = $(e.target).closest(".btn-minus").is(".btn-minus");
  const input = $(e.target).closest(".input-group").find("input");
  if (input.is("input")) {
    input[0][isNegative ? "stepDown" : "stepUp"]();
  }
});
