export const Toast = (text,style) => {
    return Toastify({
        text: text,
        duration:4000,
        className: `toast${style} customToast`,
        close: true,
    }).showToast();
};
