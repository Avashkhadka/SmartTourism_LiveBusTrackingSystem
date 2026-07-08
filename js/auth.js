export const LoadAuthHandler = () => {
    const signInForm = document.getElementById("sign-in-form");
    const signUpForm = document.getElementById("sign-up-form");
    const drSignInForm = document.getElementById("dsign-in-form");

    signInForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleSignIn(signInForm);
    });
    signUpForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleSignUp(signUpForm);

    });
    drSignInForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        const drSignInFormData = new FormData(drSignInForm);
        handleDrSignIn(drSignInForm);
    });
};

const handleSignIn = (signInForm) => {
    const signInFormData = new FormData(signInForm);
    let email = signInFormData.get("email");
    let password = signInFormData.get("password");
};
const handleDrSignIn = (signInForm) => {
    const signInFormData = new FormData(signInForm);
    let email = signInFormData.get("email");
    let password = signInFormData.get("password");
};

const handleSignUp = (signUpForm) => {
    const signUpFormData = new FormData(signUpForm);
    let fname = signUpFormData.get("full_name");
    let handle = signUpFormData.get("handle");
    let email = signUpFormData.get("email");
    let phone = signUpFormData.get("phone");
    let country = signUpFormData.get("country");
    let city = signUpFormData.get("city");
    let rememberMe = signUpFormData.get("rememberMe");
    let password = signUpFormData.get("password");

    if(fname.length<8){
        
    }



};
