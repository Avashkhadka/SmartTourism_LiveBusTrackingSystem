import { getUserLocation } from "../../utils/getUserLocation.js";
import { scrollToTop } from "../../utils/scrollToTop.js";
import { Toast } from "../../utils/toast.js";
const { BASEURL } = window.CONFIG;
export class ContributePage {
    constructor() {
        this.current = 0;
        this.map = null;

        this.container = null;
        this.pinContainers = null;
        this.pinSideBtns = null;
        this.pinBackBtn = null;
        this.pinNextBtn = null;
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
        } catch (err) {
            console.error("Failed to load map:", err);
        }
    }

    async handleSubmitForm() {
        const pinFormData = new FormData(this.pinFormContainer);
        const data = Object.fromEntries(pinFormData.entries());
        console.log(data)
        let error = false;




        console.log(data)
        if (error) return;
        try {
            const res = await fetch(`${BASEURL}/api/contribute.php`, {
                method: "POST",
                body: pinFormData
            })
            if (res.status == 200) {
                const data = await res.json();
                console.log(data)
                Toast("Added a contribution request", "Success");
            } else {
                Toast("Something went while insertind data", "Error")
            }


        } catch (err) {
            console.log(err)
        }
        // Form submission logic here
    }
}

// Create page
export const LoadContribute = async () => {
    const contributePage = new ContributePage();
    await contributePage.init();

    return contributePage;
};
