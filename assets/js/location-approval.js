import { Card } from "../../components/card.js";
import { Toast } from "../../utils/toast.js";
import { VerifyDialog } from "../../utils/viewInfo.js";

const { BASEURL } = window.CONFIG;




export const LoadLoationApproval = async () => {
    const container = document.getElementById("approval-container");
    if (!container) return;

    const CardContainer = document.querySelector(
        "#submission-approval-container"
    );
    const locations = await fetchLocationData(CardContainer)


    CardContainer.classList.add("grid", "sm:grid-cols-1", "md:grid-cols-3", "gap-4")
    PopulateData(CardContainer, locations)


    const showLocationDetail = document.querySelectorAll(".show-location-detail");

    CardContainer.addEventListener("click", async (e) => {
        const button = e.target.closest(".show-location-detail")
        if (!button) return;
        const location_id = button.dataset.location_id;
        const sellocation = locations.find(location => location.location_id == location_id);
        const dialog = document.getElementById("verify-dialog");
        dialog.innerHTML = VerifyDialog(sellocation, "location", BASEURL)
        await loadMap(sellocation.latitude, sellocation.longitude);
        dialog.showModal();

        // const token = localStorage.getItem("jwtToken");

        // const data = new FormData();
        // data.append("action", "actionOnLocation");
        // data.append("location_id", button.dataset.location_id);
        // data.append("locationAction", "approved");

        // const xhr = new XMLHttpRequest();
        // xhr.open("POST", `${BASEURL}/api/contriapi.php`, true);
        // xhr.setRequestHeader("Authorization", token)

        // xhr.onload = function () {

        //     const data = JSON.parse(xhr.responseText);
        //     if (xhr.status === 200) {
        //         Toast(data.message, "Success")
        //         let loc = JSON.parse(localStorage.getItem("locationDataAdmin")).location
        //         loc = loc.map(l => l.location_id === button.dataset.location_id ? { ...l, status: "approved" } : l)
        //         if (!loc.length > 0) {
        //             updateMessage(CardContainer, "No locations Need to be approved.")
        //         }
        //         localStorage.setItem("locationDataAdmin", JSON.stringify({ location: loc }));
        //         PopulateData(CardContainer, loc)

        //     } if (xhr.status === 401) {
        //         Toast(data.message, "Error")
        //     }
        // }
        // xhr.onerror = function () {
        //     Toast("Failed to Approve Location", "Success")
        // }

        // xhr.send(data)

    })


}

async function loadMap(lat, long, placeName) {
    try {
        const latitude = lat;
        const longitude = long;

        const map = L.map("locmap", {
        }).setView([latitude, longitude], 13);

        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup(placeName || "Location").openPopup();
    } catch (err) {
        console.error("Failed to load map:", err);
    }
}



const fetchLocationData = async () => {
    try {

        const res = await fetch(
            `${BASEURL}api/location.php/getlocation`,
            {
                method: "GET",
                headers: {
                    Authorization:
                        localStorage.getItem("jwtToken") || "",
                },
            }
        );
        console.log(res)
        if (res.status === 401) {
            Toast(res.statusText, "Error");

            setTimeout(() => {
                window.location.href = "../global/logout.php";
            }, 2000);

            return;
        }
        if (!res.ok) {
            Toast(res.statusText, "Error");
            return;
        }

        let routes = await res.json();

        // if (!locations.length) {
        //     updateMessage(CardContainer, " No locations found.")
        // }



        return routes

    } catch (err) {
        console.log(err)
    }
}

const PopulateData = (CardContainer, locations) => {
    let pendingCount = locations.filter(
        location => location.status === "pending"
    ).length;

    if (pendingCount > 0) {

        let cardHtml = "";
        locations.forEach(location => {
            if (location.status == "approved") return;
            pendingCount++;
            console.log(location)
            cardHtml +=/*html*/ `     
              <article class="w-full reveal card rounded-2xl overflow-hidden shadow-lg"
              data-location-id="${location.location_id}">
              <div class="relative">
                  <div class=" inset-0 h-full w-full px-4 py-2">
                      <div class="flex justify-between items-center">
                          
                          <div class="bg-white py-2 px-4 block text-xs font-bold rounded-full" style="padding:10px 12px;background-color:#E8F0FD;color:#1f6feb">
                                    ${location.place_category}
                                </div>
                                <div class="bg-white py-2 color-gray px-4 block text-xs font-bold rounded-full">
                                    ${location.created_at.split(" ")[0]}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-full px-6 mb-4">
                        
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-md color-black">
                                ${location.place_name.split(" ").map(e => e.charAt(0).toUpperCase() + e.slice(1)).join(" ")}
                            </h3>
                            
                        </div>
                        
                        <p class="text-xs color-gray font-medium my-4">
                            ${location.short_pitch}
                        </p>
                        <p class="text-xs color-gray font-medium my-4">
                         <i class="fa-classic fa-solid fa-user"></i>     ${location.creator_name.includes(" ")
                    ? location.creator_name.split(" ").map(e => e.charAt(0).toUpperCase() + e.slice(1)).join(" ")
                    : location.creator_name}
                        </p>

                        <div class="w-full mb-4" style="border: 1px solid var(--border-gray);"></div>

                        <div class="justify-end flex items-center">
                            <button class="border-gray text-white px-4 py-1 h-10 flex items-center text-xs rounded-full cursor-pointer no-underline font-medium bg-secondary text-white show-location-detail"
                            data-location_id=${location.location_id}>
                            
                            
                            View
                        </button>
                    </div>
                </div>
            </article>`
        });
        CardContainer.innerHTML = cardHtml
    } else {
        updateMessage(CardContainer, "No locations Need to be approved.")
    }

}

const updateMessage = (CardContainer, message) => {
    CardContainer.classList.remove("grid")
    CardContainer.classList.add("flex")
    CardContainer.innerHTML = `
    <div class="w-full p-16 text-black rounded-lg text-lg text-center border-gray">
                    ${message}
                </div>
            `;
}