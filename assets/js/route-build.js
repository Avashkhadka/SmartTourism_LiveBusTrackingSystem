import { calculateDistance } from "../../utils/calculateDistance.js";
import { getUserLocation } from "../../utils/getUserLocation.js";
import { Toast } from "../../utils/toast.js";
const { BASEURL } = window.CONFIG;
class RouteBuilder {
    constructor() {
        this.map = null;
        this.mapClickData = null;
        this.marker = null;
        this.latElement = null;
        this.lngElement = null;
        this.mapStopPoints = [];
        this.markers = [];
        this.routeLine = null;
        this.totalDistance = 0;

        this.totalStopsElem = document.getElementById("totalStops")
        this.totalDistanceElem = document.getElementById("totalDistance")
        this.estTravelElem = document.getElementById("estTravel")
        this.stopsListsElem = document.getElementById("stopsLists")
        this.routeBuilderControl = document.getElementById("route-builder-control");

        this.handleAction();
    }

    handleAction() {
        this.routeBuilderControl.addEventListener("click", (e) => {
            const button = e.target.closest("button");
            if (!button) return;

            if (button.innerText === "Undo") {
                this.undoPoint();
            }

            if (button.innerText === "Clear") {
                this.clearPoints();
            }

            if (button.innerText === "Save Route") {
                this.saveRoute();
            }
        })
    }


    async saveRoute() {
        const routeName = document.getElementById("route_name").value.trim();

        if (!routeName) {
            Toast("Enter route name", "Error");
            return;
        }

        if (this.mapStopPoints.length < 2) {
            Toast("Add at least 2 stops", "Error");
            return;
        }

        const routeData = new FormData();

        routeData.append("action", "saveRoute");
        routeData.append("route_name", routeName);
        routeData.append("distance", this.totalDistance.toFixed(2));
        routeData.append("total_stops", this.mapStopPoints.length);
        routeData.append("est_travel", Math.round((this.totalDistance / 20) * 60));
        routeData.append("route_stops", JSON.stringify(this.mapStopPoints));

        try {
            const response = await fetch(`${BASEURL}api/main.php`, {
                method: "POST",

                body: routeData
            });

            const result = await response.json();
            if (result.status == 200) {
                Toast("Route saved successfully", "Success");
                this.clearPoints();
                document.getElementById("route_name").value = "";
            } else {
                Toast(result.message || "Failed to save route", "Error");
            }
        } catch (err) {
            console.error("Save route failed:", err);
            Toast("Something went wrong", "Error");
        }
    }

    async loadMap() {
        try {
            const { latitude, longitude } = await getUserLocation();

            this.map = L.map("routeBuilderMap", {
                zoomControl: false,
            }).setView([latitude, longitude], 13);

            L.tileLayer("https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png", {
                maxZoom: 19,
                attribution: "&copy; OpenStreetMap contributors",
            }).addTo(this.map);

            this.map.on("click", (e) => {
                this.mapClickData = e;
                this.handleMapClick();
            });
        } catch (err) {
            console.error("Failed to load map:", err);
        }
    }

    handleMapClick() {
        const { lat, lng } = this.mapClickData.latlng;

        this.mapStopPoints.push({ lat, lng });

        const marker = L.marker([lat, lng], {
            icon: L.divIcon({
                className: "route-marker",
                html: /*html*/`<div class="w-8 h-8 rounded-full bg-white flex justify-center items-center"><div class="w-6 h-6 rounded-full font-bold bg-secondary flex justify-center items-center text-white">${this.mapStopPoints.length}</div></div>`,
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            })
        }).addTo(this.map);



        this.markers.push(marker);

        if (this.routeLine) {
            this.map.removeLayer(this.routeLine);
        }

        this.routeLine = L.polyline(
            this.mapStopPoints.map(point => [point.lat, point.lng])
        ).addTo(this.map);

        if (this.mapStopPoints.length > 1) {
            const previous = this.mapStopPoints[this.mapStopPoints.length - 2];
            const current = this.mapStopPoints[this.mapStopPoints.length - 1];

            this.totalDistance += calculateDistance(
                previous.lat,
                previous.lng,
                current.lat,
                current.lng
            );

        }

        this.handleUpdatedPoints()



    }



    handleUpdatedPoints() {

        this.totalDistanceElem.innerText = `${this.totalDistance.toFixed(2)} km`;
        this.estTravelElem.innerText = `${Math.round((this.totalDistance / 20) * 60)} min`
        this.totalStopsElem.innerText = this.mapStopPoints.length;

        let listPointHtml = "";

        this.mapStopPoints.forEach((el, i) => {
            listPointHtml += /*html*/`
                
                <div class="flex gap-4 items-center border-gray p-4 bg-white rounded-2xl ">
                    <div
                        class=" h-6 w-6 rounded-full text-white bg-secondary flex justify-center items center font-bold">
                        ${i + 1}</div>
                    <div class="flex flex-col gap-2">
                        <div class='text-base font-bold'>Stop ${i + 1}</div>
                        <div class="color-gray">${el.lat.toFixed(4)}, ${el.lng.toFixed(4)}</div>
                    </div>
                </div>
            `
        })

        this.stopsListsElem.innerHTML = listPointHtml

    }


    undoPoint() {
        if (this.mapStopPoints.length === 0) return;

        this.mapStopPoints.pop();

        const marker = this.markers.pop();
        if (marker) {
            this.map.removeLayer(marker);
        }

        if (this.routeLine) {
            this.map.removeLayer(this.routeLine);
            this.routeLine = null;
        }

        if (this.mapStopPoints.length > 1) {
            this.routeLine = L.polyline(
                this.mapStopPoints.map(point => [point.lat, point.lng])
            ).addTo(this.map);
        }
        this.handleUpdatedPoints();
        console.log(this.mapStopPoints);
    }

    clearPoints() {
        this.totalDistanceElem.innerText = `0.00 km`;
        this.estTravelElem.innerText = `0 min`
        this.totalStopsElem.innerText = 0;

        this.markers.forEach(marker => {
            this.map.removeLayer(marker);
        });

        if (this.routeLine) {
            this.map.removeLayer(this.routeLine);
        }

        this.mapStopPoints = [];
        this.markers = [];
        this.routeLine = null;

        this.handleUpdatedPoints();
        console.log(this.mapStopPoints);
    }
}

export const LoadRouteBuild = () => {
    const container = document.getElementById("routeBuilder");
    if (!container) return;

    const routeBuilder = new RouteBuilder();
    routeBuilder.loadMap();
};