import axios, {AxiosResponse, AxiosStatic} from "axios";
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
    // laravel validation errors
    errors: { [key: string]: any } | undefined;
}

export interface SimpleRequest {}

export async function make_request<T extends SimpleRequest, U extends SimpleResponse>(request: T, endpoint: string): Promise<boolean | U> {
    let ret: boolean | U = true;
    await axios.post(endpoint, request, {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    }).then((response) => {
        ret = handle_response<U>(response);
    }).catch((error) => {
        console.error(error);
        const errors = error.response.data.errors;
        if (errors) {
            for (const key in errors) {
                if (errors.hasOwnProperty(key)) {
                    window.toastr.error(errors[key]);
                }
            }
        }
        ret = false;
    })
    return ret;
}

export function handle_response<T extends SimpleResponse>(response: AxiosResponse<T>): boolean | T {
    if (response.status !== 200) {
        console.error("Unexpected response:" + response.statusText);
        return false;
    }
    const data = response.data;
    const success = data.success;
    const error = data.error;
    if (success) {
        window.toastr.success(success);
        return data;
    }
    if (error) {
        window.toastr.error(error);
        return false;
    }
    return data;
}
