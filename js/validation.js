$(function() {

  $.validator.setDefaults({
    errorClass: 'help-block',
    highlight: function(element) {
      $(element)
        .closest('.form-group')
        .addClass('has-error');
    },
    unhighlight: function(element) {
      $(element)
        .closest('.form-group')
        .removeClass('has-error');
    }
  });

  //Sign up FORM
  $("#registerform").validate({
  rules: {
      registername: {
      required: true,
      maxlength: 50,
      lettersonly: true
    },
      registerlastname: {
        required: true,
        maxlength: 50,
        lettersonly: true
    },
      registeremail: {
        required: true,
        maxlength: 100,
        myEmail: true
    },
      registerpassword: {
        required: true,
        maxlength: 255,
        pwcheck: true
    }
  },
  messages: {
      registername: {
      required: "Emri nuk munde te lihet i zbrazet",
      maxlength: "Keni tejkaluar gjatesin e lejuar",
      lettersonly: "Shenoni vetem shkronja"
    },
      registerlastname: {
        required: "Mbiemri nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        lettersonly: "Shenoni vetem shkronja"
    },
      registeremail: {
        required: "Email nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar"
    },
      registerpassword: {
        required: "Passwordi nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        pwcheck: "min 6 characters,letters,upperlatters and numbers"
    }

  }
  }),
  //Admin new user
    $( "#admin_new_user" ).validate({
  rules: {
      emri: {
      required: true,
      maxlength: 50,
      lettersonly: true
    },
      mbiemri: {
        required: true,
        maxlength: 50,
        lettersonly: true
    },
      email: {
        required: true,
        maxlength: 100,
        myEmail: true
    },
    password: {
        required: true,
        maxlength: 255,
        pwcheck: true
    },
    telefoni1: {
        maxlength: 20,
        number: true
    },
    telefoni2: {
        maxlength: 20,
        number: true
    },
    foto: {
        extension: "jpg|png|jpeg"
    },
  },
  messages: {
      emri: {
      required: "Emri nuk munde te lihet i zbrazet",
      maxlength: "Keni tejkaluar gjatesin e lejuar",
      lettersonly: "Shenoni vetem shkronja"
    },
      mbiemri: {
        required: "Mbiemri nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        lettersonly: "Shenoni vetem shkronja"
    },
      email: {
        required: "Email nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar"
    },
      password: {
        required: "Passwordi nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        pwcheck: "min 6 characters,letters,upperlatters and numbers"
    },
    telefoni1: {
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        number: "Shenoni vetem numra"
    },
    telefoni2: {
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        number: "Shenoni vetem numra"
    },
    foto: {
        extension: "Formati i fotos gabim"
    },

  }
  }),
  //Review
  $( "#review_form" ).validate({
  rules: {
    review: {
      required: true,
      maxlength: 1000
    },
    vote: {
      required: true,
      range: [1, 5]
    }
  },
  messages: {
    review: {
      required: "Nuk munde te lihet e zbrazet",
      maxlength: "Keni tejkaluar gjatesin e lejuar"
    },
    vote: {
      required: "Duhet te zgjedhi nje vote",
      range: "Duhet te zgjedhi nje vote"
    }
  }
  }),
    //Login FORM
  $( "#loginform" ).validate({
  rules: {
      loginemail: {
        required: true,
        maxlength: 100,
        myEmail: true
    },
      loginpassword: {
        required: true,
        maxlength: 255,
        pwcheck: true
    }
  },
  messages: {
      loginemail: {
        required: "Email nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar"
    },
      loginpassword: {
        required: "Passwordi nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar",
        pwcheck: "min 6 characters,letters,upperlatters and numbers"
    }

  }
  }),
      //Shpallja FORM
  $( "#shpallja_form" ).validate({
  rules: {
      titulli: {
        required: true,
        maxlength: 50
    },
      short_pershkrimi: {
        required: true,
        maxlength: 150,
    },
    foto: {
        required: true,
        extension: "jpg|png|jpeg"
    },
    cmimi: {
      required: true
    },
    qyteti: {
      required: true
    },
    adresa: {
      required: true
    }
  },
  messages: {
      titulli: {
        required: "titulli nuk mund te lihet i zbrazet",
        maxlength: "Keni tejkaluar gjatesin e lejuar"
    },
      short_pershkrimi: {
        required: "Jepeni nje pershkrim te shkurter",
        maxlength: "Keni tejkaluar gjatesin e lejuar"
    },
    foto: {
        required: "Ngarko foton",
        extension: "Formati i fotos gabim"
    },
    cmimi: {
      required: "Cmimi nuk munde te lihet i zbrazet"
    },
    qyteti: {
      required: "Qyteti nuk munde te lihet i zbrazet"
    },
    adresa: {
      required: "Adresa nuk munde te lihet e zbrazet"
    }

  }
  });
});

// create your custom rule
jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Formati i email-it gabim');

$.validator.addMethod("pwcheck", function(value) {
   return  (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d!@#$%& _*]{6,}$/).test(value) //8 KARAKTERE , LETER E MADHE E VOGEL EDHE NUMER
});