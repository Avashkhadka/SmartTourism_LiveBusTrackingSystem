
import { LoadAuthHandler } from "./auth.js";
import { loadDiscoverpage } from "./discoverPage.js";
import { LoadDriversSignUp } from "./drivers-sign-up.js";
import { LoadIntersectionObserver } from "./intersectionObserver.js";
import { handleLiveMap } from "./livemap.js";
import { HandleViewLocation } from "./viewLocation.js";

document.addEventListener("DOMContentLoaded", () => {
    LoadAuthHandler();
    LoadDriversSignUp();
    loadDiscoverpage();
    handleLiveMap();

    LoadIntersectionObserver();
    HandleViewLocation();
});
