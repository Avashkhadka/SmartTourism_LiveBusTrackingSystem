export function scrollToTop(top = 0) {
    window.scrollTo({
        top: top,
        behavior: "smooth",
    });
}