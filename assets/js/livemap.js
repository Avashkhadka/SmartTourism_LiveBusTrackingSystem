import { getUserLocation } from "../../utils/getUserLocation.js";

export const handleLiveMap = async () => {
    const liveMapContainer = document.getElementById("live-map-container")
    if (!liveMapContainer) return;
    const centerMap = document.getElementById("center-map");
    const { latitude, longitude } = await getUserLocation();
    const map = handleMap(latitude, longitude);
    const buses = new Map();

    centerMap.addEventListener("click", () => {
        map.flyTo([latitude, longitude], 15, {
            duration: 2
        });
    })
    handleSocket(buses);
}



function handleSocket(buses) {
    const socket = new WebSocket("ws://localhost:8080/bus");

    socket.onmessage = (event) => {
        const bus = JSON.parse(event.data);
        buses.set(bus.busId, bus);
        console.log(bus)
        console.log("All buses:", buses);
    };
}


function handleMap(latitude, longitude) {
    var map = L.map('liveMap', { zoomControl: false }).setView([latitude, longitude], 13);
    const A = [27.7172, 85.3240];
    const B = [27.6710, 85.4298];
    // "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
    // "https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png"

    L.tileLayer(
        "https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png",
        {
            maxZoom: 19,
            attribution: "Tiles &copy; Esri"
        }
    ).addTo(map);

    // Place names + boundaries
    // L.tileLayer(
    //     "https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}",
    //     {
    //         maxZoom: 19,
    //         attribution: "Labels &copy; Esri"
    //     }
    // ).addTo(map);

    // Transportation overlay
    // L.tileLayer(
    //     "https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Transportation/MapServer/tile/{z}/{y}/{x}",
    //     {
    //         maxZoom: 19,
    //         attribution: "Roads &copy; Esri"
    //     }
    // ).addTo(map);

    const userIcon = L.divIcon({
        className: "user-location-marker",
        html: `<div class="user-location-dot"></div>`,
        iconSize: [20, 20],
        iconAnchor: [30, 10]
    });

    L.marker([latitude, longitude], {
        icon: userIcon
    }).addTo(map);

    return map
}