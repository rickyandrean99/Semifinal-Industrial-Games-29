require('./bootstrap');

$(document).on('click', '#update_siklus', function(e) {
    e.preventDefault();

    const options = {
        method: 'post',
        url: '/panitia/updatesiklustimer',
        data: {},
        transformResponse: [(data) => {
            $('#success-note').show();
            $('#success-note').html("Siklus Berhasil Diperbaharui");

            $("#success-note").fadeTo(3000, 500).hide(500, function(){
                $("#success-note").hide(500);
            });

            return data;
        }]
    }

    axios(options);
});

window.Echo.channel('timerChannel').listen('.update', (e) => {
    siklus = parseInt(e.siklus);
    cooldown = false;
    time = parseInt(e.time);

    if (e.siklus == 5) {
        $('#product_list_5').after("<tr id='product_list_6'><td id='nama_produk_6' class='text-center border-dark border-2 nama fw-bold'></td><td id='harga_produk_6' class='text-center border-dark border-2 harga fw-bold'></td><td class='text-center border-dark border-2'><input class='form-control text-center jumlah' type='number' min='0' value='0' name='product[]' id='product' onchange='updatePricing()'></td></tr>");
    }

    realTimeProduk();
});