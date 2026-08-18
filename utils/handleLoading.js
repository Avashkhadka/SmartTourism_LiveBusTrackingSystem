export function handleLoading(isLoading) {
    document.body.style.overflow = isLoading ? "hidden" : "auto";

    const existingOverlay = document.getElementById("loading-overlay");

    // If loading is finished, remove existing overlay
    if (!isLoading) {
        if (existingOverlay) {
            existingOverlay.close();
            existingOverlay.remove();
        }
        return;
    }

    // Don't create another overlay if one already exists
    if (existingOverlay) {
        return;
    }

    // Create loading overlay
    const loadingOverlay = document.createElement("dialog");

    loadingOverlay.id = "loading-overlay";
    loadingOverlay.className = "loading-overlay";

    loadingOverlay.innerHTML = `
        <div class="loading-spinner">
            <div class="loader"></div>
        </div>
    `;

    document.body.appendChild(loadingOverlay);

    loadingOverlay.showModal();
}