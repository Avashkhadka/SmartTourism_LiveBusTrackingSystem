import { handleLoading } from "../../utils/handleLoading.js";
import { Toast } from "../../utils/toast.js";

const { BASEURL } = window.CONFIG;

export const LoadRegisterBus = () => {
    const registerForm = document.getElementById("bus-registartion-form");

    registerForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleRegisterBus(registerForm);
    });
};

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
            Toast("Bus submitted for verification.", "Success");
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