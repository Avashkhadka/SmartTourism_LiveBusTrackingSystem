import { Toast } from "../utils/toast.js";
const {BASEURL} = window.CONFIG;

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

const handleSignUp = async (signUpForm) => {
    const signUpFormData = new FormData(signUpForm);
    let fname = signUpFormData.get("full_name");
    let handle = signUpFormData.get("handle");
    let email = signUpFormData.get("email");
    let phone = signUpFormData.get("phone");
    let country = signUpFormData.get("country");
    let city = signUpFormData.get("city");
    let rememberMe = signUpFormData.get("rememberMe");
    let password = signUpFormData.get("password");
    let cpassword = signUpFormData.get("cpassword");

    let error = false;
    if ([fname, handle, email, phone, country, city, password, cpassword].some((value) => !value?.trim())) {
        Toast("Don't leave any fields empty.", "Error");
        error = true;
    }

    if (fname.length < 8) {
        Toast("Name must be at least 8 Characters", "Error");
        error = true;
    }

    if (phone.length < 10) {
        Toast("Number must be at least 10 Characters", "Error");
        error = true;
    }

    if (password.length < 8 || cpassword.length < 8) {
        Toast("Password must be at least 8 Characters", "Error");
        error = true;
    }

    if (cpassword !== password) {
        Toast("Password and Confirm Password Doesn't match", "Error");
        error = true;
    }

    if (!rememberMe) {
        Toast("Please aggree to Terms and Privacy Policy", "Error");
        error = true;
    }

    if(error) return;

    let res = await fetch(`${BASEURL}/api/auth.php`,{
        method:"POST",
        headers:{
            "Content-Type":"application/json"
        },
        body:JSON.stringify({
            action:"login",
            user_info:{fname,handle,email,phone,country,city,password}
        })
    })
    console.log(BASEURL)
    Toast("Please wait. Creating your account", "Success");
    Toast("Redirecting...", "Success");
    signUpForm.reset();
};

