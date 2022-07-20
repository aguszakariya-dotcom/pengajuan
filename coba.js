
// tambahan
$('#tbDiary').DataTable();
$('#tbGajian').DataTable();


let totalTmp = 0;
let totalTmp2 = 0;
let jumlah = 0;
let harga = 0;

$('#jumlah').change(function () {
    if (harga == 0) {
        alert("isi harga dulu")
        $('#jumlah').val('')
        return
    }

    const jml = $('#jumlah').val();
    const hrg = $('#harga').val();
    const total = jml * hrg;
    $('#total').val(total);
    totalTmp = total;
    jumlah = jml;

});


$('#harga').change(function () {
    const jml = $('#jumlah').val();
    const hrg = $('#harga').val();
    const total = Number(jml) * Number(hrg);
    $('#total').val(total);
    totalTmp = total;
    harga = hrg;
});

$('#anyar').change(function (e) {
    let target = e.target.value;
    let total = totalTmp;
    if (target == "y") {
        total = totalTmp * 1.5;
    } else if (target == "n") {
        total = totalTmp;
    }

    $('#total').val(total);
    totalTmp2 = total;
});



$('#patrun').change(function (e) {
    let target = e.target.value;
    let total = totalTmp2;

    if (target == "y") {
        total = totalTmp2 + 50000;

    } else if (target == "n") {

        total = totalTmp2;
    }

    $('#total').val(total);


});
