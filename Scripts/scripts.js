
// Prevent add products form from submission if is invalid
$('form#productForm').submit(function () {
    if ($('#productProductImages').hasClass('is-invalid')) {
        alert("Please select valid files before submission.");
        return false;
    }
});

// Check validity of uploaded product images
let productImagesSelector = $('#productProductImages');
let productImagesFeedbackField = $('#productProductImagesFeedback');
productImagesSelector.change(function () {
    let totalSize = 0;
    let allowedMIME = [
        'image/jpeg',
        'image/png',
        'image/gif'
    ];
    let error = false;
    $.each(productImagesSelector[0].files, function (i, file) {
        //Check filetype
        if (!allowedMIME.includes(file.type)) {
            productImagesFeedbackField.text("Only images of jpg/jpeg, png or gif formats are allowed");
            productImagesSelector.addClass('is-invalid');
            error = true;
            return false;
        }

        //Check file size
        if (file.size > 2000000) {
            productImagesFeedbackField.text("Maximum size of a single file should below 2M");
            productImagesSelector.addClass('is-invalid');
            error = true;
            return false;
        }

        totalSize += file.size;
    });

    //Check total size of all selected files
    if (totalSize > 7000000) {
        productImagesFeedbackField.text("Maximum size of all files combined cannot exceed 7M");
        productImagesSelector.addClass('is-invalid');
        error = true;
        return false;
    }

    if (!error) productImagesSelector.removeClass('is-invalid');
});


