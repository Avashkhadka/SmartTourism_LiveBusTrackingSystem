export function Card(location) {
    let coverImage = JSON.parse(location.images)
    console.log(coverImage)
    return /*html*/ `<article class="w-full reveal card rounded-2xl overflow-hidden shadow-lg" data-location-id="${location.location_id}">
        <div class="relative">
            ${location.images ? `
            <img src="../../${coverImage[0]}" loading="lazy" alt="${location.place_name}" class="w-full object-cover" style='height:230px'>
                `: ''}

                <div class="absolute inset-0 h-full w-full p-4">
                    <div class="flex justify-between items-center">
                        
                        <div class="bg-white py-2 px-4 block text-xs font-bold rounded-full">
                            ${location.place_category}
                        </div>

                        <div
                            class="bg-white p-2 text-lg font-bold rounded-full flex justify-center items-center fav-svg-container">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:cc="http://creativecommons.org/ns#"
                                xmlns:dc="http://purl.org/dc/elements/1.1/">
                                <g transform="translate(0 -1028.4)">
                                    <path
                                        d="m7 1031.4c-1.5355 0-3.0784 0.5-4.25 1.7-2.3431 2.4-2.2788 6.1 0 8.5l9.25 9.8 9.25-9.8c2.279-2.4 2.343-6.1 0-8.5-2.343-2.3-6.157-2.3-8.5 0l-0.75 0.8-0.75-0.8c-1.172-1.2-2.7145-1.7-4.25-1.7z" />
                                </g>
                            </svg>
                        </div>

                    </div>
                </div>
        </div>

        <div class="w-full p-6">

            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-md color-black">
                    ${location.place_name}
                </h3>

                <h3 class="font-medium text-xs color-gray">
                    ${location.distance.toFixed(2)} km
                </h3>
            </div>

            <p class="text-xs color-gray font-medium my-4">
                ${location.short_pitch}
            </p>

            <div class="w-full mb-4" style="border: 1px solid var(--border-gray);"></div>

            <div class="justify-between flex items-center">

                <a class="border-gray flex items-center bg-white py-1 h-8 px-3 text-xs rounded-full cursor-pointer no-underline text-black font-medium"
                    href="live-map.php">
                    Moderate. Rs1000
                </a>

                <a class="border-gray text-white px-4 py-1 h-10 flex items-center text-sm rounded-full cursor-pointer no-underline font-medium active-category"
                    href="view-location.php?location_id=${location.location_id}">
                    Details
                </a>

            </div>
        </div>
    </article>`
}