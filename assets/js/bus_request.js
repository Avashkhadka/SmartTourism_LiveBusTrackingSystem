import { Toast } from "../../utils/toast.js";
import { VerifyDialog } from "../../utils/viewInfo.js";

const { BASEURL } = window.CONFIG;

export const LoadBusApproval = async () => {
    const container = document.getElementById("bus-approval-container");
    if (!container) return;

    const CardContainer = document.querySelector("#bus-approval-container-card");
    if (!CardContainer) return;
    const Buses = await fetchBusData(CardContainer);

    CardContainer.classList.add("grid", "sm:grid-cols-1", "md:grid-cols-3", "gap-4");
    PopulateData(CardContainer, Buses);

    CardContainer.addEventListener("click", (e) => {
        const viewButton = e.target.closest(".show-bus-detail");

        if (!viewButton) return;

        const bus = Buses.find(bus => bus.bus_id == viewButton.dataset.bus_id);

        if (!bus) return;

        const dialog = document.getElementById("bus-req-dialog");
        const dialogContainer = document.getElementById("dialog-data-bus-container");

        dialogContainer.innerHTML = VerifyDialog(bus, "bus", BASEURL);

        dialog.showModal();
        handleAction(document.getElementById("bus-dialog-actions"));
    });

};
const handleAction = (actions) => {

    actions.addEventListener("click", async (e) => {
        const button = e.target.closest("button");
        if (!button) return;

        const id = button.dataset.id;
        const mode = button.dataset.action;

        if (mode === "close") {
            document.getElementById("bus-req-dialog").close();
            return;
        }

        try {
            const res = await fetch(`${BASEURL}/api/main.php?action=manageRecord&id=${id}&mode=${mode}&tb=bus&tbfn=bus_id`, {
                method: "GET",
                headers: {
                    Authorization: localStorage.getItem("jwtToken") || ""
                }
            });

            const data = await res.json();

            if (data.status === 200) {
                Toast(data.message,"Success");
                document.getElementById("bus-req-dialog").close();
                LoadBusApproval();
            } else {
                Toast(data.message || "Action failed","Error");
            }
        } catch (error) {
            console.error(error);
            Toast("Something went wrong","Error");
        }
    });
};
const fetchBusData = async (CardContainer) => {
    try {
        CardContainer.classList.add("flex");

        const res = await fetch(`${BASEURL}api/main.php?action=getbusrequests`, {
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
        const buses = Array.isArray(busData) ? busData : busData.data || [];

        if (!buses.length) {
            updateMessage(CardContainer, "No bus requests found.");
        }

        return buses;
    } catch (err) {
        console.log(err);
        Toast("Failed to fetch bus requests.", "Error");
        return [];
    }
};

const PopulateData = (CardContainer, buses) => {
    const pendingBuses = buses.filter(
        bus => bus.status?.toUpperCase() === "PENDING"
    );

    const pendingCount = document.getElementById("pending-bus-approval");

    if (pendingCount) {
        pendingCount.textContent = pendingBuses.length;
    }

    if (pendingBuses.length > 0) {
        let cardHtml = "";

        pendingBuses.forEach(bus => {
            cardHtml += /*html*/`
                <article
                    class="w-full reveal card rounded-2xl overflow-hidden shadow-lg"
                    data-bus-id="${bus.bus_id}"
                >
                    <div class="relative">
                        <div class="inset-0 h-full w-full px-4 py-2">
                            <div class="flex justify-between items-center">
                                <div
                                    class="bg-white py-2 px-4 block text-xs font-bold rounded-full"
                                    style="padding:10px 12px;background-color:#E8F0FD;color:#1f6feb"
                                >
                                    Bus
                                </div>

                                <div class="bg-white py-2 color-gray px-4 block text-xs font-bold rounded-full">
                                    ${bus.created_at ? bus.created_at.split(" ")[0] : ""}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full px-6 mb-4 flex flex-col gap-3">

                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-md color-black">
                                ${bus.bus_number || "N/A"}
                            </h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-bus"></i>
                                    <span class="text-black">Vehicle Type:</span>
                                </span>
                                ${bus.vehicle_type || "N/A"}
                            </p>

                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-chair"></i>
                                    <span class="text-black">Seats:</span>
                                </span>
                                ${bus.seat_capacity || "N/A"}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-file"></i>
                                    <span class="text-black">Bill Book:</span>
                                </span>
                                ${bus.bill_book_no || "N/A"}
                            </p>

                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-shield"></i>
                                    <span class="text-black">Insurance:</span>
                                </span>
                                ${bus.insurance_number || "N/A"}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-user"></i>
                                    <span class="text-black">Owner:</span>
                                </span>
                                ${bus.name || "N/A"}
                            </p>

                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-envelope"></i>
                                    <span class="text-black">Email:</span>
                                </span>
                                ${bus.email || "N/A"}
                            </p>
                        </div>

                        <div
                            class="w-full mb-4"
                            style="border:1px solid var(--border-gray);"
                        ></div>

                        <div class="justify-end flex items-center gap-2">
                            <button
                                class="border-gray text-white px-4 py-1 h-10 flex items-center text-xs rounded-full cursor-pointer no-underline font-medium bg-secondary show-bus-detail"
                                data-bus_id="${bus.bus_id}"
                            >
                                View
                            </button>
                        </div>

                    </div>
                </article>
            `;
        });

        CardContainer.innerHTML = cardHtml;
    } else {
        updateMessage(CardContainer, "No Buses Need to be approved.");
    }
};

const updateMessage = (CardContainer, message) => {
    CardContainer.classList.remove("grid");
    CardContainer.classList.add("flex");

    CardContainer.innerHTML = `
        <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray">
            ${message}
        </div>
    `;
};