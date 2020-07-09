<!-- frontendscripts -->
<script src="{{ asset('js/required/jquery.min.js') }}" ></script>
<script src="{{ asset('js/required/bootstrap.bundle.min.js') }}" ></script>
<script src="{{ asset('dist/js/admin.min.js') }}" ></script>
<script src="{{ asset('js/toastr.min.js') }}" ></script>
<!-- fronEndScriptsEnd -->

<!-- backend scripts -->
<script src="{{ asset('js/required/admin.min.js') }}" ></script>
<script>

(function(){
  function id(v){return document.getElementById(v); }
  function loadbar() {
    var ovrl = id("overlay"),
        prog = id("progress"),
        stat = id("progstat"),
        img = document.images,
        c = 0;
        tot = img.length;

    function imgLoaded(){
      c += 1;
      var perc = ((100/tot*c) << 0) +"%";
      prog.style.width = perc;
      stat.innerHTML = "Loading "+ perc;
      if(c===tot) return doneLoading();
    }
    function doneLoading(){
      ovrl.style.opacity = 0;
      setTimeout(function(){
        ovrl.style.display = "none";
      }, 1200);
    }
    for(var i=0; i<tot; i++) {
      var tImg     = new Image();
      tImg.onload  = imgLoaded;
      tImg.onerror = imgLoaded;
      tImg.src     = img[i].src;
    }
  }
  document.addEventListener('DOMContentLoaded', loadbar, false);
}());
</script>
<!-- backend scripts end -->

@yield('pagespecificscripts')
