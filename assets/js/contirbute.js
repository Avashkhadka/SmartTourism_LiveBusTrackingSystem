import { getUserLocation } from "../../utils/getUserLocation.js";
import { scrollToTop } from "../../utils/scrollToTop.js";
import { Toast } from "../../utils/toast.js";
const { BASEURL } = window.CONFIG;
export class ContributePage {
    constructor() {
        this.current = 0;
        this.map = null;
        this.marker = null;

        this.container = null;
        this.pinContainers = null;
        this.pinSideBtns = null;
        this.pinBackBtn = null;
        this.pinNextBtn = null;
        this.mapClickData = null;
        this.pinFormContainer = null;
    }

    async init() {
        this.container = document.getElementById("contribute-page-container");

        if (!this.container) return;


        this.pinContainers = document.querySelectorAll(".pin-place-menu");
        this.pinSideBtns = document.querySelectorAll(".pin-a-place-options");
        this.pinBackBtn = document.querySelector("#pin-back");
        this.pinNextBtn = document.querySelector("#pin-next");
        this.pinFormContainer = document.querySelector("#pin-place-menu-container");
        this.pinSubmit = document.querySelector("#pin-submit");
        this.pinProgressBar = document.querySelector("#pin-progress-bar");
        this.latElement = document.querySelector("#pin-place-menu-container #latitude")
        this.lngElement = document.querySelector("#pin-place-menu-container #longitude")


        await this.loadMap();

        this.pinBackBtn?.addEventListener("click", () => {
            this.current = this.current === 0 ? this.current : this.current - 1;
            this.handleChange("prev");
        });

        this.pinNextBtn?.addEventListener("click", () => {
            this.current = this.current < this.pinContainers.length - 1 ? this.current + 1 : this.current;
            this.handleChange("next");
        });

        this.pinFormContainer?.addEventListener("submit", (e) => {
            e.preventDefault();
            this.handleSubmitForm();
            scrollToTop();
        });
    }

    handleChange(action) {
        if (!this.pinContainers || this.pinContainers.length === 0) {
            return;
        }
        if (this.map) {

            setTimeout(() => {
                this.map.invalidateSize();
            }, 100);
        }
        if (action === "next") {
            if (this.current > 0 && this.current < this.pinContainers.length) {
                this.pinContainers[this.current].classList.remove("hidden");
                this.pinContainers[this.current].classList.add("flex", "flex-col");

                this.pinContainers[this.current - 1].classList.add("hidden");
                this.pinContainers[this.current - 1].classList.remove("flex", "flex-col");

            }

            if (this.current === this.pinContainers.length - 1) {
                this.pinSubmit.classList.remove("hidden")
                this.pinNextBtn.classList.add("hidden")
            }
            this.pinProgressBar.style.width = `${(100 / (this.pinContainers.length - 1)) * this.current}%`;
            this.updateSideButtons();
        } else if (action === "prev") {
            if (this.current >= 0 && this.current < this.pinContainers.length) {
                this.pinContainers[this.current].classList.remove("hidden");
                this.pinContainers[this.current].classList.add("flex", "flex-col");
                this.pinSubmit.classList.add("hidden")
                this.pinNextBtn.classList.remove("hidden")

                if (this.pinContainers[this.current + 1]) {
                    this.pinContainers[this.current + 1].classList.add("hidden");
                    this.pinContainers[this.current + 1].classList.remove("flex", "flex-col");
                }
                let wid = (100 / (this.pinContainers.length - 1)) * this.current
                if (!wid) {
                    wid = 10
                }
                this.pinProgressBar.style.width = `${wid}%`;
            }

            this.updateSideButtons();
        }

        scrollToTop();
    }

    updateSideButtons() {
        if (!this.pinSideBtns) return;

        this.pinSideBtns.forEach((element, index) => {
            const number = element.querySelector(".num-pin");

            if (!number) return;

            if (index < this.current) {
                number.classList.add("bgcolor-secondary", "text-white");
                number.classList.remove("active-primary", "bg-white");
            }

            if (index === this.current) {
                number.classList.add("active-primary");
                number.classList.remove("bg-white", "bgcolor-secondary");
            }
            if (index > this.current) {
                number.classList.remove("active-primary", "bgcolor-secondary", "text-white");
                number.classList.add("bg-white");
            }
        });
    }

    async loadMap() {
        try {
            const { latitude, longitude } = await getUserLocation();

            this.map = L.map("pinmap", {
                zoomControl: false,
            }).setView([latitude, longitude], 13);

            L.tileLayer("https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png", {
                maxZoom: 19,
                attribution: "&copy; OpenStreetMap contributors",
            }).addTo(this.map);

            this.map.on("click", (e) => {
                this.mapClickData = e;
                this.handleMapClick();
            })

        } catch (err) {
            console.error("Failed to load map:", err);
        }
    }

    handleMapClick() {

        const { lat, lng } = this.mapClickData.latlng;
        if (this.marker) {
            this.map.removeLayer(this.marker)
        }
        this.marker = L.marker([lat, lng]).addTo(this.map);
        this.latElement.value = lat;
        this.lngElement.value = lng;

    }

    handleSubmitForm() {
        const pinFormData = new FormData(this.pinFormContainer);
        const data = Object.fromEntries(pinFormData.entries());
        data.vibe = pinFormData.getAll("vibe[]")
        data.amenities = pinFormData.getAll("amenities[]")
        console.log(data)
        let error = false;

        for (const [key, value] of pinFormData.entries()) {


            if (key === "amenities[]" || key === "vibe[]") continue;


            if (value instanceof File) continue;

            if (!value?.toString().trim()) {
                Toast(`${key} cannot be empty.`, "Error");
                error = true;

            }
        }

        if (data.amenities.length === 0 || data.vibe.length === 0) {
            Toast("Don't leave any fields empty.", "Error");
            error = true;
        }

        if (data['short_pitch'].length < 30) {
            Toast("Short pitch must be at least 30 characters.", "Error")
            error = true
        }

        console.log(data)
        if (error) return;


        const xhr = new XMLHttpRequest();

        xhr.open("POST", `${BASEURL}/api/contriapi.php`, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {

                    const data = JSON.parse(xhr.responseText);
                    console.log(data)
                    Toast("Added a contribution request", "Success");
                } catch (err) {
                    console.log(xhr.responseText)
                    Toast("Invalid server response", "Error")
                }
            } else {
                Toast("Something went while insertind data", "Error")
            }
        }

        xhr.onerror = function () {
            Toast("Something went while insertind data", "Error")

        }
        xhr.send(pinFormData)




    }
    // Form submission logic here

}

// Create page
export const LoadContribute = async () => {
    const contributePage = new ContributePage();
    await contributePage.init();

    return contributePage;
};
