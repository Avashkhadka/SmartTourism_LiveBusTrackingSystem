
import { LoadAuthHandler } from "./auth.js";
import { LoadDriversSignUp } from "./drivers-sign-up.js";
import { LoadIntersectionObserver } from "./intersectionObserver.js";

document.addEventListener("DOMContentLoaded", () => {
    LoadIntersectionObserver();
    LoadAuthHandler();
    LoadDriversSignUp();
    


    
});
