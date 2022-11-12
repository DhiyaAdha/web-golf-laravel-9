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

function remaining() {
    var audio = new Audio('../sound/remaining.mp3');
    audio.play();
}

function cal(price) {
    let total = $('.nilai-total1-td').data('total');
    $('#customRadioInline3').prop('checked', true);
    if ($('.bayar-cash').val() == '') {
        $('.refund').removeClass('d-none');
        $('.bayar-cash').val(price);
        let return_pay = parseInt($('.bayar-cash').val()) - parseInt(total);
        if($('.bayar-cash').val() > total) {
            $('.bayar-cash').removeClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(25, 216, 149, 0.2)",
                "color": "#19d895"
            }).data('refund', return_pay).addClass('green');
        } else {
            $('.bayar-cash').addClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(216, 25, 25, 0.2)",
                "color": "#d81c19d1"
            }).data('refund', return_pay).addClass('green');
        }
    } else {
        let result = parseInt($('.bayar-cash').val());
        $('.bayar-cash').val(result + price);
        let return_pay = parseInt($('.bayar-cash').val()) - parseInt(total);
        if($('.bayar-cash').val() > total) {
            $('.bayar-cash').removeClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(25, 216, 149, 0.2)",
                "color": "#19d895"
            }).data('refund', return_pay);
        } else {
            $('.bayar-cash').addClass('is-invalid');
            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                "background-color": "rgba(216, 25, 25, 0.2)",
                "color": "#d81c19d1"
            }).data('refund', return_pay);
        }
    }
}

function call(price) {
    if ($('.bayar-input').val() == '') {
        $('.bayar-input').val(price);
    } else {
        let result = parseInt($('.bayar-input').val());
        $('.bayar-input').val(result + price);
    }
}

function formatIDR(price) {
    var number_string = price.toString(),
        split = number_string.split(','),
        remainder = split[0].length % 3,
        idr = split[0].substr(0, remainder),
        thousand = split[0].substr(remainder).match(/\d{1,3}/gi);
    if (thousand) {
        separator = remainder ? '.' : '';
        idr += separator + thousand.join('.');
    }
    return split[1] != undefined ? idr + ',' + split[1] : idr;
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
    $('.bayar-input').removeClass('is-invalid').val()
    $('.bayar-cash').removeClass('is-invalid').val();
    $('#return').text('Rp. 0,00').css({
        "background-color": "rgba(25, 216, 149, 0.2)",
        "color": "#19d895"
    }).data('refund', 0);
    if(!$('.bayar-input').val() || !$('.bayar-cash').val()) {
        $('.bayar-cash').val('');
        $('.bayar-input').val('');
    } else {
        $('.bayar-cash').val($('.bayar-cash').data('bill'));
        $('.bayar-input').val($('.bayar-input').data('bill'));
    }
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

    $('input[type=radio][name=payment]').on('change', function() {
        switch ($(this).val()) {
            case 'single':
                click();
                $("input[name='payment-type[]']").prop('checked', false);
                $('#single').show();
                $('#multiple').hide().addClass('d-none');
                $('#balance').text('Rp. ' + formatIDR($('#balance').data('balance') + ',00'));
                $('.items-default').removeClass('d-none');
                $('.items-replace').addClass('d-none');
                $('.discount').hide();
                $('.refund').addClass('d-none');
                $('.remaining').addClass('d-none');
                $('.bayar-input').val('');
                break;
            case 'multiple':
                click();
                $('.discount').hide();
                $('.refund').addClass('d-none');
                $("input[name=payment-type]").prop('checked', false);
                $('.items-default').removeClass('d-none');
                $('.items-replace').addClass('d-none');
                $('#single').hide();
                $('#multiple').show().removeClass('d-none');
                $('.bayar-cash').val('');
                $('#cash-transfer').hide();
                $('#balance').text('Rp. ' + formatIDR($('#balance').data('balance') + ',00'));
                $('.nilai-total1-td').text('Rp. ' + format($('.nilai-total1-td').data('total')) +
                    ',00');
                break;
        }
    });

    $(document).on('change', '#customSwitch2', function(e) {
        click();
        let data_bill = $('#customCheck8').data('bill');
        let data_deposit = $('#customCheck8').data('deposit');
        let price_single = $('.kmt').data('pricesingle');
        let type_multiple = $('input[name="payment-type[]"]:checked')
            .map(function() {
                return $(this).val();
            }).get();
        let minus_deposit = data_bill - data_deposit;
        let discount = '';

        if ($(this).is(':checked')) {
            $('#hide-limit').removeClass('d-none');
        } else {
            $("#customRadioInline5").prop('checked', false);
            $("#customRadioInline6").prop("checked", false);
            $('#hide-limit').addClass('d-none');
            if(data_deposit < data_bill) {
                if(type_multiple.length == 1) {
                    type_multiple.splice(0,1);
                    $('.discount').hide();
                    $('.remaining').addClass('d-none');
                    $('#remaining').text('Rp. 0');
                } else if (type_multiple.length == 2) {
                    type_multiple.splice(1,1);
                    $('.discount').hide();
                    if(type_multiple[0] == 'deposit') {
                        $('.bayar-input').val('');
                        $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                        $('.nilai-total1-td').data('total', data_bill);
                        $('#remaining').text('Rp. ' + format(data_bill - data_deposit));
                    } else if (type_multiple[0] == 'cash/transfer') {
                        $('#remaining').text('Rp. 0');
                        $('.bayar-input').val(data_bill).removeClass('is-invalid');
                        $('#return').text('0').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', 0);
                        $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                        $('.nilai-total1-td').data('total', data_bill);
                    }
                } else if (type_multiple.length == 3) {
                    type_multiple.splice(2,1);
                    $('.discount').hide();
                    $('.bayar-input').val(data_bill - data_deposit).removeClass('is-invalid');
                    $('#return').text('0').css({
                        "background-color": "rgba(25, 216, 149, 0.2)",
                        "color": "#19d895"
                    }).data('refund', 0);
                    $('#remaining').text('Rp. 0');
                    $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                    $('.nilai-total1-td').data('total', data_bill);
                }
            } else {
                if (type_multiple.length == 1) {
                    type_multiple.splice(0,1);
                    $('.discount').hide();
                } else if(type_multiple.length == 2) {
                    if(type_multiple[0] == 'deposit') {
                        type_multiple.splice(1,1);
                        $('.deposit').addClass('d-none');
                        $('#deposit').text('Rp. 0');
                        $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                        $('.discount').hide();
                    } else if (type_multiple[0] == 'cash/transfer') {
                        $('.discount').hide();
                        $('.bayar-input').val(data_bill).removeClass('is-invalid');
                        $('#return').text('-').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', 0);
                    }
                } else if (type_multiple.length == 3) {
                    type_multiple.splice(2,1);
                    $('.discount').hide();
                    $('#deposit').text('Rp. 0');
                    $('.bayar-input').val('');
                    $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00').data('total', data_bill);
                }
            }
        }
    });

    $(document).on('input', '.bayar-cash', function(e) {
        let total = $('.nilai-total1-td').data('total');
        let return_pay = parseInt($(this).val()) - parseInt(total);
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
    $(document).on('input', '.bayar-input', function(e) {
        e.preventDefault();
        let total = $('.nilai-total1-td').data('total');
        let return_pay = parseInt($(this).val()) - parseInt(total);
        let remaining = parseInt(total) - parseInt($(this).val());
        let split = $('.nilai-total1-td').data('split') - parseInt($(this).val());
        let return_split = parseInt($(this).val()) - $('.nilai-total1-td').data('split');
        let data_deposit = $('#customCheck8').data('deposit');
        let price_single = $('.kmt').data('pricesingle');
        let type_multiple = $('input[name="payment-type[]"]:checked')
            .map(function() {
                return $(this).val();
            }).get();

        if(data_deposit < total) {
            let minus_deposit = total - data_deposit;
            if(type_multiple.length == 1) {
                if (type_multiple[0] == 'cash/transfer') {
                    if ($(this).val() < total) {
                        if ($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', return_pay);
                            $('#remaining').text('Rp. ' + format(total));
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', return_pay);
                            $('#remaining').text('Rp. ' + format(remaining));
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', return_pay);
                        $('#remaining').text('Rp. ' +0);
                    }
                }
            } else if (type_multiple.length == 2 ) {
                if (type_multiple[0] == 'cash/transfer') {
                    if ($(this).val() < $('.nilai-total1-td').data('split')) {
                        if ($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', return_split);
                            $('#remaining').text('Rp. ' + format($('.nilai-total1-td').data('split')));
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + format(return_split) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', return_split);
                            $('#remaining').text('Rp. ' + format(split));
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + format(return_split) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', return_split);
                        $('#remaining').text('Rp. ' +0);
                    }
                } else if (type_multiple[1] == 'cash/transfer') {
                    if ($(this).val() < minus_deposit) {
                        if ($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', parseInt($(this).val()) - minus_deposit);
                            $('#remaining').text('Rp. ' + format(minus_deposit));
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + format(parseInt($(this).val()) - minus_deposit) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', parseInt($(this).val()) - minus_deposit);
                            $('#remaining').text('Rp. ' + format(parseInt(minus_deposit) - parseInt($(this).val())));
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + format(parseInt($(this).val()) - minus_deposit) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', parseInt($(this).val()) - minus_deposit);
                        $('#remaining').text(0);
                    }
                }
            } else if (type_multiple.length == 3) {
                if (type_multiple[1] == 'cash/transfer') {
                    if ($(this).val() < (total - data_deposit)) {
                        if ($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', parseInt($(this).val()) - (total - data_deposit));
                            $('#remaining').text('Rp. ' + format(total - data_deposit));
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + format(parseInt($(this).val()) - (total - data_deposit)) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', parseInt($(this).val()) - (total - data_deposit));
                            $('#remaining').text('Rp. ' + format(parseInt(total - data_deposit) - parseInt($(this).val())));
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + format(parseInt($(this).val()) - (total - data_deposit)) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', parseInt($(this).val()) - (total - data_deposit));
                        $('#remaining').text('Rp. ' +0);
                    }
                }
            }
        } else {
            if(type_multiple.length == 1) {
                if (type_multiple[0] == 'cash/transfer') {
                    if ($(this).val() < total) {
                        if ($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', return_pay);
                            $('#remaining').text('Rp. ' + format(total));
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', return_pay);
                            $('#remaining').text('Rp. ' + format(remaining));
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', return_pay);
                        $('#remaining').text('Rp. ' +0);
                    }
                }
            } else if (type_multiple.length == 2) {
                if (type_multiple[0] == 'cash/transfer') {
                    let remain = total - price_single;;
                    if($(this).val() > remain) {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + format($(this).val() - remain) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', $(this).val() - remain);
                    } else {
                        if($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', 0);
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + format($(this).val() - remain) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', $(this).val() - remain);
                        }
                    }
                } else if (type_multiple[1] == 'cash/transfer') {
                    let remain = total - $(this).val();
                    if($(this).val() > total) {
                        $('#deposit').text('Rp. 0');
                        $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                }).data('refund', return_pay);
                    } else {
                        if($(this).val() == '') {
                            $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                            $('#deposit').text('Rp. 0');
                        } else {
                            $('#return').text('0').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                            $('#deposit').text('Rp. -' + format(remain));
                        }
                    }
                }
            } else if (type_multiple.length == 3) {
                if (type_multiple[1] == 'cash/transfer') {
                    let remain = total - price_single;
                    if($(this).val() > remain) {
                        $('#deposit').text('Rp. 0');
                        $('#return').text(' Rp. ' + format($(this).val() - remain) + ',00').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                }).data('refund', $(this).val() - remain);
                    } else {
                        if($(this).val() == '') {
                            $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                            $('#deposit').text('Rp. 0');
                        } else {
                            $('#return').text('0').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                            $('#deposit').text('Rp. -' + format(remain - $(this).val()));
                        }
                    }
                }
            }
        }
    });

    $(document).on('change', 'input[name="payment-type[]"]', function(e) {
        click();
        let data_bill = $('#customCheck8').data('bill');
        let data_deposit = $('#customCheck8').data('deposit');
        let price_single = $('.kmt').data('pricesingle');
        let type_multiple = $('input[name="payment-type[]"]:checked')
            .map(function() {
                return $(this).val();
            }).get();
        let minus_deposit = data_bill - data_deposit;
        let discount = '';
        if ($(this).is(':checked')) {
            if(data_deposit < data_bill) {
                $('.remaining').removeClass('d-none');
                if(type_multiple.length == 1) {
                    if (type_multiple[0] == 'deposit') {
                        $.toast({
                            text: 'Deposit ditambahkan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });
                        $('#remaining').text('Rp. ' + format(minus_deposit));
                    } else if (type_multiple[0] == 'cash/transfer') {
                        $.toast({
                            text: 'Cash/transfer ditambahkan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });

                        $('.refund').removeClass('d-none');
                        $('#return').addClass('green').text(0);
                        $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                        $('.bayar-input').val(data_bill);
                        $('#remaining').text('Rp. ' + 0);
                    } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                        $.toast({
                            text: 'Kupon/limit ditambahkan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });
                        
                        discount += `<div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Diskon</span>
                                            <span>Rp. ${format(price_single)},00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.discount').html(discount).show();

                        $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                        $('#remaining').text('Rp. ' + format(data_bill - price_single) + ',00');
                    }
                } else if (type_multiple.length == 2) {
                    if (type_multiple[0] == 'deposit') {
                        if (type_multiple[1] == 'cash/transfer') {
                            $.toast({
                                text: 'Cash/transfer ditambahkan',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });

                            $('.refund').removeClass('d-none');
                            $('#return').addClass('green').text(0);
                            $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                            $('.bayar-input').val(minus_deposit);
                            $('#remaining').text('Rp. ' + format(minus_deposit - minus_deposit));
                        } else if (type_multiple[1] == 'kupon' || type_multiple[1] == 'limit') {
                            if (((data_bill - price_single) - data_deposit) < price_single) {
                                type_multiple.splice(0,1)
                                $("#customRadioInline6").prop("checked", false);
                                $("#customRadioInline5").prop('checked', false);
                                sword();
                                swal({
                                    title: "",
                                    type: "error",
                                    text: 'Harga satuan limit/kupon tidak terpenuhi',
                                    confirmButtonColor: "#01c853",
                                });
                                return false;
                            } else {
                                $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                                $('.nilai-total1-td').data('total', data_bill - price_single);
                                $('#remaining').text('Rp. ' + format((data_bill - price_single) - data_deposit));
                                $('.bayar-input').val((data_bill - price_single) - data_deposit);
                                discount += `<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${format(price_single)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $('.discount').html(discount).show();

                                if((data_bill - price_single) > data_deposit) {
                                    remaining();
                                    swal({
                                        title: "",
                                        type: "error",
                                        text: "Gunakan cash/transfer untuk sisa pembayaran",
                                        confirmButtonColor: "#01c853",
                                    });
                                    return false;
                                }
                            }
                        }
                    } else if (type_multiple[0] == 'cash/transfer') {
                        if (type_multiple[1] == 'kupon') {
                            $.toast({
                                text: 'Kupon ditambahkan',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });
                            $('#kupon').text($('#kupon').data('kupon') - 1);

                            discount += `<div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Diskon</span>
                                            <span>Rp. ${format(price_single)},00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.refund').removeClass('d-none');
                            $('.discount').html(discount).show();
                            $('.bayar-input').val(data_bill - price_single);
                            $('#return').addClass('green').text(0);
                            $('#remaining').text('Rp. 0');
                            $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                            $('.nilai-total1-td').data('split', data_bill - price_single);
                        } else if (type_multiple[1] == 'limit') {
                            $('#limit').text($('#limit').data('limit') - 1);
                            $.toast({
                                text: 'Limit ditambahkan',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });

                            discount += `<div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Diskon</span>
                                            <span>Rp. ${format(price_single)},00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.discount').html(discount).show();

                            $('.bayar-input').val(data_bill - price_single);
                            $('#return').addClass('green').text(0);
                            $('#remaining').text('Rp. 0');
                            $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                            $('.nilai-total1-td').data('split', data_bill - price_single);
                        }
                    }
                } else if (type_multiple.length == 3) {
                    if (type_multiple[2] == 'kupon' || type_multiple[2] == 'limit') {
                        if (((data_bill - price_single) - data_deposit) < price_single) {
                            type_multiple.splice(0,1)
                            $("#customRadioInline6").prop("checked", false);
                            $("#customRadioInline5").prop('checked', false);
                            sword();
                            swal({
                                title: "",
                                type: "error",
                                text: 'Harga satuan limit/kupon tidak terpenuhi',
                                confirmButtonColor: "#01c853",
                            });
                            return false;
                        } else {
                            $('.refund').removeClass('d-none');
                            $('#return').addClass('green').text(0);
                            $('.bayar-input').val((data_bill - price_single) - data_deposit);
                            $('.nilai-total1-td').data('total', data_bill - price_single);
                            $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                            discount += `<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${format(price_single)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $('.discount').html(discount).show();
                            $.toast({
                                text: 'Kupon/limit ditambahkan',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });
                            $('#remaining').text('Rp. 0');
                        }
                    }
                }
            } else {
                if(type_multiple.length == 1) {
                    if (type_multiple[0] == 'deposit') {
                        $.toast({
                            text: 'Deposit ditambahkan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });
                        $('#remaining').text('Rp. 0');
                    } else if (type_multiple[0] == 'cash/transfer') {
                        $.toast({
                            text: 'Cash/transfer ditambahkan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });
                        $('.refund').removeClass('d-none');
                        $('#return').addClass('green').text(0);
                        $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00');
                        $('.bayar-input').val(data_bill);
                        $('#remaining').text('Rp. ' + 0);
                    } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                        $.toast({
                            text: 'Kupon/limit ditambahkan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });
                        
                        discount += `<div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Diskon</span>
                                            <span>Rp. ${format(price_single)},00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.discount').html(discount).show();

                        $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                        $('#remaining').text('Rp. ' + format(data_bill - price_single) + ',00');
                    }
                } else if (type_multiple.length == 2) {
                    if (type_multiple[0] == 'deposit') {
                        if(type_multiple[1] == 'cash/transfer') {
                            $('.refund').removeClass('d-none');
                            $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0).addClass('green');
                            $('.deposit').removeClass('d-none');
                            $('#deposit').text('Rp. 0');
                            $('.bayar-input').val('');
                        } else if (type_multiple[1] == 'kupon' || type_multiple[1] == 'limit') {
                            if(JSON.parse($('.package-default').val()).length == 1) {
                                $('.deposit').removeClass('d-none');
                                $('#deposit').text('Rp. 0');
                                $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                                discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${format(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();
                            } else {
                                $('.deposit').removeClass('d-none');
                                $('#deposit').text('Rp. -' + format(data_bill - price_single));
                                $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                                discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${format(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();
                            }
                        }
                    } else if (type_multiple[0] == 'cash/transfer') {
                        if(type_multiple[1] == 'kupon' || type_multiple[1] == 'limit') {
                            if(JSON.parse($('.package-default').val()).length == 1) {
                                $("#customCheck7").prop("checked", false);
                                $('.bayar-input').val('');
                                $('#return').text('0').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                }).data('refund', 0);
                                $('.refund').addClass('d-none');
                                discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${format(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();
                                $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                                swal({
                                    title: "",
                                    type: "error",
                                    text: "Gunakan limit atau kupon",
                                    confirmButtonColor: "#01c853",
                                });
                                return false;
                            } else {
                                $('.bayar-input').val(data_bill - price_single).removeClass('is-invalid');
                                $('#return').text('0').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                }).data('refund', 0).addClass('green');
                                discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${format(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();
                                $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                                $('.refund').removeClass('d-none');
                            }
                        }
                    }
                } else if (type_multiple.length == 3) {
                    if(type_multiple[2] == 'kupon' || type_multiple[2] == 'limit') {
                        $('.bayar-input').val('');
                        $('.deposit').removeClass('d-none');
                        $('#deposit').text('Rp. 0');
                        $('.refund').removeClass('d-none');
                        $('#return').addClass('green').text('-');
                        discount += `<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${format(price_single)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $('.discount').html(discount).show();
                        $('.nilai-total1-td').text('Rp. ' + format(data_bill - price_single) + ',00');
                    }
                }
            }
        } else {
            if(data_deposit < data_bill) {
                if(type_multiple.length == 0) {
                    $('.remaining').addClass('d-none');
                    if ((type_multiple[0] == 'cash/transfer') == false) {
                        $('.refund').addClass('d-none');
                        $('.bayar-input').val('').removeClass('is-invalid');
                        $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                        $('#return').text('0')
                    }
                } else if (type_multiple.length == 1) {
                    if((type_multiple[0] == 'deposit') == false) {
                        if(type_multiple[0] == 'cash/transfer') {
                            $('.bayar-input').val(data_bill);
                            $('#return').addClass('green').text('0');
                            $('#remaining').text('Rp. 0');
                        } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                            $('#remaining').text('Rp. ' + format(data_bill - price_single));
                            $('.refund').addClass('d-none');
                            $('.bayar-input').val('').removeClass('is-invalid');
                            $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', 0);
                            $('#return').text('0');
                        }
                    } else if (((type_multiple[0] || type_multiple[1]) == 'cash/transfer') == false) {
                        $('.bayar-input').val('').removeClass('is-invalid');
                        $('.refund').addClass('d-none');
                        $('#remaining').text('Rp. ' + format(data_bill - data_deposit));
                        $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                        $('#return').text('0')
                    }
                } else if (type_multiple.length == 2) {
                    if((type_multiple[0] == 'deposit') == false) {
                        $('.bayar-input').val(data_bill - price_single);
                        $('.nilai-total1-td').data('split', data_bill - price_single);
                    } else if ((type_multiple[1] == 'cash/transfer') == false) {
                        $('.bayar-input').val('').removeClass('is-invalid');
                        $('.refund').addClass('d-none');
                        $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                        $('#remaining').text('Rp. ' + format((data_bill - price_single) - data_deposit));
                    }
                }
            } else {
                if (type_multiple.length == 0) {
                    if((type_multiple[0] == 'cash/transfer') == false) {
                        $('.bayar-input').val('').removeClass('is-invalid');
                        $('.refund').addClass('d-none');
                        $('#return').text('-').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                }).data('refund', 0).addClass('green');
                    }
                } else if(type_multiple.length == 1) {
                    if(type_multiple[0] == 'deposit') {
                        if((type_multiple[1] == 'cash/transfer') == false) {
                            $('.refund').addClass('d-none');
                            $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0).addClass('green');
                            $('.bayar-input').val('');
                            $('.deposit').addClass('d-none');
                            $('#deposit').text('Rp. 0');
                        }
                    } else if (type_multiple[0] == 'cash/transfer') {
                        if((type_multiple[0] == 'deposit') == false) {
                            $('.deposit').addClass('d-none');
                            $('#deposit').text('Rp. 0');
                            $('.bayar-input').val(data_bill);
                            $('#return').text('0').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', 0).addClass('green');
                        } else if ((type_multiple[1] == 'kupon' || type_multiple == 'limit') == false) {
                            $('.discount').hide();
                        }
                    } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                        if ((type_multiple[0] == 'cash/transfer') == false) {
                            $('.bayar-input').val('');
                            $('.refund').addClass('d-none');
                            $('#return').text('0').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', 0).addClass('green');
                        }
                        if((type_multiple[0] == 'deposit') == false) {
                            $('.deposit').addClass('d-none');
                            $('#deposit').text('Rp. 0');
                            $('.nilai-total1-td').text('Rp. ' + format(data_bill) + ',00').data('total', data_bill);
                        }
                    }
                } else if (type_multiple.length == 2) {
                    if((type_multiple[0] == 'deposit') == false) {
                        $('.deposit').addClass('d-none');
                        $('#deposit').text('Rp. 0');
                    } else if ((type_multiple[1] == 'cash/transfer') == false) {
                        $('.bayar-input').val('');
                        $('.refund').addClass('d-none');
                        $('#return').text('-').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                        $('#deposit').text('Rp. ' + format((data_bill - price_single)));
                    }
                }
            }
        }
    });

    $(document).on('change', 'input[name="payment-type"]', function(e) {
        e.preventDefault();
        click();
        let type_single = $(this).val();
        let tg = window.location.href;
        tg = tg.split("?")
        tg = tg[0];
        tg = tg.split("/");
        page = tg[tg.length - 1];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            async: true,
            type: 'GET',
            data: {
                type: type_single,
                param: $('input[type=hidden]').val()
            },
            url: '/select',
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
                    $('#balance').text(format(response.price) + ',00');
                    $('#kupon').text(format(parseInt(response.kupon)));
                    $('#limit').text(format(parseInt(response.limit)));

                    let html = '';
                    let discount = '';
                    let price_discount = 0;
                    let price = 0;
                    if (type_single == 1) {
                        $.each(response.orders, function(b, val) {
                            html += `<div class="d-flex">
                                        <span class="flex-grow-1">${val.name} ${response.orders[b].category == 'default' ? '| game' : ''} x ${val.qty}</span>
                                        <small>${response.orders[b].category == 'default' ? 'limit gratis' : 'Rp. ' + format(val.pricesingle) + ',00'}</small>
                                    </div>`;
                            price_discount += val.pricesingle;
                            price += val.price;
                        });
                        $('.items-replace').html(html).removeClass('d-none');
                        $('.items-default').addClass('d-none');
                        $('.refund').addClass('d-none');
                        $('.bayar-cash').val('');
                        discount += `<div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <span class="flex-grow-1">Diskon</span>
                                        <span>Rp. ${format(price_discount)},00</span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        $('.discount').html(discount).show();
                        $('.nilai-total1-td').text('Rp. ' + format(response.total_price - response.price_default) + ',00');

                        $('#return').text('-').addClass('green').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        });

                        $('#cash-transfer').html(
                            `<div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" min="0"
                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                    class="form-control number-input input-notzero bayar-cash"
                                    name="bayar" placeholder="Masukkan nominal bayar"
                                    autocomplete="off">
                            </div>`
                        ).hide().prev().addClass('mb-2');
                    } else if (type_single == 2) {
                        $.each(response.orders, function(b, val) {
                            html += `<div class="d-flex">
                                        <span class="flex-grow-1">${val.name} ${response.orders[b].category == 'default' ? '| game' : ''} x ${val.qty}</span>
                                        <small>${response.orders[b].category == 'default' ? 'kupon gratis' : 'Rp. ' + format(val.pricesingle) + ',00'}</small>
                                    </div>`;
                            price_discount += val.pricesingle;
                            price += val.price;
                        });
                        $('.items-replace').html(html).removeClass('d-none');
                        $('.items-default').addClass('d-none');
                        $('.refund').addClass('d-none');
                        $('.bayar-cash').val('');
                        discount += `<div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <span class="flex-grow-1">Diskon</span>
                                        <span>Rp. ${format(price_discount)},00</span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        $('.discount').html(discount).show();
                        $('.nilai-total1-td').text('Rp. ' + format(response.total_price - response.price_default) + ',00');
                        $('#return').text('-').addClass('green').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        });
                        $('#cash-transfer').html(
                            `<div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" min="0"
                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                    class="form-control number-input input-notzero bayar-cash"
                                    name="bayar" placeholder="Masukkan nominal bayar"
                                    autocomplete="off">
                            </div>`
                        ).hide().prev().addClass('mb-2');
                    } else if (type_single == 4) {
                        $.each(response.orders, function(b, val) {
                            html += `<div class="d-flex">
                                        <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                        <small>${'Rp. ' + format(val.price) + ',00'}</small>
                                    </div>`;
                        });
                        $('.items-replace').html(html).removeClass('d-none');
                        $('.items-default').addClass('d-none');
                        $('.discount').hide();
                        $('.refund').addClass('d-none');
                        $('.nilai-total1-td').text('Rp. ' + format(response.total_price) + ',00');
                        $('.bayar-cash').val('');
                        $('#return').text('-').addClass('green').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        });
                        $('#cash-transfer').html(
                            `<div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" min="0"
                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                    class="form-control number-input input-notzero bayar-cash"
                                    name="bayar" placeholder="Masukkan nominal bayar"
                                    autocomplete="off">
                            </div>`
                        ).hide().prev().addClass('mb-2');
                    } else {
                        $('#cash-transfer').html(
                            `<div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" min="0"
                                        onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                        class="form-control number-input input-notzero bayar-cash"
                                        name="bayar" placeholder="Masukkan nominal bayar"
                                        autocomplete="off">
                                </div>`
                        ).show().prev().removeClass('mb-2');
                        $('#return').text('Rp. 0,00').addClass('green').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        });

                        $.each(response.orders, function(b, val) {
                            html += `<div class="d-flex">
                                            <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                            <small>${'Rp. ' + format(val.price) + ',00'}</small>
                                        </div>`;
                        });
                        $('.items-replace').html(html).removeClass('d-none');
                        $('.items-default').addClass('d-none');
                        $('.discount').hide();
                        $('.refund').removeClass('d-none');
                        $('.bayar-cash').val(response.total_price);
                        $('.nilai-total1-td').text('Rp. ' + format(response.total_price) + ',00');
                    }

                    $.toast({
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#fec107',
                        icon: 'success',
                        hideAfter: 700,
                    });
                } else {
                    $.toast({
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#fec107',
                        icon: 'error',
                        hideAfter: 700,
                    });
                    return false;
                }
            }
        });
    });

    $(document).on('click', '#pay', function(e) {
        e.preventDefault();
        let type = $('input[type=radio][name=payment]:checked').val();
        let type_single = $("input[name='payment-type']:checked").val();
        let type_multiple = $("input[name='payment-type[]']:checked")
            .map(function() {
                return $(this).val();
            }).get();
        let order_number = $('#order-number').text();
        let bayar_cash = $('.bayar-cash').val();
        let bayar_input = $('.bayar-input').val();
        let refund = $('#return').data('refund');
        let tg = window.location.href;
        tg = tg.split("?");
        tg = tg[0];
        tg = tg.split("/");
        page = tg[tg.length - 1];

        let data_deposit = $('#customCheck8').data('deposit');
        let data_bill = $('#customCheck8').data('bill');
        let pay_deposit = data_bill - data_deposit;

        if (type_single == 3) {
            if (!bayar_cash) {
                sword();
                swal({
                    title: "",
                    type: "error",
                    text: "Nominal wajib diisi",
                    confirmButtonColor: "#01c853",
                });
                return false;
            }
        }
        
        if (type_multiple[0] == 'cash/transfer') {
            if (!bayar_input) {
                sword();
                swal({
                    title: "",
                    type: "error",
                    text: "Nominal wajib diisi",
                    confirmButtonColor: "#01c853",
                });
                return false;
            }
        } else if (type_multiple[1] == 'cash/transfer') {
            if (!bayar_input) {
                sword();
                swal({
                    title: "",
                    type: "error",
                    text: "Nominal wajib diisi",
                    confirmButtonColor: "#01c853",
                });
                return false;
            }
        }

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
                        type: type,
                        type_single: type_single,
                        type_multiple: type_multiple,
                        page: $('input[type=hidden]').val(),
                        order_number: order_number,
                        bayar_input: bayar_input,
                        bayar_cash: bayar_cash,
                        pay_deposit: pay_deposit,
                        refund: refund
                    },
                    url: '/pay',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr(
                                'content')
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
                                invoice('/print_invoice/'+$('input[type=hidden]').val(),
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