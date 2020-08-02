<div class="shadow-sm p-3 mt-2 mb-5 bg-white rounded">

    <!-- Maldives pill start-->
    <div class="text-right divtype" style="direction: rtl; ">
      <b-button variant="primary" pill>
        ރާއްޖެ: <b> @{{maldivestotal.local_confirmed}}</b>
      </b-button>
    </div>
    <!-- Maldives pill end-->
    <!--<time class="f6 db gray text-center">LastUpdated:  @{{maldivestotal.created_at | utc().format("LLLL") }}</time> -->
    <p class="text-center" style="font-size: 11px;">Data Source: <a href="https://twitter.com/HPA_MV"
      style="color: #2F80FF;">@HPA</a></p>
    <!-- Maldives stats start-->
    <div class="flex flex-wrap nl3 nr3">
      <status-card class="card-settings" text="ރަނގަޅުވެފައިވާ ޢަދަދު" colour="t-green"
        :value="maldivestotal.total_recovered"></status-card>

      <status-card class="card-settings" text="ބަލިޖެހިފައިވާ ޢަދަދު" colour="t-orange"
        :value="maldivestotal.total_confirmed">
      </status-card>

      <status-card v-if="maldives.cases" class="card-settings" text="މަރުގެ ޢަދަދު"
        colour="t-red" :value="maldivestotal.total_deaths">
      </status-card>
      <status-card class="card-settings" text="ފަރުވާ ދެމުންގެންދާ ޢަދަދު" colour="t-yellow"
        :value="maldivestotal.total_active">
      </status-card>

      <status-card class="card-settings" text="އައިސޮލޭޝަން ފެސިލިޓީތަކުގައި" colour="t-flesh"
        :value="maldivestotal.isolation">
      </status-card>

      <status-card class="card-settings" text="ކަރަންޓީން ފެސިލިޓީތަކުގައި" colour="t-purple"
        :value="maldivestotal.quarantine">
      </status-card>

    </div>

    <hr class="o-60" />


    <h4 class="divtype o-90 text-center" style="font-size: 17px;color: #3A3A56;">ޓެސްޓު ތަކުގެ ނަތީޖާ</h4>
    <p class="text-center" style="font-size: 11px;">Data Source: <a href="https://twitter.com/HPA_MV"
        style="color: #2F80FF;">@HPA</a></p>
    <div class="flex flex-wrap nl3 nr3">
      <status-card class="card-settings" text="ޕޮސިޓިވް" colour="t-orange" :value="maldivestotal.total_confirmed">
      </status-card>

      <status-card class="card-settings" text="ޖުމްލަ" colour="t-black" :value="maldivestotal.samples_tested">
      </status-card>

      <status-card class="card-settings" text="ޕެންޑިން" colour="t-flesh" :value="maldivestotal.samples_pending">
      </status-card>

      <status-card class="card-settings" text="ނެގެޓިވް" colour="t-red" :value="maldivestotal.samples_negative">
      </status-card>
    </div>
    <!-- Maldives stats end-->
  </div>