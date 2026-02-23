import { Jodit } from '../../node_modules/jodit/esm/index.js';

$('.custom-select, .submit, #disabled').on('change', function(){
    $(this).closest("form").submit();
});

$(document).on('click', '.remove-img', function(){
    $(this).closest(".form-group").find('input[name=img-remove]').val(true);
    $(this).closest(".form-group").find('img').remove();
    $(this).remove();
});

$(document).on('click', '.navbar-toggler', function(){
    $($(this).data("bs-target")).toggleClass("show");
});

$("#sortable").sortable({
    update: function(event, ui) {
        $('.card').each(function(i) {
           $(this).find('input').val(i + 1); // updates the data object
        });
    }
});


$(document).on('change', '.join_product', function(){
    if ($(this).val() == 'true') {
        $(this).val('false');
    } else {
        $(this).val('true');
    }
    var select = $(this).val();
    $.ajax({
        url: "/change-select-view/"+select,
        success: function(result){
            $('#addDish .select-view').empty();
            $('#addDish .select-view').append(result);

            $('.dish-category-select').select2({
                dropdownParent: $("#addDish .modal-content"),
            });
            $('.dish-product-select').select2({
                dropdownParent: $("#addDish .modal-content"),
            });
        }
    });
});

$(document).on('change', '.change_join_product', function(){
    if ($(this).val() == 'true') {
        $(this).val('false');
    } else {
        $(this).val('true');
    }
    var select = $(this).val();
    $.ajax({
        url: "/change-select-view/"+select,
        success: function(result){
            $('#changeDish .select-view').empty();
            $('#changeDish .select-view').append(result);

            $('.dish-category-select').select2({
                dropdownParent: $("#changeDish .modal-content"),
            });
            $('.dish-product-select').select2({
                dropdownParent: $("#changeDish .modal-content"),
            });
        }
    });
});

$('.changeDishButton').on('click', function(){
    var id = $(this).data('dish-id');
    $.ajax({
        url: "/change-dish-modal/"+id,
        success: function(result){
            $('#changeDish .modal-content').append( result );

            $('textarea').each(function() {
                const editor = Jodit.make($(this)[0], {
                    "enter": "BR",
                });
            });

            $('#changeDish .dish-category-select').select2({
                dropdownParent: $("#changeDish .modal-content"),
            });

            $('#changeDish .dish-product-select').select2({
                dropdownParent: $("#changeDish .modal-content"),
            });
        }
    });
});

$('#changeDish').on("hide.bs.modal", function() {
	$('#changeDish .modal-content form').remove();
});

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.custom-select').select2();
    $('.settings-select').select2();

    $('.category-select').select2({
        dropdownParent: $("#addCategory .modal-content"),
    });
    $('.dish-category-select').select2({
        dropdownParent: $("#addDish .modal-content"),
    });

    $('.dish-change-select').each(function() {
        var id = $(this).data('id');
        $('.dish-change-select').select2({
            dropdownParent: $("#changeDish_"+id),
        });
        $(this).removeClass('dish-change-select');
    });

    $('textarea').each(function() {
        const editor = Jodit.make($(this)[0], {
            "enter": "BR",
        });
    });
});

$('.category-select').on('change', function(){
    if (~$('.category-select').val().indexOf('sub_courses')) {
        $('#addCategory').find('.hide').addClass('show');
    } else {
        $('#addCategory').find('.hide').removeClass('show');
    }
});

$('#addDish').find('#info').on('change', function(){
    var info = $(this).val();
    if (info != null && info != '') {
        $('#addDish').find('#info_en').prop("required", true);
        $('#addDish').find('#info_de').prop("required", true);
    } else {
        $('#addDish').find('#info_en').prop("required", false);
        $('#addDish').find('#info_de').prop("required", false);
    }
});
$('#addDish').find('#big_desciption').on('change', function(){
    var big_desciption = $(this).val();
    if (big_desciption != null && big_desciption != '') {
        $('#addDish').find('#big_desciption_en').prop("required", true);
        $('#addDish').find('#big_desciption_de').prop("required", true);
    } else {
        $('#addDish').find('#big_desciption_en').prop("required", false);
        $('#addDish').find('#big_desciption_de').prop("required", false);
    }
});
$('#changeDish').find('#info').on('change', function(){
    var info = $(this).val();
    if (info != null && info != '') {
        $('#changeDish').find('#info_en').prop("required", true);
        $('#changeDish').find('#info_de').prop("required", true);
    } else {
        $('#changeDish').find('#info_en').prop("required", false);
        $('#changeDish').find('#info_de').prop("required", false);
    }
});
$('#changeDish').find('#big_desciption').on('change', function(){
    var big_desciption = $(this).val();
    if (big_desciption != null && big_desciption != '') {
        $('#changeDish').find('#big_desciption_en').prop("required", true);
        $('#changeDish').find('#big_desciption_de').prop("required", true);
    } else {
        $('#changeDish').find('#big_desciption_en').prop("required", false);
        $('#changeDish').find('#big_desciption_de').prop("required", false);
    }
});

$('#addDish').find('.btn-primary').on('click', function(){
    if ($('#addDish').find('#info_en').prop("required")) {
        $('#addDish').find('#info_en').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
        $('#addDish').find('#info_de').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
    }
    if ($('#addDish').find('#big_desciption_en').prop("required")) {
        $('#addDish').find('#big_desciption_en').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
        $('#addDish').find('#big_desciption_de').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
    }
});
$('#changeDish').find('.btn-primary').on('click', function(){
    if ($('#changeDish').find('#info_en').prop("required")) {
        $('#changeDish').find('#info_en').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
        $('#changeDish').find('#info_de').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
    }
    if ($('#changeDish').find('#big_desciption_en').prop("required")) {
        $('#changeDish').find('#big_desciption_en').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
        $('#changeDish').find('#big_desciption_de').parent().find('.jodit-container').css({ 'border' : '2px solid red'});
    }
});

$('#addCategory').find('#sub_title').on('change', function(){
    var info = $(this).val();
    if (info != null && info != '') {
        $('#addCategory').find('#sub_title_en').prop("required", true);
        $('#addCategory').find('#sub_title_de').prop("required", true);
    } else {
        $('#addCategory').find('#sub_title_en').prop("required", false);
        $('#addCategory').find('#sub_title_de').prop("required", false);
    }
});
$('#changeCategory').find('#sub_title').on('change', function(){
    var info = $(this).val();
    if (info != null && info != '') {
        $('#changeCategory').find('#sub_title_en').prop("required", true);
        $('#changeCategory').find('#sub_title_de').prop("required", true);
    } else {
        $('#changeCategory').find('#sub_title_en').prop("required", false);
        $('#changeCategory').find('#sub_title_de').prop("required", false);
    }
});
