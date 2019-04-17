function removeItemSelect2(element_id, select2_id) {
    var data = $('#' + select2_id).select2('data');
    var new_data = [''];
    for (var i = 0; i < data.length; i++) {
      if (data[i].id != element_id) {
        new_data.push(data[i].id);
      }
    }

    if(new_data.length == 0 || (new_data.length == 1 && new_data[0] == "")) {
        $('#' + select2_id).parents(".form-group").removeClass("custom-selected");
    }

    $('#' + select2_id).val(new_data);
    $('#' + select2_id).trigger('change');
    $('#' + select2_id + '-select2-item-' + element_id).remove();

}

function getStringAddItemSelect2(element_id, element_text, select2_id) {
    return '<div id="' + select2_id + '-select2-item-' + element_id + '" class=\"form-busqueda-filtros-item\" onclick=\"removeItemSelect2(' + element_id + ', \'' + select2_id + '\')\">' + element_text + '<i id=\"fa fa-remove\" class=\"fa fa-remove icono-4x text-gray\" data-clipboard-text=\"fa-remove\"></i></div>'
}

$(document).ready(function(){
    hideLoading();
    $(".showLoadingMenuItem, .showLoadingMenu li").click( showLoadingNewPage );
    $(".showLoading").click( showLoading );
});

function hideLoading() {
    $('#page-loader').css('display', 'block');
    $('#loader').css('display', 'none');
}

function showLoadingNewPage() {
    $('#page-loader').css('display', 'none');
    $('#loader').css('display', 'block');
}

function showLoading() {
    $('#loader').css('display', 'block');
}

function fix_reflow_highcharts() {
    $( ".highcharts-container" ).each(function() {
        var chart = $(this).parent().highcharts();
        if (chart) {
            // console.log("fix_reflow_highcharts");
            chart.reflow();
        }
    });
}
function fix_reflow_amcharts() {
    if (typeof AmCharts != 'undefined') {
        $.each(AmCharts.charts, function(index, value) {
            value.invalidateSize();
        });
    }
}
// $(window).resize(function (e) { // on resize window
//     console.log("resize");
//     fix_reflow_highcharts();
//     fix_reflow_amcharts();
// });
// $(window).resize(function (e) { // on resize window
//     $( ".highcharts-container" ).each(function(index, value) {
//         height = $(value).height();
//         width = $(value).width();
//         console.log('width: ' + width);
//         console.log('height: ' + height);
//         var chart = $(this).parent().highcharts();
//         setTimeout(function() {
//             chart.setSize(width, height, doAnimation = true);
//         }, 1000);
//     });
// });
$(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) { // on tab selection event
    fix_reflow_highcharts();
    fix_reflow_amcharts();
});
$(document).on( 'shown.bs.modal', function (e) { // on tab selection event
    fix_reflow_highcharts();
    fix_reflow_amcharts();
});
$(document).on( 'shown.bs.collapse', function (e) { // on tab selection event
    fix_reflow_highcharts();
    fix_reflow_amcharts();
});

function copyToClipboard(elem) {
     // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

function animateScroll(id) {
    $('html, body').animate({
        scrollTop: $(id).offset().top
    }, 1000);
}