import { getUserLocation } from "../../utils/getUserLocation.js";

export const LoadContribute = async() => {
    const container = document.getElementById("contribute-page-container");
    if (!container) return;

    const {latitude,longitude} = await getUserLocation()

   var map = L.map('pinmap', { zoomControl: false }).setView([latitude, longitude], 13);
    L.tileLayer(
        "https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png",
        {
            maxZoom: 19,
            attribution: "Tiles &copy; Esri"
        }
    ).addTo(map);

}