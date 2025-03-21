import {CustomWindow} from "@ts/utils.ts";
declare let window: CustomWindow;

export function previewImageUpload(image_input: HTMLInputElement, image_preview: HTMLImageElement) {
    image_input.addEventListener('change', function(event) {
        if (event.target === null || !(event.target instanceof HTMLInputElement)) { throw new Error('Invalid image input event target'); }
        if (!event.target.files) { return; }

        const file = event.target.files[0];
        if (!file) { return; }

        const reader = new FileReader();
        reader.onload = function(event) {
            if (event.target === null) { throw new Error('File reader event target null'); }

            const image_src = event.target.result;
            if (!(typeof image_src === 'string')) { return; }

            image_preview.src = image_src;
        };
        reader.readAsDataURL(file);
    });
}

window.previewImageUpload = previewImageUpload;
