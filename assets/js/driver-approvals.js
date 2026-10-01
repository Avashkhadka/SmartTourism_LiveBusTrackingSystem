import { Toast } from "../../utils/toast.js";
import { VerifyDialog } from "../../utils/viewInfo.js";

const { BASEURL } = window.CONFIG;

export const LoadDriverApproval = async () => {
    const container = document.getElementById("approval-container");
    if (!container) return;

    const CardContainer = document.querySelector(
        "#drivers-submission-approval-container"
    );
    if (!CardContainer) return;

    const Drivers = await fetchDriversData(CardContainer);
    CardContainer.classList.add(
        "grid",
        "sm:grid-cols-1",
        "md:grid-cols-3",
        "gap-4"
    );

    PopulateData(CardContainer, Drivers);

    CardContainer.addEventListener("click", (e) => {
        const button = e.target.closest(".show-driver-detail");
        if (!button) return;
        const driver_id = button.dataset.driver_id;
        const driver = Drivers.find(driver => driver.user_id == driver_id);
        const dialog = document.getElementById("verify-dialog");

        dialog.innerHTML = VerifyDialog(driver, "driver", BASEURL)

        dialog.showModal();

    })





    // CardContainer.addEventListener("click", (e) => {
    //     const button = e.target.closest(".show-driver-detail");
    //     if (!button) return;

    //     const token = localStorage.getItem("jwtToken");
    //     const data = new FormData();

    //     data.append("action", "actionOnDriver");
    //     data.append("driver_id", button.dataset.driver_id);
    //     data.append("driverAction", "approved");

    //     const xhr = new XMLHttpRequest();

    //     xhr.open("POST", `${BASEURL}/api/driverapi.php`, true);
    //     xhr.setRequestHeader("Authorization", token);

    //     xhr.onload = function () {
    //         const response = JSON.parse(xhr.responseText);

    //         if (xhr.status === 200) {
    //             Toast(response.message, "Success");

    //             let drivers = JSON.parse(
    //                 localStorage.getItem("driverDataAdmin")
    //             );

    //             drivers = Array.isArray(drivers)
    //                 ? drivers
    //                 : drivers.driver || [];

    //             drivers = drivers.map((driver) =>
    //                 driver.driver_id === button.dataset.driver_id
    //                     ? { ...driver, status: "approved" }
    //                     : driver
    //             );

    //             localStorage.setItem(
    //                 "driverDataAdmin",
    //                 JSON.stringify({ driver: drivers })
    //             );

    //             PopulateData(CardContainer, drivers);
    //         }

    //         if (xhr.status === 401) {
    //             Toast(response.message, "Error");
    //         }
    //     };

    //     xhr.onerror = function () {
    //         Toast("Failed to Approve Driver", "Error");
    //     };

    //     xhr.send(data);
    // });
};




const fetchDriversData = async (CardContainer) => {
    try {
        CardContainer.classList.add("flex");

        const res = await fetch(
            `${BASEURL}api/main.php?action=getdrivers`,
            {
                method: "GET",
                headers: {
                    Authorization:
                        localStorage.getItem("jwtToken") || "",
                },
            }
        );

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

        let driverData = await res.json();

        const drivers = Array.isArray(driverData)
            ? driverData
            : driverData.driver || [];

        if (!drivers.length) {
            updateMessage(
                CardContainer,
                "No drivers found."
            );
        }

        return drivers;
    } catch (err) {
        console.log(err);
        return [];
    }
};

const PopulateData = (CardContainer, drivers) => {
    const pendingDrivers = drivers.filter(
        driver =>
        (
            driver.bill_book_status !== "approved" ||
            driver.driving_license_status !== "approved" ||
            driver.insurance_document_status !== "approved"
        )
    );


    document.getElementById("pending-driver").innerText = `${pendingDrivers.length} `
    
    if (pendingDrivers.length > 0) {
        let cardHtml = "";

        pendingDrivers.forEach((driver) => {
            cardHtml += /*html*/`


                <article
                    class="w-full reveal card rounded-2xl overflow-hidden shadow-lg"
                    data-driver-id="${driver.driver_id}"
                >
                    <div class="relative">
                        <div class="inset-0 h-full w-full px-4 py-2">
                            <div class="flex justify-between items-center">
                                <div
                                    class="bg-white py-2 px-4 block text-xs font-bold rounded-full"
                                    style="padding:10px 12px;background-color:#E8F0FD;color:#1f6feb"
                                >
                                    Driver
                                </div>

                                <div class="bg-white py-2 color-gray px-4 block text-xs font-bold rounded-full">
                                    ${driver.created_at.split(" ")[0]}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full px-6 mb-4 flex flex-col gap-3">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-md color-black">
                              ${driver.name}
                            </h3>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-id-card"></i>
                                    <span class="text-black">License Number:</span>
                                </span>
                                ${driver.license_number}
                            </p>
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-envelope"></i>
                                    <span class="text-black">Email:</span>
                                </span>
                                ${driver.email}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-location-dot"></i>
                                    <span class="text-black">Address:</span>
                                </span>
                                ${driver.country}, ${driver.city}
                            </p>
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-flag"></i>
                                    <span class="text-black">Nationality:</span>
                                </span>
                                ${driver.nationality}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-phone"></i>
                                    <span class="text-black">Phone:</span>
                                </span>
                                ${driver.phone}
                            </p>
                            <p class="text-xs color-gray font-medium flex flex-col gap-2">
                                <span>
                                    <i class="fa-classic fa-solid fa-id-card"></i>
                                    <span class="text-black">License Type:</span>
                                </span>
                                ${driver.license_type}
                            </p>
                        </div>
                            
                            <div
                            class="w-full mb-4"
                            style="border: 1px solid var(--border-gray);"
                            ></div>

                        <div class="justify-end flex items-center">
                            <button
                                class="border-gray text-white px-4 py-1 h-10 flex items-center text-xs rounded-full cursor-pointer no-underline font-medium bg-secondary show-driver-detail"
                                data-driver_id="${driver.user_id}"
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
        updateMessage(
            CardContainer,
            "No Drivers Need to be approved."
        );
    }
};

const updateMessage = (CardContainer, message) => {
    CardContainer.classList.remove("grid");
    CardContainer.classList.add("flex");

    CardContainer.innerHTML = `
                <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray" >
                    ${message}
                </div>
    `;
};