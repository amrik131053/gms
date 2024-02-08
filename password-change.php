<?php 
include "header.php";

?>
<style>

.form-container {

  /* padding: 1rem; */
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  /* background-color: #fafafa; */
}

form {
  padding: 3rem;
  display: flex;
  flex-direction: column;
  gap: 2rem;
  width: 100%;
  max-width: 600px;
  background-color: white;
  border: 1px solid rgba(0, 0, 0, 0.12);
  /* border-radius: 0.5rem; */
  /* box-shadow: 0 0 8px 0 rgb(0 0 0 / 8%), 0 0 15px 0 rgb(0 0 0 / 2%), 0 0 20px 4px rgb(0 0 0 / 6%); */
}

.input-container {
  background-color: #f5f5f5;
  position: relative;
  border-radius: 4px 4px 0 0;
  height: 56px;
  transition: background-color 500ms;
}

.input-container:hover {
  background-color: #ececec;
}

.input-container:focus-within {
  background-color: #dcdcdc;
}

label {
  display: block;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 16px;
  color: rgba(0, 0, 0, 0.5);
  transform-origin: left top;
  user-select: none;
  transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1),color 150ms cubic-bezier(0.4, 0, 0.2, 1), top 500ms;
}

input {
  width: 100%;
  height: 100%;
  box-sizing: border-box;
  background: transparent;
  caret-color: var(--accent-color);
  border: 1px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.42);
  color: rgba(0, 0, 0, 0.87);
  transition: border 500ms;
  padding: 20px 16px 6px;
  font-size: 1rem;
}

input:focus {
  outline: none;
  border-bottom-width: 2px;
  border-bottom-color: var(--accent-color);
}

input:focus + label {
  color: var(--accent-color);
}

input:focus + label,
input.is-valid + label {
  transform: translateY(-100%) scale(0.75);
}

input[type=submit] {
  transition: .25s;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.12);
  /* padding: 16px; */
  background-color: #223260;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  font-size: 14px;
}

input[type=submit]:disabled {
  color: #808080;
  background-color: #f5f5f5;
  cursor: not-allowed;
}

input[type=submit]:not(:disabled):hover {
  border-color: transparent;
  background-color: var(--accent-color-opaque);
  color: var(--accent-color);
}

.submit-container {
  border-radius: 4px;
  /* margin-top: 1rem; */
  height: 40px;
}

.show-password {
  transition: opacity .25s;
  position: absolute;
  background-color: transparent;
  right: 0;
  margin: auto;
  top: 0;
  bottom: 0;
  height: fit-content;
  border: none;
  font-size: 10px;
  color: grey;
  cursor: pointer;
  outline: none;
  text-transform: uppercase;
}

.show-password:hover,
.show-password:focus {
  color: black;
}

.input-container:not(:hover, :focus-within) .show-password {
  opacity: 0;
}

.password-requirements {
  display: flex;
  flex-wrap: wrap;
  margin-top: -1rem;
  padding: 0 16px;
}


.requirement {
  font-size: 14px;
  flex: 1 0 50%;
  min-width: max-content;
  margin: 5px 0;
}

.requirement:before {
  content: '\2639';
  padding-right: 5px;
  font-size: 1.6em;
  position: relative;
  top: .15em;
}

.requirement:not(.valid) {
  color: #808080;
}

.requirement.valid {
  color: #4CAF50;
}

.requirement.valid:before {
  content: '\263A';
}

.requirement.error {
  color: red;
}

.hidden {
  display: none;
}

</style>
  <!-- <div class="  card-primary"> -->
 
    <!-- <div class="card-body"> -->
    <div class="form-container">
      
  <form id="form">
  <h4 class="text-center"><b>Change Password</b></h4>
    <div class="input-container">
      <input type="password" id="password" aria-describedby="requirements" required />
      <label for="password">New Password</label>
      <button class="show-password" id="show-password" type="button" role="switch" aria-label="Show password" aria-checked="false">Show</button>
    </div>

    <div id="requirements" class="password-requirements">
      <p class="requirement" id="length">Min. 8 characters</p>
      <p class="requirement" id="lowercase">Include lowercase letter</p>
      <p class="requirement" id="uppercase">Include uppercase letter</p>
      <p class="requirement" id="number">Include number</p>
      <p class="requirement" id="characters">Include a special character: #.-?!@$%^&*</p>
    </div>

    <div class="input-container">
      <input type="password" id="confirm-password" required />
      <label for="confirm-password">Confirm password</label>
    </div>

    <div class="password-requirements">
      <p class="requirement hidden error" id="match">Passwords must match</p>
    </div>

    <div class="submit-container">
      <input type="submit" class="btn " id="submit" disabled style="background-color:#223260;color:white;">
    </div>
    <div id="password-success">
      <center><b><p class="successPass  " style="color:green; display:none;" >Password Change Successfully</p></b></center>
    </div>
  </form>

  
     
    </div>
    <!-- /.login-card-body -->
  <!-- </div> -->
  <p id="ajax-loader"></p>
<script>
  
const inputs = document.querySelectorAll("input");
const form = document.getElementById("form");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");
const showPassword = document.getElementById("show-password");
const matchPassword = document.getElementById("match");
const submit = document.getElementById("submit");

inputs.forEach((input) => {
  input.addEventListener("blur", (event) => {
    if (event.target.value) {
      input.classList.add("is-valid");
    } else {
      input.classList.remove("is-valid");
    }
  });
});

showPassword.addEventListener("click", (event) => {
  if (password.type == "password") {
    password.type = "text";
    confirmPassword.type = "text";
    showPassword.innerText = "hide";
    showPassword.setAttribute("aria-label", "hide password");
    showPassword.setAttribute("aria-checked", "true");
  } else {
    password.type = "password";
    confirmPassword.type = "password";
    showPassword.innerText = "show";
    showPassword.setAttribute("aria-label", "show password");
    showPassword.setAttribute("aria-checked", "false");
  }
});

const updateRequirement = (id, valid) => {
  const requirement = document.getElementById(id);

  if (valid) {
    requirement.classList.add("valid");
  } else {
    requirement.classList.remove("valid");
  }
};

password.addEventListener("input", (event) => {
  const value = event.target.value;

  updateRequirement("length", value.length >= 8);
  updateRequirement("lowercase", /[a-z]/.test(value));
  updateRequirement("uppercase", /[A-Z]/.test(value));
  updateRequirement("number", /\d/.test(value));
  updateRequirement("characters", /[#.?!@$%^&*-]/.test(value));
});

confirmPassword.addEventListener("blur", (event) => {
  const value = event.target.value;
  $('.successPass').hide();
  if (value.length && value != password.value) {
    matchPassword.classList.remove("hidden");
  } else {
    matchPassword.classList.add("hidden");
  }
});

confirmPassword.addEventListener("focus", (event) => {
  matchPassword.classList.add("hidden");
});

const handleFormValidation = () => {
  const value = password.value;
  const confirmValue = confirmPassword.value;

  if (
    value.length >= 8 &&
    /[a-z]/.test(value) &&
    /[A-Z]/.test(value) &&
    /\d/.test(value) &&
    /[#.?!@$%^&*-]/.test(value) &&
    value == confirmValue
  ) {
    submit.removeAttribute("disabled");
    return true;
  }

  submit.setAttribute("disabled", true);
  return false;
  
};

form.addEventListener("change", () => {
  handleFormValidation();
});

form.addEventListener("submit", (event) => {
  event.preventDefault();
  const validForm = handleFormValidation();

  if (!validForm) {
    return false;
  }

    var code = 366;
    const value = password.value;
  const confirmValue = confirmPassword.value;
  var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action_g.php ",
        type: "POST",
        data: {
            code: code,
            confirmValue: confirmValue,value:value
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
              $('.successPass').show();
              SuccessToast('Password Change Successfully');

            }
            else if(response==2)
            {
                matchPassword.classList.remove("hidden");

            }
            else{
                matchPassword.classList.remove("hidden");
            }
        }
    });
});
    </script>
<?php 
include "footer.php";
?>
