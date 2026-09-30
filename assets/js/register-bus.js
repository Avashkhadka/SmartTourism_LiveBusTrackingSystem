import { handleLoading } from "../../utils/handleLoading.js";
import { Toast } from "../../utils/toast.js";

const { BASEURL } = window.CONFIG;

export const LoadRegisterBus = () => {

    const container = document.getElementById("bus-registeration");
    if (!container) return;
    const registerForm = document.getElementById("bus-registartion-form");
    const operating_route = document.getElementById("operating_route");
    registerForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleRegisterBus(registerForm);
    });
    fetchRouteData(operating_route);
};

const fetchRouteData = async (operating_route) => {
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
    let data = await res.json();
    let optionHtml = "<option selected>Select Route</option>";

    if (data.status == 200) {
        if (data.route.length > 0) {
            data.route.forEach((el) => {
                optionHtml += /*html*/`
                <option value="${el.route_id}">${el.route_name}</option>
            `;
            });

            operating_route.innerHTML = optionHtml;
        }
        console.log(operating_route)
    } else if (data.status == 401) {
        Toast(res.statusText, "Error");

        // setTimeout(() => {
        //     window.location.href = "../global/logout.php";
        // }, 2000);

        return;
    }
    else {
        Toast("Failed to load Routes", "Error");
    }

    console.log(operating_route);
    console.log(data);
}

const handleRegisterBus = async (registerForm) => {
    const formData = new FormData(registerForm);
    formData.append("action", "registerBus");

    const bus_number = formData.get("bus_number");
    const bus_type = formData.get("bus_type");
    const total_seats = formData.get("total_seats");
    const bus_fare = formData.get("bus_fare");
    const insurance_number = formData.get("insurance_number");
    const bill_book_no = formData.get("bill_book_no");
    const operating_route = formData.get("operating_route");

    let error = false;

    if ([bus_number, bus_type, total_seats, bus_fare, insurance_number, bill_book_no, operating_route].some(value => !value?.toString().trim())) {
        Toast("Don't leave any fields empty.", "Error");
        error = true;
    }

    if (error) return;

    Toast("Please wait...", "Success");
    handleLoading(true);
    try {
        const res = await fetch(`${BASEURL}api/main.php`, {
            method: "POST",
            body: formData,
        });

        const data = await res.json();
        console.log(data);

        if (data.status == 200) {
            Toast(`${data.message}`, "Success");
            registerForm.reset();
        } else {
            Toast(`${data.message}`, "Error");
        }
    } catch (err) {
        Toast("Something went wrong", "Error");
        console.log(err);
    }

    handleLoading(false);
};