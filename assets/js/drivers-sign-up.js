export const LoadDriversSignUp = () => {
    const nextBtn = document.getElementById("nextPage");
    const prevBtn = document.getElementById("prevPage");
    const submitBtn = document.getElementById("dr-sign-up-submit");
    const drSignInFormContent = document.querySelectorAll(".dr-sign-form-content");
    const driverSignLine = document.querySelector(".driver-sign-line");
    const countShowContainer = document.getElementById("list-dr-sign");
    const inputs = document.querySelectorAll('input[type="file"]');
    const fileName = document.getElementById("file-name");

    if (!nextBtn && !drSignInFormContent && !driverSignLine && !countShowContainer) return;

    let current = 0;

    let countHtml = "";
    drSignInFormContent?.forEach((el, i) => {
        countHtml += `<span class="h-8 w-8 text-white flex flex-shrink justify-center items-center rounded-full bg-secondary p-2 z-1">${i + 1}</span>`;
    });
    if (countShowContainer) {
        countShowContainer.insertAdjacentHTML("beforeend", countHtml);
    }

    nextBtn?.addEventListener("click", (e) => {
        // if (current == drSignInFormContent.length - 1) {
        //     // nextBtn.type = "submit";
        // } else {
            if (current == drSignInFormContent.length - 2) {
                submitBtn.classList.remove("hidden");
                nextBtn.classList.add("hidden");
            //     nextBtn.innerText = "Create a account";
            }
            prevBtn.disabled = false;
            prevBtn.classList.add("bgcolor-secondary", "text-white");
            prevBtn.classList.remove("bg-disabled", "text-black");
            drSignInFormContent[current].classList.remove("flex", "flex-col");
            drSignInFormContent[current].classList.add("hidden");
            drSignInFormContent[current + 1].classList.remove("hidden");
            drSignInFormContent[current + 1].classList.add("flex", "flex-col");
            current += 1;
            driverSignLine.style.width = `${(100 / (drSignInFormContent.length - 1)) * current}%`;
        // }
    });

    prevBtn?.addEventListener("click", () => {
        nextBtn.type = "button";
        if (current == 1) {
            prevBtn.disabled = true;
            prevBtn.classList.remove("bgcolor-secondary");
            prevBtn.classList.add("bg-disabled", "text-black");
        }
        // nextBtn.innerText = "Next";
        submitBtn.classList.add("hidden");
        nextBtn.classList.remove("hidden");
        drSignInFormContent[current].classList.remove("flex", "flex-col");
        drSignInFormContent[current].classList.add("hidden");
        drSignInFormContent[current - 1].classList.remove("hidden");
        drSignInFormContent[current - 1].classList.add("flex", "flex-col");
        current -= 1;
        driverSignLine.style.width = `${(100 / (drSignInFormContent.length - 1)) * current}%`;
    });
    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            let labelId = `#label_${input.id}`;
            const label = document.querySelector(labelId);
            console.log(label);
            label.textContent = input.files[0].name;

            // fileName.textContent = input.files.length ? input.files[0].name : "";
        });
    });
};
