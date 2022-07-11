
let jumlah = 0;
let harga = 0;
let totalTmp = 0;
let total = 0;
let costtmp = 0;
var jahit = $('#jahit').val();


$('#tbProduksi').DataTable();
$('#tbSalary').DataTable();


if($('#nama').val('')){
    $('#simpan').hide(3000);
    $('#pesan').show(3000);

}else{
    $('#pesan').hide();
    $('#simpan').show(3000);
}
// if($('#nama') > 0){
//     $('#pesan').hide();
//     $('#simpan').show();
//     $('#gambar').show();
    
// }
let cost = 0;
var cst = $('#cost').val();
var jahit = $('#jahit').val();
var naskat = $('#naskat').val();
var motong = $('#motong').val();
// const jml = $('#qty').val();
// const hrg = $('#cost').val();
$('#size').keyup(function() {
    const jml = $('#qty').val();
    const hrg = $('#cost').val();
    const total = Number(jml) * Number(hrg);
    $('#total').val(total);
    // totalTmp = total;
});
$('#nama').on('change', function() {    
    var nm = $('#nama').val();
    $('#pesan').hide();
    $('#simpan').show(3000);
    

    if(nm == 'Surya Darma') {
        $('#cost').val(naskat);
    }else if(nm == 'Aulia Margareta') {
        $('#cost').val(motong);
    }else{
        $('#cost').val(jahit);
    }  
})

$('#qty').keyup(function() {
    const jml = $('#qty').val();
    const hrg = $('#cost').val();
    const total = Number(jml) * Number(hrg);
    $('#total').val(total);
    totalTmp = total;
});
$('#cost').change(function() {
    const jml = $('#qty').val();
    const hrg = $('#cost').val();
    const total = Number(jml) * Number(hrg);
    $('#total').val(total);
    // totalTmp = total;
});



