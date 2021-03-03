var $ = jQuery;

var isRtl = ($('.rtl').length > 0) ? true : false;

$(document).ready(function(){
    $('.js-modalItem').click(function(e){
        e.preventDefault();
        _this = $(this);
        var item = _this.closest('.js-item')
        item.find('.fa-plus').addClass('fa-spinner-third').removeClass('fa-plus')
        console.log(postIds)
        var idPrev = '';
        var idNext = '';
        for (var i = 0; i < postIds.length; i++) {
            if (postIds[i] == _this.attr('data-id')) {
                if (postIds[i-1]) {
                    idPrev = postIds[i-1];
                }
                if (postIds[i+1]) {
                    idNext = postIds[i+1];
                }
            }
        }
        $.ajax({
            method: 'POST',
            url: '/wp-content/themes/sharjahsystem/inc/ajax/item-post.php',
            data: {
                id : _this.attr('data-id'),
                idPrev: idPrev,
                idNext: idNext
            }
        }).done(function(response){
            $('.js-modlSlider').slick('unslick')
            item.find('.fa-spinner-third').addClass('fa-plus').removeClass('fa-spinner-third')
            $('#listmodal').html(response);
            $('#listmodal').arcticmodal();
            $('.js-modlSlider').slick({
                adaptiveHeight: true,
                prevArrow:'<span class="icon-left-arrow"></span>',
                nextArrow:'<span class="icon-right-arrow"></span>',
                rtl: isRtl
            })
        }).fail(function(error){
            alert(translates.error);
            item.find('.fa-spinner-third').addClass('fa-plus').removeClass('fa-spinner-third')
            console.log(error);
        });
    })
    $('.js-printForMdl').click(function(e){
        e.preventDefault();
        $('.js-printToMdlType').val($(this).data('type'))
        $('.js-printToMdlId').val($(this).data('catid'))
        $('#checkprint').arcticmodal();
    })
    $('.js-forpar').change(function(){
        $('.js-printParams').val('')
        var forVal = ''
        $('.js-forpar').each(function(i){
            if($(this).prop('checked') === true) {
                if(i > 0) {
                    forVal += ','
                }
                forVal += $(this).val()
            }
        })
        $('.js-printParams').val(forVal)
    })
    $('#listmodal').on('click', '.js-postChange', function(e){
        e.preventDefault();
        // $('#listmodal').arcticmodal('close');
        $('.js-spinnerPost').fadeIn();
        _this = $(this);
        console.log(postIds)
        var idPrev = '';
        var idNext = '';
        for (var i = 0; i < postIds.length; i++) {
            if (postIds[i] == _this.attr('data-id')) {
                if (postIds[i-1]) {
                    idPrev = postIds[i-1];
                }
                if (postIds[i+1]) {
                    idNext = postIds[i+1];
                }
            }
        }
        $.ajax({
            method: 'POST',
            url: '/wp-content/themes/sharjahsystem/inc/ajax/item-post.php',
            data: {
                id : _this.attr('data-id'),
                idPrev: idPrev,
                idNext: idNext
            }
        }).done(function(response){
            $('.js-modlSlider').slick('unslick')
            $('#listmodal').html(response);
            $('.js-modlSlider').slick({
                adaptiveHeight: true,
                prevArrow:'<span class="icon-left-arrow"></span>',
                nextArrow:'<span class="icon-right-arrow"></span>',
                rtl: isRtl
            })
            $('.js-spinnerPost').fadeOut();
        }).fail(function(error){
            alert(translates.error);
            console.log(error);
        });
    })
    $('body').on('click', '.arcticmodal-close', function(e){
        e.preventDefault();
        $('#listmodal').arcticmodal('close');
        $('.js-modlSlider').slick('unslick')
    })
    $('.js-postCount').change(function(){
        var search = window.location.search;
        var newSearch = insertParam(search, 'post_count', $(this).val());
        window.location.search = newSearch
    })
    $('.js-sortSrch').change(function(){
        var search = window.location.search;
        var newSearch = insertParam(search, 'order', $(this).val());
        window.location.search = newSearch
    })


    $('.js-itemDel').click(function(e){
        e.preventDefault();
        _this = $(this);
        var isDel = confirm(translates.sure_del_item);

        if (isDel){
            $.ajax({
                method: 'POST',
                url: '/wp-content/themes/sharjahsystem/inc/ajax/item-delete.php',
                data: {
                    post_id : _this.attr('data-id')
                }
            }).done(function(response){
                alert(translates.del_success);
                window.location.reload()
            }).fail(function(error){
                alert(translates.error);
                console.log(error);
            });
        }
    })

    $('.js-imageUpload').change(function(e){
        e.stopPropagation();
        e.preventDefault();
        var files = this.files;
        var formdata = new FormData();
        $.each( files, function( key, value ){
            console.log(key)
            console.log(value)
            formdata.append( 'profilepicture', value );
        });

        $.ajax({
            url: '/wp-content/themes/sharjahsystem/inc/form/process_upload.php',
            type: 'POST',
            data: formdata,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
        }).done(function(response){
            console.log(response)
            alert(translates.img_upl_success);
            console.log($('.js-imageID').val());
            console.log($('.js-imageID').val() != 0);
            console.log($('.js-imageID').val() != '');
            if ($('.js-imageID').val() == 0 || $('.js-imageID').val() == '' ) {
                $('.js-imageID').val(response.id);
            } else {
                var imgLength = $('.js-imageArr').length;
                $('.js-imgWrap').append('<input type="hidden" name="image-arr-'+imgLength+'" class="js-imageArr" value="'+response.id+'" >');
            }
            // $('.js-imagePath').text(response.str);
            $('.js-imagePic').append('<img src="'+response.str+'" alt="" />');
        }).fail(function(error){
            alert(translates.img_upl_fail);
            console.log(error);
        });
    })

    function insertParam(search, key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);

        var kvp = search.substr(1).split('&');
        var i=0;

        for(; i<kvp.length; i++){
            if (kvp[i].startsWith(key + '=')) {
                let pair = kvp[i].split('=');
                pair[1] = value;
                kvp[i] = pair.join('=');
                break;
            }
        }

        if(i >= kvp.length){
            kvp[kvp.length] = [key,value].join('=');
        }

        // can return this or...
        var params = kvp.join('&');

        // reload page with new params
        return params;
    }

    $('.js-chkSrch').change(function(){
        var postId = $(this).attr('data-id')
        $.each(postIds, function (index, value) {
            if (value.id == postId) {
                value.activated = !value.activated
                return
            }
        });
    })

    $('.js-printSelected').click(function(e){
        e.preventDefault()
        if ($('.js-chkSrch:checked').length == 0) {
            alert(translates.nothing_sel);
        } else {
            var str = '';
            $('.js-chkSrch:checked').each(function(i) {
                if(i != 0) {
                    str = str + ',';
                }
                str = str + $(this).attr('data-id')
            })
            var params = '';
            $('.js-listShowWith:checked').each(function(i) {
                if(i != 0) {
                    params = params + ',';
                }
                params = params + $(this).attr('name')
            })
            if (params != '') {
                params = '&params=' + params;
            }
            window.location.href = '/print-list/?id='+str+params;
        }
    })

    $('.js-printAll').click(function(e){
        e.preventDefault()
        $('.js-chkSrch').prop('checked', true);
        if ($('.js-chkSrch:checked').length == 0) {
            alert(translates.nothing_sel);
        } else {
            var str = '';
            $('.js-chkSrch:checked').each(function(i) {
                if(i != 0) {
                    str = str + ',';
                }
                str = str + $(this).attr('data-id')
            })
            var params = '';
            $('.js-listShowWith:checked').each(function(i) {
                if(i != 0) {
                    params = params + ',';
                }
                params = params + $(this).attr('name')
            })
            if (params != '') {
                params = '&params=' + params;
            }
            window.location.href = '/print-list/?id='+str+params;
        }
    })

    $('.js-delSelected').click(function(e){
        e.preventDefault()
        _this = $(this)
        _this.css('pointer-events', 'none')
        _this.css('opacity', '0.5')
        if ($('.js-chkSrch:checked').length == 0) {
            alert(translates.nothing_sel);
        } else {
            var arr = [];
            $('.js-chkSrch:checked').each(function(i) {
                arr[i] = $(this).attr('data-id')
            })

            var conf = confirm(translates.sure_del);
            if (conf == true) {
                $.ajax({
                    method: 'POST',
                    url: '/wp-content/themes/sharjahsystem/inc/ajax/del-selected.php',
                    data: {
                        ids : arr
                    }
                }).done(function(response){
                    window.location.reload()
                }).fail(function(error){
                    alert(translates.error);
                    _this.css('pointer-events', 'all')
                    _this.css('opacity', '1')
                    console.log(error);
                });
            } else {
                _this.css('pointer-events', 'all')
                _this.css('opacity', '1')
            }
        }
    })

    $('.js-printCheck').change(function(){
        if($(this).prop('checked')) {
            $(this).closest('.js-printCheckWrap').removeClass('non-print');
            $('.js-xlsForm [name="'+$(this).attr('name')+'"]').val($($('[name='+$(this).attr('name')+'].js-printCheck')).attr('data-xls'))
            $('.js-pdfForm [name="'+$(this).attr('name')+'"]').val($($('[name='+$(this).attr('name')+'].js-printCheck')).attr('data-xls'))
        } else {
            $(this).closest('.js-printCheckWrap').addClass('non-print');
            $('.js-xlsForm [name="'+$(this).attr('name')+'"]').val('')
            $('.js-pdfForm [name="'+$(this).attr('name')+'"]').val('')
        }
    })
    $('.js-printSubm').click(function(e){
        e.preventDefault()
        window.print()
    })
    $('.js-printSubmAll').click(function(e){
        e.preventDefault()
        $('.js-printCheck').prop('checked', true)
        $('.js-printCheckWrap').removeClass('non-print');
        $('.js-xlsForm input').each(function(){
            if ($(this).attr('name') != 'name' && $(this).attr('name') != 'img' && $(this).attr('name') != 'img_height' && $(this).attr('name') != 'descr') {
                console.log($(this).attr('name') + '.js-printCheck')
                $(this).val($('[name='+$(this).attr('name')+'].js-printCheck').attr('data-xls'))
            }
        });
        $('.js-pdfForm input').each(function(){
            if ($(this).attr('name') != 'name' && $(this).attr('name') != 'img' && $(this).attr('name') != 'img_height' && $(this).attr('name') != 'descr') {
                console.log($(this).attr('name') + '.js-printCheck')
                $(this).val($('[name='+$(this).attr('name')+'].js-printCheck').attr('data-xls'))
            }
        });
        window.print()
    })
    $('.js-printClear').click(function(e){
        e.preventDefault()
        $('.js-printCheck').prop('checked', false)
        $('.js-printCheckWrap').addClass('non-print');
        $('.js-pdfForm input').each(function(){
            if ($(this).attr('name') != 'name' && $(this).attr('name') != 'img' && $(this).attr('name') != 'img_height' && $(this).attr('name') != 'descr') {
                $(this).val('')
            }
        });
        $('.js-xlsForm input').each(function(){
            if ($(this).attr('name') != 'name' && $(this).attr('name') != 'img' && $(this).attr('name') != 'img_height' && $(this).attr('name') != 'descr') {
                $(this).val('')
            }
        });
    })

    $('.js-xls').click(function(e){
        e.preventDefault();
        $('.js-xlsForm').submit();
    })
    $('.js-xlsFormBtn').click(function(e){
        e.preventDefault();
        $('.js-xlsFormList').submit();
    })

    $('.js-pdf').click(function(e){
        e.preventDefault();
        $('.js-pdfForm').submit();
    })
    $('.js-pdfFormBtn').click(function(e){
        e.preventDefault();
        $('.js-pdfFormList').submit();
    })

    if($('.js-getImgHeight').length > 0) {
        $('.js-getImgHeight').val($('.print-image img').height())
    }

    if($('.js-xlsFormList').length > 0) {
        var search = window.location.search;
        var str = search.slice(1);
        var params = str.split('&')
        $.each(params, function(i, el){
            var parts = el.split('=')
            if (parts[0] == 'id') {
                $('.js-formListId').val(parts[1])
            }
            if (parts[0] == 'params') {
                $('.js-formListParams').val(parts[1])
            }
            if (parts[0] == 'type') {
                $('.js-formListCat').val(parts[1])
            }
            if (parts[0] == 'cat_id') {
                $('.js-formListCatVal').val(parts[1])
            }
        })
    }

    $('.js-showHideBtn').click(function(){
        if ($(this).hasClass('active')) {
            $('.js-showHide').animate({
                height: 168
            })
        } else {
            $('.js-showHide').animate({
                height: 658
            })
        }
        $(this).toggleClass('active')
    })

    $('.js-clearFilt').click(function(e){
        e.preventDefault()
        window.location = window.location.origin+window.location.pathname
    })

    var alphabetLower = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

    $('.js-headerSearch').submit(function(e){
        e.preventDefault()
        var locCode = '';
        var numCode = '';
        var materialCode = '';
        var partCode = '';

        var lang = ($('html').attr('lang') == 'en-US') ? 'en' : 'ar'
        var searchParam = $(this).find('input[type="text"]').val()
        var arrayOfStrings = searchParam.split(' ');
        for (var i = 0; i < arrayOfStrings.length; i++) {
            var symb = arrayOfStrings[i].split('');
            symbNum = symb.length;
            var isUpper = (arrayOfStrings[i] == arrayOfStrings[i].toUpperCase()) ? true : false;
            var isLower = (arrayOfStrings[i] == arrayOfStrings[i].toLowerCase()) ? true : false;
            var isNum = (parseInt(arrayOfStrings[i])) ? true : false;

            if (isUpper && symbNum <= 3 && symbNum > 1 && !isNum) {
                locCode = '&item-num_loc='+arrayOfStrings[i];
            }
            if (isNum) {
                numCode = '&filt_by_from='+arrayOfStrings[i];
            }
            if (isUpper && symbNum == 1 && !isNum) {
                materialCode = '&item-mat='+arrayOfStrings[i];
            }
            if (isLower && symbNum == 1 && !isNum) {
                partCode = '&item-num_part='+arrayOfStrings[i];
            }
            if (isLower && symbNum == 3 && !isNum && symb[1] == '-') {
                partCode = '&item-num_part='+arrayOfStrings[i];
            }
        }
        if(locCode == '' && numCode == '' && materialCode == '' && partCode == '') {
            var locCode = '&item-num_loc='+$(this).find('input[type="text"]').val();
            var numCode = '&filt_by_from='+$(this).find('input[type="text"]').val();
            var numCode = '&item-mat='+$(this).find('input[type="text"]').val();
            var partCode = '&item-num_part='+$(this).find('input[type="text"]').val();
        }

        window.location = window.location.origin+'/'+lang+'/?s='+locCode+''+numCode+''+materialCode+''+partCode
    })


    $('.js-catDel').click(function(e){
        e.preventDefault();
        _this = $(this);
        var isDel = confirm(translates.sure_del_item);

        if (isDel){
            $.ajax({
                method: 'POST',
                url: '/wp-content/themes/sharjahsystem/inc/ajax/cat-delete.php',
                data: {
                    id : _this.attr('data-id'),
                    taxonomy : _this.attr('data-taxonomy')
                }
            }).done(function(response){
                alert(translates.del_success);
                window.location.reload()
            }).fail(function(error){
                alert(translates.error);
                console.log(error);
            });
        }
    })


    $('.js-imageCatUpload').change(function(e){
        e.stopPropagation();
        e.preventDefault();
        var files = this.files;
        var formdata = new FormData();
        $.each( files, function( key, value ){
            console.log(key)
            console.log(value)
            formdata.append( 'profilepicture', value );
        });

        $.ajax({
            url: '/wp-content/themes/sharjahsystem/inc/form/process_upload.php',
            type: 'POST',
            data: formdata,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
        }).done(function(response){
            console.log(response)
            alert(translates.img_upl_success);
            console.log($('.js-imageCatID').val());
            console.log($('.js-imageCatID').val() != 0);
            console.log($('.js-imageCatID').val() != '');
            if ($('.js-imageCatID').val() == 0 || $('.js-imageCatID').val() == '' ) {
                $('.js-imageCatID').val(response.id);
            }
            $('.js-imageCatPic').append('<img src="'+response.str+'" alt="" />');
        }).fail(function(error){
            alert(translates.img_upl_fail);
            console.log(error);
        });
    })


    $('.js-logout').click(function(e){
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: '/wp-content/themes/sharjahsystem/inc/ajax/user-logout.php',
            data: {}
        }).done(function(response){
            window.location.reload()
        }).fail(function(error){
            alert(translates.error);
            console.log(error);
        });
    })

});


