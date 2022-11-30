const sword = () => {
    var audio = new Audio('../sound/sword.mp3');
    audio.play();
}

const bell = () =>{
    var audio = new Audio('../sound/bell.mp3');
    audio.play();
}

$('#show-qr-scan').on('click', function() {
    $('.disabled-scan').addClass('d-none');
    let onScanSuccess = (decodedText, decodedResult) => {
        $("#resultTEXT").val(decodedText)
        $('#resultDECODE').val(JSON.stringify(decodedResult));
        html5QrcodeScanner.clear();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/visitor/qrcode',
            data: {
                qrCode: decodedText
            },
            dataType: 'json',
            success: (response) => {
                if (response.status === "VALID") {
                    bell();
                    swal({
                        title: "Verifikasi berhasil",
                        type: "success",
                        text: "Atas nama " + response.data.name,
                        confirmButtonColor: "#01c853",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 2000,
                    }, () => {
                        window.location = response.data.detail_scan;
                    });
                } else {
                    sword();
                    swal({
                        title: "",
                        type: "error",
                        text: response.message,
                        confirmButtonColor: "#01c853",
                    }, () => {
                        window.location.reload(true)
                    });
                }
            }
        });
    }

    const onScanFailure = (error) => {
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 144,
            qrbox: {
                width: 200,
                height: 200
            }
        },
        true);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});

$('#verification-no-hp').keypress(function(e) {
    if (e.which == 13) {
        swal({
            title: "",
            text: "Verifikasi No Hp?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#01c853",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    async: true,
                    type: 'GET',
                    data: {
                        phone: $('#verification-no-hp').val()
                    },
                    url: '/visitor/phone',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr(
                                'content')
                    },
                    beforeSend: () => {
                        $.blockUI({
                            css: {
                                backgroundColor: 'transparent',
                                border: 'none'
                            },
                            message: '<img src="../img/rolling.svg">',
                            baseZ: 1500,
                            overlayCSS: {
                                backgroundColor: '#7C7C7C',
                                opacity: 0.4,
                                cursor: 'wait'
                            }
                        });
                    },
                    success: (response) => {
                        $.unblockUI();
                        if (response.status == "INVALID") {
                            sword();
                            swal({
                                title: "",
                                type: "error",
                                text: response.message,
                                confirmButtonColor: "#01c853",
                            });
                        } else {
                            bell();
                            swal({
                                title: '',
                                type: "success",
                                text: response.message,
                                confirmButtonColor: "#01c853",
                            }, () => {
                                window.location = response.data.detail_scan;
                            });
                        }
                    },
                    error: () => {
                        sword();
                        swal({
                            title: "Internal Server Error",
                            type: "error",
                            text: "Terdapat kesalahan program pada action ini",
                            confirmButtonColor: "#01c853",
                        });
                        return false;
                    }
                });
            } else {
                swal("Dibatalkan", "", "info");
            }
        });
    }
})