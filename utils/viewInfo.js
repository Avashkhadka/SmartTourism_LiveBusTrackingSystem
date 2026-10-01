export const VerifyDialog = (data, type, BASEURL) => {
    if (type === "driver") {
        return `
           <div class="driver-dialog-content">
           
                   <div class="driver-dialog-header">
                       <div>
                           <h2>Verify Driver</h2>
                           <p>Review driver information and submitted documents.</p>
                       </div>
           
                       <button class="dialog-close-btn"
                           onclick="document.getElementById('verify-dialog').close()">
                           <i class="fa-solid fa-xmark"></i>
                       </button>
                   </div>
           
                   <div class="driver-main-grid">
           
                       <div class="driver-profile-card">
                           <img src="${BASEURL}${data.profile_image}"
                               class="driver-profile-image">
           
                           <h3>${data.name}</h3>
                           <p>${data.email}</p>
           
                           <span class="driver-role">
                               ${data.role}
                           </span>
                       </div>
           
                       <div class="driver-info">
           
                           <div class="driver-section">
                               <h3>Personal Information</h3>
           
                               <div class="driver-info-grid">
                                   <div class="driver-info-item">
                                       <span>Full Name</span>
                                       <strong>${data.name}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Email</span>
                                       <strong>${data.email}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Phone</span>
                                       <strong>${data.phone}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Nationality</span>
                                       <strong>${data.nationality}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Country</span>
                                       <strong>${data.country}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>City</span>
                                       <strong>${data.city}</strong>
                                   </div>
                               </div>
                           </div>
           
                           <div class="driver-section">
                               <h3>Driving Information</h3>
           
                               <div class="driver-info-grid">
                                   <div class="driver-info-item">
                                       <span>License Number</span>
                                       <strong>${data.license_number}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>License Type</span>
                                       <strong>${data.license_type}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Issue Date</span>
                                       <strong>${data.license_issue_date}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Expiry Date</span>
                                       <strong>${data.license_expiry_date}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Issuing Office</span>
                                       <strong>${data.issuing_office}</strong>
                                   </div>
           
                                   <div class="driver-info-item">
                                       <span>Experience</span>
                                       <strong>${data.year_of_experience} Years</strong>
                                   </div>
                               </div>
                           </div>
           
                       </div>
                   </div>
           
                   <div class="driver-section documents-section">
                       <h3>Submitted Documents</h3>
           
                       <div class="documents-grid">
           
                           <div class="document-card">
                               <div class="document-header">
                                   <h4>Bill Book</h4>
                                   <span class="status ${data.bill_book_status}">
                                       ${data.bill_book_status}
                                   </span>
                               </div>
           
                               <div class="document-images">
                                   <img src="${BASEURL}${data.bill_book_front_photo}">
                                   <img src="${BASEURL}${data.bill_book_back_photo}">
                               </div>
                           </div>
           
                           <div class="document-card">
                               <div class="document-header">
                                   <h4>Driving License</h4>
                                   <span class="status ${data.driving_license_status}">
                                       ${data.driving_license_status}
                                   </span>
                               </div>
           
                               <div class="document-images">
                                   <img src="${BASEURL}${data.driving_license_front_photo}">
                                   <img src="${BASEURL}${data.driving_license_back_photo}">
                               </div>
                           </div>
           
                           <div class="document-card">
                               <div class="document-header">
                                   <h4>Insurance</h4>
                                   <span class="status ${data.insurance_document_status}">
                                       ${data.insurance_document_status}
                                   </span>
                               </div>
           
                               <div class="document-images">
                                   <img src="${BASEURL}${data.insurance_document_front_photo}">
                                   <img src="${BASEURL}${data.insurance_document_back_photo}">
                               </div>
                           </div>
           
                       </div>
                   </div>
           
                   <div class="driver-dialog-actions">
                       <button class="py-2 px-4 rounded-full border-none"
                           onclick="document.getElementById('verify-dialog').close()">
                           Cancel
                       </button>
           
                       <button class="py-2 px-4 rounded-full border-none bg-red-500 text-white">
                           Reject
                       </button>
           
                       <button class="py-2 px-4 bg-secondary text-white rounded-full border-none">
                           Approve Driver
                       </button>
                   </div>
           
               </div>
        `;
    }

    if (type === "location") {
        const amenities = data.amenities ? JSON.parse(data.amenities) : [];
        const images = data.images ? JSON.parse(data.images) : [];
        const vibe = data.vibe ? JSON.parse(data.vibe) : [];
        return `

        <div class="driver-dialog-content">
            <div class="driver-dialog-header">
                <div>
                    <h2>Verify Place</h2>
                    <p>Review place information and submitted details.</p>
                </div>
                <button class="dialog-close-btn" onclick="document.getElementById('verify-dialog').close()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="driver-main-grid">
                <div class="driver-profile-card">
                    <img src="${BASEURL}${images[0] || 'assets/images/default-place.jpg'}" class="driver-profile-image">
                    <h3>${data.place_name}</h3>
                    <p>${data.place_category}</p>
                    <span class="driver-role">${data.status}</span>
                </div>

                <div class="driver-info">
                    <div class="driver-section">
                        <h3>Place Information</h3>
                        <div class="driver-info-grid">
                            <div class="driver-info-item">
                                <span>Place Name</span>
                                <strong>${data.place_name}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Category</span>
                                <strong>${data.place_category}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>City / Region</span>
                                <strong>${data.city_region}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Nearest Landmark</span>
                                <strong>${data.nearest_landmark || "Not provided"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Entry Fee</span>
                                <strong>${data.entry_fee === "0.00" ? "Free" : data.entry_fee}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Best Time to Visit</span>
                                <strong>${data.best_time_to_visit || "Not provided"}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="driver-section">
                        <h3>Opening Hours</h3>
                        <div class="driver-info-grid">
                            <div class="driver-info-item">
                                <span>Opening Time</span>
                                <strong>${data.opening_hours || "Not provided"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Closing Time</span>
                                <strong>${data.closing_hours || "Not provided"}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="driver-section">
                <h3>About This Place</h3>
                <p class="place-description">${data.short_pitch || "No description provided."}</p>
            </div>

    
            <div id="locmap" class="h-80 w-full rounded-2xl border-gray"></div>

            <div class="driver-section">
                <h3>Experience Details</h3>
                <div class="place-details">
                    <div class="place-detail-group">
                        <span>Amenities</span>
                        <div class="tag-container">
                            ${amenities.length ? amenities.map(item => `<span class="place-tag">${item}</span>`).join("") : `<span class="empty-value">No amenities provided</span>`}
                        </div>
                    </div>
                    <div class="place-detail-group">
                        <span>Vibe</span>
                        <div class="tag-container">
                            ${vibe.length ? vibe.map(item => `<span class="place-tag">${item}</span>`).join("") : `<span class="empty-value">No vibe specified</span>`}
                        </div>
                    </div>
                    <div class="place-detail-group">
                        <span>How to Reach</span>
                        <p>${data.how_to_reach || "No information provided."}</p>
                    </div>
                </div>
            </div>

            <div class="driver-section">
                <div class="document-header">
                    <h3>Submitted Images</h3>
                    <span class="status ${data.status}">${data.status}</span>
                </div>
                <div class="place-images">
                    ${images.length ? images.map(image => `<img src="${BASEURL}${image}" onclick="window.open(this.src, '_blank')">`).join("") : `<span class="empty-value">No images submitted.</span>`}
                </div>
            </div>

            <div class="driver-section">
                <h3>Submission Information</h3>
                <div class="driver-info-grid">
                    <div class="driver-info-item">
                        <span>Submitted By</span>
                        <strong>${data.creator_name ? data.creator_name.split(" ").map(e => e.charAt(0).toUpperCase() + e.slice(1)).join(" ") : "Unknown"}</strong>
                    </div>
                    <div class="driver-info-item">
                        <span>Created At</span>
                        <strong>${data.created_at}</strong>
                    </div>
                    <div class="driver-info-item">
                        <span>Contribution Agreement</span>
                        <strong>${data.contribute_aggrement == "1" ? "Accepted" : "Not Accepted"}</strong>
                    </div>
                    <div class="driver-info-item">
                        <span>Location ID</span>
                        <strong>#${data.location_id}</strong>
                    </div>
                </div>
            </div>

              <div class="location-dialog-actions">
                       <button class="py-2 px-4 rounded-full border-none"
                           data-action="close">
                           Cancel
                       </button>
           
                        <button
                    data-location_id="${data.location_id}"
                    data-action="reject"
                    class="py-2 px-4 rounded-full border-none bg-secondary text-white">
                    Reject
                </button>

                <button
                    data-location_id="${data.location_id}"
                    data-action="accept"
                    class="py-2 px-4 rounded-full border-none bg-secondary text-white">
                    Approve
                </button>

          
                   </div>
        </div>

        `;
    }

    if (type === "bus") {
        return /*html*/`
        <div class="driver-dialog-content">
            <div class="driver-dialog-header">
                <div>
                    <h2>Verify Bus</h2>
                    <p>Review bus information and submitted details.</p>
                </div>
                <button class="dialog-close-btn" onclick="document.getElementById('bus-req-dialog').close()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="driver-main-grid">
                <div class="driver-profile-card">
                    <img src="${BASEURL}${data.bus_image}" class="driver-profile-image">
                    <h3>${data.bus_number}</h3>
                    <p>${data.vehicle_type}</p>
                    <span class="driver-role">${data.status}</span>
                </div>

                <div class="driver-info">
                    <div class="driver-section">
                        <h3>Bus Information</h3>
                        <div class="driver-info-grid">
                            <div class="driver-info-item">
                                <span>Bus Number</span>
                                <strong>${data.bus_number || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Vehicle Type</span>
                                <strong>${data.vehicle_type || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Seat Capacity</span>
                                <strong>${data.seat_capacity || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Bill Book Number</span>
                                <strong>${data.bill_book_no || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Insurance Number</span>
                                <strong>${data.insurance_number || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Status</span>
                                <strong>${data.status || "N/A"}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="driver-section">
                        <h3>Owner Information</h3>
                        <div class="driver-info-grid">
                            <div class="driver-info-item">
                                <span>Full Name</span>
                                <strong>${data.name || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Email</span>
                                <strong>${data.email || "N/A"}</strong>
                            </div>
                            <div class="driver-info-item">
                                <span>Phone</span>
                                <strong>${data.phone || "N/A"}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="driver-section">
                <h3>Bus Image</h3>
                <div class="place-images">
                    ${data.bus_image ? `
                        <img src="${BASEURL}${data.bus_image}" onclick="window.open(this.src,'_blank')">
                    ` : `
                        <span class="empty-value">No bus image submitted.</span>
                    `}
                </div>
            </div>

            <div class="driver-section">
                <h3>Submission Information</h3>
                <div class="driver-info-grid">
                    <div class="driver-info-item">
                        <span>Submitted By</span>
                        <strong>${data.name || "Unknown"}</strong>
                    </div>
                    <div class="driver-info-item">
                        <span>Created At</span>
                        <strong>${data.created_at || "N/A"}</strong>
                    </div>
                    <div class="driver-info-item">
                        <span>Bus ID</span>
                        <strong>#${data.bus_id || "N/A"}</strong>
                    </div>
                    <div class="driver-info-item">
                        <span>Route</span>
                        <strong>${data.route_name || "N/A"}</strong>
                    </div>
                </div>
            </div>

            <div class="driver-dialog-actions" id="bus-dialog-actions">

                <button
                    data-id="${data.bus_id}"
                    data-action="reject"
                    class="py-2 px-4 rounded-full border-none bg-secondary text-white">
                    Reject
                </button>

                <button
                    data-id="${data.bus_id}"
                    data-action="accept"
                    class="py-2 px-4 rounded-full border-none bg-secondary text-white">
                    Approve
                </button>

                <button
                    data-id="${data.bus_id}"
                    data-action="close"
                    class="py-2 px-4 rounded-full border-none">
                    Close
                </button>

            </div>
        </div>
    `;
    }

    return "";
};