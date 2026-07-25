export const loadDiscoverpage = () => {
    const favBtn = document.querySelectorAll(".fav-svg-container");
    const favLocation = []
    favBtn.forEach((e) => {
        e.addEventListener("click", (el) => {
            const article = el.currentTarget.closest("article");
            const location_id = article.dataset.locationId
            const index = favLocation.indexOf(location_id)

            if (index == -1) {
                favLocation.push(location_id)
                e.classList.add("active")
            } else {
                favLocation.splice(index, 1);
                e.classList.remove("active")

            }
        })
    })
}