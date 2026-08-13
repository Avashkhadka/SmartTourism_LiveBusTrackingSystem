import { AddText } from "../../utils/addText.js";
import { Toast } from "../../utils/toast.js";

const { BASEURL, SOCKETPATH } = window.CONFIG;
const headCardTitle = ["SHIFT STATUS","NEXT TRIP"];

class DriverDashboard {
    constructor() {
        this.container = document.getElementById("drivers-dashboard");
        this.dashboardControls = document.getElementById("dashboard-control");
        this.cardContainer = document.getElementById("driver-dashboard-card-container");
        this.socket = null;
        this.watchId = null;
        this.DriverData = null;
    }

    async init() {
        if (!this.container || !this.dashboardControls || !this.cardContainer) return;

        this.renderDriverCard();
         AddText("#head-card-driver-0", "Offline");
        try {
            this.DriverData = await this.fetchDriverData();
            this.socket = new WebSocket(SOCKETPATH);

            this.socket.onerror = (error) => {
                console.error("WebSocket error:", error);
                Toast("WebSocket connection error", "Error");
            };

            this.dashboardControls.addEventListener("click", (e) => {
                const button = e.target.closest("button");
                if (!button) return;

                switch (button.innerText.trim()) {
                    case "Edit Profile":
                        break;
                    case "Pause Shift":
                        this.pauseShift();
                        break;
                    case "Go Online":
                        this.goLive();
                        break;
                }
            });
        } catch (err) {
            console.error("Dashboard error:", err);
            Toast("Failed to load driver dashboard", "Error");
        }
    }

    renderDriverCard() {
        this.cardContainer.innerHTML = headCardTitle.map((title, i) => /*html*/`
            <div class="border-gray bg-white p-4 flex flex-col gap-2 rounded-xl">
                <div class="color-gray font-medium">${title}</div>
                <div  id='head-card-driver-${i}' class='font-bold text-2xl'></div>
                <div class='text-green-500 text-sm'> <span>On Duty</span> - <span>2h 14m</span></div>
            </div>
        `).join("");
    }

    fetchDriverData() {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `${BASEURL}api/main.php?action=get-driver-details`, true);
            xhr.setRequestHeader("Authorization", localStorage.getItem("jwtToken"));
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onload = () => {
                console.log(xhr.responseText);
                if (xhr.status === 200) {
                    try {
                        resolve(JSON.parse(xhr.responseText));
                    } catch {
                        reject("Invalid JSON response");
                    }
                } else reject(xhr.responseText);
            };

            xhr.onerror = () => reject("Request failed");
            xhr.send();
        });
    }

    sendLocation(lat, lng) {
        if (!this.socket || this.socket.readyState !== WebSocket.OPEN) {
            Toast("WebSocket is not connected", "Error");
            return;
        }

        const data = {
            busId: `BUS-${this.DriverData.id}`,
            lat,
            lng
        };

        this.socket.send(JSON.stringify(data));
        console.log("Location sent:", data);
    }

    goLive() {
        if (this.watchId !== null) {
            Toast("Already Online", "Success");
            return;
        }

        if (!navigator.geolocation) {
            Toast("Geolocation is not supported by this browser.", "Error");
            return;
        }

        let locationReceived = false;

        this.watchId = navigator.geolocation.watchPosition(
            (pos) => {
                if (!locationReceived) {
                    locationReceived = true;
                    Toast("You are now online", "Success");
                    AddText("#DriverStatus", "ON DUTY");
                    AddText("#head-card-driver-0", "Online");
                    console.log("Driver went online. Watch ID:", this.watchId);
                }

                this.sendLocation(
                    pos.coords.latitude,
                    pos.coords.longitude
                );
            },
            (err) => {
                console.error("GPS error:", err.code, err.message);

                if (err.code === 1)
                    Toast("Location permission denied", "Error");
                else if (err.code === 2)
                    console.log("Location temporarily unavailable. Waiting...");
                else if (err.code === 3)
                    console.log("GPS timeout. Waiting for next location...");
            },
            {
                enableHighAccuracy: false,
                maximumAge: 0,
                timeout: 5000
            }
        );
    }

    pauseShift() {
        if (this.watchId === null) {
            Toast("Driver is already offline", "Error");
            return;
        }

        navigator.geolocation.clearWatch(this.watchId);
        this.watchId = null;

        Toast("Shift paused", "Success");
        AddText("#DriverStatus", "ON PAUSE");
        AddText("#head-card-driver-0", "Offline");
        console.log("Location tracking stopped");
    }
}

const driverDashboard = new DriverDashboard();

export const LoadDriverDashboard = async () => {
    await driverDashboard.init();
};