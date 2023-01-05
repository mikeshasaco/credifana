$(document).ready(function () {
    //   estimate page for country code
    const input = document.querySelector(".tel");
    if (input) {
        var iti = window.intlTelInput(input, {
            autoHideDialCode: true,
            separateDialCode: true,
            initialCountry: 'US',
        });
        let target_field = $(input).closest(".country-code").next().find("input");
        input.addEventListener("countrychange", function (e, countryData) {
            $(target_field).val("");
            $(target_field).mask($(this).attr("placeholder").replace(/[0-9]/g, "9"));
            var selectedData = iti.getSelectedCountryData();
            $('#dial-code').val(selectedData.dialCode);
            $('#country-name').val(selectedData.name);
            $('#customer_phone').focus();
        });

        $(target_field).mask($(input).attr("placeholder").replace(/[0-9]/g, "9"));
        
        var selectedData = iti.getSelectedCountryData();
        $('#dial-code').val(selectedData.dialCode);
        $('#country-name').val(selectedData.name);
    }

    $('.question').click(function (e) { 
        e.preventDefault();
        $(this).siblings('.answer').toggle();;
    });

    $(".question-wrapper").click( function () {
        var container = $(this).parents(".accordion");
        var answer = container.find(".answer-wrapper");
        var trigger = container.find(".material-icons.drop");
          var state = container.find(".question-wrapper");
        
        answer.animate({height: "toggle"}, 100);
        
        if (trigger.hasClass("icon-expend")) {
          trigger.removeClass("icon-expend");
              // state.removeClass("active");
        }
        else {
          trigger.addClass("icon-expend");
              // state.addClass("active");
        }
        
        if (container.hasClass("expanded")) {
          container.removeClass("expanded");
        }
        else {
          container.addClass("expanded");
        }
    });

      // $('.navbar-toggler').click(function(){
      //   $(this).siblings('#navbarNav').toggle();
      // })
});