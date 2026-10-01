import { AddText } from "../../utils/addText.js";
import { handleLoading } from "../../utils/handleLoading.js";
import { Toast } from "../../utils/toast.js";

const { BASEURL } = window.CONFIG;

export const LoadRegisterBus = () => {
    const container = document.getElementById("bus-registeration");
    if (!container) return;

    const registerForm = document.getElementById("bus-registartion-form");
    const operating_route = document.getElementById("operating_route");

    if (!registerForm) return;

    fetchRouteData(operating_route);
    checkExistingBusData(registerForm, operating_route);

    registerForm.addEventListener("submit", (e) => {
        e.preventDefault();

        handleRegisterBus(registerForm);
    });

};


const checkExistingBusData = async (registerForm, operating_route) => {
    try {
        const res = await fetch(
            `${BASEURL}api/main.php?action=getUserData`,
            {
                method: "GET",
                headers: {
                    Authorization:
                        localStorage.getItem("jwtToken") || "",
                },
            }
        );

        const data = await res.json();


        if (data.status === 200 && data.bus) {
            // Store bus ID so we know this is an update
            AddText("#register_bus_header", "Update Bus Information");
            document.getElementById("register-bus-image-container").style.display = "none";
            registerForm.dataset.busId = data.bus.bus_id;
            registerForm.querySelector('[name="bus_number"]').value = data.bus.bus_number || "";
            registerForm.querySelector('[name="bus_type"]').value = data.bus.vehicle_type || "";
            registerForm.querySelector('[name="total_seats"]').value = data.bus.seat_capacity || "";
            registerForm.querySelector('[name="bus_fare"]').value = data.bus.bus_fare || "5";
            registerForm.querySelector('[name="insurance_number"]').value = data.bus.insurance_number || "";
            registerForm.querySelector('[name="bill_book_no"]').value = data.bus.bill_book_no || "";

            if (operating_route) {
                operating_route.value = data.bus.route_id || "";
            }

            console.log("Bus data loaded for update");
        } else if (data.status === 404) {
            delete registerForm.dataset.busId;

        } else if (data.status === 401) {
            Toast("Unauthorized. Please login again.", "Error");
        } else {
            Toast("Failed to check bus data.", "Error");
        }
    } catch (err) {
        console.error("Error checking bus data:", err);
        Toast("Something went wrong while checking bus data.", "Error");
    }
};


const fetchRouteData = async (operating_route) => {
    try {
        const res = await fetch(
            `${BASEURL}api/main.php?action=getRoutes`,
            {
                method: "GET",
                headers: {
                    Authorization:
                        localStorage.getItem("jwtToken") || "",
                },
            }
        );

        const data = await res.json();

        let optionHtml = `<option value="">Select Route</option>`;

        if (data.status === 200) {
            if (data.route.length > 0) {
                data.route.forEach((el) => {
                    optionHtml += `
                        <option value="${el.route_id}">
                            ${el.route_name}
                        </option>
                    `;
                });

                operating_route.innerHTML = optionHtml;

                // After routes are loaded, restore existing bus route
                const busRoute = operating_route.dataset.selectedRoute;

                if (busRoute) {
                    operating_route.value = busRoute;
                }
            }
        } else if (data.status === 401) {
            Toast("Unauthorized", "Error");
            return;
        } else {
            Toast("Failed to load Routes", "Error");
        }
    } catch (err) {
        console.error("Error loading routes:", err);
        Toast("Failed to load Routes", "Error");
    }
};


const handleRegisterBus = async (registerForm) => {
    const formData = new FormData(registerForm);

    const busId = registerForm.dataset.busId;

    // If bus ID exists -> update
    // Otherwise -> create
    if (busId) {
        formData.append("action", "updateBus");
    } else {
        formData.append("action", "registerBus");
    }

    const bus_number = formData.get("bus_number");
    const bus_type = formData.get("bus_type");
    const total_seats = formData.get("total_seats");
    const bus_fare = formData.get("bus_fare");
    const insurance_number = formData.get("insurance_number");
    const bill_book_no = formData.get("bill_book_no");
    const operating_route = formData.get("operating_route");

    const fields = [
        bus_number,
        bus_type,
        total_seats,
        bus_fare,
        insurance_number,
        bill_book_no,
        operating_route,
    ];

    if (
        fields.some(
            (value) => !value?.toString().trim()
        )
    ) {
        Toast("Don't leave any fields empty.", "Error");
        return;
    }

    Toast(
        busId
            ? "Updating bus information..."
            : "Registering bus...",
        "Success"
    );

    handleLoading(true);

    try {
        const res = await fetch(`${BASEURL}api/main.php`, {
            method: "POST",
            headers: {
                Authorization:
                    localStorage.getItem("jwtToken") || "",
            },
            body: formData,
        });

        const data = await res.json();

        console.log(data);

        if (data.status === 200) {
            Toast(
                data.message ||
                (busId
                    ? "Bus updated successfully."
                    : "Bus registered successfully."),
                "Success"
            );

            // Don't reset on update
            if (!busId) {
                registerForm.reset();
            }
        } else if (data.status === 401) {
            Toast("Unauthorized. Please login again.", "Error");
        } else {
            Toast(
                data.message || "Something went wrong.",
                "Error"
            );
        }
    } catch (err) {
        console.error(err);
        Toast("Something went wrong", "Error");
    } finally {
        handleLoading(false);
    }
};