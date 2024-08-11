function decrement(element, min) {
    var inputField = element.nextElementSibling;
    var value = parseInt(inputField.value);
    if (!isNaN(value) && value > min) {
        inputField.value = value - 1;
    }
}

function increment(element) {
    var inputField = element.previousElementSibling;
    var value = parseInt(inputField.value);
    if (!isNaN(value) ) {
        inputField.value = value + 1;
    }
}

function increment_max(element, max) {
    var inputField = element.previousElementSibling;
    var value = parseInt(inputField.value);
    if (!isNaN(value) && value < max) {
        inputField.value = value + 1;
    }
}

function options() {
    this.submit();
}

$(document).ready(function() {
    $(".nav-link.dropdown-toggle.hide-arrow").click(function() {
        $(this).parent().siblings(".dropdown-menu").toggleClass("show");
    });
});

// Get the price slider element
var slider = document.querySelector('.slider-range-price');

// Get the min and max values from the data attributes
var minPrice = parseInt(slider.getAttribute('data-min'));
var maxPrice = parseInt(slider.getAttribute('data-max'));

// Output the min and max prices
// console.log("Min Price:", minPrice);
// console.log("Max Price:", maxPrice);

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
  
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
  }

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


