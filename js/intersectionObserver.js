export const LoadIntersectionObserver = () => {
    const elements = document.querySelectorAll("[id]");

    elements.forEach((el) => {
        el.classList.add("fade");
    });

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.2,
        },
    );

    elements.forEach((el) => {
        observer.observe(el);
    });
};
