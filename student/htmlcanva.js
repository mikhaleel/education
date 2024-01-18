function makePayment() {
       //  let refno ='NSPZEVAPP'+Math.floor((Math.random() * 1000000000) + 1);

    FlutterwaveCheckout({
     // public_key: "FLWPUBK_TEST-SANDBOXDEMOKEY-X",
     public_key: "FLWPUBK-993353b917cbc6dbf275ba7f099382fc-X",
      tx_ref: 'NSPZEVAPP'+Math.floor((Math.random() * 1000000000) + 1),
      amount: document.getElementById("amount").value,
      currency: "NGN",
      payment_options: "card, banktransfer, ussd",
      redirect_url: "app_transaction_verify?txid="+document.getElementById("txid").value+"&id="+document.getElementById("student_id").value,
      meta: {
        consumer_id: document.getElementById("matno").value,
        consumer_mac: document.getElementById("names").value + "-" + document.getElementById("matno").value + "-" + document.getElementById("extra").value + "-Evening",
      },
      customer: {
        email: document.getElementById("email").value,
        phone_number: document.getElementById("phone").value,
        name: document.getElementById("names").value,
      },
      customizations: {
        title: "FLAILAS",
        description: document.getElementById("desc").value,
        logo: "https://flailas.sch.ng/logo.png",
      },
    });
  }
 
  function SquadPay() {
     let refno ='NSPZEVAPP'+Math.floor((Math.random() * 1000000000) + 1);

 const squadInstance = new squad({
      onClose: () => swal("Oops!", " Payment cancelled.", "info"),
      onLoad: () => console.log("Widget loaded successfully"),
     
      onSuccess: () => window.location.href="app_transaction_verifys?txid="+document.getElementById("txid").value+"&id="+document.getElementById("student_id").value+"&sys="+refno,
        key: "pk_37ff2b25593f8a389a0b9f55407c52d264f98be2",

     //key: "pk_37ff2b25593f8a389a0b9f55407c52d264f98be2",
      email: document.getElementById("email").value,
      amount: document.getElementById("amount").value * 100,
      currency_code: "NGN",
      customer_name: document.getElementById("names").value + "-" + document.getElementById("matno").value + "-" + document.getElementById("extra").value + "-Evening", 
     transaction_ref: refno,
      transaction_memo: document.getElementById("desc").value + "-EVApplication-" + document.getElementById("category").value + "-" + document.getElementById("dated").value + "-" + document.getElementById("memo").value,
     
      metadata: {
        custom_fields: [
           {
              display_name: 'customer_name',
                 value: document.getElementById("names").value + "-" + document.getElementById("matno").value + "-" + document.getElementById("extra").value + "-Evening"

           }
        ],
      }
    });
    squadInstance.setup();
    squadInstance.open();
      }