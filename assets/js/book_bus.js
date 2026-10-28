import { AddText } from "../../utils/addText.js";
import { calculateDistance } from "../../utils/calculateDistance.js";
import { Toast } from "../../utils/toast.js";

const { BASEURL, SOCKETPATH } = window.CONFIG;

class BusBooking {
    constructor() {
        let params = new URLSearchParams(window.location.search);

        this.buses = [];
        this.busDatas = null;

        this.locationId = params.get("location_id");
        this.lat = params.get("lat");
        this.lng = params.get("lng");
        this.eta = params.get("eta");
        this.est_fare = params.get("est_fare");
        this.entry_fee = params.get("entry_fee");
        this.how_to_reach = params.get("how_to_reach");


        AddText("#busEstEntryFeesl", this.entry_fee);
        AddText("#busETAsl", ` ${this.eta} min`);
        AddText("#busEstfairsl", `Rs ${this.est_fare}`);

        this.availableBusContainer = document.querySelector(".available_bus_container");
        this.busEstEntryFee = document.querySelector("#busEstEntryFeebs")
        this.init();
    }

    async init() {
        this.ActiveBus = await this.handleSocket();
        console.log("Active Bus", this.ActiveBus);
        this.buses = this.ActiveBus;

        if (this.buses.length > 0) {
            this.busDatas = await this.fetchBusData()

            this.findBusToRoute(this.lat, this.lng)
        } else {
            Toast("No bus Active", "Error")
            setTimeout(() => {
                window.history.back();
            }, 2000);
        }
    }

    async findBusToRoute(lat, lng) {
        const targetLat = parseFloat(lat);
        const targetLng = parseFloat(lng);
        const buses = this.busDatas
            .map(bus => {
                const distances = bus.route_stops.map(stop =>
                    calculateDistance(
                        stop.lat,
                        stop.lng,
                        targetLat,
                        targetLng
                    )
                );
                const busData = this.buses.find(b => b.busId.split("-")[1] === bus.bus_id);

                let distanceFromBus = calculateDistance(busData.lat, busData.lng, this.lat, this.lng);
                const distance = Math.min(...distances);

                return {
                    ...bus,
                    distance,
                    distanceFromBus
                };
            })
            .filter((bus) => {  
                // console.log(this.how_to_reach === "bus_walk")

                // if (this.how_to_reach === "bus_walk") { return bus.distance < 0.1 && bus.distanceFromBus < 30 }
                // else if (this.how_to_reach === "walking") { return bus.distance < 0.8 && bus.distanceFromBus < 30 }
                // else if (this.how_to_reach === "trek") { return bus.distance < 1.5 && bus.distanceFromBus < 30 }
                // else if (this.how_to_reach === "bus") { return bus.distance < 0.5 && bus.distanceFromBus < 30 }
                
                return bus.distance < 0.5 && bus.distanceFromBus < 30  
            });
        this.populateBus(buses);

        return buses;
    }

    async populateBus(buses) {
        this.availableBusContainer.innerHTML = "";
        console.log(this.buses);
        if (buses.length === 0) {

            this.availableBusContainer.innerHTML = `
                <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray" >
                    No bus available for this route.
                </div>
            `;
            return;
        } else {
            buses.forEach((bus, i) => {


                const busCard = document.createElement("div");
                busCard.classList.add("bus-card", "border", "rounded-lg");
                busCard.innerHTML =/*html*/`
                     <div class="available_bus_card flex shadow-md  w-full gap-4 rounded-3xl border-gray p-4">
                                <input type="radio" name="availableBus" id="bus_id_${i}">
                                <label for="bus_id_${i}" class="w-full">
                                    <div class="flex justify-between w-full">
                                        <div class="flex flex-col gap-2">
                                            <span class="font-bold">

                                               Bus Number: ${bus.bus_number || "N/A"}
                                            </span>
                                            <span class="color-gray">${bus.route_name}</span>
                                        </div>
                                        <div class="flex flex-col gap-2 color-gray text-sm items-end ">
                                            <span class="font-semibold text-md text-white bg-secondary rounded-full w-fit px-6  text-center py-2">

                                                 ${Math.round((bus.distanceFromBus / 20) * 60)} min
                                            </span>
                                            <span>
                                                ${bus.seat_capacity} seats | ${bus.vehicle_type}
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                `;
                this.availableBusContainer.appendChild(busCard);
            })
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

            return busData.bus;
        } catch (err) {
            console.log(err);
            Toast("Failed to fetch bus requests.", "Error");
            return [];
        }

    }

    async handleSocket() {
        try {
            const socket = new WebSocket(SOCKETPATH);
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