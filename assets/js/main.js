
import { LoadAuthHandler } from "./auth.js";
import { LoadBusApproval } from "./bus_request.js";
import { LoadContribute } from "./contirbute.js";
import { loadDiscoverpage } from "./discoverPage.js";
import { LoadDriverApproval } from "./driver-approvals.js";
import { LoadDriverDashboard } from "./driverDashboard.js";
import { loadDriverDocumentation } from "./driverdocument.js";
import { LoadDriversSignUp } from "./drivers-sign-up.js";
import { LoadIntersectionObserver } from "./intersectionObserver.js";
import { handleLiveMap } from "./livemap.js";
import { LoadLoationApproval } from "./location-approval.js";
import { HandleOtp } from "./otpPage.js";
import { LoadRegisterBus } from "./register-bus.js";
import { LoadRouteBuild } from "./route-build.js";
import { HandleViewLocation } from "./viewLocation.js";

document.addEventListener("DOMContentLoaded", () => {
    LoadAuthHandler();
    LoadDriversSignUp();
    loadDiscoverpage();
    handleLiveMap();
    LoadContribute();
    LoadLoationApproval();
    LoadDriverDashboard()
    loadDriverDocumentation()
    LoadDriverApproval();
    LoadRegisterBus();
    LoadRouteBuild();
    LoadBusApproval();
    HandleOtp()

    LoadIntersectionObserver();
    HandleViewLocation();
});
