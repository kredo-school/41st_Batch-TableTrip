document.addEventListener('DOMContentLoaded', function () {
    // Main image preview
    const mainImageInput = document.getElementById('main_image');
    const mainImagePreview = document.getElementById('main_image_preview');
    const mainImagePlaceholder = document.getElementById('main_image_placeholder');

    if (mainImageInput && mainImagePreview && mainImagePlaceholder) {
        mainImageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) {
                mainImagePreview.src = '#';
                mainImagePreview.classList.add('d-none');
                mainImagePlaceholder.classList.remove('d-none');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                mainImagePreview.src = e.target.result;
                mainImagePreview.classList.remove('d-none');
                mainImagePlaceholder.classList.add('d-none');
            };

            reader.readAsDataURL(file);
        });
    }

    // Additional images preview
    const additionalImagesInput = document.getElementById('additional_images');
    const additionalImagesPreview = document.getElementById('additional_images_preview');

    if (additionalImagesInput && additionalImagesPreview) {
        additionalImagesInput.addEventListener('change', function (event) {
            additionalImagesPreview.innerHTML = '';

            const files = event.target.files;

            if (!files.length) return;

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const col = document.createElement('div');
                    col.className = 'col-6 col-md-3';

                    col.innerHTML = `
                        <img
                            src="${e.target.result}"
                            alt="Additional image preview"
                            class="img-fluid rounded-3 border"
                            style="width: 100%; height: 120px; object-fit: cover;"
                        >
                    `;

                    additionalImagesPreview.appendChild(col);
                };

                reader.readAsDataURL(file);
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.delete-image-btn');

    buttons.forEach(button => {
        button.addEventListener('click', async () => {
            if (!confirm('Delete this image?')) return;

            const imageId = button.dataset.id;
            const url = button.dataset.url;

            console.log('delete url:', url);

            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Delete failed:', response.status, errorText);
                    alert('削除失敗');
                    return;
                }

                document.getElementById(`image-${imageId}`)?.remove();

            } catch (error) {
                console.error(error);
                alert('エラー発生');
            }
        });
    });
});