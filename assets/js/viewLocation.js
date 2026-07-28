import { calculateDistance } from "./calculateDistance.js";

const { BASEURL } = window.CONFIG;
export const HandleViewLocation = async () => {
    const view_page_container = document.getElementById("view_page_container")
    if (!view_page_container) return;
    const locationTitle = document.getElementById("placeName-head-title");
    const locationHeadingTitle = document.querySelector(".location-heading-title");
    const categoryHead = document.querySelectorAll(".category-head");
    const totalDistance = document.querySelector(".totalDistance");
    const locationDescription = document.querySelector("#location-description");
    const busEstfair = document.querySelector("#busEstfair");
    const busETA = document.querySelector("#busETA");




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

            if (res.status === 409) {
                Toast(res.statusText, "Error");

                setTimeout(() => {
                    window.location.href = "logout.php";
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
                JSON.stringify(locationData)
            );
            sessionStorage.setItem(
                "lastUpdatedTime",
                new Date().getTime()
            );
            isNewLocation = true
        }


        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLat = position.coords.latitude;
                const userLong = position.coords.longitude;
                if (isNewLocation) {
                    console.log(position)
                    const locationArr = locations
                        .map((location) => ({
                            ...location,
                            distance: calculateDistance(
                                userLat,
                                userLong,
                                Number(location.latitude),
                                Number(location.longitude)
                            ),
                        }))
                        .sort((a, b) => a.distance - b.distance);



                    localStorage.setItem(
                        "locationData",
                        JSON.stringify(locationArr)
                    );
                }
            })

        const locationArr = JSON.parse(localStorage.getItem("locationData"))

        const locations = Array.isArray(locationData)
            ? locationData
            : locationData.location || [];
        const params = new URLSearchParams(window.location.search)
        let location_id = parseInt(params.get("location_id"));
        let thisLocation = locations.find((el) => el.location_id == location_id)
        console.log(thisLocation)
        console.log()
        locationTitle.innerText = thisLocation.name
        locationHeadingTitle.innerText = thisLocation.name
        categoryHead.forEach(element => {
            if (element.classList.contains("head")) {
                element.innerText = thisLocation.category
            } else {
                element.innerText = thisLocation.category.toUpperCase()

            }
        });
        totalDistance.innerHTML = `<i class="fa-solid fa-map-pin" style="color: rgb(255, 0, 0);"></i> ${parseFloat(thisLocation.distance).toFixed(2)} Km away`
        locationDescription.textContent = thisLocation.description
        
        busEstfair.innerText = `Rs ${parseInt((thisLocation.distance<5)?"25":5*thisLocation.distance)}`
        busETA.innerText = `${Math.round((thisLocation.distance/20)*60)} min`



    } catch (err) {


        console.error(err);
    }
}