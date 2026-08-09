
import { LoadAuthHandler } from "./auth.js";
import { LoadContribute } from "./contirbute.js";
import { loadDiscoverpage } from "./discoverPage.js";
import { LoadDriversSignUp } from "./drivers-sign-up.js";
import { LoadIntersectionObserver } from "./intersectionObserver.js";
import { handleLiveMap } from "./livemap.js";
import { LoadLoationApproval } from "./location-approval.js";
import { HandleViewLocation } from "./viewLocation.js";

document.addEventListener("DOMContentLoaded", () => {
    LoadAuthHandler();
    LoadDriversSignUp();
    loadDiscoverpage();
    handleLiveMap();
    LoadContribute();
    LoadLoationApproval();



    LoadIntersectionObserver();
    HandleViewLocation();
});
