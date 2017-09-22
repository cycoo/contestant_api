$.formUtils.addValidator({
  name : 'firstname',
  validatorFunction : function(value, $el, config, language, $form) {
    return parseInt(value, 10) % 2 === 0;
  },
  errorMessage : 'First Name is required',
  errorMessageKey: 'badFirstName'
});

$.formUtils.addValidator({
  name : 'lastname',
  validatorFunction : function(value, $el, config, language, $form) {
    return parseInt(value, 10) % 2 === 0;
  },
  errorMessage : 'Last Name is required',
  errorMessageKey: 'badLastName'
});

$.formUtils.addValidator({
  name : 'dob',
  validatorFunction : function(value, $el, config, language, $form) {
    return parseInt(value, 10) % 2 === 0;
  },
  errorMessage : 'Date of Birth is required',
  errorMessageKey: 'badDOB'
});

$.formUtils.addValidator({
  name : 'address',
  validatorFunction : function(value, $el, config, language, $form) {
    return parseInt(value, 10) % 2 === 0;
  },
  errorMessage : 'Address is required',
  errorMessageKey: 'badAddress'
});