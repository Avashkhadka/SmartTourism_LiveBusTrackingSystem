const { BASEURL } = window.CONFIG

export const LoadFunction = () => {
    const container = document.getElementById("driverAdmin");
    if (!container) return;

    loadPlatformUsers();

}

async function loadPlatformUsers() {
    const container = document.getElementById("platform_users_list_container");

    if (!container) return;

    try {
        const response = await fetch(`${BASEURL}api/main.php?action=getUsers`, {
            method: "GET",
            headers: {
                Authorization: localStorage.getItem("jwtToken") || ""
            }
        });
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        const data = await response.json();
        const users = data.users || data;
        
        container.innerHTML = `
                                <table id="platform-users-table" class="w-full border-collapse">
                                    <thead>
                                        <tr class="border-b border-gray-200" style="background-color: #FAF8F3">
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">User</th>
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</th>
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Role</th>
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Phone</th>
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Country</th>
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">City</th>
                                            <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            `;

        const tbody = document.querySelector("#platform-users-table tbody");

        users.forEach(user => {
            const row = document.createElement("tr");

            row.className = `
    group
    border-b border-gray-100
    hover:bg-[#fff1ea]
    transition-colors duration-150
    cursor-pointer
`;

            const initials = (user.name || "U")
                .split(" ")
                .map(name => name.charAt(0))
                .join("")
                .substring(0, 2)
                .toUpperCase();

            const role = (user.role || "").toLowerCase();

            const roleClass = role === "driver"
                ? "bg-[#fff1ea] text-[#ff5a1f]"
                : "bg-[#faf8f3] text-[#ff5a1f]";

            row.innerHTML = `
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3 min-w-[180px]">

                                    <div class="
                                        w-10 h-10
                                        rounded-lg
                                        bg-secondary
                                        text-white
                                        flex items-center justify-center
                                        font-semibold
                                        text-sm
                                        shrink-0
                                    ">
                                        ${initials}
                                    </div>

                                    <div class="min-w-0">
                                        <div class="
                                            font-semibold
                                            text-gray-900
                                            text-sm
                                            truncate
                                        ">
                                            ${user.name ?? ""}
                                        </div>

                                        <div class="text-xs text-gray-400 mt-0.5">
                                            #${user.user_id ?? ""}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm text-gray-900">
                                    ${user.email ?? "—"}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="
                                    inline-flex
                                    items-center
                                    px-3 py-1
                                    rounded-full
                                    text-xs
                                    font-medium
                                    bg-success
                                    text-white
                                    ${roleClass}
                                ">
                                    ${user.role ?? "—"}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm text-gray-900">
                                    ${user.phone ?? "—"}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm text-gray-900">
                                    ${user.country ?? "—"}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm text-gray-900">
                                    ${user.city ?? "—"}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm text-gray-900">
                                    ${user.created_at ?? "—"}
                                </span>
                            </td>
                        `;

            tbody.appendChild(row);
        });

        // Initialize DataTable
        $("#platform-users-table").DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            searching: true,
            ordering: true,
            responsive: true,
            order: [[0, "desc"]]
        });

    } catch (error) {
        console.error("Failed to fetch users:", error);

        container.innerHTML = `
            <div class="p-4 text-red-500">
                Failed to load users.
            </div>
        `;
    }
}
