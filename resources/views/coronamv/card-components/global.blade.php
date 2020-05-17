<div class="shadow-sm p-3 mt-2 mb-5 bg-white rounded">
    <div class="flex flex-wrap mt3 nl3 nr3">
      <status-card class="card-settings" text="ރަނގަޅު ވެފައިވާ އަދަދު" colour="t-green"
        :value="infectionData.TotalRecovered"></status-card>
      <status-card class="card-settings" text="ބަލިޖެހިފައިވާ ޢަދަދު" colour="t-orange"
        :value="infectionData.TotalConfirmed"></status-card>
      <status-card class="card-settings" text="މަރުގެ އަދަދު" colour="t-red" :value="infectionData.TotalDeaths">
      </status-card>

      <status-card class="card-settings" text="ފަރުވާ ދެމުންގެންދާ ޢަދަދު" colour="t-yellow"
        :value="(infectionData.TotalConfirmed - infectionData.TotalRecovered - infectionData.TotalDeaths)">
      </status-card>

    </div>

  </div>