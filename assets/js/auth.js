import { Toast } from "../../utils/toast.js";
const { BASEURL } = window.CONFIG;

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
        handleDrSignUp(drSignInForm);
    });
};

const handleSignIn = async (signInForm) => {
    const signInFormData = new FormData(signInForm);
    let email = signInFormData.get("email");
    let password = signInFormData.get("password");

    let isLoading = false;

    let error = false;
    if ([email, password].some((value) => !value?.trim())) {
        Toast("Don't leave any fields empty.", "Error");
        error = true;
    }
    if (password.length < 8) {
        Toast("Password must be at least 8 Characters", "Error");
        error = true;
    }

    if (error) return;
    Toast("Please wait...", "Success");
    isLoading = true;
    try {
        let res = await fetch(`${BASEURL}api/auth.php`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                action: "login",
                user_info: { email, password },
            }),
        });
        let data = await res.json();
        if (data.status == 200) {
            console.log(data);
            Toast(`${data.message}`, "Success");
            Toast("Redirecting...", "Success");
            setTimeout(() => {
                window.location.href = `${BASEURL}index.php`;
            }, 1000);
            signInForm.reset();
        } else if (data.status == 400) {
            Toast(`${data.message}`, "Error");
        }
    } catch (err) {
        Toast("Something went wrong", "Error");
        console.log(err);
    }
    isLoading = false;
};
const handleDrSignUp = (drSignInForm) => {
    const drSignInFormData = new FormData(drSignInForm);
    let email = drSignInFormData.get("email");
    let password = drSignInFormData.get("password");
};

const handleSignUp = async (signUpForm) => {
    const signUpFormData = new FormData(signUpForm);
    let fname = signUpFormData.get("full_name");
    let nationality = signUpFormData.get("nationality");
    let email = signUpFormData.get("email");
    let phone = signUpFormData.get("phone");
    let country = signUpFormData.get("country");
    let city = signUpFormData.get("city");
    let rememberMe = signUpFormData.get("rememberMe");
    let password = signUpFormData.get("password");
    let cpassword = signUpFormData.get("cpassword");

    let isLoading = false;
    let error = false;
    if ([fname, nationality, email, phone, country, city, password, cpassword].some((value) => !value?.trim())) {
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
    
    if (error) return;
    Toast("Please wait...", "Success");
    isLoading = true;
    try {
        console.log(fname, nationality, email, phone, country, city, password, cpassword)
        let res = await fetch(`${BASEURL}api/auth.php`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                action: "signup",
                user_info: { fname, nationality, email, phone, country, city, password },
            }),
        });
        console.log("reached")
        console.log(res)
        let data = await res.json();
        console.log(res)
        console.log("reached here")
        if (data.status == 200) {
            console.log(data);
            Toast(`${data.message}`, "Success");
            Toast("Redirecting...", "Success");
            setTimeout(() => {
                window.location.href = `${BASEURL}pages/sign-in.php`;
            }, 1000);
            signUpForm.reset();
        } else if (data.status == 409) {
            Toast(`${data.message}`, "Error");
        }
    } catch (err) {
        Toast("Something went wrong", "Error");
        console.log(err);
    }
    isLoading = false;
};
