/**
 * Global Profile Picture Preview Handler
 */

function handleImagePreview(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const previewImg = document.getElementById('profile_picture_preview');
            const defaultSvg = document.getElementById('default_svg');
            const fileNameDisplay = document.getElementById('file-name');

            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'inline-block';
            }

            if (defaultSvg) {
                defaultSvg.style.display = 'none';
            }

            if (fileNameDisplay) {
                fileNameDisplay.textContent = file.name;
            }
        };

        reader.readAsDataURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const profileInput = document.getElementById('profile_picture');
    
    if (profileInput) {
        profileInput.addEventListener('change', function() {
            handleImagePreview(this);
        });
    }
});