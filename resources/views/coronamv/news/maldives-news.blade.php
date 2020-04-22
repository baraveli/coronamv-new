<div id="mvnews">
    <hr class="o-20" />
    <h3 class="liveText mt-3 o-90" style="font-family: Mvaamu; color:#3A3A56;  font-size: 25px;">ރާއްޖޭގެ ޚަބަރުތައް
      <span class="badge badge-pill"><img src="icons/maldives.svg" class="icon-size"></span></h3>
    <hr class="o-20" />
    <div class="shadow-sm p-3 mt-2 bg-white rounded" style="margin-top: 15px;" v-for="feed in feeds">
      <div class="card-body">
        <a :href="feed.href" class="link-div">
          <h4 class="card-title divtype o-90" style="font-size: 19px; direction: rtl; color:#3A3A56;"> @{{feed.title}}
          </h4>
        </a>


        <div class="container text-right">
          <a :href="feed.href"> <span class="badge badge-pill"><img :src="'icons/' + feed.logo"
                class="icon-size"></span></a>
        </div>

        <div class="container text-left">
          <a :href="'https://www.facebook.com/sharer/sharer.php?u='+ feed.href"><i
              class="fab fa-facebook social-color"></i></a>
          <a :href="'https://twitter.com/intent/tweet?text='+feed.title+'&&url='+ feed.href"><i
              class="fab fa-twitter social-color" style="margin-left:6px;"></i></a>
        </div>

      </div>
    </div>


  </div>