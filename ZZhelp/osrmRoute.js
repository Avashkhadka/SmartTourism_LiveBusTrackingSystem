import { getUserLocation } from "../../utils/getUserLocation.js";

export const handleLiveMap = async () => {
    const liveMapContainer = document.getElementById("live-map-container")
    if (!liveMapContainer) return;
    const { latitude, longitude } = await getUserLocation();

    var map = L.map('liveMap').setView([latitude, longitude], 13);
    const A = [27.7172, 85.3240];
    const B = [27.6710, 85.4298];
    L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            maxZoom: 19,
            attribution: "Tiles &copy; Esri"
        }
    ).addTo(map);

    // Place names + boundaries
    L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}",
        {
            maxZoom: 19,
            attribution: "Labels &copy; Esri"
        }
    ).addTo(map);

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
        iconAnchor: [10, 10]
    });

    L.marker([latitude, longitude], {
        icon: userIcon
    }).addTo(map);

    const url =
        `https://router.project-osrm.org/route/v1/driving/` +
        `${A[1]},${A[0]};${B[1]},${B[0]}` +
        `?overview=full&geometries=geojson`;

    const response = await fetch(url);
    const data = await response.json();
    console.log(data)
    if (data.code !== "Ok") {
        console.error("Route not found");
        return;
    }

    const route = data.routes[0].geometry;

    // Draw actual road route
    L.geoJSON(route, {
        style: {
            color: "blue",
            weight: 5
        }
    }).addTo(map);

    // A marker
    L.marker(A)
        .addTo(map)
        .bindPopup("A");

    // B marker
    L.marker(B)
        .addTo(map)
        .bindPopup("B");


    map.fitBounds(
        L.geoJSON(route).getBounds(),
        { padding: [40, 40] }
    );

}