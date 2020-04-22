<div id="live">
    <hr class="o-20" />
    <h3 class="liveText o-90" style="font-family: Mvaamu; color:#3A3A56;  font-size: 25px;">ލައިވް ކަވަރޭޖް<span
        class="badge badge-pill"><img src="icons/liveg.svg" class="icon-size"></span></h3>
    <hr class="o-20" />

    <div class="shadow-sm p-3 mt-2 bg-white rounded" style="border-radius:32px; margin-top: 20px; height: 120px;"
      v-for="feed in feeds">

      <a :href="feed.source" class="link-div">
        <h5 class="divtype o-90" style="font-size: 20px; color:#3A3A56;"> @{{feed.description}}</h5>
      </a>

      <div class="container text-right">
        <h5 class="text-muted"> @{{feed.time}} :  @{{feed.date}}<a class="link-div" :href="feed.source"> 📰</a>
        </h5>
      </div>
    </div>
  </div>