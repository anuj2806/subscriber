document.addEventListener("DOMContentLoaded", function () {
    const subscribeForm = document.getElementById("subscribeForm");
    const emailInput = document.getElementById("email");
    const subscribeButton = document.getElementById("subscribeButton");
    const messageDiv = document.getElementById("messageDiv");

    subscribeButton.addEventListener("click", function () {
        const email = emailInput.value;

        if (email === "") {
            messageDiv.textContent = "Please enter an email.";
            return;
        }

        const formData = new FormData();
        formData.append("email", email);

        fetch("subscribe.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            messageDiv.textContent = data.message;
            if(data.message=="Thank you for subscribing!"){
                messageDiv.style.color='green';
            }else if (data.message=="You are already subscribed!") {
                messageDiv.style.color='red';
            } 
        })
        // .catch(error => {
        //     console.error("Error:", error);
        // });
    });
});
