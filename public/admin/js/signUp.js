
function displaySelectedImage(event) {
    const selectedFile = event.target.files[0];
    const imageContainer = document.getElementById('image-container');
  
    if (selectedFile) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const imageDataUrl = event.target.result;
            imageContainer.innerHTML = '<img src="' + imageDataUrl + '" style="width: 40px; height: 40px; border-radius: 50%;" />';
        };
        reader.readAsDataURL(selectedFile);
    }
  }