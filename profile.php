<?php  
require("./header.php");
?>

<div>
  <h4>profile</h4>
  <div id="userProfile">

  </div>
</div>


<script>
  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  let user=null;
  const userData = JSON.parse(getCookie('crud-user'));
  console.log(userData?.token);
  const jsonData = JSON.stringify({token:userData?.token});
  console.log(jsonData);
  var xhr = new XMLHttpRequest();
  
  xhr.open('POST', `http://localhost/rahat/api/verify-jwt`, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onload = function () {
    if (this.status == 200) {
      user = JSON.parse(this.responseText);
      console.log(user);
      let html = `
      <div>
        <p>Username: <span class="text-primary">${user?.username}</span>  </p>
        <p>Profile: <span class="text-primary"> ${user?.email}</span></p>
      </div>
      `;
      document.getElementById("userProfile").innerHTML = html;
    }
  };

  xhr.send(jsonData);

</script>



<?php  
require("./footer.php");
?>
