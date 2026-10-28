import { AddText } from "../../utils/addText.js";
import { Toast } from "../../utils/toast.js";
const { BASEURL } = window.CONFIG;
export const loadDriverDocumentation = () => {
    const container = document.getElementById("drivers-document");
    if (!container) return;

    const documentForm = document.getElementById("document-verification-form");
    const docGridContainerontainer = document.querySelectorAll(".doc-grid-container>div");
    if (!docGridContainerontainer) return;
    documentForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const documentFormData = new FormData(documentForm);
        documentFormData.append("action", "add_document");
        const data = Object.fromEntries(documentFormData.entries());
        let error = false;
        for (const [key, value] of documentFormData.entries()) {

            if (value instanceof File) {
                if (value.size === 0) {
                    error = true;
                }
                continue;
            }

            if (!value?.toString().trim()) {
                error = true;
            }
        }

        console.log(data);
        if (error) {
            Toast("Don't leave any fields empty.", "Error");
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("POST", `${BASEURL}api/document.php`, true);
        xhr.onload = function () {

            if (xhr.status >= 200 && xhr.status < 300) {

                try {
                    const response = JSON.parse(xhr.responseText);
                    console.log("Parsed response:", response);

                    if (response.success) {
                        Toast("Documents submitted successfully.", "Success");
                    } else {
                        Toast(response.message || "Something went wrong.", "Error");
                    }

                } catch (err) {
                    console.error("JSON Parse Error:", err);
                    console.error("Raw response:", xhr.responseText);

                    Toast("Invalid server response.", "Error");
                }

            } else {

                console.error("HTTP Error:", xhr.status);
                console.error("Server response:", xhr.responseText);

                Toast(`Server error: ${xhr.status}`, "Error");
            }
        };

        xhr.onerror = function () {
            console.error("Network Error");
            Toast("Unable to connect to the server.", "Error");
        };

        xhr.send(documentFormData);
    });


    checkExistingBusData(docGridContainerontainer)

}
const createOverlay = (container, status, style) => {
    let overlay = document.createElement("span");
    overlay.classList.add("flex", "text-xl", "font-bold", "text-black", "flex-col", style, "rounded-xl", 'justify-center', "items-center", "top-0", "left-0", "h-full", "w-full", "absolute")
    overlay.innerText = style
    container.appendChild(overlay)
}
const checkExistingBusData = async (container) => {
    try {
        const res = await fetch(
            `${BASEURL}api/main.php?action=getDriverData`,
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

            console.log(data.bus)

            const statuses = [
                data.bus.bill_book_status,
                data.bus.driving_license_status,
                data.bus.insurance_document_status
            ];
            const approved = statuses.filter(s => s === "approved").length;
            const pending = statuses.filter(s => s === "pending").length;
            const rejected = statuses.filter(s => s === "rejected").length;
            console.log(approved, pending, rejected)
            console.log(container)
            statuses.forEach((el, i) => {
                if (el !== "missing") {

                    createOverlay(container[i], i, el)
                }
            })
            console.log("statuses", statuses)
            AddText("#approved-document", `${approved} / 3 approved`)
            AddText("#pending-document", `${pending} pending`)
            AddText("#rejected-document", `${rejected} rejected`)

            console.log("Bus data loaded for update");
        } else if (data.status === 200 && !data.bus) {
            return
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

