

$(function(){
    console.log("start");
    var stepController = new StepController(q_fields);

    $("#bt_next").click(function() {
        stepController.gotoNextStep(1);
    });
    $("#bt_back").click(function() {
        stepController.gotoNextStep(-1);
    });

    $('input[type="checkbox"]').on("change", function(){
        stepController.buttonControl();
    });
    $('input[type="text"]').on("change", function(){
        stepController.buttonControl();
    });
    $('.input.radio input').on("change", function(){

        stepController.buttonControl();
    });
    $('.form_q_term_wish .input.radio label').on("click", function(e){
        var currentId = $(this).attr("for");
        var checkedId = $(this).parents('.input.radio').find('input:checked').attr("id");
        if(currentId == checkedId){
            $("#"+checkedId).prop("checked",false);
            $(".form_q_term_wish .input.radio input").prop("checked",false);
            e.preventDefault();
        }

    });
    $("select").on("change",function(){
        stepController.buttonControl();
    });
    stepController.cookieGet();
    stepController.stepin();


    $("#zip-code").on("change",function(){
        var value = $(this).val();
        value = zenToHan(value);
        value = value.replace(/-/g,'');
        stepController.get_zip(value);
        $(this).val(value);

    });
    $("#zip-code").on('keyup',function(){
        if($(".form_q_zip_code .error_block").is(':visible') == true){
            if($(this).val() == ''){
                ($(".form_q_zip_code .error_block").hide())
            }
        }
        if($(this).val().length >= 7){
            var value = $(this).val();
            value = zenToHan(value);
            value = value.replace(/-/g,'');
            stepController.get_zip(value);
            $(this).val(value);
        }
    });

    $("#tel").on("change",function(){
        var value = $(this).val();
        value = zenToHan(value);
        value = value.replace(/-/g,'');
        stepController.get_zip(value);
        $(this).val(value);

    });

    $("#address-prefecture").on("change",function(){
        if($(this).val()=='' || $(this).val() == false){
            $("#address-city").html('<option>----</option>');
            $("#address-city").prop('disabled',true);
        }else{
            stepController.get_pref($(this).val(),false,null);
            $("#address-city").prop('disabled',false);
        }
    });
});



var StepController = function(fields) {
    this.current_step = 1;
    this.current_validate = false;
    this.max_step = 5;
    this.fields = fields;
    this.thisOjb = this;

    this.gotoNextStep = function(step){
        var thisObj = this;
        var nextStep = this.current_step+step;

        if(step > 0) {
            this.checkValidation();
        }

        if(step > 0 && this.current_validate == false){

            return ;
        }


        if(this.max_step >= nextStep){
            $(".form_step_"+this.current_step).fadeOut(300,function(){

                thisObj.current_step = nextStep;
                thisObj.stepin();
                ///thisObj.checkValidation();
                thisObj.buttonControl();
                $(".error_block").hide();
                thisObj.cookieSet();
                $("#main_container_content").removeClass();
                $("#main_container_content").addClass('step_'+nextStep);

                $(".form_step_"+nextStep).fadeIn(300,
                    function(){
                       /// thisObj.checkValidation();

                        footerFix();

                        if(thisObj.current_step == 3){
                            if($('select[name="address_city"]').val() == '' || $('select[name="address_city"]').val() == false){
                                thisObj.get_pref($("#address-prefecture").val(), false,null);
                            }

                        }
                    }
                );

            });
        }else{
            thisObj.buttonControl();
            thisObj.cookieSet();
            $("#form1").submit();
        }
    }



    this.buttonControl = function(){
        if(this.current_step > 1){
            $("#bt_back").show();
        }else{
            $("#bt_back").hide();
        }
        if(this.current_step == this.max_step){
            $("#bt_next img").attr("src", "/img/shared/bt_complete.png");
        }else{
            $("#bt_next img").attr("src", "/img/shared/bt_next.png");
        }
        /*
        if(this.current_validate==true){
            $("#bt_next img").attr("src", "/img/shared/bt_next.png");
            if(this.current_step == this.max_step){
                $("#bt_next img").attr("src", "/img/shared/bt_complete.png");
            }else{

            }
        }else{
            $("#bt_next img").attr("src", "/img/shared/bt_next_off.png");
        }*/

    }

    this.checkValidation = function(){
        var validate = false;
        var invalidCount = 0;
        var step = this.current_step;
        if(step == 1){
            $('input[name="has_license"]').each(function(){
               if($(this).is(":checked")){
                   validate = true;
               }
            });
            var error_block = $(".form_step_"+this.current_step+' .form_q_has_license').find(".error_block");
            if(validate==false){
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }
        }else if(step == 2){
            $('input[name="work_style"]').each(function(){
                if($(this).is(":checked")){
                    validate = true;
                }
            });
            var error_block = $(".form_step_"+this.current_step+' .form_q_work_style').find(".error_block");
            if(validate==false){
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }
        }else if(step == 3){
            validate = false;
            var validMessage = '';
            if($('select[name="address_prefecture"]').val() != ""){
                validate = true;
            }
            var error_block = $(".form_step_"+this.current_step+' .form_q_address_prefecture').find(".error_block");
            if(validate==false){
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }


            validate = false;
            var validMessage = '';
            if($('select[name="address_city"]').val() != false && $('select[name="address_city"]').val() != ""){
                validate = true;
            }
            var error_block = $(".form_step_"+this.current_step+' .form_q_address_city').find(".error_block");
            if(validate==false){
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }


        }else if(step == 4){
            validate = false;
            var validMessage = '';
            if($('input[name="name"]').val() == ""){
                validMessage = 'お名前を入力してください';
            }else if(!$('input[name="name"]').val().match(/^[^\x01-\x7E\xA1-\xDF]+$/)){
                validMessage = 'お名前に使用できるのは漢字、ひらがな、カタカナのみです。';
            }else{
                validate = true;
            }
            var error_block = $(".form_step_"+this.current_step+' .form_q_name').find(".error_block");
            if(validate==false){
                $(error_block).find('p').html(validMessage);
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }


            validate = true;
            if($('select[name="birthday_year"]').val() == "" || $('select[name="birthday_month"]').val() == "" ||
                $('select[name="birthday_year"]').val() ==  false || $('select[name="birthday_month"]').val() == false){
                validate = false;

            }
            var error_block = $(".form_step_"+this.current_step+' .form_q_birthday').find(".error_block");
            if(validate==false){
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }
        }else if(step == 5){
            validate = true;
            var validMessage = '';
            if($('input[name="tel"]').val() == ""){
                validate = false;
                validMessage = '電話番号を入力してください';
            }else{
                var inputVal = $('input[name="tel"]').val();
                inputVal = zenToHan(inputVal);
                var numOnly = inputVal.replace(/-/g,'');
                inputVal = numOnly;
                $('input[name="tel"]').val(numOnly);

                if(!inputVal.match(/^([0-9-]+)[0-9]$/)){
                    validate = false;
                    validMessage = '電話番号に使用できるのは数字と-（ハイフン）、のみです';
                }else{
                    if(numOnly.length<10) {
                        validate = false;
                        validMessage = '電話番号の桁数が足りていません';
                    }
                    if(numOnly.length>11) {
                        validate = false;
                        validMessage = '電話番号の桁数が多すぎます';
                    }
                }
                $('input[name="tel"]').val(inputVal);
            }
            var error_block = $(".form_step_"+this.current_step+' .form_q_tel').find(".error_block");
            if(validate==false){
                $(error_block).find('p').html(validMessage);
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }

            validate = true;
            if($('input[name="email"]').val() != "" && checkMailaddressFormat($('input[name="email"]').val()) == false){
                validate = false;
                validMessage = 'メールアドレスを正しく入力してください';
            }
            var error_block = $(".form_step_"+this.current_step+' .form_q_email').find(".error_block");
            if(validate==false){
                $(error_block).find('p').html(validMessage);
                $(error_block).show();
                invalidCount++;
            }else{
                $(error_block).hide();
            }

        }
        if(invalidCount>0){
            this.current_validate = false;
        }else{
            this.current_validate = true;
        }
        return validate;
    }

    this.stepin = function(){
        var sendval = this.current_step;
        $.ajax({
            type: "GET",
            url: "/form_api?m=stepin&s="+sendval,
            dataType: "JSON",
            success: function(result){
                console.log(result);
                if(result['result']){


                }else{
                }
            },
            error: function(e){
                console.log(e);
            }

        });
    }


    this.cookieSet = function(){
        var answer_params = {};

        $.each(this.fields, function(idx, name){
            console.log($('input[name="'+name+'"]').length, name,$('input[name="'+name+'"]'));
            if($('input[name="'+name+'"]').length>0){
                var target = $('input[name="'+name+'"]').last();
                var type = target.attr("type");
                if(type == "checkbox"){
                    var checkedValues = [];
                    $('input[name="'+name+'"]').each(function(){
                        if($(this).attr("type")=='checkbox' && $(this).is(":checked")){
                            checkedValues.push($(this).val());
                        }
                    });
                    answer_params[name] = checkedValues;
                }else if(type == "radio"){
                    var checkedValues = [];
                    $('input[name="'+name+'"]').each(function(){
                        if($(this).attr("type")=='radio' && $(this).is(":checked")){
                            checkedValues.push($(this).val());
                        }
                    });
                    answer_params[name] = checkedValues;
                }else if(type == "text"){
                    var checkedValues = [];
                    console.log($(target));
                    checkedValues.push($(target).val());
                    answer_params[name] = checkedValues;
                }
            }
            if($('select[name="'+name+'"]').length>0) {

                var target = $('select[name="'+name+'"]').last();
                var checkedValues = [];
                checkedValues.push($(target).val());
                answer_params[name] = checkedValues;
            }
        });

        console.log(answer_params);
        var answer_params_str = JSON.stringify(answer_params);
        docCookies.setItem("answer_params", answer_params_str);
    }


    this.cookieGet = function() {
        var answer_params_str = docCookies.getItem("answer_params");
        var answer_params = JSON.parse(answer_params_str);
        var thisObj = this;

        console.log(answer_params);
        if (answer_params == null) {
            answer_params = { 'work_style': ['常勤（日勤のみ）'], 'address_prefecture': ['東京都']};
            var answer_params_str = JSON.stringify(answer_params);
            docCookies.setItem("answer_params", answer_params_str);
        }

        if (answer_params['address_prefecture'] && answer_params['address_city'] ) {
            this.get_pref(answer_params['address_prefecture'], false, function(){
                console.log('call city set get');
                $('select[name="address_city"]').val(answer_params['address_city']);
            });
        }
        thisObj.cookieGetProcess();
    }

    this.cookieGetProcess = function(){
        var answer_params_str = docCookies.getItem("answer_params");
        var answer_params = JSON.parse(answer_params_str);


        $.each(answer_params, function(name,values){
            if(values.length > 0) {
                if ($('input[name="' + name + '"]').length > 0) {
                    var target = $('input[name="' + name + '"]').last();
                    var type = target.attr("type");
                    if (type == "checkbox") {
                        $('input[name="' + name + '"]').each(function () {
                            var targetInput = $(this);
                            $.each(values, function (idx, value) {
                                if ($(targetInput).val() == value) {
                                    $(targetInput).prop("checked", true);
                                }
                            });
                        });
                    } else if (type == "radio") {
                        $('input[name="' + name + '"]').each(function () {
                            var targetInput = $(this);
                            $.each(values, function (idx, value) {
                                console.log(idx, value);
                                if ($(targetInput).val() == value) {
                                    $(targetInput).prop("checked", true);
                                }
                            });
                        });
                    } else if (type == "text") {

                        $(target).val(values[0]);
                    }
                }

                if ($('select[name="' + name + '"]').length > 0) {
                    var target = $('select[name="' + name + '"]').last();
                    $(target).val(values[0]);
                }
            }
        });
    }


    this.get_zip = function(sendval){
        var thisObj = this;
        $.ajax({
            type: "GET",
            url: "/form_api?m=zipcode&s="+sendval,
            dataType: "JSON",
            success: function(data){
                console.log(data);
                if(data['result']){
                    $("#address-prefecture").val(data['result']['state']);

                    thisObj.get_pref(data['result']['state'],false, function(){
                        $("#address-city").val(data['result']['city']);
                    });

                    $(".form_q_zip_code .error_block").hide();


                }else{
                    $(".form_q_zip_code .error_block").show();
                }
            },
            error: function(e){
                console.log(e);
                $(".form_q_zip_code .error_block").show();
            }

        });
    }


    this.get_pref = function(sendval, valid, callback){
        var thisObj = this;
        $.ajax({
            type: "GET",
            url: "/form_api?m=pref&s="+sendval,
            dataType: "JSON",
            success: function(result){
                console.log(result);
                if(result['result']){
                    $("#address-city").prop('disabled',false);
                    $("#address-city").html('');
                    $("#address-city").append('<option value="">選択してください</option>');
                    $.each(result['result'], function(idx, data){
                        $("#address-city").append('<option value="'+data['city']+'">'+data['city']+'</option>');
                    });
                    $(".form_q_address_prefecture .error_block").hide();

                    if(callback != null){
                        callback();
                    }

                    if(valid==true){
                        thisObj.checkValidation();

                    }
                }else{
                }
            },
            error: function(e){
                console.log(e);
            }

        });
    }

};
