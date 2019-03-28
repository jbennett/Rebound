function webformSquareBootstrap(appId, formNid) {
  var formId = 'webform-client-form-' + formNid;
  var paymentForm = new SqPaymentForm({
    // Initialize the payment form elements
    applicationId: appId,
    inputClass: 'sq-input',
    autoBuild: false,

    // Customize the CSS for SqPaymentForm iframe elements
    inputStyles: [{
      fontSize: '16px',
      // fontFamily: 'futura-pt, sans-serif',
      padding: '0 5px',
      // color: '#373F4A',
      // backgroundColor: 'transparent',
      lineHeight: '32px',
      boxShadow: '2px 2px 6px rgba(0,0,0,0.3) inset',
      // placeholderColor: '#CCC',
      // _webkitFontSmoothing: 'antialiased',
      // _mozOsxFontSmoothing: 'grayscale'
    }],

    applePay: false,
    masterpass: false,
    cardNumber: {
      elementId: 'sq-card-number-' + formNid,
      placeholder: '• • • •  • • • •  • • • •  • • • •'
    },
    cvv: {
      elementId: 'sq-cvv-' + formNid,
      placeholder: 'CVV'
    },
    expirationDate: {
      elementId: 'sq-expiration-date-' + formNid,
      placeholder: 'MM/YY'
    },
    postalCode: {
      elementId: 'sq-postal-code-' + formNid,
      placeholder: '12345'
    },
    callbacks: {
      createPaymentRequest: function () {
        return {
          requestShippingAddress: false,
          requestBillingInfo: true,
          currencyCode: "CAD",
          countryCode: "CA",
          total: {
            label: "Sarnia-Lambton Rebound",
            amount: "100",
            pending: false
          },
          lineItems: [
            {
              label: "Subtotal",
              amount: "100",
              pending: false
            }
          ]
        }
      },
      cardNonceResponseReceived: function (errors, nonce, cardData) {
        if (errors) {
          document.getElementById('error-' + formId).innerHTML = '';
          errors.forEach(function (error) {
            document.getElementById('error-' + formId).innerHTML += error.message + '<br>';
          });

          return;
        }
        document.getElementById('card-nonce-' + formNid).value = nonce;
        // document.getElementById(formId).submit();

      },
      unsupportedBrowserDetected: function () { },
      inputEventReceived: function (inputEvent) {
        console.log(inputEvent);
        switch (inputEvent.eventType) {
          case 'focusClassAdded':
            /* HANDLE AS DESIRED */
            break;
          case 'focusClassRemoved':
            /* HANDLE AS DESIRED */
            break;
          case 'errorClassAdded':
            document.getElementById("error").innerHTML = "Please fix card information errors before continuing.";
            break;
          case 'errorClassRemoved':
            /* HANDLE AS DESIRED */
            document.getElementById("error").style.display = "none";
            break;
          case 'cardBrandChanged':
            /* HANDLE AS DESIRED */
            break;
          case 'postalCodeChanged':
            /* HANDLE AS DESIRED */
            break;
        }
      },
      paymentFormLoaded: function () { }
    }
  });

  if (SqPaymentForm.isSupportedBrowser()) {
    paymentForm.build();
    paymentForm.recalculateSize();
    document.querySelector('#' + formId + ' input[type=submit]').onclick = (function (event) { requestCardNonce(event, paymentForm); });
  }
}

function requestCardNonce(event, form) {
  event.preventDefault();
  form.requestCardNonce();
}
