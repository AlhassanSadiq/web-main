const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".eye-icon"),
      links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
        
    })
})      

links.forEach(link => {
    link.addEventListener("click", e => {
       e.preventDefault(); //preventing form submit
       forms.classList.toggle("show-signup");
    })
})




  
  // Binance

  const binancePay = new BinancePay({
    apiKey: 'Uotm1VzrOEPHhMUjCvSX5KWlLNO03laJPctnMJdnYiIVHoOP2BVHxsVwgdVvyRjR',
    secretKey: 'ZxQBFJrlMhu25da4Fj1aBhZr7hAmsjsOXolF1MR6oCdmxTlDBDIDb8xb145ze7UC',
  });

document.querySelector('.top-up-button').addEventListener('click', () => {
    // Retrieve the selected payment amount from the dropdown
    const selectedAmount = document.querySelector('select[name="topup_amount"]').value;
  
    // Create a payment request
    const paymentRequest = {
      productId: 'YOUR_PRODUCT_ID',
      amount: parseFloat(selectedAmount), // Convert the selected amount to a float
      currency: 'USD', // Replace with your desired currency
      description: 'Payment for Porcodes', // Replace with a description
    };
  
    // Use the Binance Pay SDK to create the payment
    binancePay.createPayment(paymentRequest)
      .then((paymentUrl) => {
        // Redirect the user to the Binance Pay payment page
        window.location.href = paymentUrl;
      })
      .catch((error) => {
        console.error('Error creating payment request:', error);
      });
  });
  