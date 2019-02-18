var qr = new QCodeDecoder();
var img = document.querySelector('.ticket__info-qr');
console.log(img);
qr.decodeFromImage(img, function (err, result) {
    if (err) throw err;
  
    console.log(result);
  });