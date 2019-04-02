function webformSquareBootstrap(appId, formNid, price) {
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
      placeholder: '1A1 A1A'
    },
    callbacks: {
      createPaymentRequest: function () {
        var subtotal = getSubtotal();
        return {
          requestShippingAddress: false,
          requestBillingInfo: true,
          currencyCode: "CAD",
          countryCode: "CA",
          total: {
            label: "Sarnia-Lambton Rebound",
            amount: subtotal,
            pending: false
          },
          lineItems: [
            {
              label: "Subtotal",
              amount: subtotal,
              pending: false
            }
          ]
        }
      },
      cardNonceResponseReceived: function (errors, nonce, cardData) {
        if (errors) {
          document.getElementById('error-' + formNid).innerHTML = '';
          errors.forEach(function (error) {
            document.getElementById('error-' + formNid).innerHTML += error.message + '<br>';
          });

          return;
        }
        document.getElementById('card-nonce-' + formNid).value = nonce;
        document.getElementById(formId).submit();
      },
      unsupportedBrowserDetected: function () { },
      inputEventReceived: function (inputEvent) {
        switch (inputEvent.eventType) {
          case 'focusClassAdded':
            /* HANDLE AS DESIRED */
            break;
          case 'focusClassRemoved':
            /* HANDLE AS DESIRED */
            break;
          case 'errorClassAdded':
            document.getElementById('error-' + formNid).innerHTML = "Please fix card information errors before continuing.";
            break;
          case 'errorClassRemoved':
            /* HANDLE AS DESIRED */
            document.getElementById('error-' + formNid).style.display = "none";
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
    document.querySelector('#' + formId + ' input[type=submit]').onclick = function (event) {
      event.preventDefault();
      paymentForm.requestCardNonce();
    };

    var $quantityField = jQuery('.sq-quantity-select');
    $quantityField.on('change', udpateSubtotalText);
    $quantityField.on('input', udpateSubtotalText);
    $quantityField.on('keyup', udpateSubtotalText);
  }

  function udpateSubtotalText(event) {
    document.getElementById('sq-card-price-' + formNid).innerHTML = 'Your total is: $' + getSubtotal() + '.';
  }

  function getSubtotal() {
    var quantity = getQuantity();
    var subtotal = parseFloat(price) * quantity;

    return subtotal;
  }

  function getQuantity() {
    var $quantityField = jQuery('.sq-quantity-select');
    return $quantityField.toArray().reduce(function (acc, current) {
      var currentValue = parseInt(current.value, 10);
      if (isNaN(currentValue) || currentValue < 0) {
        currentValue = 0;
        current.value = 0;
      }

      return acc + currentValue;
    }, 0);
  }
}
