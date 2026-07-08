export const Toast = (text,style) => {
    return Toastify({
        text: text,
        className: `toast${style} customToast`,
        close: true,
    }).showToast();
};
