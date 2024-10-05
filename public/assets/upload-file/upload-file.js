const isAdvancedUpload = (function () {
    const div = document.createElement('div');
    return (
        ('draggable' in div || ('ondragstart' in div && 'ondrop' in div)) &&
        'FormData' in window &&
        'FileReader' in window
    );
})();

let draggableFileArea = document.querySelector(
    '.upload-files-container .drag-file-area',
);
let browseFileText = document.querySelector(
    '.upload-files-container .browse-files',
);
let dragDropText = document.querySelector(
    '.upload-files-container .dynamic-message',
);
let fileInput = document.querySelector(
    '.upload-files-container .default-file-input',
);
let cannotUploadMessage = document.querySelector(
    '.upload-files-container .cannot-upload-message',
);
let cancelAlertButton = document.querySelector(
    '.upload-files-container .cancel-alert-button',
);
let uploadedFile = document.querySelector(
    '.upload-files-container .file-block',
);
let fileName = document.querySelector('.upload-files-container .file-name');
let fileSize = document.querySelector('.upload-files-container .file-size');
let progressBar = document.querySelector(
    '.upload-files-container .progress-bar',
);
let removeFileButton = document.querySelector(
    '.upload-files-container .remove-file-icon',
);
let uploadButton = document.querySelector('#dp-upload-btn');
let fileFlag = 0;

const validateFileType = (input) => {
    const filePath = input.value;
    const allowedExtensions = /(\.JPG|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Images not in JPG, PNG or GIF');
        input.value = ''; // Clear the input
        return false;
    }
    return true;
};
const addImage = (file) => {
    if (file) {
        // const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = function (event) {
            const src = event.target.result;
            // if (validateFileType(src)) {
            //     console.log(true);
            // }
            $('.upload-files-container #user-image')
                .attr('src', src)
                .removeClass('d-none');
            $('.upload-files-container .upload-icon').addClass('d-none');
            $('.upload-files-container .attach-note').addClass('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        console.log(src, 'not valid');
    }
};
const removeImage = () => {
    $('.upload-files-container #user-image').attr('src', '').addClass('d-none');
    $('.upload-files-container .upload-icon').removeClass('d-none');
    $('.upload-files-container .attach-note').removeClass('d-none');
};

fileInput &&
    fileInput.addEventListener('click', () => {
        fileInput.value = '';
        console.log(fileInput.value);
    });

fileInput &&
    fileInput.addEventListener('change', (e) => {
        console.log('insert image: ' + fileInput.value);
        cancelAlertButton.click();
        uploadButton && (uploadButton.innerHTML = `Upload`);
        fileName.innerHTML = fileInput.files[0].name;
        const imgSize = (fileInput.files[0].size / 1024).toFixed(1);
        if (imgSize > 4999) {
            dragDropText.innerHTML = `[${imgSize}]: Your file size greater then 5MB!`;
            console.warn('Your file size greater then 5MB', imgSize);
            // return;
        } else {
            dragDropText.innerHTML = 'File Dropped Successfully!';
            console.log('file size; ', imgSize);
            addImage(e.target.files[0]);
        }
        fileSize.innerHTML = imgSize + ' KB';
        uploadedFile.style.cssText = 'display: flex;';
        progressBar.style.width = 0;
        fileFlag = 0;
    });

uploadButton &&
    uploadButton.addEventListener('click', () => {
        const uploadedFileWidth = $(
            '.upload-files-container .file-block',
        ).width();
        console.log({ uploadedFileWidth });

        let isFileUploaded = fileInput.value;
        if (isFileUploaded != '') {
            if (fileFlag == 0) {
                fileFlag = 1;
                var width = 0;
                var id = setInterval(frame, 50);
                function frame() {
                    if (width >= (uploadedFileWidth || 390)) {
                        clearInterval(id);
                        uploadButton &&
                            (uploadButton.innerHTML = `<span class=" upload-button-icon"> check_circle </span> Uploaded`);
                    } else {
                        width += 5;
                        progressBar.style.width = width + 'px';
                    }
                }
            }
        } else {
            cannotUploadMessage.style.cssText =
                'display: grid; animation: fadeIn linear 1.5s;';
            console.warn('Please select a file first...');
        }
    });

cancelAlertButton &&
    cancelAlertButton.addEventListener('click', () => {
        cannotUploadMessage.style.cssText = 'display: none;';
    });

if (isAdvancedUpload && draggableFileArea) {
    [
        'drag',
        'dragstart',
        'dragend',
        'dragover',
        'dragenter',
        'dragleave',
        'drop',
    ].forEach((evt) =>
        draggableFileArea.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
        }),
    );

    ['dragover', 'dragenter'].forEach((evt) => {
        draggableFileArea.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dragDropText.innerHTML = 'Drop your file here!';
        });
    });

    draggableFileArea.addEventListener('drop', (e) => {
        cancelAlertButton.click();
        uploadButton && (uploadButton.innerHTML = `Upload Picture`);

        let files = e.dataTransfer.files;
        fileInput.files = files;
        console.log(files[0].name + ' ' + files[0].size);
        console.log(document.querySelector('.default-file-input').value);
        fileName.innerHTML = files[0].name;

        const imgSize = (fileInput.files[0].size / 1024).toFixed(1);
        if (imgSize > 4999) {
            dragDropText.innerHTML = `[${imgSize}]: Your file size greater then 5MB!`;
            console.warn('Your file size greater then 5MB', imgSize);
            // return;
        } else {
            dragDropText.innerHTML = 'File Dropped Successfully!';
            console.log('file size; ', imgSize);
            addImage(files[0]);
        }

        fileSize.innerHTML = (files[0].size / 1024).toFixed(1) + ' KB';
        uploadedFile.style.cssText = 'display: flex;';
        progressBar.style.width = 0;
        fileFlag = 0;
    });
}

removeFileButton &&
    removeFileButton.addEventListener('click', () => {
        uploadedFile.style.cssText = 'display: none;';
        fileInput.value = '';
        dragDropText.innerHTML =
            'Drop a file here to upload <br> Photo must be 5MB or less';
        uploadButton && (uploadButton.innerHTML = `Upload`);
        removeImage();
    });
