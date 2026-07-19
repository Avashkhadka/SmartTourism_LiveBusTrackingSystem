import { Toast } from "../../utils/toast.js";
const { BASEURL } = window.CONFIG;

export const LoadAuthHandler = () => {
    console.log("LoadAuthHandler initialized");
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
        handleDrSignUp(drSignInForm, e);
    });
};

const handleSignIn = async (signInForm) => {
    const signInFormData = new FormData(signInForm);
    signInFormData.append("action", "login");
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

            body: signInFormData,
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
const handleDrSignUp = async (drSignInForm, e) => {
    console.log("handleDrSignUp called");
    e.preventDefault();
    const drSignInFormData = new FormData(drSignInForm);
    drSignInFormData.append("action", "driverSignup");
    let full_name = drSignInFormData.get("full_name");
    let date_of_birth = drSignInFormData.get("date_of_birth");
    let email = drSignInFormData.get("email");
    let phone = drSignInFormData.get("phone");
    let id_front_photo = drSignInFormData.get("id_front_photo");
    let id_back_photo = drSignInFormData.get("id_back_photo");
    let password = drSignInFormData.get("password");
    let cPassword = drSignInFormData.get("cPassword");

    let license_number = drSignInFormData.get("license_number");
    let lisence_type = drSignInFormData.get("lisence_type");
    let license_issue_date = drSignInFormData.get("license_issue_date");
    let license_expiry_date = drSignInFormData.get("license_expiry_date");
    let issuing_office = drSignInFormData.get("issuing_office");
    let year_of_experience = drSignInFormData.get("year_of_experience");
    let license_front_photo = drSignInFormData.get("license_front_photo");
    let license_back_photo = drSignInFormData.get("license_back_photo");
    let rememberMe = drSignInFormData.get("rememberMe");

    let error = false;
    let isLoading = false;

    if (
        [full_name, date_of_birth, email, phone, password, cPassword, license_number, lisence_type, license_issue_date, license_expiry_date, issuing_office, year_of_experience].some(
            (value) => !value?.toString().trim(),
        )
    ) {
        Toast("Don't leave any fields empty.", "Error");
        error = true;
    }

    if ([id_front_photo, id_back_photo, license_front_photo, license_back_photo].some((file) => !file || file.size === 0)) {
        Toast("Please upload all required documents.", "Error");
        error = true;
    }

    if (!rememberMe) {
        Toast("Please accept the Terms and Privacy Policy.", "Error");
        error = true;
    }

    if (cPassword.trim() !== password.trim()) {
        Toast("Password doesn't Match. Please try again", "Error");
        error = true;
    }
    if (error) return;
    Toast("Please wait...", "Success");
    isLoading = true;
    try {
        let res = await fetch(`${BASEURL}api/auth.php`, {
            method: "POST",
            body: drSignInFormData,
        });

        console.log(res);
        if (res.status == 200) {
            // let data1 = await res.text();
            let data= await res.json();
            console.log(data)
            // console.log(data1)
            Toast(`${data.message}`, "Success");
            Toast("Redirecting...", "Success");
            setTimeout(() => {
                window.location.href = `${BASEURL}pages/sign-in.php`;
            }, 5000);
            drSignInForm.reset();

        } else if (res.status == 409) {
            Toast(`${data.message}`, "Error");
        } else {
            console.log("something else");
        }
    } catch (err) {
        Toast("Something went wrong", "Error");
        console.log(err);
    }
    isLoading = false;
    console.log("endss");
};

const handleSignUp = async (signUpForm) => {
    const logs = JSON.parse(localStorage.getItem("logs")) || [];
    console.log("Previous logs:", logs);
    const signUpFormData = new FormData(signUpForm);
    signUpFormData.append("action", "signup");
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
        let res = await fetch(`${BASEURL}api/auth.php`, {
            method: "POST",
            body: signUpFormData,
        });

        let data = await res.json();
        if (data.status == 200) {
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
