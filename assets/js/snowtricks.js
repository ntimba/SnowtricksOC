
// create an input with label
function createInputWithLabel(id, type,name, placeholder, labelText) {
    let inputElement = document.createElement('input');
    inputElement.setAttribute('type', type);
    inputElement.setAttribute('name', name);
    inputElement.classList.add('form-control');
    inputElement.setAttribute('id', id);
    inputElement.setAttribute('placeholder', placeholder);

    let labelElement = document.createElement('label');
    labelElement.setAttribute('for', id);
    labelElement.textContent = labelText;

    let container = document.createElement('div');
    container.classList.add('form-floating', 'mt-4', 'mb-2');
    container.appendChild(inputElement);
    container.appendChild(labelElement);

    return container;
}

let imageCount = 0;
let videoCount = 0;

function addImageItem(){
    let imageItem = document.createElement('li');
    imageItem.classList.add('list-group-item');

    let inputFile = createInputWithLabel('formFile' + imageCount, 'file','photos[]', '', '');
    let inputDescription = createInputWithLabel('floatingTextAlt' + imageCount, 'text','description', 'Description image', "Description de l'image");

    imageItem.appendChild(inputFile);
    imageItem.appendChild(inputDescription);

    imageCount++;
    return imageItem;
}


function addVideoItem() {
    let videoItem = document.createElement('li');
    videoItem.classList.add('list-group-item', 'video-item');

    let videoInput = createInputWithLabel('floatingTextAlt' + videoCount, 'text','embed_code[]', 'iframe vidéo', 'iframe de la vidéo');

    videoItem.appendChild(videoInput);
    videoCount++;
    return videoItem;
}

document.addEventListener('DOMContentLoaded', function() {
    let addVideo = document.querySelector('#add-video');
    let addImage = document.querySelector('#add-image');

    let videosList = document.querySelector('#videos-list');
    let imagesList = document.querySelector('#images-list');

    addVideo.addEventListener('click', function() {
        console.log("Ajout d'une nouvelle vidéo");
        let videoItem = addVideoItem();
        videosList.appendChild(videoItem);
    });

    addImage.addEventListener('click', function() {
        console.log("Ajout d'une nouvelle image");
        let imageItem = addImageItem();
        imagesList.appendChild(imageItem);
    });
});

