import { getUserLocation } from "../../utils/getUserLocation.js";
const { SOCKETPATH } = window.CONFIG
const busMarkers = new Map();


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
    handleSocket(buses, map);
}



function handleSocket(buses, map) {

    try {

        const socket = new WebSocket(SOCKETPATH);
        let socketTimer = null

        socket.onmessage = (event) => {
            if (socketTimer) clearTimeout(socketTimer)
            const bus = JSON.parse(event.data);
            buses.set(bus.busId, bus);
            // socketTimer = setTimeout(() => {
            for (const [busId, busData] of buses) {
                PopulateMap(busId, busData, map)
            }
            // }, 5000);
        };
    } catch (err) {
        console.log("failed to connect with socket")
    }
}



async function PopulateMap(busId, busData, map) {
    const position = [busData.lat, busData.lng];
    let busDetails = busMarkers.get(busId);
    let marker = busDetails?.marker;
    if (!marker) {

        const busIcon = L.divIcon({
            className: "user-location-marker",
            html: `<div class="bus-location-dot"><i class="fa-solid fa-bus-simple fa-beat" style="color: rgb(255, 255, 255);"></i></div>`,
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        });

        marker = L.marker(position, {
            icon: busIcon
        }).addTo(map);

        let BusDetails = await fetchBusData()
        marker.bindPopup(`
        <div class="flex flex-col gap-2 px4 py-2" >
            <span>
                <strong>   Bus Id:</strong> ${busId}
            </span>
            <span>
                <strong>   Final Destination:</strong> ${BusDetails.route_to}
            </span>
            <span>
                <strong>   No of Seats:</strong> ${BusDetails.seats}
            </span>
            <span>
                 <strong>   Fee:</strong> ${BusDetails.fee}
            </span>
            <button class='text-xs text-white font-semibold rounded-full bg-secondary border-none py-2 px-8'>Book Seat</button>
        </div>
        
        `)
        busMarkers.set(busId, { marker: marker, busDetails: BusDetails });

    } else {

        marker.setLatLng(position);
    }
}


function fetchBusData() {
    // const xhr = new XMLHttpRequest();
    // xhr.open("POST","")
    return {
        "route": "3",
        "route_to": "RNAC",
        "seats": 19,
        "fee": 120,
    }
}


function handleMap(latitude, longitude) {
    var map = L.map('liveMap', { zoomControl: false }).setView([latitude, longitude], 13);
    const A = [27.7172, 85.3240];
    const B = [27.6710, 85.4298];

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
        html: `<div class="user-location-dot"><i class="fa-regular fa-circle-dot fa-beat" style="color: #4285f4;"></i></div>`,
        iconSize: [20, 20],
        iconAnchor: [30, 10]
    });

    L.marker([latitude, longitude], {
        icon: userIcon
    }).addTo(map);

    return map
}