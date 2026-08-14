// import * as maplibregl from "https://unpkg.com/maplibre-gl@6.0.0/dist/maplibre-gl.mjs";
import { Card } from "../../components/card.js";
import { Toast } from "../../utils/toast.js";
import { calculateDistance } from "../../utils/calculateDistance.js";

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
    const near_this_place = document.querySelector("#near_this_place");
    const coverImage = document.querySelector("#coverImage")



    try {
        let locationData =
            JSON.parse(localStorage.getItem("locationData")) || [];


        const locations = Array.isArray(locationData)
            ? locationData
            : locationData.location || [];

        const params = new URLSearchParams(window.location.search)
        let location_id = parseInt(params.get("location_id"));
        let thisLocation = locations.find((el) => el.location_id == location_id)
        if (!thisLocation) {
            window.location.href = `${BASEURL}pages/discover.php`
            return;
        }
        locationTitle.innerText = thisLocation.place_name
        locationHeadingTitle.innerText = thisLocation.place_name
        categoryHead.forEach(element => {
            if (element.classList.contains("head")) {
                element.innerText = thisLocation.place_category
            } else {
                element.innerText = thisLocation.place_category.toUpperCase()

            }
        });
        console.log(thisLocation)
        coverImage.src = `../../${JSON.parse(thisLocation.images)[0]}`


        totalDistance.innerHTML = `<i class="fa-solid fa-map-pin" style="color: rgb(255, 0, 0);"></i> ${parseFloat(thisLocation.distance).toFixed(2)} Km away`
        locationDescription.textContent = thisLocation.short_pitch

        busEstfair.innerText = `Rs ${parseInt((thisLocation.distance < 5) ? "25" : 5 * thisLocation.distance)}`
        busETA.innerText = `${Math.round((thisLocation.distance / 20) * 60)} min`



        var map = L.map('map').setView([thisLocation.latitude, thisLocation.longitude], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([thisLocation.latitude, thisLocation.longitude]).addTo(map);
        marker.bindPopup(thisLocation.name).openPopup();


        let nearThisPlaceHtml = ""

        let nearThisLocationArray = locationData.filter((el) => { return el.location_id !== thisLocation.location_id }).map((el) => {
            const distance = calculateDistance(
                thisLocation.latitude,
                thisLocation.longitude,
                el.latitude,
                el.longitude
            )
            return { ...el, nearbyDistance: distance }
        }).sort((a, b) => a.nearbyDistance - b.nearbyDistance).slice(0, 3)

        nearThisLocationArray.forEach((el) => {
            nearThisPlaceHtml += Card(el)
        })
        near_this_place.innerHTML = nearThisPlaceHtml



    } catch (err) {


        console.error(err);
    }
}