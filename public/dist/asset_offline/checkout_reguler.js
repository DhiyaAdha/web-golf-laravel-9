$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function deleteCharacter() {
    dlt();
    let currentValue = $('.inputDisplay').val();
    $('.inputDisplay').val(currentValue.substring(0, currentValue.length - 1));
}

function insertCharacter(char) {
    click();
    let currentValue = $('.inputDisplay').val();
    let length = currentValue.length;
    let flag = false;
    if(char == '+' || char == '-' || char == '*' || char == '/')
        flag = true;
    if(length == 0) {
        if(flag)
        return;
    }
    let flagNew = false;
    let lastCharacter = currentValue[length-1];
    if(lastCharacter == '+' || lastCharacter == '-' || lastCharacter == '*' || lastCharacter == '/')
    flagNew = true;
    if(flag && flagNew)
        $('.inputDisplay').val(currentValue.substring(0,length-1) + char);
    else
        $('.inputDisplay').val($('.inputDisplay').val() + char);
}

function clearInput() {
    dlt();
    $('.inputDisplay').val('');
}

function result() {
    dlt();
    let currentValue = $('.inputDisplay').val();
    let length = currentValue.length;
    let flag = false;
    let char = currentValue[length-1];
    if(char == '+' || char == '-' || char == '*' || char == '/')
    flag = true;
    if(flag)
        $('.inputDisplay').val("ERROR!");
    else
        $('.inputDisplay').val(eval($('.inputDisplay').val()));
}

function add() {
    var audio = new Audio('../sound/add.mp3');
    audio.play();
}

function beep() {
    var audio = new Audio('../sound/beep.mp3');
    audio.play();
}
function click() {
    var audio = new Audio('../sound/click.mp3');
    audio.play();
}

function dlt() {
    var audio = new Audio('../sound/remove.mp3');
    audio.play();
}

function rst() {
    var audio = new Audio('../sound/reset.mp3');
    audio.play();
}

function sword() {
    var audio = new Audio('../sound/sword.mp3');
    audio.play();
}

function bell() {
    var audio = new Audio('../sound/bell.mp3');
    audio.play();
}

function cal(price) {
    let total = $('.nilai-total1-td').data('total');
    if ($('.bayar-input').val() == '') {
        $('.bayar-input').val(price);
        let return_pay = parseInt($('.bayar-input').val()) - parseInt(total);
        if($('.bayar-input').val() > total) {
            $('.bayar-input').removeClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(25, 216, 149, 0.2)",
                "color": "#19d895"
            }).data('refund', return_pay);
        } else {
            $('.bayar-input').addClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(216, 25, 25, 0.2)",
                "color": "#d81c19d1"
            }).data('refund', return_pay);
        }
    } else {
        let result = parseInt($('.bayar-input').val());
        $('.bayar-input').val(result + price);
        let return_pay = parseInt($('.bayar-input').val()) - parseInt(total);
        if($('.bayar-input').val() > total) {
            $('.bayar-input').removeClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(25, 216, 149, 0.2)",
                "color": "#19d895"
            }).data('refund', return_pay);
        } else {
            $('.bayar-input').addClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(216, 25, 25, 0.2)",
                "color": "#d81c19d1"
            }).data('refund', return_pay);
        }
    }
}

var format = function(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
            output.push(".");
        }
        i++;
        }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

function refreshInput() {
    $('.bayar-input').val($('.bayar-input').data('bill')).removeClass('is-invalid');
    $('#return').text('Rp. 0,00').css({
        "background-color": "rgba(25, 216, 149, 0.2)",
        "color": "#19d895"
    }).data('refund', 0);
}

$(document).ready(function() {
    $("[data-toggle=popover]").popover({
        html : true,
        sanitize: false,
        content: function() {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
        title: function() {
            var title = $(this).attr("data-popover-content");
            return $(title).children(".popover-header").html();
        }
    });

    $(document).on('input', '.bayar-input', function(e) {
        e.preventDefault();
        let total = $('.nilai-total1-td').data('total');
        let return_pay = $(this).val() - total;

        if ($(this).val() < total) {
            if ($(this).val() == '') {
                $(this).removeClass('is-invalid');
                $('#return').text('-').css({
                    "background-color": "rgba(25, 216, 149, 0.2)",
                    "color": "#19d895"
                }).data('refund', return_pay);
            } else {
                $(this).addClass('is-invalid');
                $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                    "background-color": "rgba(216, 25, 25, 0.2)",
                    "color": "#d81c19d1"
                }).data('refund', return_pay);
            }
        } else {
            $(this).removeClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(25, 216, 149, 0.2)",
                "color": "#19d895"
            }).data('refund', return_pay);
        }
    });

    $(document).on('click', '.add-name', function(e) {
        click();
        e.preventDefault();
        $('.add-name').hide();
        $(`<div class="d-flex align-items-center">
            <input type="text" class="name" placeholder="Masukkan nama">
        </div>`).insertAfter($('.add-name'));
    });

    $(document).on('click', '#pay', function(e) {
        e.preventDefault();
        let refund = $('#return').data('refund');
        let pay_amount = $('.bayar-input').val();
        let order_number = $('#order-number').text();
        let total_payment = $('.nilai-total1-td').data('total');
        let name = '';
        let url = "{{ route('invoice.print.reguler') }}";

        if (!pay_amount) {
            sword();
            swal({
                title: "",
                type: "error",
                text: "Nominal wajib diisi",
                confirmButtonColor: "#01c853",
            });
            return false;
        } else {
            if ($('.name').val() == '' || $('.name').val() == null) {
                name = 'reguler';
            } else {
                name = $('.name').val();
            }
        }

        if (pay_amount < total_payment) {
            sword();
            swal({
                title: "",
                type: "error",
                text: "Nominal tidak terpenuhi",
                confirmButtonColor: "#01c853",
            });
            return false;
        } else {
            swal({
                title: "",
                text: "Lakukan pembayaran?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#01c853",
                confirmButtonText: "Bayar",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        async: true,
                        type: 'POST',
                        data: {
                            refund: refund,
                            order_number: order_number,
                            pay_amount: pay_amount,
                            name: name
                        },
                        url: "/pay_reguler",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function(request) {
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
                        success: function(response) {
                            $.unblockUI();
                            if (response.status == "VALID") {
                                bell();
                                swal({
                                    title: '',
                                    type: "success",
                                    text: response.message,
                                    confirmButtonColor: "#01c853",
                                }, function(isConfirm) {
                                    invoice("/print_invoice_reguler",
                                        'Print Invoice');
                                    history.go(0);
                                });
                            } else {
                                sword();
                                swal({
                                    title: "",
                                    type: "error",
                                    text: response.message,
                                    confirmButtonColor: "#01c853",
                                });
                                return false;
                            }
                        }
                    });
                } else {
                    swal("Dibatalkan", "", "info");
                }
            });
            return false;
        }

    });

    function invoice(url, title) {
        popupCenter(url, title, 340, 550);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window
            .screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window
            .screenY;
        const width = window.innerWidth ? window.innerWidth : document.documentElement
            .clientWidth ?
            document
            .documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement
            .clientHeight ?
            document
            .documentElement.clientHeight : screen.height;
        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft
        const top = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow = window.open(url, title,
            `scrollbars=yes,width  = ${w / systemZoom}, height = ${h / systemZoom}, top    = ${top}, left   = ${left}`
        );
        if (window.focus) newWindow.focus();
    }
});