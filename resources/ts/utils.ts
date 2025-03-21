import {AxiosResponse, AxiosStatic} from "axios";
import toastr from "toastr";

export interface CustomWindow extends Window {
    setupProductButtons: any;
    setupCartButtons: any;
    previewImageUpload: (image_input: HTMLInputElement, image_preview: HTMLImageElement) => void;
    axios: AxiosStatic;
    toastr: typeof toastr;
}
declare let window: CustomWindow;

export interface SimpleResponse {
    success: string | undefined;
    error: string | undefined;
}

export function handle_response<T extends SimpleResponse>(response: AxiosResponse<T>): boolean {
    if (response.status !== 200) {
        console.error("Unexpected response:" + response.statusText);
        return false;
    }
    const data = response.data;
    const success = data.success;
    const error = data.error;
    if (success) {
        window.toastr.success(success);
    }
    if (error) {
        window.toastr.error(error);
        return false;
    }
    return true
}
