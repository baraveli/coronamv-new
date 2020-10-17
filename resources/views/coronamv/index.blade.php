<!DOCTYPE html>
<html lang="dv">

@include('coronamv.partials.header')

<body>
  <main>
    <div class="mw8 center pv4 ph3" id="dashboard">
      <section class="flex-m flex-l w-100 w-75-m w-75-l  center">

        <article class="ph3-m ph3-l">
          <header class="mb3">
            <img src="images/logos.png" class="logo-thub">
          </header>
          <hr class="o-20" />
          <div class="tc relative">
            <h3 class="fw4 ttu mv0 dib ph3 o-90" style="font-family:Mvaamu; color: #3A3A56; font-size: 25px;">ދިވެހި
              ރާއްޖެ<span style="margin-left:5px;"><img src="icons/maldives.svg" class="icon-size"></span></h3>
            <hr class="o-20" />
            
              <b-alert show variant="danger">
    <h6 class="text-center" style="color:white;">Note: We don't maintain this anymore. Because of the government issued <a href="https://covid19.health.gov.mv/dashboard/">dashboard</a></h6>
  </b-alert>
           

          </div>

          <div class="jumbotron">
            <h6 class="text-center o-90">Coronamv Resources</h6>
            <p class="lead text-center">
              A curated list of services offered by maldivian companies to help with the COVID-19 crisis.
            </p>
            <div class="text-center">
              <a href="/resources" class="btn btn-sm" style="background-color: #2F80FF; color:white;">Resources</a>

            </div>
          </div>

          @include('coronamv.card-components.level')

          @include('coronamv.card-components.maldives')

          @include('coronamv.card-components.map')

          @include('coronamv.card-components.islands-table')

          @include('coronamv.card-components.hotline-numbers')

          @include('coronamv.card-components.travel-bans')





          <hr class="o-20" />
          <div class="tc relative">
            <h3 class="fw4 ttu mv0 dib ph3 o-90" style="font-family:Mvaamu; color: #3A3A56; font-size: 25px;">މުޅި
              ދުނިޔެ<span style="margin-left:5px;"><img src="icons/worldwide.svg" class="icon-size"></span></h3>
            <hr class="o-20" />
            <small class="text-muted"><a href="https://www.jhu.edu/" style="color: #2F80FF;">@Johns Hopkins
                University</a></small>
          </div>


          @include('coronamv.card-components.global')


          <hr class="o-20" />

          <h3 class="o-90" style="text-align:center; font-family:Mvaamu; color: #3A3A56; font-size: 25px;">ކޭސް
            ތަކުގެ އަދަދު</h3>
          <hr class="o-20" />

          <graphline title="x" class="shadow-sm p-3 mb-5 bg-white rounded" value="y"></graphline>


         


          <hr class="o-20" />
          <div class="mt4">
            <div class="tc relative" style="margin-bottom: 3px;">
              <h3 class="fw4 ttu mv0 dib ph3 o-90" style="font-family:Mvaamu; color: #3A3A56; font-size: 25px;">
                ޤައުމުތައް
                ވަކި
                ވަކިން</h3>
              <hr class="o-20" />

            </div>

            @include('coronamv.card-components.global-table')

          </div>
    </div>
    </article>
    </section>


    </div>

  </main>
  <section class="mw7 center">
    <hr class="o-20" />
    <h3 class="athelas ph3 ph0-l o-90"
      style="font-family:Mvaamu; text-align:center; color: #3A3A56; font-size: 25px; letter-spacing: 1px;">އިތުރު
      މަޢުލޫމާތު</h3>
    <hr class="o-20" />
    <div class="shadow-sm p-3 mt-2 bg-white rounded">
      <article class="pv4 ph3 ph0-l">
        <div class="flex flex-column flex-row-ns">
          <div class="w-100 w-60-ns pr3-ns order-2 order-1-ns">
            <h1 class="f3 athelas mt0 lh-title divtype o-90" style="color: #3A3A56;">ނޮވެލް ކޮރޯނާ ވައިރަސްއަކީ ކޮބާ؟
            </h1>
            <hr class="o-50" />
            <p class="o-90"
              style="font-family: mvtyper; font-size: 16px; direction: rtl; text-align: right; color: #232D42;">
              ކޮވިޑް-19 ނުވަތަ އާންމު ނަމުންނަމަ ކޮރޯނާ ވައިރަސްއަކީ މުޅިން އަލަށް 2019 ވަނަ އަހަރު ފެނިފައިވާ
              ވައިރަސްއެކެވެ. ކޮރޯނާ ވައިރަސްގެ އާއިލާއަށް ނިސްބަތްވާ މިވައިރަސް އަކީ އެވައިރަސް އަކަށް ވެކްސިން އެއް
              ނުވަތަ ސީދާ މިބައްޔަށް ފަރުވާއެއް އަދި ނުލިބޭ ބައްޔެކެވެ.

              <br>
              <br>

              ޗައިނާގެ ސިޓީއެއް ކަމަށްވާ ވޫހާންގެ މާރުކޭޓް ސަރަހައްދުން ފެތުރެން ފެށި ކަމަށް ބެލެވޭ މި ވައިރަސް އަކީ
              ކޮރޯނާ އާއިލާގެ އެހެން ވައިރަސްތައް ފަދައިން ކޮންމެވެސް ކަހަލަ ޖަނަވާރެއްގެ ފަރާތުން އުފެދިފައިވާ
              ވައިރަސްއެއް ކަމަށްވެއެވެ.
            </p>
          </div>
          <div class="pl3-ns order-1 order-2-ns mb4 mb0-ns w-100 w-40-ns">
            <img src="images/coroa.jpg" class="db">
          </div>
        </div>
      </article>
    </div>
    <article class="pv4 ph3 ph0-l">
      <div class="flex flex-column flex-row-ns">
        <div class="w-100 w-60-ns pr3-ns order-2 order-1-ns">
          <hr class="o-20" />
          <h1 class="f3 athelas mt0 lh-title divtype o-90" style="color: #3A3A56;">ނޮވެލް ކޮރޯނާ ފެތުރެނީ ކިހިނެއް؟</h1>
          <hr class="o-20" />

          <div class="shadow-sm p-3 mt-2 bg-white rounded">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center divtype o-90"
                style="font-size: 14px; text-align:right;">
                ނޮވެލް ކޮރޯނާވައިރަސް ބަލިޖެހިފައިވާ މީހަކު ކެއްސާ ކިނބިހި އެޅުމުގައި ކުޅާއެކު ވައިރަސް ހަށިގަނޑުން
                ނުކުމޭ
                <span class="badge badge-pill"><img src="icons/cough.svg" class="icon-size"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center divtype o-90"
                style="font-size: 14px; text-align:right;">
                ބަލިމީހާ ކެއްސާއިރު 3 ފޫޓް ކައިރީގައި ހުރި މީހެއްގެ އަނގަޔަށް، ނޭފަތަށް ނުވަތަ ލޮލަށް ހިނގައްޖެނަމަ ބަލި
                ޖެހިދާނެ
                <span class="badge badge-pill"><img src="icons/virus.svg" class="icon-size"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center divtype o-90"
                style="font-size: 14px; text-align:right;">
                ކެއްސާ ކިނބިހި އަޅާނަމަ އެހެން މީހުންގެ ސަލާމަތަށްޓަކައި ފޭސް މާސްކް އެޅިދާނެ
                <span class="badge badge-pill"><img src="icons/mask.svg" class="icon-size"></span>
              </li>
            </ul>
          </div>
        </div>
    </article>

    <article class="pv4 ph3 ph0-l">
      <div class="flex flex-column flex-row-ns">
        <div class="w-100 w-60-ns pr3-ns order-2 order-1-ns">
          <hr class="o-20" />
          <h1 class="f3 athelas mt0 lh-title divtype o-90" style="color: #3A3A56;">
            ނޮވެލް ކޮރޯނާގެ ބައެއް އަލާމާތްތަށް
          </h1>
          <hr class="o-20" />
          <div class="shadow-sm p-3 mt-2 bg-white rounded">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-right divtype o-90">
                ކަރުގައި ރިއްސުން
                <span class="badge badge-pill"><img src="icons/throat.svg" class="icon-size"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center divtype o-90">
                ނޭވާލާން އުނދަގޫވުން
                <span class="badge badge-pill"><img src="icons/lungs.svg" class="icon-size"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center divtype o-90">
                ހުންއައުން
                <span class="badge badge-pill"><img src="icons/fever.svg" class="icon-size"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center divtype o-90">
                ކެއްސުން
                <span class="badge badge-pill"><img src="icons/cough.svg" class="icon-size"></span>
              </li>
            </ul>
          </div>
        </div>
    </article>
    <div class="shadow-sm p-3 mt-2 bg-white rounded">
      <div class="list-group">
        <div class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <small class="text-muted"><a href="http://www.health.gov.mv/" style="color: #2F80FF;">@MOH</a></small>
            <h5 class="mb-1 divtype" style="text-align:center; color: #60717B;">މިނިސްޓްރީ އޮފް ހެލްތް ރިޕަބްލިކް އޮފް
              މޯލްޑިވްސް</h5>

          </div>
          <p class="mb-1 divtype-normal o-90" style="margin-top: 5px; text-align:right;">ކެއްސާ، ކިނބިހި އަޅާއިރު
            އަނގަޔާ ނޭފަތް
            ޓިޝޫއަކުން
            ނިވާކުރުން އަދި ބޭނުންކުރި ޓިޝޫ ކުނި ވަށިގަނޑަށް އެއްލާލުމަށްފަހު ސައިބޯނި ލައިގެން ރަނގަޅަށް އަތް ދޮވުން

            <br>
            <br>
            ނިވާކުރުމަށް ޓިޝޫ އެއް ނެތްނަމަ، އަތް އުޅަބޮށިން ލަންބާލުމަށްފަހު، ނޭފަތާއި އަނގަ ނިވާކުރައްވާ.
            <br>
            <br>
            މީލްސް އަދި
            ނޮވެލް ކޮރޯނާވައިރަސްއާ ގުޅޭގޮތުން މައުލޫމާތު ހޯއްދެވުމަށް 1676 އަކަށް ގުޅުއްވާ</p>
        </div>
      </div>
    </div>

    @include('coronamv.news.maldives-news')
   

    @include('coronamv.news.live')

  </section>



  @include('coronamv.partials.footer')



</body>

</html>
