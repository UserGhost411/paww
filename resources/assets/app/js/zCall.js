$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
function sel_upload(update_url,csrf,loading_url) {
  var input = document.createElement('input');
  input.type = 'file';
  input.accept = '.jpg,.jpeg,.png';
  input.onchange = e => {
    var file = e.target.files[0];
    var formData = new FormData();
    formData.append("image", file);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (e) {
      if (this.readyState == 4 && this.status == 200) {
        var dat = JSON.parse(this.responseText);
        if (dat.success == true) {
          updateprofilepic(dat['data']['url'],update_url,csrf);
        } else {
          Swal.fire({ type: 'error', title: 'Oops...', text: ss.msg });
        }
      } else if (this.readyState == 4 && this.status == 400) {
        Swal.fire({ type: 'error', title: 'Oops...', text: "Error Happend." });
      }
    };
    xhr.open('POST', "https://api.imgbb.com/1/upload?key=4f75afc566e5f7daf3665f53f78d73e5", true);
    document.getElementById('mypp').src = loading_url;
    xhr.send(formData);
  }
  input.click();
}
function updateprofilepic(url,update_url,csrf) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var ss = JSON.parse(this.responseText);
      if (ss.status == "ok") {
        document.getElementById('mypp').src = "https://cdn.statically.io/img/" + ss.pic + "?f=auto&h=200";
      } else {
        Swal.fire({ type: 'error', title: 'Oops...', text: ss.msg });
      }
    }
  };
  xhttp.open("POST", update_url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.setRequestHeader('X-CSRF-TOKEN',csrf);
  xhttp.send("pic=" + url);
}