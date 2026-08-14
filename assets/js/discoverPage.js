import { Card } from "../../components/card.js";
import { Toast } from "../../utils/toast.js";
import { calculateDistance } from "../../utils/calculateDistance.js";
import { LoadIntersectionObserver } from "./intersectionObserver.js";
import { getUserLocation } from "../../utils/getUserLocation.js";

const { BASEURL } = window.CONFIG;

const discoverContainer = document.getElementById("discover-container");
const discoverCardContainer = document.querySelector(
    ".discover_card_container"
);

export const loadDiscoverpage = () => {
    if (discoverContainer) {
        fetchLocationData();
    }
};

const fetchLocationData = async () => {
    if (!discoverCardContainer) return;

    discoverCardContainer.style.display = "flex";

    try {
        let locationData =
            JSON.parse(localStorage.getItem("locationData")) || [];
        let lastUpdatedTime = parseInt(sessionStorage.getItem("lastUpdatedTime")) || 0;
        let buff = parseInt((new Date().getTime() - lastUpdatedTime) / (1000 * 60));
        let isNewLocation = false
        if (locationData.length === 0 || buff >= 15) {
            const res = await fetch(
                `${BASEURL}api/location.php/getlocation`,
                {
                    method: "GET",
                    headers: {
                        Authorization:
                            localStorage.getItem("jwtToken") || "",
                    },
                }
            );
            console.log(res)
            if (res.status === 401) {
                Toast(res.statusText, "Error");

                setTimeout(() => {
                    window.location.href = "../global/logout.php";
                }, 2000);

                return;
            }

            if (!res.ok) {
                Toast(res.statusText, "Error");
                return;
            }

            locationData = await res.json();

            localStorage.setItem(
                "locationData",
                JSON.stringify(locationData.location)
            );
            console.log(locationData)
            sessionStorage.setItem(
                "lastUpdatedTime",
                new Date().getTime()
            );
            isNewLocation = true
            console.log(isNewLocation)
        }


        const locations = Array.isArray(locationData)
            ? locationData
            : locationData.location || [];;

        if (!locations.length) {
            discoverCardContainer.innerHTML = `
                <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray">
                    No locations found.
                </div>
            `;
  
            return;
        }

        try {
            const { latitude, longitude } = await getUserLocation();
            try {

                if (isNewLocation) {

                    const locationArr = locations
                        .map((location) => ({
                            ...location,
                            distance: calculateDistance(
                                latitude,
                                longitude,
                                Number(location.latitude),
                                Number(location.longitude)
                            ),
                        }))
                        .sort((a, b) => a.distance - b.distance);



                    localStorage.setItem(
                        "locationData",
                        JSON.stringify(locationArr)
                    );
                    console.log("not that this")
                }

                const locationData = JSON.parse(localStorage.getItem("locationData"))
                const locationArr = Array.isArray(locationData)
                    ? locationData
                    : locationData.location || [];
                let html = "";

                locationArr.forEach((location) => {
                    if (location.distance >= 30) return;
                    console.log(location)
                    html += Card(location)
                });


                discoverCardContainer.style.display = "grid";
                discoverCardContainer.innerHTML = html;


                // Add favorite listeners AFTER DOM is created
                const favButtons = document.querySelectorAll(
                    ".fav-svg-container"
                );

                favButtons.forEach((button) => {
                    button.addEventListener("click", (event) => {
                        const article =
                            event.currentTarget.closest("article");

                        if (!article) return;

                        const locationId =
                            article.dataset.locationId;

                        event.currentTarget.classList.toggle("active");

                        console.log("Favorite:", locationId);
                    });
                });

                // Run AFTER cards are inserted
                LoadIntersectionObserver();
            } catch (error) {
                discoverCardContainer.style.display = "flex";

                discoverCardContainer.innerHTML = `
                    <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray">
                        Something went wrong
                    </div>
                `;

                console.error("Geolocation error:", error);
            }

        } catch (error) {
            discoverCardContainer.style.display = "flex";

            discoverCardContainer.innerHTML = `
                    <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray">
                        Please allow permission to access your location...
                    </div>
                `;

            console.error("Geolocation error:", error);
        }

    } catch (err) {
        discoverCardContainer.style.display = "flex";

        discoverCardContainer.innerHTML = `
            <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray">
                Failed to load data...
            </div>
        `;

        console.error(err);
    }
};