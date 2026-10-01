import { Toast } from "../../utils/toast.js";

const {BASEURL, SOCKETPATH } = window.CONFIG;

class BusBooking {
    constructor() {
        this.buses = [];
        this.init();
    }

    async init() {
        this.ActiveBus = await this.handleSocket();
        this.buses = this.ActiveBus;

        if(this.buses.length>0){
            this.fetchBusData()
        }else{
            Toast("No bus Active","Error")
            setTimeout(() => {
                window.history.back();
            }, 2000);
        }
    }

    async fetchBusData() {
        try {

            const activeBusId = this.buses.map((el) => {
                return el.busId.split("-")[1];
            })

            const res = await fetch(`${BASEURL}api/main.php?action=getActiveBusData&activeBusId=${activeBusId.join(",")}`, {
                method: "GET",
                headers: {
                    Authorization: localStorage.getItem("jwtToken") || ""
                }
            });

            if (res.status === 401) {
                Toast(res.statusText, "Error");

                setTimeout(() => {
                    window.location.href = "../global/logout.php";
                }, 2000);

                return [];
            }

            if (!res.ok) {
                Toast(res.statusText, "Error");
                return [];
            }

            const busData = await res.json();
            console.log(busData)
            // const buses = Array.isArray(busData) ? busData : busData.bus || [];

            // if (!buses.length) {
                // updateMessage(CardContainer, "No bus requests found.");
            // }

            console.log(activeBusId)
            // return buses;
        } catch (err) {
            console.log(err);
            Toast("Failed to fetch bus requests.", "Error");
            return [];
        }

    }

    async handleSocket() {
        const socket = new WebSocket(SOCKETPATH);
        try {
            const buses = await new Promise((resolve, reject) => {
                socket.onopen = () => console.log("Socket connected");

                socket.onmessage = (event) => {
                    const bus = JSON.parse(event.data);
                    const Activebus = bus.filter(el => el.status === "Active");
                    socket.close();
                    resolve(Activebus);
                };

                socket.onerror = () => reject(new Error("Socket connection failed"));
            });

            return buses;
        } catch (err) {
            console.log("failed to connect with socket");
        }
    }
}


export const LoadBusBooking = async () => {
    const container = document.getElementById("bookBusContainer");
    if (!container) return;

    new BusBooking();

}