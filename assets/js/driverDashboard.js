import { AddText } from "../../utils/addText.js";
import { Toast } from "../../utils/toast.js";

const { BASEURL, SOCKETPATH } = window.CONFIG;

export const LoadDriverDashboard = async () => {
    const container = document.getElementById("drivers-dashboard");
    if (!container) return;
    const dashboardControls = document.getElementById("dashboard-control");
    if (!dashboardControls) return;

    try {
        const socket = new WebSocket(SOCKETPATH);





        let DriverData = await fetchDriverData();



        let watchId = null;
        socket.onerror = (error) => {
            console.error("WebSocket error:", error);
            Toast(error.name)
        };

        dashboardControls.addEventListener("click", (e) => {
            const button = e.target.closest("button");

            if (!button) return;

            switch (button.innerText.trim()) {

                case "Edit Profile":
                    break;

                case "Pause Shift":
                    watchId = handlePauseShift(watchId);
                    break;

                case "Go Online":
                    handleGoLive(
                        watchId,
                        socket,
                        (newWatchId) => {
                            watchId = newWatchId;
                        },
                        DriverData
                    );
                    break;
            }
        });
    } catch (err) {
        console.log("failed to connect with socket")
    }
};


// let DriverData = await fetchDriverData();

// console.log(DriverData);

function fetchDriverData() {
    return new Promise((resolve, reject) => {

        const xhr = new XMLHttpRequest();

        xhr.open(
            "GET",
            `${BASEURL}api/main.php?action=get-driver-details`,
            true
        );

        xhr.setRequestHeader("Authorization", localStorage.getItem("jwtToken"));
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = () => {
            console.log(xhr.responseText)
            if (xhr.status === 200) {
                resolve(JSON.parse(xhr.responseText));
            } else {
                reject(xhr.responseText);
            }
        };

        xhr.onerror = () => {
            reject("Request failed");
        };

        xhr.send();
    });
}

function sendLocation(lat, lng, socket, DriverData) {

    if (socket.readyState !== WebSocket.OPEN) {
        console.warn("WebSocket is not connected");
        Toast(
            `WS ERROR Type: ${event.type} State: ${socket.readyState}`,
            "Error"
        );
        Toast("WebSocket is not connected", "Error");
        return;
    }

    const data = {
        busId: `BUS-${DriverData.id}`,
        lat: lat,
        lng: lng
    };

    socket.send(JSON.stringify(data));

    console.log("Location sent:", data);
}


function handleGoLive(watchId, socket, setWatchId, DriverData) {

    if (watchId !== null) {
        console.log("Already online");
        Toast("Already Online", "Success");
        return;
    }

    if (!navigator.geolocation) {
        Toast(
            "Geolocation is not supported by this browser.",
            "Error"
        );
        return;
    }

    let activeWatchId = null;
    let locationReceived = false;

    activeWatchId = navigator.geolocation.watchPosition(
        (pos) => {
            if (!locationReceived) {

                locationReceived = true;

                // GPS is actually working
                setWatchId(activeWatchId);

                console.log(
                    "Driver went online. Watch ID:",
                    activeWatchId
                );

                Toast("You are now online", "Success");
                AddText("#DriverStatus", "ON DUTY");
            }

            sendLocation(
                pos.coords.latitude,
                pos.coords.longitude,
                socket,
                DriverData
            );
        },
        (err) => {
            console.error("GPS error:", err.code, err.message);

            if (err.code === 1) {
                Toast("Location permission denied", "Error");
            }
            else if (err.code === 2) {
                console.log("Location temporarily unavailable. Waiting...");
            }
            else if (err.code === 3) {
                console.log("GPS timeout. Waiting for next location...");
            }
        },
        {
            enableHighAccuracy: false,
            maximumAge: 0,
            timeout: 5000
        }
    );
}




function handlePauseShift(watchId) {
    if (watchId === null) {
        Toast("Driver is already offline", "Error");
        return null;
    }
    navigator.geolocation.clearWatch(watchId);

    Toast("Shift paused", "Success");
    AddText("#DriverStatus", "ON PAUSE");
    console.log("Location tracking stopped");

    return null;
}