import { calculateDistance } from "./calculateDistance.js";
import { LoadIntersectionObserver } from "./intersectionObserver.js";

const { BASEURL } = window.CONFIG;

const favBtn = document.querySelectorAll(".fav-svg-container");
const discoverContainer = document.getElementById("discover-container");
const discoverCardContainer = document.querySelector(".discover_card_container");


export const loadDiscoverpage = () => {
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
    if (discoverContainer) {
        fetchLocationData();
    }

}


const fetchLocationData = async () => {
    discoverCardContainer.style.display = "flex";
    try {

        let res = await fetch(`${BASEURL}api/location.php/getlocation`, {
            method: "GET",
            headers: {
                "Authorization": localStorage.getItem("jwtToken"),
            }
        });
        let data = await res.json();

        let UserCoordinate = {}

        navigator.geolocation.getCurrentPosition((p) => {
            UserCoordinate.lat = p.coords.latitude;
            UserCoordinate.long = p.coords.longitude;


            if (res.status == 200) {

                const locationArr = data.location
                    .map((i) => ({
                        ...i,
                        distance: calculateDistance(
                            UserCoordinate.lat,
                            UserCoordinate.long,
                            i.latitude,
                            i.longitude
                        )
                    }))
                    .sort((a, b) => a.distance - b.distance);

                if (discoverCardContainer) {
                    let html = "";
                    locationArr.forEach((i) => {
                        if (i.distance < 30) {

                            html +=/*html*/`
                            <article class="w-full reveal card rounded-2xl overflow-hidden shadow-lg"
                            data-location-id="<?php echo $i ?>">
                                <div class="relative">
                                    <img src="../assets/images/signin-bg.jpg" loading="lazy" alt="" class="w-full">
                                    <div class="absolute inset-0 h-full w-full p-4">
                                        <div class="flex justify-between items-center">
                                            <div class="bg-white py-2 px-4 block text-xs font-bold rounded-full">${i.category}</div>
                                            <div
                                                class="bg-white p-2 block text-lg font-bold rounded-full flex justify-center items-center fav-svg-container">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24"
                                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:cc="http://creativecommons.org/ns#"
                                                    xmlns:dc="http://purl.org/dc/elements/1.1/">
                                                    <g transform="translate(0 -1028.4)">
                                                        <path
                                                            d="m7 1031.4c-1.5355 0-3.0784 0.5-4.25 1.7-2.3431 2.4-2.2788 6.1 0 8.5l9.25 9.8 9.25-9.8c2.279-2.4 2.343-6.1 0-8.5-2.343-2.3-6.157-2.3-8.5 0l-0.75 0.8-0.75-0.8c-1.172-1.2-2.7145-1.7-4.25-1.7z" />
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                        <div></div>
                                    </div>
                                </div>

                                <div class="w-full p-6">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-semibold text-md color-black">${i.name}</h3>
                                        <h3 class="font-medium text-xs  color-gray">${i.distance.toFixed(2)} km</h3>
                                    </div>
                                    <p class="text-xs color-gray font-medium my-4 ">${i.description}</p>
                                    <div class="w-full mb-4" style=" border: 1px solid var(--border-gray);"></div>
                                    <div class="justify-between flex items-center">
                                        <a class="border-gray flex items-center bg-white py-1 h-8 px-3 text-xs rounded-full curser-pointer no-underline text-black font-medium"
                                            href="live-map.php">Moderate. Rs1000</a> <a
                                            class="border-gray text-white px-4  py-1 h-10 flex items-center text-sm rounded-full curser-pointer no-underline text-black font-medium active-category"
                                            href="live-map.php">Details</a>

                                    </div>
                                </div>


                            </article>
        
                        `
                        }
                    })

                    discoverCardContainer.style.display = "grid";
                    discoverCardContainer.innerHTML = html
                      LoadIntersectionObserver();
                }
            }
        }, (e) => {
            discoverCardContainer.style.display = "flex"
            discoverCardContainer.innerHTML = "<div class='w-full p-16 text-black rounded-lg text-lg text-center border-gray'>Please Allow Permission to access your location...</div>"
            console.log("error:", e)
        })

        // } else {
        //     throw new Error(data.error)
        // }


    }
    catch (err) {

        discoverCardContainer.style.display = "flex";
        discoverCardContainer.innerHTML = `
            <div  class='w-full p-16 text-black rounded-lg text-lg text-center border-gray'>
                Failed to load data...
            </div>
        `;
        console.log(err);
    }
}