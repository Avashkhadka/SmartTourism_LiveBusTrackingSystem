<script>

    window.CONFIG = {
        BASEURL: "<?php echo BASEURL ?>",
        SOCKETPATH: "<?php echo SOCKETPATH ?>"
    }
</script>
<!-- <script src="https://cdn.maptiler.com/maplibre-gl-js/v1.13.0-rc.4/mapbox-gl.js"></script> -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script type="module" src="<?php echo BASEURL ?>assets/js/main.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- <script src="https://cdn.maptiler.com/maplibre-gl-js/v1.13.0-rc.4/mapbox-gl.js"></script> -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>



<!-- <script src="https://unpkg.com/maplibre-gl@5.12.0/dist/maplibre-gl.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/eruda"></script>
<script>
    // eruda.init();
    document.addEventListener("DOMContentLoaded", () => {
        const mobNav = document.getElementById("mob-nav");

        mobNav?.addEventListener("toggle", (e) => {
            document.body.style.overflow = e.newState === "open"
                ? "hidden"
                : "";
        });
    });


</script>